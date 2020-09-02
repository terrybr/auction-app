<?php

declare(strict_types=1);

namespace App\Http\Action;

use App\Http\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomeAction implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): Response
    {
        return new JsonResponse([]);
    }
}
