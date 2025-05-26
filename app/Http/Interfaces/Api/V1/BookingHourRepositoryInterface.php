<?php

declare(strict_types=1);

namespace App\Http\Interfaces\Api\V1;

use App\DTOs\ListBookedHours\BookingHourDto as ListBookedHoursDto;
use App\DTOs\StoreBookingHours\BookingHourDto;
use App\Http\Resources\Api\V1\BookingHourResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface BookingHourRepositoryInterface
{
    public function store(BookingHourDto $dto, int $timeSlotId): void;
    public function getAllBookings(ListBookedHoursDto $dto, ?string $egn): ResourceCollection;
    public function getBooking(int $id): BookingHourResource;
}
