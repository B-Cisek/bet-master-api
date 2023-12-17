<?php

declare(strict_types=1);

namespace App\Libs\API\Integrations\ApiFootball;

use App\Libs\API\Api;

trait ApiFootballHelper
{
    protected array $options = [];
    protected array $queryParams = [];
    protected string $endpoint = '';
    protected string $method = Api::GET;

    protected function setAction(Action $action): self
    {
        $this->queryParams['action'] = $action->value;

        return $this;
    }

    protected function setParam(string $key, string $value): self
    {
        $this->queryParams[$key] = $value;

        return $this;
    }

    protected function setEndpoint(string $endPoint): self
    {
        $this->endpoint = $endPoint;

        return $this;
    }

    protected function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    protected function setOptions(): self
    {
        $this->options['query'] = $this->queryParams;

        return $this;
    }

    protected function getData(bool $json = true): string|array
    {
        if ($json) {
            return $this
                ->setOptions()
                ->{$this->method}($this->endpoint, $this->options)
                ->getBody()
                ->getContents();
        }

        return json_decode(
            $this->setOptions()->{$this->method}($this->endpoint, $this->options)->getBody()->getContents(),
            true
        );
    }
}
