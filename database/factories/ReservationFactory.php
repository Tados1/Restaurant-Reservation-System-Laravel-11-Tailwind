<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startHour = 8;
        $endHour = 21;

        $randomDate = Carbon::now()->addDays(fake()->numberBetween(1, 7))->toDateString();
        $randomStartTime = Carbon::createFromTime(fake()->numberBetween($startHour, $endHour), 0);
        $EndTime = $randomStartTime->copy()->addHours(1);

        return [
            'user_id' => User::all()->random()->id,
            'table_id' => Table::all()->random()->id,
            'start_time' => $randomStartTime->toTimeString(),
            'end_time' => $EndTime,
            'date' => $randomDate,
        ];
    }
}