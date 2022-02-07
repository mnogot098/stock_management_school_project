<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        //if the user is not logged redirect to login page
        if(!session()->has('LoggedUser')){
            return redirect('login')->withErrors('Please log in first!');
        }
        return $next($request);
    }
}
