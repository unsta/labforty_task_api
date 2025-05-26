<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Services\Api\V1\DestroyBookingHourService;
use Illuminate\Http\JsonResponse;

readonly class DestroyBookingHourController
{
    public function __construct(public DestroyBookingHourService $service)
    {
    }

    public function __invoke(int $bookingHourId): JsonResponse
    {
        $this->service->softDelete($bookingHourId);
        return response()->json(['message' => 'Booking hour soft-deleted successfully.']);
    }
}
