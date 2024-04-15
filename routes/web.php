<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AttractionsController;
use App\Http\Controllers\OpeningHoursController;
use App\Http\Controllers\TicketPricesController;
use App\Http\Controllers\ContactController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/attractions', [AttractionsController::class, 'index'])->name('attractions');
Route::get('/opening-hours', [OpeningHoursController::class, 'index'])->name('opening-hours');
Route::get('/ticket-prices', [TicketPricesController::class, 'index'])->name('ticket-prices');
Route::post('/place-order', [TicketPricesController::class, 'placeOrder'])->name('placeOrder');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');