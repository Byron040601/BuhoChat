<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
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
