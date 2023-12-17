<?php

namespace App\Libs\API\Integrations\ApiFootball;

enum Action: string
{
    case GET_COUNTRIES = 'get_countries';
    case GET_LEAGUES = 'get_leagues';
}
