<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\Table;
use App\Models\OpeningHours;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FirstStepCreateController extends Controller
{

    public function getGuestsNumber() { 
        return view('reservations.guests-number');
    }

    public function postGuestsNumber(Request $request) { 
        $guestsNumber = $request->input('number'); 
        
        if ($guestsNumber>= 1) { 
            $seats = ceil($guestsNumber / 2) * 2; 
        } 
        
        $seats = intval($seats); 

        $checkAvailableTables = Table::where('seats', $seats)
        ->get();

        if ($checkAvailableTables->isEmpty()) {
            return redirect()->back()->with('failure', "There are no free tables with capacity for $guestsNumber guests.");
        }

        session(['seats' => $seats]); 
            
        return redirect()->route('date')->with('success', "You chose seats for $guestsNumber successfully."); 
        
    }

    public function getDate() { 
        return view('reservations.date');
    }

    public function postDate(Request $request) { 
        $date = $request->input('date');

        $newdate = Carbon::parse($date);
        $formattedDate = $newdate->format('F j, Y'); 
    
        session(['date' => $date]);
    
        return redirect()->route('reservations.create')->with('success', "You choose $formattedDate successfully.");
    }

  
}
