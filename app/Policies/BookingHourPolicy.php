<?php

namespace App\Policies;

use App\Models\BookingHour;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookingHourPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BookingHour $bookingHour): bool
    {
        if (in_array('admin', Auth::user()->getRoleNames()->toArray(), true)) {
            return true;
        }

        return $user->id === $bookingHour->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BookingHour $bookingHour): bool
    {
        return $user->id === $bookingHour->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BookingHour $bookingHour): bool
    {
        return $user->id === $bookingHour->user_id;
    }
}
