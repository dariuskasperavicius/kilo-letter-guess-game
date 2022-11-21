<?php

declare(strict_types=1);

namespace App\Domain\Adapter\ViewModel;

use App\Domain\Interfaces\ViewModelInterface;
use Symfony\Component\HttpFoundation\Response;

class HttpResourceViewModel implements ViewModelInterface
{
    public function __construct(private Response $response)
    {
    }

    public function getResponse(): Response
    {
        return $this->response;
    }
}
