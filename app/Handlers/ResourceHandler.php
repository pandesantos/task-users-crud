<?php

declare(strict_types=1);

namespace App\Handlers;

use Illuminate\Config\Repository as Config;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory as Http;

abstract class ResourceHandler
{
    public function __construct(
        private readonly Http $http,
        protected readonly Config $config
    ) {}

    /**
     * @throws ConnectionException
     */
    protected function list(): array
    {
        return $this->http->get(
            url: $this->getFullPath()
        )->json();
    }

    /**
     * @throws ConnectionException
     */
    protected function delete(int $resourceId): array
    {
        return $this->http->delete(
            url: $this->getFullPath($resourceId)
        )->json();
    }

    /**
     * @throws ConnectionException
     */
    protected function store(array $attributes): array
    {
        return $this->http
            ->post(url: $this->getFullPath(), data: $attributes)
            ->json();
    }

    protected function find(int $id): array
    {
        return $this->http->get(
            url: $this->getFullPath($id)
        )->json();
    }

    public abstract function getFullPath(int|string|null $resourceId = null): string;
}