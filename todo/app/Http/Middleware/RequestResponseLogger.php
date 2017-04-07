<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Illuminate\Http\Request;
use App\RequestLog;
use App\Http\Requests;


class RequestResponseLogger
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
        return $next($request);
    }

     public function terminate($request, $response)
    {
        $log = new RequestLog;
        $log->ip = $request->ip();
        $log->route = $request->url();
        $log->time_taken = microtime(true) - LARAVEL_START;
        $log->save();
    }
}
