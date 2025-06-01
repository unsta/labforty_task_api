<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Interfaces\Api\V1\TimeSlotRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

readonly class ListTimeSlotsService
{
    public function __construct(public TimeSlotRepositoryInterface $repository)
    {
    }

    public function getTimeSlots(): ResourceCollection
    {
        return $this->repository->getAll();
    }
}
