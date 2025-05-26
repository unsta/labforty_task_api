<?php

declare(strict_types=1);

namespace App\Http\Exceptions\Api\V1;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TimeSlotInactiveException extends Exception
{
    public function __construct()
    {
        parent::__construct('Time slot is no longer active.');
    }

    public function render(): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->getMessage()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
