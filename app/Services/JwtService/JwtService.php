<?php

declare(strict_types=1);

namespace App\Services\JwtService;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

readonly class JwtService implements JwtServiceInterface
{
    /**
     * @throws UserNotDefinedException
     */
    public function login(array $credentials): string
    {
        /** @var string|bool $token */
        $token = Auth::attempt($credentials);

        if (! $token) {
            throw new UserNotDefinedException;
        }

        return $token;
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function refresh(): string
    {
        return Auth::refresh();
    }

    /**
     * @throws UserNotDefinedException
     */
    public function me(): Authenticatable
    {
        return Auth::userOrFail();
    }
}
