<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\FoodController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return view('home', [

    ]);
});

Route::get('/', function () {
    return view('home', [

    ]);
});

Route::get('/login', [UserController::class, 'login']);

Route::post('/authenticate', [UserController::class, 'authenticate']);

Route::get('/register', [UserController::class, 'register']);

Route::post('/users', [UserController::class, 'store']);

Route::get('/logout', [UserController::class, 'logout']);

Route::post('/updateWeight', [UserController::class, 'updateWeight']);

Route::get('/profile',[UserController::class, 'getLastWeight']);

Route::get('/imc', [ChartController::class, 'lineChart']);

Route::get('/alimentation', [FoodController::class, 'showAlimentation']);

Route::get('/alimentation/{date}', function ($date) {
    return view('/alimentation', ['date' => $date]);
});

Route::post('/addFoodstuff', [FoodController::class, 'addFoodstuff']);

Route::post('/showAdd', [FoodController::class, 'showAdd']);

Route::post('/searchFoodstuff', [FoodController::class, 'searchFoodstuff']);

Route::get('/deleteUser', [UserController::class, 'deleteUser']);
