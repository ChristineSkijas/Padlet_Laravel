<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entrie extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'padlet_id',
        'title',
        'content'
    ];

    /** Beziehung zwischen User und Eintrag */
    public function ratings() : HasMany {
        return $this->HasMany(Rating::class);
    }

    /** Beziehung zwischen Einträgen und Kommentaren */
    public function comments() : HasMany {
        return $this->HasMany(Comment::class);
    }

    /** Beziehung zwischen User und Eintrag */
    public function user() : BelongsTo {
        return $this->BelongsTo(User::class);
    }

    /** Beziehung zwischen Eintrag und Padlet */
    public function padlet() : BelongsTo {
        return $this->BelongsTo(Padlet::class);
    }
}
