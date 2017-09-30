<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard($guard)->check()) {
////            return redirect('/home');
//            return view('home');
////            return redirect()->route('doctor.dashboard') ;
//        }
        //        for different guard such as admin, there needs some condition in which home page will be redirected
        if($guard=='doctor') {
            if (Auth::guard($guard)->check()) {      // normally ei if condition thake ei file e
//                return redirect('/home');
                return redirect()->route('doctor.dashboard');
            }
//            else{
//                return view('welcome');
//            }
        }else{
            if (Auth::guard($guard)->check()) {      // normally ei if condition thake ei file e
                return redirect('/home');
            }
//            else{
//             return view('welcome');
//            }
        }



        return $next($request);
    }



}
