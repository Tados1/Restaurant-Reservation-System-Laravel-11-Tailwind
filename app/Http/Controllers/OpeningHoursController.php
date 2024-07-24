<?php

namespace App\Http\Controllers;

use App\Models\OpeningHours;
use App\Http\Requests\StoreOpeningHoursRequest;
use App\Http\Requests\UpdateOpeningHoursRequest;

class OpeningHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $openingHour = OpeningHours::first();
        $hours = $openingHour ? $openingHour->hours : null;
    
        return view('opening-hours.index', compact('hours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOpeningHoursRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OpeningHours $openingHours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OpeningHours $openingHours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpeningHoursRequest $request, OpeningHours $openingHours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpeningHours $openingHours)
    {
        //
    }
}
