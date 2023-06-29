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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->type == 'admin')
        {
            return $next($request);
            //return redirect('/');
        }
        elseif(Auth::user()->type == 'user')
        {
            return redirect('/');
        }
        else
        {
            return redirect('/login')->with('status','Access Denied. As you are not Admin ');
        }

/*        if (Auth::user()->type == 'admin')
        {
            return $next($request);
            //return redirect('/');
        }
        elseif(Auth::user()->type == 'user')
        {
            return redirect()->route('home');
        }
        else
        {
            return redirect('/login')->with('status','Access Denied. As you are not Admin ');
        }*/
    }
}
