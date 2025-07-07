<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class LoginAuth
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
        if (auth()->check()) {
            $userRole = auth()->user()->role;
    
            if ($userRole == 'Records Officer' && ($request->is('users') || $request->is('users/ulist'))) {
                return redirect()->route('dashboard')->with('error1', 'You do not have permission to access this page');
            }
        } else {
            return redirect()->route('getLogin')->with('error', 'You have to sign in first to access this page');
        }
    
        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    
        return $response;
    }
    
}