<?php
/**
 * @file    web.php
 * @brief   This page contains all the routes linking the views of the application together
 * @author  Created by Thierry.KOETSCHET
 * @version 08.05.2023
 */

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

Route::post('/updateUser', [UserController::class, 'updateUser']);

Route::get('/profile',[UserController::class, 'getLastWeight']);

Route::get('/imc', [ChartController::class, 'lineChart']);

Route::get('/alimentation', [FoodController::class, 'showAlimentation']);

Route::get('/alimentation/{id}', [FoodController::class, 'showAlimentationSpecific']);

Route::post('/addFoodstuff', [FoodController::class, 'addFoodstuff']);

Route::post('/showAdd', [FoodController::class, 'showAdd']);

Route::post('/searchFoodstuff', [FoodController::class, 'searchFoodstuff']);

Route::get('/deleteUser', [UserController::class, 'deleteUser']);

Route::get('deleteFoodstuff/{id}/{date}', [FoodController::class, 'deleteFoodstuff']);

Route::post('/changePassword', [UserController::class, 'changePassword']);

Route::get('newPassword', [UserController::class, 'newPassword']);
