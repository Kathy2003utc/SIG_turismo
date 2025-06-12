<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TurismoController;


Route:: get('/turismos/mapa', [TurismoController::class, 'mapa'])->name('turismos.mapa');
Route:: resource('turismos', TurismoController::class);