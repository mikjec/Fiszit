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
    public function learn($deckId)
    {
        $deck = auth()->user()->decks()->findOrFail($deckId);
        $flashcards = $deck->flashcards()->latest()->get();
        return view('deck-learn', ['deck' => $deck, 'flashcards' => $flashcards]);
    }

    public function store(Request $request, $deckId)
    {
        $deck = auth()->user()->decks()->findOrFail($deckId);

        $deck->flashcards()->create(['front' => 'przód', 'back' => 'tył']);

        return redirect()->back()->with('success', 'Dodano kartę');
    }

    public function importFile(Request $request, $deckId)
    {
        $deck = auth()->user()->decks()->findOrFail($deckId);

        $request->validate([
            'flashcards_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('flashcards_file');
        $content = file($file->getRealPath());
        $imported = 0;
        $skipped = 0;

        foreach ($content as $line) {
            $line = trim($line);

            if ($line === '' || !str_contains($line, ';')) {
                $skipped++;
                continue;
            }

            $parts = explode(';', $line, 2);

            if (count($parts) !== 2) {
                $skipped++;
                continue;
            }

            [$front, $back] = array_map('trim', $parts);

            if ($front === '' || $back === '') {
                $skipped++;
                continue;
            }

            $deck->flashcards()->create([
                'front' => mb_substr($front, 0, 255),
                'back'  => mb_substr($back, 0, 5000),
            ]);

            $imported++;
        }

        return redirect()->back()->with('success', "Zaimportowano: $imported, pominięto: $skipped");
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
