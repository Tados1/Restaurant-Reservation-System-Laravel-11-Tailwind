<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Table;
use App\Models\Reservation;
use App\Models\OpeningHours;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    protected static $number = 1;
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $exists = OpeningHours::where('from', '08:00:00')->where('to', '22:00:00')->exists();

        if (!$exists) {
            OpeningHours::factory()->create();
        }

        User::factory(3)->create();

        $tableWith4Seats = Table::factory()->create(['seats' => 4]);
        $tablesWith2Seats = Table::factory(2)->create(['seats' => 2]);

        $tomorrow = Carbon::tomorrow();

        foreach ($tablesWith2Seats as $table) {
            Reservation::factory()->create([
                'table_id' => $table->id,
                'date' => $tomorrow,
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
            ]);
        }

    }
}