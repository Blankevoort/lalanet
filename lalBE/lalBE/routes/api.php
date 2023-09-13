<?php

use App\Models\User;
use App\Mail\SendPass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\LalaeyController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\ProfileController;

//Send And Search Lalaeys

Route::resource('lalaies', LalaeyController::class);

Route::get('/lalaies/search', [searchController::class, 'searchLalaey']);

//User Login And Register Requests

Route::post('register', function (Request $request) {
    Mail::to($request->email)->send(new SendPass(""));
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    return response()->json(['status'=> true]);
});

Route::post('login', [AuthController::class, 'login']);

//Protected Routes

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::resource('profile', ProfileController::class);

    Route::resource('stories', StoryController::class);

    Route::get('userStories', [StoryController::class, 'userStories']);

    Route::get('userLalaies', [LalaeyController::class, 'userLalaies']);

    Route::post('logout', [AuthController::class, 'logout']);

    Route::resource('likes', LikeController::class);

    Route::get('user', function (Request $request) {
        return $request->user();
    });
});
