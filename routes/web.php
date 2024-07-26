<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpeningHoursController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FirstStepCreateController;
use Illuminate\Http\Request;

Route::get('/', [OpeningHoursController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('reservations/guests-number', [FirstStepCreateController::class, 'getGuestsNumber'])->name('guests-number');
    Route::post('reservations/guests-number', [FirstStepCreateController::class, 'postGuestsNumber'])->name('guests-number');
    
    Route::get('reservations/date', [FirstStepCreateController::class, 'getDate'])->name('date');
    Route::post('reservations/date', [FirstStepCreateController::class, 'postDate'])->name('date');

    Route::resource('reservations', ReservationController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
