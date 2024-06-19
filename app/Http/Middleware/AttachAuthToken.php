<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AttachAuthToken
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
        // Get the current route name
        $routeName = $request->route()->getName();

        if ($routeName === 'RoomController@index') {
            return $next($request);
        }

        $token = $request->cookie('authtoken');

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ]);

        return $next($request);
    }
}