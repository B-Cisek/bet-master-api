<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Libs\API\Integrations\TheOddsAPI;
use Carbon\CarbonInterval;
use Illuminate\Http\JsonResponse;
use Psr\SimpleCache\CacheInterface;

class TheOddsController extends Controller
{
    public function __construct(
        private readonly TheOddsAPI $api,
        private readonly CacheInterface $cache
    ) {
    }

    public function sports(): JsonResponse
    {
        $sports = $this->cache->get('sports');

        if (! $sports) {
            $sports = $this->api->getSports();
            $this->cache->set('sports', $sports, CarbonInterval::day());
        }

        return new JsonResponse(data: $sports, json: true);
    }
}
