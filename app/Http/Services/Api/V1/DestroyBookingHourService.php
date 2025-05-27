<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Models\BookingHour;

readonly class DestroyBookingHourService
{
    public function __construct(public BookingHourRepositoryInterface $repository)
    {
    }

    public function softDelete(BookingHour $bookingHour): void
    {
        $this->repository->softDelete($bookingHour);
    }
}
