<?php

namespace App\Http\Middleware;

use App\Traits\ResultTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMiddleware
{
    use ResultTrait ;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header('Authorization');

        if (! $authorization || ! str_starts_with($authorization, 'Bearer ')) {
            return $this->errorResponse(__('messages.auth.token_required'), null, 401);
        }

        $user = Auth::guard('sanctum')->user();

        if (! $user) {
            return $this->errorResponse(__('messages.auth.token_invalid'), null, 401);
        }

        Auth::setUser($user);

        return $next($request);
    }
}