<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken as SanctumToken;

class ValidateToken
{
    /** Simple time-to-live for tokens (adjust as you like) */
    private const TOKEN_TTL_DAYS = 30;

    /**
     * Verify the bearer token, delete it when invalid/expired,
     * and authenticate the owner for this request.
     */
    public function handle(Request $request, Closure $next)
    {
        /* ──────────────────────────────────────────────
         | 1. Extract the plain bearer token string      |
         ────────────────────────────────────────────── */
        $plainToken = $request->bearerToken();
        if (! $plainToken) {
            return $this->deny('Bearer token missing.');
        }

        /* ──────────────────────────────────────────────
         | 2. Find the hashed token row in the database |
         ────────────────────────────────────────────── */
        $token = SanctumToken::findToken($plainToken);
        if (! $token) {
            return $this->deny('Invalid token.');     // nothing to delete
        }

        /* ──────────────────────────────────────────────
         | 3. Integrity checks                          |
         ────────────────────────────────────────────── */
        // 3-a) Token has no owner (user deleted?)
        if (! $token->tokenable) {
            $token->delete();                         // wipe orphaned token
            return $this->deny('Token owner no longer exists.');
        }

        // 3-b) Expired?
        if (now()->greaterThan($token->created_at->addDays(self::TOKEN_TTL_DAYS))) {
            $token->delete();                         // wipe expired token
            return $this->deny('Token expired – please log in again.');
        }

        /* ──────────────────────────────────────────────
         | 4. All good – authenticate the user          |
         ────────────────────────────────────────────── */
        Auth::setUser($token->tokenable);             // attaches user to request

        return $next($request);
    }

    /** Consistent JSON 401 helper */
    private function deny(string $msg)
    {
        return response()->json(['error' => $msg], Response::HTTP_UNAUTHORIZED);
    }
}
