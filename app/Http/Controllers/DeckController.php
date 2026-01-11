<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Deck;



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

    public function share(Deck $deck)
    {
        abort_if($deck->user_id !== auth()->id(), 403);
        if (!$deck->share_token) {
            $deck->update([
                'is_public' => true,
                'share_token' => Str::random(32),
            ]);
        }
        return back()->with('succes', 'Zestaw został udostępniony!');
    }
    public function unShare(Deck $deck)
    {
        abort_if($deck->user_id !== auth()->id(), 403);
        if ($deck->share_token) {
            $deck->update([
                'is_public' => false,
                'share_token' => '',
            ]);
        }
        return back()->with('succes', 'Zakończono udostępnianie!');
    }
}
