<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = ['text'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    use HasFactory;
}
