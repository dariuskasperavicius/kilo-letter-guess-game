<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Turn;

use Symfony\Component\HttpFoundation\Request;

class TurnRequestModel
{
    public function __construct(private Request $request)
    {
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function hasLetter(): bool
    {
        return $this->getLetter() !== null;
    }

    public function getLetter(): string
    {
        return $this->request->get('letter');
    }
}
