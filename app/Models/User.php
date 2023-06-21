<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** Beziehung zwischen User und Padlet */
    public function padlets() : HasMany {
        return $this->hasMany(Padlet::class);
    }

    /** Beziehung zwischen User und Eintrag */
    public function entries() : HasMany {
        return $this->hasMany(Entrie::class);
    }

    /** Beziehung zwischen User und Rechten */
    public function userrights() : HasMany {
        return $this->hasMany(Userright::class);
    }

    /** Beziehung zwischen User und Bewertungen */
    public function ratings() : HasMany {
        return $this->hasMany(Rating::class);
    }

    /** Beziehung zwischen User und Kommentaren */
    public function comments() : HasMany {
        return $this->hasMany(Comment::class);
    }

    /** Für die Anmeldung eines Users   */
    public function getJWTIdentifier()
    {
        //gibt den aktuellen "key" vom jsonwebtoken zurück
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return ['user' => ['id' => $this->id]];
    }

}
