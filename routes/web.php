<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


Route::get('/',[Controllers\ListingController::class,'index'])
->name('jobs.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
