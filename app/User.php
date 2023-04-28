<?php

namespace App;

use App\Notifications\UserReg;
use App\Notifications\UserRegistration;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments()
    {
        return $this->hasMany('App\BookComments');
    }

    protected static function booted()
    {
        static::creating(function ($user) {

        });

        static::created(function ($user) {
            $user->notify(new UserReg($user));
        });

        static::updating(function ($user) {
            
        });

        static::updated(function ($user) {
            
        });
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT. (метод, который возвращает ключ)
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT. (Возвращает массив пользовательских данных)
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
