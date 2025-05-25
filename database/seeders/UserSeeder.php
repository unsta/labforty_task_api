<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@labforty.com',
            'email_verified_at' => CarbonImmutable::now(),
            'password' => Hash::make('password'),
            'remember_token' => 'a@fdsdas34234dfsf345',
            'created_at' => CarbonImmutable::now(),
        ]);
    }
}
