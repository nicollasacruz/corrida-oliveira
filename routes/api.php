<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

Route::post('/token', [DeviceController::class, 'storeToken']);
