<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\TableStationLogic as Logic;

class TableMiddleware
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

        if(!isset($request['data'])){
            Logic::delete_record($request['table'],$request['id']);
        }else if(!isset($request['id'])){
            Logic::insert_record($request['table'],$request['data']);
        }else{
            Logic::edit_record($request['table'],$request['id'],$request['data']);
        }
        
        return $next($request);
    }

}
