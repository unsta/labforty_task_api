<?php

declare(strict_types=1);

namespace App\Http\Repositories\Api\V1;

use App\DTOs\StoreBookingHours\PersonalDataDto;
use App\Helpers\EgnHelper;
use App\Http\Interfaces\Api\V1\PersonalDataRepositoryInterface;
use App\Models\PersonalData;

class PersonalDataRepository implements PersonalDataRepositoryInterface
{
    public function store(PersonalDataDto $dto): PersonalData
    {
        return PersonalData::updateOrCreate(
            ['user_id' => $dto->userId],
            [
                'egn_encrypted' => EgnHelper::encrypt($dto->egn),
                'egn_hash' => EgnHelper::hash($dto->egn),
                'egn_index' => hash('sha256', $dto->egn),
            ]
        );
    }
}
