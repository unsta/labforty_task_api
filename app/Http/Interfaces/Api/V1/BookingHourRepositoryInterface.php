<?php

declare(strict_types=1);

namespace App\Http\Interfaces\Api\V1;

use App\DTOs\ListBookedHours\BookingHourDto as ListBookedHoursDto;
use App\DTOs\StoreBookingHours\BookingHourDto;
use App\Http\Resources\Api\V1\BookingHourResource;
use App\Models\BookingHour;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface BookingHourRepositoryInterface
{
    public function update(BookingHour $booking, array $data): BookingHourResource;
    public function store(BookingHourDto $dto, int $timeSlotId): void;
    public function getAllBookings(ListBookedHoursDto $dto, ?string $egn): ResourceCollection;
    public function getCurrentAndUpcomingBookings(int $id): BookingHourResource;
    public function softDelete(BookingHour $booking): void;
}
