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
        'heading' => 'Latest Listings',
        'listings' => Listing::all()
    ]);
});

Route::get('/home/{id}', function ($id) {
    return view('listing', [
        'listing' => Listing::find($id)
    ]);
});

Route::get('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'register']);

Route::post('/users', [UserController::class, 'store'])->name('registerUser');

Route::get('/profile', function () {
    return view('profile', [

    ]);
});

Route::get('/logout', [UserController::class, 'logout']);
