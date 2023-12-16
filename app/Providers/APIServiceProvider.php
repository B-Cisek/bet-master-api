<?php

namespace App\Providers;

use App\Libs\API\Integrations\TheOddsAPI;
use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TheOddsAPI::class, function () {
            return new TheOddsAPI([
                'base_uri' => env('THE_ODDS_API_BASE_URL'),
                'query' => ['apiKey' => env('THE_ODDS_API_KEY')],
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
