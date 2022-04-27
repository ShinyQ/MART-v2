<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FamilyCardController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'user'], function () {
    Route::post('login', [UserController::class, 'login']);
    Route::get('profile', [UserController::class, 'profile'])->middleware('user');
    Route::get('logout', [UserController::class, 'logout'])->middleware('user');
});

Route::group(['middleware' => 'user'], function () {
    Route::get('family/{id}', [FamilyCardController::class, 'family_by_nik']);
});
Route::group(['middleware' => 'superuser'], function () {
    Route::resource('family_card', FamilyCardController::class);
    Route::resource('family_member', FamilyCardController::class);
});
