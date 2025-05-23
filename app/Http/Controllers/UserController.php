<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Traits\ResultTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResultTrait;

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        try {
            $data = $this->userService->getAll($request);
            return $this->successResponse($data, __('messages.users.list_success'));
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.unexpected_error'), ['error' => $e->getMessage()]);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $user = $this->userService->create($request->validated());
            return $this->successResponse(new UserResource($user), __('messages.users.created'), 201);
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.unexpected_error'), ['error' => $e->getMessage()]);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = $this->userService->update($id, $request->validated());
            return $this->successResponse(new UserResource($user), __('messages.users.updated'));
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.unexpected_error'), ['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->delete($id);
            return $this->successResponse(null, __('messages.users.deleted'));
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.unexpected_error'), ['error' => $e->getMessage()]);
        }
    }
}