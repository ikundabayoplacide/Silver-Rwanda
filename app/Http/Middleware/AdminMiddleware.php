<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin'|| Auth::user()->role == 'sedo'
        || Auth::user()->role == 'rab'|| Auth::user()->role == 'cooperative_manager'
        || Auth::user()->role == 'sector_agronome'
        || Auth::user()->role == 'district_agronome'||
         Auth::user()->role == 'self')
          {
            return $next($request);
        }

        // Auth::logout();
        return redirect()->back()->with('success','Registration successfuly');
    }
}
