<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Egn implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\d{10}$/', $value)) {
            $fail('Invalid :attribute format.');
            return;
        }

        $year = (int) substr($value, 0, 2);
        $month = (int) substr($value, 2, 2);
        $day = (int) substr($value, 4, 2);

        if ($month >= 1 && $month <= 12) {
            $year += 1900;
        } elseif ($month >= 21 && $month <= 32) {
            $year += 1800;
            $month -= 20;
        } elseif ($month >= 41 && $month <= 52) {
            $year += 2000;
            $month -= 40;
        } else {
            $fail('The :attribute has an invalid month.');
            return;
        }

        // Validate date
        if (!checkdate($month, $day, $year)) {
            $fail('The :attribute contains an invalid date.');
        }

        // Calculate checksum
        $weights = [2, 4, 8, 5, 10, 9, 7, 3, 6];
        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $sum += $weights[$i] * intval($value[$i]);
        }

        $checksum = $sum % 11;
        if ($checksum === 10) {
            $checksum = 0;
        }

         if ($checksum !== intval($value[9])) {
             $fail('Invalid :attribute format (checksum failed).');
         }
    }
}
