<?php

namespace App\Infrastructure\Repository\StorageAdapter;

interface StorageAdapterInterface
{
    public function save(string $key, array $data): void;

    public function get($key);

    public function has($key): bool;
}