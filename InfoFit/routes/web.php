<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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
        'heading' => 'Latest Listings',
        'listings' => Listing::all()
    ]);
});

Route::get('/home/{id}', function ($id) {
    return view('listing', [
        'listing' => Listing::find($id)
    ]);
});

Route::get('/login', function () {
    return view('login', [

    ]);
});

Route::get('/register', function () {
    return view('register', [

    ]);
});

Route::get('/alimentation', function () {
    return view('alimentation', [

    ]);
});

Route::get('/imc', function () {
    return view('imc', [

    ]);
});

Route::get('/profile', function () {
    return view('profile', [

    ]);
});
