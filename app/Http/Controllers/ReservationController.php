<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\OpeningHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Auth::user()->reservations()->latest()->paginate(3);

        return view('reservations.index', compact('reservations'));

    }

    // Zistíme či sú v daný deň všetky stoly voľné na každú hodinu
    private function getAvailableTables($seats, $date)
    {
        return Table::where('seats', $seats)
            ->whereDoesntHave('reservations', function ($query) use ($date) {
                $query->where('date', $date);
            })
            ->get();
    }

    //Ziskame kolekciu voľných časov od otvorenia do zatvorenia, ak uživateľ zvolí dnešný dátum, tak kolekcia bude začínať od momentálnej najbližšej hodiny
    private function generateAvailableHours($openingHour, $actual_hour, $date, $today)
    {
        $hours = collect($openingHour->hours);
        $start_hour = $hours["from_hour"];
        $end_hour = $hours["to_hour"] - 1;
    
        $available_hours = [];
    
        if ($date == $today && $actual_hour < 22) {
            $new_start_hour = $actual_hour + 1;
            $start = Carbon::parse("{$new_start_hour}:00:00");
        } else {
            $start = Carbon::parse("{$start_hour}:00:00");
        }
    
        $end = Carbon::parse("{$end_hour}:00:00");
    
        while ($start <= $end) {
            $available_hours[] = $start->format('H:i:s');
            $start->addHour();
        }
    
        return $available_hours;
    }

    //Zistíme ktoré hodiny sú v daný deň vybookované
    private function getBookedTimes($availableTimes, $seats, $date)
    {
        $bookedTimes = collect();
        $specificTableCount = Table::where('seats', $seats)->count();

        foreach ($availableTimes as $hour) {
            $bookedTablesCount = Table::where('seats', $seats)
                ->whereHas('reservations', function ($query) use ($date, $hour) {
                    $query->where('date', $date)
                          ->where('start_time', $hour);
                })
                ->count();

            if ($bookedTablesCount == $specificTableCount) {
                $bookedTimes->push($hour);
            }
        }
        
        return $bookedTimes;
    }

    //Odstráni vybookované časy a vráti len dostupné
    private function getFreeTimes($availableTimes, $bookedTimes) {
        return collect($availableTimes)->reject(function ($time) use ($bookedTimes) {
            return $bookedTimes->contains($time);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $seats = session('seats');
        $date = session('date');

        $actual_hour = (int) Carbon::now()->format('H');
        $today = Carbon::today()->format('Y-m-d');

        $openingHour = OpeningHours::first();
        $hours = $openingHour ? collect($openingHour->hours) : collect([]);

        $end_time = (int) ($hours['to_hour']);

        // Zistíme či sú v daný deň všetky stoly voľné na každú hodinu
        $availableTables = $this->getAvailableTables($seats, $date);

        //Ziskame kolekciu voľných časov od otvorenia do zatvorenia, ak uživateľ zvolí dnešný dátum, tak kolekcia bude začínať od momentálnej najbližšej hodiny
        $availableTimes = $this->generateAvailableHours($openingHour, $actual_hour, $date, $today);   
    

        if(!$hours->isEmpty()) {
            
            if($actual_hour >= $end_time && $date == $today) {

                return back()->with('failure', 'We are already closed today.');

            } else {

                if(!$availableTables->isEmpty()) {

                    $table_id = $availableTables[0]->id;
                    return view('reservations.create', compact('availableTimes', 'table_id'));

                } else {        

                    //Zistíme ktoré hodiny sú v daný deň vybookované
                    $bookedTimes = $this->getBookedTimes($availableTimes, $seats, $date);

                    //Odstráni vybookované časy a vráti len dostupné
                    $availableHours = $this->getFreeTimes($availableTimes, $bookedTimes);

                    return view('reservations.create', compact('availableHours'));
                }
           }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $startTime = intval($request->input('start_time'));

        $formattedStartTime = sprintf('%02d:00:00', $startTime);
        $formattedEndTime = sprintf('%02d:00:00', $startTime + 1);

        $seats = session('seats');
        $date = session('date');

        $table_id =$request->input('table_id');

        if(!$table_id) {
            $availableTables = Table::where('seats', $seats)
            ->where(function ($query) use ($date, $formattedStartTime) {
                $query->whereDoesntHave('reservations', function ($subQuery) use ($date, $formattedStartTime) {
                    $subQuery->where('date', $date)
                        ->where('start_time', $formattedStartTime);
                });
            })
            ->get();

            $table_id = $availableTables[0]->id;
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'table_id' => $table_id,
            'start_time' => $formattedStartTime,
            'end_time' => $formattedEndTime,
            'date' => $date,
        ]);
        
        return redirect()->route('dashboard')->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('posts.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('delete', 'Your reservation was deleted!');
    }
}
