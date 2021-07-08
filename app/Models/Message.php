<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['text'];

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
