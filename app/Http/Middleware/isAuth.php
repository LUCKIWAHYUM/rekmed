<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAuth
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
        $auth = Auth::check();
        if($auth) {
            $user = Auth::user();
            switch($user->level) {
                case 1:
                    return redirect()->intended('app/dashboard');
                    break;
                case 2:
                    return redirect()->intended('user');
                    break;
            }
        }

        return $next($request);
    }
}
