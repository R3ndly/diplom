<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Если пользователь зарегистрирован, то отобразить шапку для зарегистрированных пользователей
            return $next($request);
        } else {
            // Если пользователь гость, то отобразить шапку для гостей
            return response(view('guest_header'));
        }
    }
}
