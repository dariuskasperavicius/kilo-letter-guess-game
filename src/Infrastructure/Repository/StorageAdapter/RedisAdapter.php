<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\StorageAdapter;

use Predis\Client;

class RedisAdapter implements StorageAdapterInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function save(string $key, array $data): void
    {
        $this->client->set($key, json_encode($data, JSON_THROW_ON_ERROR));
    }

    public function get($key): ?array
    {
       $data = $this->client->get($key);
       return $data ? json_decode($data, true, 512, JSON_THROW_ON_ERROR) : null;
    }

    public function has($key): bool
    {
        return $this->get($key) !== [];
    }
}
