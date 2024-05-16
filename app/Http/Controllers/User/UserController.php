<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }


    /**
     * @throws ConnectionException
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->getListOfUsers();

        return response()->json($users);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->storeUser($request->validated());

        return response()->json($user);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->getUser($id);

        return response()->json($user);
    }

    public function update(StoreUserRequest $request, int $id): JsonResponse
    {
        $user = $this->userService->updateUser($request->validated(), $id);

        return response()->json($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = $this->userService->deleteUser($id);

        return response()->json($user);
    }
}
