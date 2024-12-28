<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;

Route::post('register', [RegistrationController::class, 'register']);
Route::post('login', [RegistrationController::class, 'login']);