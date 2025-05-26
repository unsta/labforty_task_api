<?php

declare(strict_types=1);

namespace Feature\Api\V1;

use App\Enums\BookingStatus;
use App\Models\{BookingHour, TimeSlot, User};
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithoutMiddleware};
use Tests\TestCase;

class DestroyBookingHourControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

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
        $this->actingAs($user);

        $timeSlot = TimeSlot::factory()->create();

        $bookingHour = BookingHour::factory()->create([
            'user_id' => $user->id,
            'time_slot_id' => $timeSlot->id,
        ]);

        $response = $this->delete($this->endpoint . $bookingHour->id, $this->headers);
        $response->assertOk();

        $this->assertSoftDeleted('booking_hours', ['id' => $bookingHour->id]);
        $this->assertDatabaseHas('booking_hours', ['status' => BookingStatus::CANCELED]);
    }

    public function test_invoke_authorized_exception(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->actingAs($user2);

        $timeSlot = TimeSlot::factory()->create();

        $bookingHour = BookingHour::factory()->create([
            'user_id' => $user1->id,
            'time_slot_id' => $timeSlot->id,
        ]);

        $this->delete($this->endpoint . $bookingHour->id, $this->headers)
            ->assertStatus(401)
            ->assertJson(['message' => 'You are not authorized to update this booking.'])
        ;
    }
}
