<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and add security headers.
     * Also strips X-Powered-By to avoid leaking PHP version.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Strip X-Powered-By (PHP version disclosure)
        $response->headers->remove('X-Powered-By');
        if (function_exists('header_remove')) {
            @header_remove('X-Powered-By');
        }

        // Clickjacking protection
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        // MIME sniffing protection
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        // Referrer policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        // Permissions-Policy (formerly Feature-Policy)
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        // HSTS is set by Vercel edge, but ensure for non-Vercel env
        if (! $response->headers->has('Strict-Transport-Security')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=63072000; includeSubDomains; preload');
        }

        return $response;
    }
}
