<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\ReservationController;
use Carbon\Carbon;

class ReservationControllerTest extends TestCase
{
    public function test_it_generate_available_hours() 
    {
        $openingHour = [
        "from" => "14:00:00",
        "to" => "22:00:00"
        ];

        $actual_hour = 5;
        $date = "2024-06-26";
        $today = Carbon::today()->format('Y-m-d');

        $controller = new ReservationController();
        $availableHours = $controller->generateAvailableHours($openingHour, $actual_hour, $date, $today);

        $expectedFreeTimes = collect([
            '14:00:00',
            '15:00:00',
            '16:00:00',
            '17:00:00',
            '18:00:00',
            '19:00:00',
            '20:00:00',
            '21:00:00'
        ]);

        $this->assertEquals($expectedFreeTimes ,collect($availableHours));
    }

    public function test_it_generate_available_hours_for_today() 
    {
        $openingHour = [
        "from" => "14:00:00",
        "to" => "22:00:00"
        ];

        $actual_hour = 18;
        $date = Carbon::today()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');

        $controller = new ReservationController();
        $availableHours = $controller->generateAvailableHours($openingHour, $actual_hour, $date, $today);

        $expectedFreeTimes = collect([
            '19:00:00',
            '20:00:00',
            '21:00:00'
        ]);

        $this->assertEquals($expectedFreeTimes ,collect($availableHours));
    }

    public function test_it_returns_free_times_by_excluding_booked_times()
    {
        $availableTimes = [
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00'
        ];

        $bookedTimes = collect([
            '10:00',
            '12:00',
            '14:00'
        ]);

        $expectedFreeTimes = collect([
            '09:00',
            '11:00',
            '13:00'
        ]);

        $controller = new ReservationController();
        $freeTimes = $controller->getFreeTimes($availableTimes, $bookedTimes);

        $this->assertEquals($expectedFreeTimes, $freeTimes);
    }
}
