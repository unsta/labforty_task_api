<?php

declare(strict_types=1);

namespace Feature\Api\V1;

use App\Helpers\EgnHelper;
use App\Models\{BookingHour, PersonalData, TimeSlot, User};
use Carbon\CarbonImmutable;
use Database\Seeders\TimeSlotSeeder;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithoutMiddleware};
use Tests\TestCase;

class ListBookingHoursControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    private string $endpoint;
    private array $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = 'api/v1/list-booking-hours';
        $this->headers = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];

        CarbonImmutable::setTestNow('2025-05-26');
    }

    public function test_invoke_with_multiple_results(): void
    {
        $this->prepareDatabase();

        $response = $this->getJson($this->endpoint, $this->headers);
        $response->assertOk();
        $this->assertCount(2, $response->json()['data']);
    }

    private function prepareDatabase(): void
    {
        $this->seed(TimeSlotSeeder::class);

        $user1 = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@labforty.com'
        ]);
        $user2 = User::factory()->create([
            'name' => 'Bob Bobber',
            'email' => 'bob.bobber@labforty.com'
        ]);
        $this->actingAs($user1);

        PersonalData::factory()->count(2)->sequence(
            [
                'user_id' => $user1->id,
                'egn_encrypted' => EgnHelper::encrypt('3208080983'),
                'egn_hash' => EgnHelper::hash('3208080983'),
                'egn_index' => hash('sha256', '3208080983'),
            ],
            [
                'user_id' => $user2->id,
                'egn_encrypted' => EgnHelper::encrypt('4705036420'),
                'egn_hash' => EgnHelper::hash('4705036420'),
                'egn_index' => hash('sha256', '4705036420'),
            ],
        )->create();

        BookingHour::factory()->count(2)->sequence(
            [
                'booking_date' => CarbonImmutable::now()->addDays(2)->format('Y-m-d'),
                'time_slot_id' => TimeSlot::where('time', '9:30')->value('id'),
                'user_id' => $user1->id,
            ],
            [
                'booking_date' => CarbonImmutable::now()->addDays(2)->format('Y-m-d'),
                'time_slot_id' => TimeSlot::where('time', '10:30')->value('id'),
                'user_id' => $user2->id,
            ],
        )->create();
    }
}
