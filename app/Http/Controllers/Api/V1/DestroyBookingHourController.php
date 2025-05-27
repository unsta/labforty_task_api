<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Services\Api\V1\DestroyBookingHourService;
use App\Models\BookingHour;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

readonly class DestroyBookingHourController
{
    public function __construct(public DestroyBookingHourService $service)
    {
    }

    public function __invoke(BookingHour $bookingHour): JsonResponse
    {
        Gate::authorize('update', $bookingHour);
        $this->service->softDelete($bookingHour);

        return response()->json(['message' => 'Booking hour soft-deleted successfully.']);
    }
}
