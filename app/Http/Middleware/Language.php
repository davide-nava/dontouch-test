<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = \Locale::acceptFromHttp($request->header('Accept-Language')) ?? 'en';

        if (empty($locale) || $locale == '*') {
            $locale = 'en';
        }

        if (str_contains($locale, '_')) {
            $locale = explode('_', $locale)[0];
        }

        if (in_array($locale, ['en', 'it'])) {
            App::setLocale($locale);
        } else {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
