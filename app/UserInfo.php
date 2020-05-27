<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'age',
        'gender',
        'profile_picture',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
