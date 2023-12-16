<?php

declare(strict_types=1);

namespace App\Libs\API;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

abstract class Api implements ApiInterface
{
    public const GET = 'get';

    public const POST = 'post';

    public const PUT = 'put';

    public const DELETE = 'delete';

    public const PATCH = 'patch';

    private Client $client;

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(array $config)
    {
        $this->client = new Client($config);
    }

    public function get(string $endpoint, array $options = []): ResponseInterface
    {
        return $this->client->request(self::GET, $endpoint, $options);
    }

    public function post(): ResponseInterface
    {
        return new Response();
    }

    public function put(): ResponseInterface
    {
        return new Response();
    }

    public function delete(): ResponseInterface
    {
        return new Response();
    }

    public function patch(): ResponseInterface
    {
        return new Response();
    }
}
