<?php

declare(strict_types=1);

namespace App\Domain\Adapter\ViewModel;

use App\Domain\Interfaces\ViewModelInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonResourceViewModel implements ViewModelInterface
{
    public function __construct(private JsonResponse $response)
    {
    }

    public function getResponse(): JsonResponse
    {
        return $this->response;
    }
}
