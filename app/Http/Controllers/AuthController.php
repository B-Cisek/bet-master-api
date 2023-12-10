<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\JwtService\JwtServiceInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class AuthController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $responseFactory,
        private readonly JwtServiceInterface $jwtService
    ) {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::create($data);

        $token = Auth::login($user);

        return $this->responseFactory->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        try {
            $token = $this->jwtService->login($credentials);

            return $this->responseFactory->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => auth()->user(),
            ]);
        } catch (UserNotDefinedException $e) {
            return $this->responseFactory->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function refresh(): JsonResponse
    {
        try {
            $token = $this->jwtService->refresh();

            return $this->responseFactory->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => auth()->user(),
            ]);
        } catch (\Exception $e) {
            return $this->responseFactory->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function logout(): Response|JsonResponse
    {
        try {
            $this->jwtService->logout();

            return $this->responseFactory->noContent();
        } catch (\Exception $e) {
            return $this->responseFactory->json(['message' => $e->getMessage()]);
        }
    }

    public function me(): JsonResponse
    {
        try {
            return $this->responseFactory->json($this->jwtService->me());
        } catch (UserNotDefinedException $e) {
            return $this->responseFactory->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
