<?php

declare(strict_types=1);

namespace App\Libs\API\Integrations\ApiFootball;

use App\Libs\API\Api;

class ApiFootball extends Api
{
    use ApiFootballHelper;

    public function getCountries(): string|array
    {
        return $this
            ->setAction(Action::GET_COUNTRIES)
            ->getData();
    }

    public function getLeagues(string $countryId): string|array
    {
        return $this
            ->setAction(Action::GET_LEAGUES)
            ->setParam('country_id', $countryId)
            ->getData();
    }
}
