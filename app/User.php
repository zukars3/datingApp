<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPicture()
    {
        if($this->profile_picture == null)
        {
            return Storage::url('/picture/default.png');
        }

        return Storage::url($this->profile_picture);
    }

    public function info()
    {
        return $this->hasOne('App\UserInfo');
    }

    public function settings()
    {
        return $this->hasOne('App\UserSettings');
    }
}
