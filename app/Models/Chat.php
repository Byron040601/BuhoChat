<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    protected $fillable = ['lastMessage'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($chat) {
            $chat->user_id_1 = Auth::id();
            $chat->user_id_2 = Auth::id();
        });
    }
    public function message()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    use HasFactory;
}
