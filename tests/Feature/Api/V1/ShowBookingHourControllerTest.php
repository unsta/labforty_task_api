<?php

declare(strict_types=1);

namespace Feature\Api\V1;

use App\Models\{BookingHour, TimeSlot, User};
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithoutMiddleware};
use Tests\TestCase;

class ShowBookingHourControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    private string $endpoint;
    private array $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = 'api/v1/show-booking-hour/';
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

        $response = $this->getJson($this->endpoint . $bookingHour->id, $this->headers);
        $response->assertOk();

        $this->assertNotEmpty($response->json('data'));
        $this->assertEmpty($response->json('upcoming_bookings'));
    }
}
