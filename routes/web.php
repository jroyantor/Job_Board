<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


Route::get('/',[Controllers\ListingController::class,'index'])
 ->name('jobs.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/{listing}',[Controllers\ListingController::class,'show'])
 ->name('jobs.show');


 Route::get('/{listing}/apply',[Controllers\ListingController::class,'apply'])
 ->name('jobs.apply'); 
