<?php

declare(strict_types=1);

namespace App\DTOs;

readonly class PersonalDataDto
{
    public function __construct(
        public string $egn,
        public int $userId,
    ) {}
}
