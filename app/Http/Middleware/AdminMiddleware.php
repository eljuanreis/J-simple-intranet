<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        //Se o cargo não for admin OU nao estiver logado
        if(Auth::guest()){
            return redirect()->route('index');
        }
        
        if (Auth::user()->cargo != "admin" ) {
            return redirect()->route('user.dashboard');
        }else{
            return $next($request);
        }
        

    }
}