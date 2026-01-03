<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeckController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/share/{token}', [PublicDeckController::class, 'show'])
    ->name('decks.share');

Route::middleware('auth')->group(function () {
    Route::resource('decks', DeckController::class);
});

Route::get('/dashboard', [DeckController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/dashboard', [DeckController::class, 'store'])
    ->middleware('auth')
    ->name('decks.store');


require __DIR__ . '/auth.php';
