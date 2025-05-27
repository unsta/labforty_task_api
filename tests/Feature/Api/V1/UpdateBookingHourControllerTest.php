<?php

declare(strict_types=1);

namespace Feature\Api\V1;

use App\Models\{BookingHour, TimeSlot, User};
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithoutMiddleware};
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateBookingHourControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $endpoint;
    private array $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = 'api/v1/update-booking-hour/';
        $this->headers = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];

        CarbonImmutable::setTestNow('2025-05-26');
    }

    public function test_invoke(): void
    {
        $payload = [
            'booking_date' => '2025-06-22',
            'time' => '13:30',
            'notification_types' => 3
        ];

        $user = User::factory()->create();

        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);

        $timeSlot1 = TimeSlot::factory()->create(
            ['time' => '09:00']
        );
        $timeSlot2 = TimeSlot::factory()->create(
            ['time' => '13:30']
        );

        $bookingHour = BookingHour::factory()->create([
            'booking_date' => '2025-06-17',
            'user_id' => $user->id,
            'time_slot_id' => $timeSlot1->id,
        ]);

        $response = $this->actingAs($user)
            ->patchJson(route('update-booking-hour', $bookingHour), $payload, $this->headers);
        $response->assertOk();

        $this->assertDatabaseHas('booking_hours', ['booking_date' => '2025-06-22']);
        $this->assertDatabaseHas('booking_hours', ['time_slot_id' => $timeSlot2->id]);
        $this->assertDatabaseHas('booking_hours', ['notification_types' => 3]);
    }

    public function test_invoke_authorized_exception(): void
    {
        $payload = [
            'booking_date' => '2025-06-22',
            'time' => '13:30',
            'notification_types' => 3
        ];

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $roleUser = Role::create(['name' => 'user']);
        $user1->assignRole($roleUser);
        $user2->assignRole($roleUser);

        $timeSlot1 = TimeSlot::factory()->create(
            ['time' => '09:00']
        );
        $timeSlot2 = TimeSlot::factory()->create(
            ['time' => '13:30']
        );

        $bookingHour = BookingHour::factory()->create([
            'user_id' => $user1->id,
            'time_slot_id' => $timeSlot1->id,
        ]);

        $this->actingAs($user2)
            ->patchJson(route('update-booking-hour', $bookingHour), $payload, $this->headers)
            ->assertStatus(403)
            ->assertJson(['message' => 'This action is unauthorized.'])
        ;
    }
}
