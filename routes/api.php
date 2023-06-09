<?php

use App\Http\Controllers\StarWarsPlanetsController;
use App\Http\Controllers\StarWarsVehicleController;
use App\Http\Controllers\StarWarsPeopleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group([
    'middleware' => 'api', 'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
    Route::post('logout',   [AuthController::class, 'logout']);
});

Route::group([
     'middleware' => 'auth', 'prefix' => 'people'
], function ($router) {
    Route::get('/{id?}',     [StarWarsPeopleController::class, 'getAllPeople']);
    Route::get('/id/{id}',   [StarWarsPeopleController::class, 'getPeopleById']);
});

Route::group([
    'middleware' => 'auth', 'prefix' => 'planets'
], function ($router) {
    Route::get('/{id?}',     [StarWarsPlanetsController::class, 'getAllPlanets']);
    Route::get('/id/{id}',   [StarWarsPlanetsController::class, 'getPlanetById']);
});

Route::group([
    'middleware' => 'auth', 'prefix' => 'vehicles'
], function ($router) {
    Route::get('/{id?}',     [StarWarsVehicleController::class, 'getAllVehicles']);
    Route::get('/id/{id}',   [StarWarsVehicleController::class, 'getVehicleById']);
});
