<?php

use App\Http\Controllers\AccommodationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AttractionsController;
use App\Http\Controllers\OpeningHoursController;
use App\Http\Controllers\TicketPricesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/attractions', [AttractionsController::class, 'index'])->name('attractions');
Route::get('/opening-hours', [OpeningHoursController::class, 'index'])->name('opening-hours');
Route::get('/ticket-prices', [TicketPricesController::class, 'index'])->name('ticket-prices');
Route::post('/place-order', [TicketPricesController::class, 'placeOrder'])->name('placeOrder');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/accommodations', [AccommodationController::class, 'index'])->name('accommodations');
Route::post('/place-accommodation-order', [AccommodationController::class, 'placeAccommodationOrder'])->name('placeAccommodationOrder');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');
Route::post('/dashboard/register', [AuthController::class, 'register'])->name('dashboard.register');