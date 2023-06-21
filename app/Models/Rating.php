<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'entrie_id',
        'rating'
    ];

    /** Beziehung zwischen User und Bewertung */
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    /** Beziehung zwischen Eintrag und Bewertung */
    public function entrie() : BelongsTo {
        return $this->belongsTo(Entrie::class);
    }
}
