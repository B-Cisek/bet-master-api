<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Libs\API\Integrations\ApiFootball\ApiFootball;
use Carbon\CarbonInterval;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\SimpleCache\CacheInterface;

class TheOddsController extends Controller
{
    public function __construct(
        private readonly ApiFootball $api,
        private readonly CacheInterface $cache
    ) {
    }

    public function countries(): JsonResponse
    {
        if ($this->cache->has('countries')) {
            return new JsonResponse(data: $this->cache->get('countries'), json: true);
        }

        $countries = $this->api->getCountries();

        $this->cache->set('countries', $countries, CarbonInterval::day());

        return new JsonResponse(data: $countries, json: true);
    }

    public function leagues(int $id): JsonResponse
    {

//        if ($this->cache->has('leagues')) {
//            return new JsonResponse(data: $this->cache->get('leagues'), json: true);
//        }

        $leagues = $this->api->getLeagues((string) $id);

       // $this->cache->set('leagues', $leagues, CarbonInterval::day());

        return new JsonResponse(data: $leagues, json: true);
    }
}
