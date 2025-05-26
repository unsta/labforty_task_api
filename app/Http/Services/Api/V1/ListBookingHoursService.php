<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\DTOs\ListBookedHours\{BookingHourDto, PersonalDataDto};
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Http\Interfaces\Api\V1\PersonalDataRepositoryInterface;
use App\Http\Interfaces\Api\V1\TimeSlotRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

readonly class ListBookingHoursService
{
    public function __construct(
        public BookingHourRepositoryInterface $bookingHourRepository,
        public PersonalDataRepositoryInterface $personalDataRepository,
        public TimeSlotRepositoryInterface $timeSlotRepository,
    ) {
    }

    public function listBookedHours(
        BookingHourDto $bookingHourDto,
        PersonalDataDto $personalDataDto
    ): ResourceCollection {
        return $this->bookingHourRepository->getAllBookings($bookingHourDto, $personalDataDto->egn);
    }
}
