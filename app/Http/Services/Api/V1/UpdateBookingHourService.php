<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Exceptions\Api\V1\UnauthorizedActionException;
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Http\Resources\Api\V1\BookingHourResource;

readonly class UpdateBookingHourService
{
    public function __construct(public BookingHourRepositoryInterface $repository)
    {
    }

    public function update(int $id, array $data): BookingHourResource
    {
        $booking = $this->repository->find($id);

        if (auth()->id() !== $booking->user_id) {
            throw new UnauthorizedActionException();
        }

        return $this->repository->update($booking, $data);
    }
}
