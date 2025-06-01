<?php

declare(strict_types=1);

namespace App\Http\Interfaces\Api\V1;

use App\Models\TimeSlot;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface TimeSlotRepositoryInterface
{
    public function findOneByTimeAndStatus(string $time, int $isActive = 1): ?TimeSlot;
    public function getAll(int $isActive = 1): ResourceCollection;
}
