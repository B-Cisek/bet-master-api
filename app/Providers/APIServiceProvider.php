<?php

namespace App\Providers;

use App\Libs\API\Integrations\ApiFootball\ApiFootball;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Query;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Message\RequestInterface;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // TODO: Refactor
        $this->app->bind(ApiFootball::class, function () {
            $queryParams = [
                'APIkey' => env('API_FOOTBALL_API_KEY')
            ];

            $handler = HandlerStack::create();

            $handler->push(Middleware::mapRequest(function (RequestInterface $request) use ($queryParams) {
                $query = Query::parse($request->getUri()->getQuery());
                $query = array_merge($queryParams, $query);
                return $request->withUri($request->getUri()->withQuery(Query::build($query)));
            }));

            return new ApiFootball([
                'base_uri' => env('API_FOOTBALL_BASE_URL'),
                'handler' => $handler,
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
