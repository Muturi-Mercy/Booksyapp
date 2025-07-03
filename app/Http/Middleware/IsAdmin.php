<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role !== 'admin'){
            return response()->json(['message'=>'Unauthorized'],403); //Is the user logged in, and does their role match the one required ie admin If yes allow access If no return a 403 Unauthorized error
        }
        return $next($request);
    }
}
