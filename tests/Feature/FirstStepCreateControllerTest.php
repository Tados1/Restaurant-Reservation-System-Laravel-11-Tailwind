<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Table;
use Illuminate\Support\Facades\Session;

class FirstStepCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_number_is_available()
    {
        $user = User::factory()->create();

        Table::create([
            'seats' => 4,
            'number' => 1,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('guests-number'), ['number' => 3]);

        $response->assertRedirect(route('date'));
        $response->assertSessionHas('success', "You chose seats for 3 successfully.");

        $this->assertEquals(4, Session::get('seats'));
    }

    public function test_guests_number_is_not_available()
    {
        $user = User::factory()->create();

        Table::create([
            'seats' => 4,
            'number' => 1,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('guests-number'), ['number' => 5]);

        $response->assertRedirect(url()->previous()); 
        $response->assertSessionHas('failure', "There are no free tables with capacity for 5 guests.");
    }

    public function test_date_is_stored_correctly()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('date'), ['date' => '2024-07-25']);

        $formattedDate = 'July 25, 2024';
        $this->assertEquals('2024-07-25', Session::get('date'));

        $response->assertRedirect(route('reservations.create'));
        $response->assertSessionHas('success', "You chose $formattedDate successfully.");
    }
}