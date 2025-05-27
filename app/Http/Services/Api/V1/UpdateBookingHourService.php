<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Http\Interfaces\Api\V1\TimeSlotRepositoryInterface;
use App\Http\Resources\Api\V1\BookingHourResource;
use App\Models\BookingHour;

readonly class UpdateBookingHourService
{
    public function __construct(
        public BookingHourRepositoryInterface $bookingHourRepository,
        public TimeSlotRepositoryInterface $timeSlotRepository,
    ) {
    }

    public function update(BookingHour $bookingHour, array $data): BookingHourResource
    {
        $timeSlot = $this->timeSlotRepository->findOneByTimeAndStatus($data['time']);

        $data['time_slot_id'] = $timeSlot->id;

        return $this->bookingHourRepository->update($bookingHour, $data);
    }
}
