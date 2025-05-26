<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Enums\NotificationType;
use App\Rules\Egn;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingHourRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'booking_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
            ],

            'time' => [
                'required',
                'date_format:H:i',
                'exists:time_slots',
                function ($attribute, $value, $fail) {
                    $minutes = CarbonImmutable::parse($value)->format('i');
                    if (!in_array($minutes, ['00', '30'], true)) {
                        $fail('Booking time must be at 30-minute interval!');
                    }
                }
            ],
            'egn' => [
                'required',
                'string',
                'size:10',
                'regex:/^[0-9]{10}$/',
                new Egn(),
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
                'min:10',
            ],

            'notification_types' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, NotificationType::validValues(), true)) {
                        $fail('Invalid notification type!');
                    }
                }
            ],
        ];
    }
}
