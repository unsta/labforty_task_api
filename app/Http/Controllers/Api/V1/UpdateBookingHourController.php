<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UpdateBookingHourRequest;
use App\Http\Resources\Api\V1\BookingHourResource;
use App\Http\Services\Api\V1\UpdateBookingHourService;
use App\Models\BookingHour;
use Illuminate\Support\Facades\Gate;

readonly class UpdateBookingHourController
{
    public function __construct(public UpdateBookingHourService $service)
    {
    }

    public function __invoke(UpdateBookingHourRequest $request, BookingHour $bookingHour): BookingHourResource
    {
        Gate::authorize('update', $bookingHour);
        return $this->service->update($bookingHour, $request->validated());
    }
}
