<?php

namespace App\Http\Middleware;
use App\category;
use Closure;

class checkCategory
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
        $count=category::all()->count();
        if($count==0){
            session()->flash('success','must have categories recorded');
            toast('must have categories recorded','error');
            return redirect(route('categories.index'));
        }
        return $next($request);
    }
}
