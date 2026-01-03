<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DeckController extends Controller
{
    public function index()
    {
        $decks = auth()->user()->decks()->latest()->get();
        return view('dashboard', ['decks' => $decks]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'deck_name' => 'required|string|max:100',
        ]);

        $deck = auth()->user()->decks()->create(['name' => $validated['deck_name']]);
        return redirect()->route('dashboard')->with('success', 'Zestaw został utworzony!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'deck_name' => 'required|string|max:100',
        ]);

        $deck = auth()->user()->decks()->findOrFail($id);
        $deck->name = $validated['deck_name'];
        $deck->save();

        return redirect()->route('dashboard')->with('success', 'Nazwa zestawu została zaktualizowana!');
    }
    public function destroy($id)
    {
        $deck = auth()->user()->decks()->findOrFail($id);
        $deck->delete();
        return redirect()->route('dashboard')->with('success', 'Zestaw został usunięty!');
    }
}
