<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $fillable = [
        'user_id',
        'search_age_from',
        'search_age_to',
        'search_male',
        'search_female'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
