<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Padlet extends Model
{
    use HasFactory;

    /** definiert alle Properties, die beschreibbar sind und dann in der DB landen
    diese Properties müssen definiert sein, damit sie in der DB auch gespeichert werden können*/

    protected $fillable = ['name', 'user_id', 'is_public'];

    /** Beziehung zwischen User und Padlet */
    public function user() : BelongsTo {
     return $this->belongsTo(User::class);
    }

    /** Beziehung zwischen Eintrag und Padlet */
    public function entries() : HasMany {
        return $this->hasMany(Entrie::class);
    }

    /** Beziehung zwischen Rechten und Padlet */
    public function userrights() : HasMany {
        return $this->hasMany(Userright::class);
    }
}
