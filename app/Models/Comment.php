<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entrie_id',
        'comment'
    ];

    /** Beziehung zwischen User und Kommentar */
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    /** Beziehung zwischen Eintrag und Kommentar */
    public function entrie() : BelongsTo {
        return $this->belongsTo(Entrie::class);
    }
}
