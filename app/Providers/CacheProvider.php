<?php

namespace App\Providers;

use App\Services\CacheService\RedisService;
use Illuminate\Support\ServiceProvider;
use Psr\SimpleCache\CacheInterface;

class CacheProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CacheInterface::class, RedisService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
