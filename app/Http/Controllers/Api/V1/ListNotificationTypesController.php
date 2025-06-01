<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ListNotificationTypesService;
use Illuminate\Http\JsonResponse;

class ListNotificationTypesController extends Controller
{
    public function __construct(public ListNotificationTypesService $service)
    {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json($this->service->getNotificationTypes());
    }
}
