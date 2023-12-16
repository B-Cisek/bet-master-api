<?php

declare(strict_types=1);

namespace App\Libs\API\Integrations;

use App\Libs\API\Api;

class TheOddsAPI extends Api
{
    private const GET_SPORTS = 'v4/sports';

    public function getSports(bool $json = true): string|array
    {
        $response = $this->get(self::GET_SPORTS)
            ->getBody()
            ->getContents();

        if ($json) {
            return $response;
        }

        return json_decode($response, true);
    }
}
