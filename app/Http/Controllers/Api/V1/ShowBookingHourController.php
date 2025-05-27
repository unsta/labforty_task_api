<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\BookingHourResource;
use App\Http\Services\Api\V1\ShowBookingHourService;
use App\Models\BookingHour;
use Illuminate\Support\Facades\Gate;

readonly class ShowBookingHourController
{
    public function __construct(public ShowBookingHourService $service)
    {
    }

    public function __invoke(BookingHour $bookingHour): BookingHourResource
    {
        Gate::authorize('view', $bookingHour);
        return $this->service->getBookingHour($bookingHour->id);
    }
}
