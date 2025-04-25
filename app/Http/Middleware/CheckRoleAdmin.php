<?php

namespace App\Http\Middleware;

use App\Traits\ResultTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdmin
{
    use ResultTrait;

    public function handle(Request $request, Closure $next)
    {
        if (! Auth::user() || ! Auth::user()->hasRole('Admin')) {
            return $this->errorResponse(__('messages.auth.not_authorized'), [], 403);
        }

        return $next($request);
    }
}
