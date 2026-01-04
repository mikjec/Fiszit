<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    public function index($deckId)
    {
        $deck = auth()->user()->decks()->findOrFail($deckId);
        $flashcards = $deck->flashcards()->latest()->get();
        return view('flashcards', ['deck' => $deck, 'flashcards' => $flashcards]);
    }

    public function store(Request $request, $deckId)
    {
        $deck = auth()->user()->decks()->findOrFail($deckId);

        $deck->flashcards()->create(['front' => 'przód', 'back' => 'tył']);

        return redirect()->back()->with('success', 'Dodano kartę');
    }

    public function update(Request $request, $deck, $flashId)
    {
        $flashcard = Flashcard::findorFail($flashId);



        if ($request->has('front')) {
            $request->validate(['front' => 'required|string']);
            $flashcard->update(['front' => $request->front]);
        }

        if ($request->has('back')) {
            $request->validate(['back' => 'required|string']);
            $flashcard->update(['back' => $request->back]);
        }
    }


    public function destroy($deckId, $flashcard)
    {
        Flashcard::findorFail($flashcard)->delete();

        return redirect("/decks/$deckId/flashcards")->with('success', 'Karta została usunięta');
    }
}
