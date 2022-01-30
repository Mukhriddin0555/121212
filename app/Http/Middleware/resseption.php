<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class resseption
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
        if(Auth::user()->role_id == 6){
            return $next($request);
        }
        $role = role::find(Auth::user()->role_id);
        return redirect()->route($role->role);
    }
}
