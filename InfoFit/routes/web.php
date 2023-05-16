<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\UserController;

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

Route::get('/profile', function () {
    return view('profile', [

    ]);
});

Route::get('/imc', function () {
    return view('imc', [

    ]);
});

Route::get('/logout', [UserController::class, 'logout']);

Route::post('/updateWeight', [UserController::class, 'updateWeight']);

Route::get('/profile',[UserController::class, 'getLastWeight']);
