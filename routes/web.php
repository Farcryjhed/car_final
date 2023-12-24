<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\BookingController;

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

Route::get('/', function () {
    return view('layouts.app');
});


Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/carss', [CarController::class, 'display'])->name('carss');
Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('car.show');

Route::get('/car/search', [CarController::class, 'search'])->name('car.search');
Route::get('/category/{category}/cars', [CarController::class, 'categoryCars'])->name('category.cars');
Route::get('/recent-cars', [CarController::class, 'recentCars'])->name('recent.cars');
Route::post('/car/review', [CarController::class, 'review'])->name('car.review');



Route::get('/car/show/{id}', [CarController::class, 'availability'])->name('availability');

