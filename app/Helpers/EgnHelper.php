<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\{Crypt, Hash};

class EgnHelper
{
    public static function encrypt(string $egn): string
    {
        return Crypt::encryptString($egn);
    }

    public static function decrypt(string $encryptedEgn): string
    {
        return Crypt::decryptString($encryptedEgn);
    }

    public static function hash(string $egn): string
    {
        return Hash::make($egn);
    }
}

