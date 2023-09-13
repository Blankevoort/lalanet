<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LalaeyController;
use App\Http\Controllers\ShowLalaeys;

Route::get('/', function () {
    return view('Main');
});

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'isAdmin'], function() {
        Route::resource('/admin', LalaeyController::class);
        Route::resource('/lalaey', ShowLalaeys::class);
    });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
