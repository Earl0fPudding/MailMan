<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfLoggedIn
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
	if(auth()->guard('mail')->check()) {
            return redirect(route('User.showStartpage'));
        }
	if(auth()->guard('admin')->check()) {
            return redirect(route('Admin.showStartpage'));
        }
        return $next($request);
    }
}
