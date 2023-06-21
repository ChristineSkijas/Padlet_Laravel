<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Userright extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'padlet_id',
        'read',
        'edit',
        'delete'
    ];

    /** Beziehung zwischen User und Rechten */
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    /** Beziehung zwischen Padlet und Rechten */
    public function padlet() : BelongsTo {
        return $this->belongsTo(Padlet::class);
    }
}
