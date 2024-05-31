<?php
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AttractionsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OpeningHoursController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TicketPricesController;
use Illuminate\Support\Facades\Route;




Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/attractions', [AttractionsController::class, 'index'])->name('attractions');

Route::delete('/attractions/{id}', [AttractionsController::class, 'destroy'])->name('attractions.destroy');


Route::get('/opening-hours', [OpeningHoursController::class, 'index'])->name('opening-hours');
Route::middleware('auth')->group(function () {
    Route::get('/opening-hours/{id}/edit', [OpeningHoursController::class, 'edit'])->name('opening-hours.edit');
    Route::post('/opening-hours/{id}', [OpeningHoursController::class, 'update'])->name('opening-hours.update');
});

Route::get('/ticket-prices', [TicketPricesController::class, 'index'])->name('ticket-prices');
Route::post('/place-order', [TicketPricesController::class, 'placeOrder'])->name('placeOrder');

Route::middleware(['auth'])->group(function () {
    Route::get('/ticket-prices/create', [TicketPricesController::class, 'create'])->name('ticket-prices.create');
    Route::post('/ticket-prices', [TicketPricesController::class, 'store'])->name('ticket-prices.store');
    Route::get('/ticket-prices/{id}/edit', [TicketPricesController::class, 'edit'])->name('ticket-prices.edit');
    Route::put('/ticket-prices/{id}', [TicketPricesController::class, 'update'])->name('ticket-prices.update');
    Route::delete('/ticket-prices/{id}', [TicketPricesController::class, 'destroy'])->name('ticket-prices.destroy');
});


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
