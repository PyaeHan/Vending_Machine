<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth()->user()) {
            if (Auth()->user()->type == 1) {
                return $next($request);
            } else {
                return redirect()->route('products.index')->with('access_error', 'Opps! You do not have access.');;
            }
        } else {
            return redirect()->route('login');
        }
    }
}
