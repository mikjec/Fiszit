<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\PublicDeckController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/share/{token}', [PublicDeckController::class, 'show'])->name('decks.share');

Route::post('/decks/{deck}/share', [DeckController::class, 'share'])
    ->middleware('auth')
    ->name('decks.share.generate');

Route::post('/decks/{deck}/unshare', [DeckController::class, 'unShare'])
    ->middleware('auth')
    ->name('decks.unshare');


Route::middleware('auth')->group(function () {
    Route::get('/decks', [DeckController::class, 'index'])->name('decks');
    Route::post('/decks', [DeckController::class, 'store'])->name('decks.store');
    Route::put('/decks/{deck}', [DeckController::class, 'update'])->name('decks.update');
    Route::delete('/decks/{deck}', [DeckController::class, 'destroy'])->name('decks.destroy');
    Route::get('/decks/{deck}/learn', [FlashcardController::class, 'learn'])->name('decks.learn');
});

Route::get('/dashboard', [DeckController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/decks/{deck}/flashcards', [FlashcardController::class, 'index'])
        ->name('flashcards.index');

    Route::post('/decks/{deck}/flashcards', [FlashcardController::class, 'store'])
        ->name('flashcards.store');

    Route::post('/decks/{deck}/flashcards/import', [FlashcardController::class, 'importFile'])
        ->name('flashcards.import.file');

    Route::put('/decks/{deck}/flashcards/{flashcard}', [FlashcardController::class, 'update'])
        ->name('flashcards.update');

    Route::delete('/decks/{deck}/flashcards/{flashcard}', [FlashcardController::class, 'destroy'])
        ->name('flashcards.destroy');

    Route::post('/decks/{deck}/share', [DeckController::class, 'share'])
        ->name('decks.share.generate');

    Route::post('/decks/{deck}/unshare', [DeckController::class, 'unShare'])
        ->name('decks.unshare');
});



require __DIR__ . '/auth.php';
