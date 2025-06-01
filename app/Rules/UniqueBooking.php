<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

readonly class UniqueBooking implements ValidationRule
{
    public function __construct(
        public ?string $bookingDate,
        public ?int $timeSlotId,
        public int $userId,
        protected ?int $ignoreId
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $data = request()->all();

        $bookingDate = $data[$this->bookingDate] ?? null;
        $timeSlotId = $data[$this->timeSlotId] ?? null;

        if (!$bookingDate || !$timeSlotId) {
            return; // Let other rules handle missing fields
        }

        $query = DB::table('booking_hours')
            ->where('booking_date', $bookingDate)
            ->where('time_slot_id', $timeSlotId)
            ->where('user_id', $this->userId);

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('You already have a booking at this date and time.');
        }
    }
}
