<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
	if(!auth()->guard('admin')->check()) {
	    if(auth()->guard('mail')->check()) {
                return redirect(route('User.showStartpage'));
            }
            return redirect(route('Login.showAdminLogin'));
        }
        return $next($request);
    }
}
