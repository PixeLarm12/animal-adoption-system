<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userRepository->all(), 200);
    }

    public function store(UserRequest $request): JsonResponse
    {
        if($request->validated())
            return response()->json($this->userRepository->save($request->getData()), 200);

        return response()->json(["message" => "Validation error!"], 403);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        if($request->validated())
            return response()->json($this->userRepository->update($user, $request->getData()), 200);

        return response()->json(["message" => "Validation error!"], 403);
    }

    public function destroy(User $user): JsonResponse
    {
        return response()->json($this->userRepository->delete($user), 200);
    }
}
