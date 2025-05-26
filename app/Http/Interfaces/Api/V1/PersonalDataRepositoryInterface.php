<?php

declare(strict_types=1);

namespace App\Http\Interfaces\Api\V1;

use App\DTOs\PersonalDataDto;
use App\Models\PersonalData;

interface PersonalDataRepositoryInterface
{
    public function store(PersonalDataDto $dto): PersonalData;
}
