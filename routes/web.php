<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProfileController;
use App\Mail\ParticipantConfirmEmail;
use App\Models\Participant;
use chillerlan\QRCode\QRCode;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/qrcode', function () {
    // $data = 'https://www.google.com';
    $data   = 'https://oliveira.run.place';
    $qrcode = (new QRCode)->render($data);

    printf('<img class="h-96" src="%s" alt="QR Code" />', $qrcode);
    return $qrcode;

});

// ignore csrfToken in rout
//Route::post('/api/token', [DeviceController::class, 'storeToken'])->name('api.token');

Route::get('/email', function () {
    try {
        Mail::to('nicollasacruz@gmail.com')->send(new ParticipantConfirmEmail(Participant::first()));
        //Mail::to('elisabetesilvabm@gmail.com')->send(new ParticipantConfirmEmail(Participant::first()));
        Mail::to('elisabete@oliveira.run.place')->send(new ParticipantConfirmEmail(Participant::first()));
        Mail::to('test-akwv3rajl@srv1.mail-tester.com')->send(new ParticipantConfirmEmail(Participant::first()));
        return 'Test email sent!';
    } catch (Exception $e) {
        Log::error("Error ao enviar email de confirmação no teste!");
        Log::error($e->getMessage());
        return $e->getMessage();
    }
});

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/about', [EventController::class, 'about'])->name('about');
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
