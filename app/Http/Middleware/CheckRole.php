<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->user() === null){
            return response("<h1>SORRY, You dont have sufficient Privilege or Rights!!!</h1><h2>Contact System Admin.</h2><br><h1>Click Back or Return on the Browser to go back...</h1>",401);
        }

        $actions=$request->route()->getAction();
        $roles=isset($actions['roles'])?$actions['roles'] : null;

        if($request->user()->hasAnyRole($roles) || !$roles){
            return $next($request);
        }

        return response("<h1>SORRY, You dont have sufficient Privilege or Rights!!!</h1><h2>Contact System Admin.</h2><br><h1>Click Back or Return on the Browser to go back...</h1>",401);
    }
}
