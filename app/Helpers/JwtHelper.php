<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\ResponseStatus;
use App\Http\Resources\UserResource;
use App\Models\User;

trait JwtHelper
{
    public function tokenResponse(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => new UserResource(auth()->user()),
        ];
    }

    public function registerResponse(User $user, string $token): array
    {
        return [
            'status' => ResponseStatus::SUCCESS,
            'message' => __('auth.user.created'),
            'user' => new UserResource($user),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ];
    }
}
