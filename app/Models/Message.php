<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $fillable = ['text', 'chat_id'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($message) {
            $message->user_id = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function chat()
    {
        return $this->belongsTo('App\Models\Chat');
    }
    use HasFactory;
}
