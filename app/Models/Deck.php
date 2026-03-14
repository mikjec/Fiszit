<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\MimeTypeDetection\FinfoMimeTypeDetector;

class Deck extends Model
{
    protected $fillable = [
        'name',
        'share_token',
        'is_public',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flashcards()
    {
        return $this->hasMany(Flashcard::class);
    }
}
