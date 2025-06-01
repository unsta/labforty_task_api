<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Helpers\EgnHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalDataResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'egn' => EgnHelper::decrypt($this->egn_encrypted)
        ];
    }
}
