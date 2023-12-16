<?php

namespace App\Libs\API;

use Psr\Http\Message\ResponseInterface;

interface ApiInterface
{
    /**
     * @param string $endpoint
     * @param array<string, string> $options
     */
    public function get(string $endpoint, array $options = []): ResponseInterface;

    public function post(): ResponseInterface;

    public function put(): ResponseInterface;

    public function delete(): ResponseInterface;

    public function patch(): ResponseInterface;
}
