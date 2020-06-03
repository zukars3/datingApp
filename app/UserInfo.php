<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserInfo extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'phone',
        'age',
        'gender',
        'profile_picture',
        'description',
        'relationship',
        'country',
        'languages'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getPicture()
    {
        if($this->profile_picture == null)
        {
            return Storage::url('/picture/default.png');
        }

        return Storage::url($this->profile_picture);
    }
}
