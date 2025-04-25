<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Traits\ResultTrait;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    use ResultTrait;
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login(LoginRequest $request)
    {
        try {
            $data = $this->authService->login($request);
            return $this->successResponse($data, __('messages.auth.login_successful'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), null, 500);
        }
    }

    public function profile()
    {
        try {
            $userResource = $this->authService->profile();
            return $this->successResponse($userResource, __('messages.profile_success'));
        } catch (\Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                ['error' => $e->getMessage()],
                $e->getCode() ?: 500
            );
        }
    }

}