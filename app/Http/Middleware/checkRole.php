<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {

        if($request->user()->role == $role){
            return $next($request);
        }

        if($request->user()->role == "admin"){
            return redirect('/home');
        } 
        elseif($request->user()->role == "mahasiswa"){
            return redirect('/');
        }
    }
}
