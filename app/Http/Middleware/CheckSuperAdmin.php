<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_admin && auth()->user()->is_superAdmin) {
            return $next($request);
        } else {
            abort(403, 'شما یک ادمین معمولی هستید و دسترسی لازم برای این مورد را ندارید');
        }
    }
}
