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
}
