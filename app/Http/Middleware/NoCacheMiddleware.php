<?php

namespace App\Http\Middleware;

use Closure;

class NoCacheMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (strpos($request->url(), '.webm') === false) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        }

        return $response;
    }
}