<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class veridyIsAdmin
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
        if(!auth()->user()->isAdmin){
            return redirect(route('index'));
        }
        return $next($request);
    }
}
