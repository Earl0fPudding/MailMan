<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	if(!auth()->guard('mail')->check()) {
	    if(auth()->guard('admin')->check()) {
                return redirect(route('Admin.showStartpage'));
            }
            return redirect(route('Login.showLogin'));
        }
        return $next($request);
    }
}
