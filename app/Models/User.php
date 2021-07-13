<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'nickName',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function contactOwn()
    {
        return $this->hasMany('App\Models\Contact', 'user_id_1', 'id');
    }

    public function contact()
    {
        return $this->hasMany('App\Models\Contact', 'user_id_2', 'id');
    }

    public function chatTransmitter()
    {
        return $this->hasMany('App\Models\Chat', 'user_id_1', 'id');
    }

    public function chatReceiver()
    {
        return $this->hasMany('App\Models\Chat', 'user_id_2', 'id');
    }

    public function interest()
    {
        return $this->hasMany('App\Models\Interest');
    }

    public function message()
    {
        return $this->hasMany('App\Models\Message');
    }
}
