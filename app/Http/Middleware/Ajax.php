<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Ajax
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->ajax()) {
            abort(404);
        }

        return $next($request);
    }
}
