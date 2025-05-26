<?php

declare(strict_types=1);

namespace App\Http\Exceptions\Api\V1;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EntityNotFoundException extends Exception
{
    public function __construct(string $model)
    {
        parent::__construct(sprintf("No query results for model [%s]", $model));
    }

    public function render(): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->getMessage()
        ], Response::HTTP_NOT_FOUND);
    }
}
