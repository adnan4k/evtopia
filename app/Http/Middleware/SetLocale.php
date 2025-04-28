<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Skip in console context
        if (App::runningInConsole()) {
            return $next($request);
        }

        // 1) Let Laravel pick the best match from the header vs. your supported list
        $supported = config('app.supported_locales');
        $locale = $request->getPreferredLanguage($supported) ?: config('app.locale');

        // 2) Normalize to two-letter lowercase (optional)
        $locale = strtolower(substr(str_replace('-', '_', $locale), 0, 2));

        // 3) Final whitelist guard
        if (! in_array($locale, $supported)) {
            $locale = config('app.locale');
        }

        // 4) Apply globally
        App::setLocale($locale);
        Carbon::setLocale($locale);

        return $next($request);
    }
}
