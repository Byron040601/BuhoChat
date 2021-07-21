<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($contact) {
            $contact->user_id_1 = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    use HasFactory;
}
