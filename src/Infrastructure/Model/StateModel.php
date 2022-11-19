<?php

declare(strict_types=1);

namespace App\Infrastructure\Model;

use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class StateModel implements JsonSerializable
{
    private string $masked;
    private string $secret;

    public function __construct(array $data)
    {
        $this->masked = $data['masked'];
        $this->secret = $data['secret'];
    }

    public function getMasked(): string
    {
        return $this->masked;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    #[ArrayShape(['masked' => "string", 'secret' => "string"])]
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
