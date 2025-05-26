<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\ListBookedHours;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeSlotResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'time' => $this->time?->format('H:i'),
            'is_active' => $this->is_active,
        ];
    }
}
