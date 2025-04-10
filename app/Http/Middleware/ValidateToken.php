<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\PersonalAccessToken;

class ValidateToken
{
    /**
     * Handle an incoming request and verify the token’s validity.
     *
     * This middleware checks:
     *   - That a user is authenticated.
     *   - That the token used for this request exists (i.e. is present in the personal_access_tokens table).
     *   - Optionally, that the token is not expired.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if a user is authenticated.
        $user = $request->user();
        if (!$user) {
            return response()->json(
                ['error' => 'Unauthorized. Invalid or missing token.'], 
                Response::HTTP_UNAUTHORIZED
            );
        }

        // Retrieve the token used for the current request.
        $token = $user->currentAccessToken();

        if (!$token) {
            return response()->json(
                ['error' => 'Unauthorized. No active token found.'], 
                Response::HTTP_UNAUTHORIZED
            );
        }

        // Additional check: Verify the token still exists in the personal_access_tokens table.
        $storedToken = PersonalAccessToken::find($token->id);
        if (!$storedToken) {
            return response()->json(
                ['error' => 'Unauthorized. Token does not exist.'], 
                Response::HTTP_UNAUTHORIZED
            );
        }

        // Optional: Check if the token is expired. For example, enforce a 30-day expiration period.
        $expirationTime = $token->created_at->addDays(30);
        if (now()->greaterThan($expirationTime)) {
            // Optionally delete the token if expired.
            $token->delete();
            return response()->json(
                ['error' => 'Token expired. Please log in again.'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        // Token is valid, so allow the request to proceed.
        return $next($request);
    }
}
