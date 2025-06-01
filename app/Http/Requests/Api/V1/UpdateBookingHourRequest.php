<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Rules\UniqueBooking;
use App\Rules\ValidEgn;
use App\Rules\ValidNotificationTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBookingHourRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'booking_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
            ],

            'time_slot_id' => [
                'required',
                'integer',
                'exists:time_slots,id',
                new UniqueBooking(
                    $this->input('booking_date'),
                    $this->input('time_slot_id'),
                    Auth::id(),
                    $this->route('update-booking-hour')
                ),
            ],

            'egn' => [
                'required',
                'string',
                'size:10',
                'regex:/^[0-9]{10}$/',
                new ValidEgn(),
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
                new ValidNotificationTypes(),
            ],
        ];
    }
}
