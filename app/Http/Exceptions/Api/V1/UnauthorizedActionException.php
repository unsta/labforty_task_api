<?php

declare(strict_types=1);

namespace App\Http\Exceptions\Api\V1;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedActionException extends Exception
{
    public function __construct()
    {
        parent::__construct('You are not authorized to update this booking.');
    }

    public function render(): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }
}
