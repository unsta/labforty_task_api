<?php

declare(strict_types=1);

namespace Feature\Api\V1;

use Spatie\Permission\Models\Role;
use App\Models\{TimeSlot, User};
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithoutMiddleware};
use Tests\TestCase;

class StoreBookingHourControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    private string $endpoint;
    private array $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = 'api/v1/store-booking-hour/';
        $this->headers = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];

        CarbonImmutable::setTestNow('2025-05-26');
    }

    public function test_invoke(): void
    {
        $payload = [
            'booking_date' => '2025-06-22',
            'time' => '13:30',
            'egn' => '4705036420',
            'notification_types' => 3
        ];

        $user = User::factory()->create();
        $this->actingAs($user);

        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);

        $timeSlot = TimeSlot::factory()->create(
            ['time' => '13:30']
        );

        $response = $this->postJson($this->endpoint, $payload, $this->headers);
        $response->assertStatus(201);

        $this->assertDatabaseHas('booking_hours', ['booking_date' => '2025-06-22']);
        $this->assertDatabaseHas('booking_hours', ['time_slot_id' => $timeSlot->id]);
        $this->assertDatabaseHas('booking_hours', ['notification_types' => 3]);

        $this->assertDatabaseHas('personal_data', ['egn_index' => hash('sha256', '4705036420')]);
    }

    public function test_invoke_tie_slot_inactive_exception(): void
    {
        $payload = [
            'booking_date' => '2025-06-22',
            'time' => '13:30',
            'egn' => '4705036420',
            'notification_types' => 3
        ];

        $user = User::factory()->create();
        $this->actingAs($user);

        TimeSlot::factory()->create(
            ['time' => '13:30', 'is_active' => false]
        );

        $this->postJson($this->endpoint, $payload, $this->headers)
            ->assertStatus(422)
            ->assertJson(['message' => 'Time slot is no longer active.'])
        ;
    }
}
