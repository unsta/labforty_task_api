<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Services\Api\V1\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

readonly class LoginController
{
    public function __construct(public LoginService $service)
    {
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Login failed'], 401);
        }

        $request->session()->regenerate();
        $user = Auth::user()?->load('personalData');

        return response()->json([
            'message' => 'Login successful',
            'user' => UserResource::make($user),
        ]);
    }
}
