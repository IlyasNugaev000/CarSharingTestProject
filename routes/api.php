<?php

use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/available-cars', [CarController::class, 'getAvailableCars'])->name('getAvailableCars');

Route::prefix('/user/{id}/car')->group(function () {
    Route::get('', [CarController::class, 'getUserWithCar'])->name('getUserWithCar');
    Route::post('', [CarController::class, 'addUserCar'])->name('addUserCar');
    Route::delete('/{car_id}', [CarController::class, 'deleteUserCar'])->name('deleteUserCar');
});
