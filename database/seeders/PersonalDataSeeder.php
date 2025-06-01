<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Helpers\EgnHelper;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personal_data')->insert([
            [
                'user_id' => 1,
                'egn_encrypted' => EgnHelper::encrypt('3208080983'),
                'egn_hash' => EgnHelper::hash('3208080983'),
                'egn_index' => hash('sha256', '3208080983'),
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'user_id' => 2,
                'egn_encrypted' => EgnHelper::encrypt('4705036420'),
                'egn_hash' => EgnHelper::hash('4705036420'),
                'egn_index' => hash('sha256', '4705036420'),
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'user_id' => 3,
                'egn_encrypted' => EgnHelper::encrypt('3010193772'),
                'egn_hash' => EgnHelper::hash('3010193772'),
                'egn_index' => hash('sha256', '3010193772'),
                'created_at' => CarbonImmutable::now(),
            ]
        ]);
    }
}
