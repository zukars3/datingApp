<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'user_one',
        'user_two'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_one');
    }
}
