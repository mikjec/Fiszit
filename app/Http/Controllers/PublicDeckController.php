<?php

namespace App\Http\Controllers;

use App\Models\Deck;

use Illuminate\Http\Request;

class PublicDeckController extends Controller
{
    public function show(string $token)
    {
        $deck = Deck::where('share_token', $token)->where('is_public', true)->with('flashcards')->firstOrFail();

        return view('deck-public', ['deck' => $deck]);
    }
}
