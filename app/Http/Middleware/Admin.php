<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth('sanctum')->user();
        
        if ($user->role === 'admin') {
            return $next($request);
        } elseif ($user) {
            Log::info('User is not an admin', ['user' => $user]);
            return response()->json(['message' => 'User is not an admin'], 403);
        } else {
            Log::info('User is not authenticated');
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

    }
}
