<?php

namespace App\Rules;

use App\Enums\NotificationType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidNotificationTypes implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array((int)$value, NotificationType::validBitmaskValues(), true)) {
            $fail('Invalid notification types selected.');
        }
    }
}
