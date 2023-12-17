<?php

declare(strict_types=1);

namespace App\Libs\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

abstract class Api
{
    public const GET = 'get';
    public const POST = 'post';
    public const PUT = 'put';
    public const DELETE = 'delete';
    public const PATCH = 'patch';

    protected Client $client;

    public function __construct(array $config)
    {
        $this->client = new Client($config);
    }

    public function get(string $endpoint = '', array $options = []): ResponseInterface
    {
        try {
            return $this->client->get($endpoint, $options);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return new Response(404);
        }
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
