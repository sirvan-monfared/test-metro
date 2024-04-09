<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->name) {
            session()->flash('error', 'قبل از دسترسی به این قسمت، لطفا اطلاعات خودت رو تکمیل کن');

            return redirect()->route('dashboard.profile.editName');
        }

        return $next($request);
    }
}
