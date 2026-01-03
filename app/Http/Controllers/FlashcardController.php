<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    public function index($deckId)
    {
        $deck = auth()->user()->decks()->findOrFail($deckId);
        $flashcards = $deck->flashcards()->latest()->get();
        return view('flashcards', ['deck' => $deck, 'flashcards' => $flashcards]);
    }
}
