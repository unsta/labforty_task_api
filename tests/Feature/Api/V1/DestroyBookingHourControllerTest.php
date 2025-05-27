<?php

declare(strict_types=1);

namespace Feature\Api\V1;

use App\Enums\BookingStatus;
use App\Models\{BookingHour, TimeSlot, User};
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DestroyBookingHourControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $endpoint;
    private array $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = 'api/v1/destroy-booking-hour/';
        $this->headers = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];

        CarbonImmutable::setTestNow('2025-05-26');
    }

    public function test_invoke(): void
    {
        $user = User::factory()->create();

        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);

        $timeSlot = TimeSlot::factory()->create();

        $bookingHour = BookingHour::factory()->create([
            'user_id' => $user->id,
            'time_slot_id' => $timeSlot->id,
        ]);

        $response = $this->actingAs($user)
            ->delete(route('destroy-booking-hour', $bookingHour), $this->headers);

        $response->assertOk();

        $this->assertSoftDeleted('booking_hours', ['id' => $bookingHour->id]);
        $this->assertDatabaseHas('booking_hours', ['status' => BookingStatus::CANCELED]);
    }

    public function test_invoke_authorized_exception(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $roleUser = Role::create(['name' => 'user']);
        $user1->assignRole($roleUser);
        $user2->assignRole($roleUser);

        $timeSlot = TimeSlot::factory()->create();

        $bookingHour = BookingHour::factory()->create([
            'user_id' => $user1->id,
            'time_slot_id' => $timeSlot->id,
        ]);

        $response = $this->actingAs($user2)
            ->deleteJson(route('destroy-booking-hour', $bookingHour), $this->headers);

        $response
            ->assertStatus(403)
            ->assertJson(['message' => 'This action is unauthorized.'])
        ;
    }
}
