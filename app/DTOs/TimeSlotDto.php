<?php

namespace App\DTOs;

readonly class TimeSlotDto
{
    public function __construct(
        public string $time,
    ) {}
}
