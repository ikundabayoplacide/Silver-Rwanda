<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if((Auth::check()&& Auth::user()->role == "user") )
        
        if (Auth::check() && (Auth::user()->role == "user" || Auth::user()->role == "sedo" || Auth::user()->role == "rab" || Auth::user()->role == "sector"))
        {
        return $next($request);
    }
    else{
    return redirect()->route('login');
    }
}}
