<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Rules\ValidEgn;
use Illuminate\Foundation\Http\FormRequest;

class ListBookingHoursRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date_from' => [
                'nullable',
                'date_format:Y-m-d',
            ],

            'date_to' => [
                'nullable',
                'date_format:Y-m-d',
            ],

            'egn' => [
                'nullable',
                'string',
                'size:10',
                'regex:/^[0-9]{10}$/',
                new ValidEgn(),
            ],
        ];
    }
}
