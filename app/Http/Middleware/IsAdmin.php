<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::find(Auth::id());

        if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2) {
            return $next($request);
        }  

        return response()->json(
            [
                "success" => false,
                "message" => "You shall not pass!!",
                "data" => $user
            ],
            401
        );
    }
}
