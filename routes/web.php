<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Http\Request;

Route::get('/',[Controllers\ListingController::class,'index'])
 ->name('jobs.index');

Route::get('/create',[Controllers\ListingController::class,'create'])
->name('jobs.create');
Route::post('/create',[Controllers\ListingController::class,'store'])
->name('jobs.create');

Route::get('/dashboard', function (Request $request) {
    $listings =  $request->user()->listings;
    return view('dashboard',['listings' => $listings]);
})->middleware(['auth'])->name('dashboard');

Route::get('/job/edit/{listing}',[Controllers\ListingController::class,'edit'])
->middleware('auth');

Route::post('/job/edit/{listing}',[Controllers\ListingController::class,'update'])
->middleware('auth')->name('job.update');

Route::post('/job/inactive/{listing}',[Controllers\ListingController::class,'inactive'])
->middleware('auth')->name('job.inactive');

require __DIR__.'/auth.php';

Route::get('/{listing}',[Controllers\ListingController::class,'show'])
 ->name('jobs.show');


 Route::get('/{listing}/apply',[Controllers\ListingController::class,'apply'])
 ->name('jobs.apply'); 
