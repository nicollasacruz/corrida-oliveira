<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RunnerKitController;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    //auth()->login(User::find(1));
    return Inertia::render('Homepage', [
        'events' => Event::all(),
    ]);
})->name('home');
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
Route::post('/event/{id}/subscribe', [ParticipantController::class, 'store'])->name('event.subscribe');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::middleware(['auth', 'verified'])->group(function () {
//    Route::resource('admin/events', EventController::class)->except(['show']);
//    Route::resource('admin/participants', ParticipantController::class)->only(['index', 'update', 'destroy']);
//    Route::resource('admin/payments', PaymentController::class)->only(['index', 'update']);
//    Route::resource('admin/runner-kits', RunnerKitController::class)->only(['index', 'update']);
//    Route::post('/admin/email/send', [ParticipantController::class, 'sendEmail'])->name('admin.email.send');
//});

require __DIR__.'/auth.php';
