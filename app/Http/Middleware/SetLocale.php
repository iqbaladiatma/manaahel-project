<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from request parameter, session, or default
        $locale = $request->input('locale') 
                  ?? $request->session()->get('locale') 
                  ?? config('localization.default_locale', 'id');
        
        // Validate locale against whitelist
        $supportedLocales = array_keys(config('localization.supported_locales', ['id', 'en', 'ar']));
        
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('localization.default_locale', 'id');
        }
        
        // Set application locale
        app()->setLocale($locale);
        
        // Store locale in session for persistence
        $request->session()->put('locale', $locale);
        
        return $next($request);
    }
}
