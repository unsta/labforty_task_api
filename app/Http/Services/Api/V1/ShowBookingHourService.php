<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Exceptions\Api\V1\UnauthorizedActionException;
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Http\Resources\Api\V1\BookingHourResource;

readonly class ShowBookingHourService
{
    public function __construct(public BookingHourRepositoryInterface $bookingHourRepository)
    {
    }

    public function getBookingHour(int $id): BookingHourResource
    {
        $booking = $this->bookingHourRepository->find($id);

        if (auth()->id() !== $booking->user_id) {
            throw new UnauthorizedActionException();
        }

        return $this->bookingHourRepository->getCurrentAndUpcomingBookings($id);
    }
}
