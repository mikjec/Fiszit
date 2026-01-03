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

Route::get('/share/{token}', [PublicDeckController::class, 'show'])->name('decks.share');

Route::middleware('auth')->group(function () {
    Route::post('/decks', [DeckController::class, 'store'])->name('decks.store');
    Route::put('/decks/{deck}', [DeckController::class, 'update'])->name('decks.update');
    Route::delete('/decks/{deck}', [DeckController::class, 'destroy'])->name('decks.destroy');
});

Route::get('/dashboard', [DeckController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\FlashcardController;

Route::middleware('auth')->group(function () {

    // Zapisanie nowej fiszki
    Route::post('/decks/{deck}/flashcards', [FlashcardController::class, 'store'])
        ->name('flashcards.store');

    // Aktualizacja istniejącej fiszki
    Route::put('/decks/{deck}/flashcards/{flashcard}', [FlashcardController::class, 'update'])
        ->name('flashcards.update');

    // Usunięcie fiszki
    Route::delete('/decks/{deck}/flashcards/{flashcard}', [FlashcardController::class, 'destroy'])
        ->name('flashcards.destroy');
});



require __DIR__ . '/auth.php';
