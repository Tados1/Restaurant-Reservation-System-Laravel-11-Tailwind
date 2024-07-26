<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Table;
use App\Models\OpeningHours;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ReservationControllerFeatureTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_reservation_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get('/reservations');

        $response->assertOk();
    }

    public function test_guests_number_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get('/reservations/guests-number');

        $response->assertOk();
    }

    public function test_date_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get('/reservations/date');

        $response->assertOk();
    }

    public function test_create_page_is_displayed(): void
    {
        OpeningHours::create([
            'from' => '08:00',
            'to' => '22:00', 
        ]);

        $response = $this
            ->actingAs($this->user)
            ->get('/reservations/create');

        $response->assertOk();
    }

    public function test_reservation_is_stored_correctly(): void
    {
        $table = Table::create([
            'seats' => 4,
            'number' => 1,
        ]);
    
        Session::start();
        Session::put('date', now()->format('Y-m-d'));
    
        $response = $this
            ->actingAs($this->user)
            ->post(route('reservations.store'), [ 
                'start_time' => '10',
                'table_id' => $table->id,
            ]);
    
        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success', 'Reservation created successfully.');
    
        $this->assertDatabaseHas('reservations', [
            'user_id' => $this->user->id,
            'table_id' => $table->id,
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'date' => now()->format('Y-m-d'),
        ]);
    }

    public function test_reservation_is_destroyed_correctly(): void
    {
        $this->actingAs($this->user);

        $table = Table::create([
            'seats' => 4,
            'number' => 1,
        ]);

        $reservation = Reservation::create([
            'user_id' => $this->user->id,
            'table_id' => $table->id,
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'date' => now()->format('Y-m-d'),
        ]);

        $response = $this->delete(route('reservations.destroy', $reservation->id));

        $response->assertRedirect();
        $response->assertSessionHas('delete', 'Your reservation was deleted!');

        $this->assertDatabaseMissing('reservations', [
            'id' => $reservation->id,
        ]);
    }
}