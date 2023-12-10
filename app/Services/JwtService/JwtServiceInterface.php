<?php

namespace App\Services\JwtService;

use Illuminate\Contracts\Auth\Authenticatable;

interface JwtServiceInterface
{
    public function login(array $credentials): string;

    public function logout(): void;

    public function refresh(): string;

    public function me(): Authenticatable;
}
