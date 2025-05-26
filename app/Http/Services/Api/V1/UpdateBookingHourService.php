<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Exceptions\Api\V1\UnauthorizedActionException;
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Http\Interfaces\Api\V1\TimeSlotRepositoryInterface;
use App\Http\Resources\Api\V1\BookingHourResource;

readonly class UpdateBookingHourService
{
    public function __construct(
        public BookingHourRepositoryInterface $bookingHourRepository,
        public TimeSlotRepositoryInterface $timeSlotRepository,
    ) {
    }

    public function update(int $id, array $data): BookingHourResource
    {
        $booking = $this->bookingHourRepository->find($id);
        $timeSlot = $this->timeSlotRepository->findOneByTimeAndStatus($data['time']);

        if (auth()->id() !== $booking->user_id) {
            throw new UnauthorizedActionException();
        }

        $data['time_slot_id'] = $timeSlot->id;

        return $this->bookingHourRepository->update($booking, $data);
    }
}
