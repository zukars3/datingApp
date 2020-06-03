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
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info()
    {
        return $this->hasOne('App\UserInfo');
    }

    public function settings()
    {
        return $this->hasOne('App\UserSettings');
    }

    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    public function userLiked()
    {
        return $this->belongsToMany('App\User', 'matches', 'user_two', 'user_one');
    }

    public function likedUser()
    {
        return $this->belongsToMany('App\User', 'matches', 'user_one', 'user_two');
    }

    public function match(User $foreignUser)
    {
        $thisMatched = $this->belongsToMany('App\User', 'matches',
            'user_one', 'user_two')
            ->where('user_one', '=', $this->id)
            ->where('user_two', '=', $foreignUser->id)->getResults();

        $matchedThis = $this->belongsToMany('App\User', 'matches',
            'user_two', 'user_one')
            ->where('user_two', '=', $this->id)
            ->where('user_one', '=', $foreignUser->id)->getResults();

        if (isset($thisMatched[0]->attributes['id']) && isset($matchedThis[0]->attributes['id'])) {
            return $foreignUser;
        } else {
            return null;
        }
    }

    public function dislikes()
    {
        return $this->belongsToMany('App\User', 'dislikes', 'user_two', 'user_one');
    }

    public function scopeSearchWithSettings($query, $from, $to, $gender, $id)
    {
        if ($gender == 'both') {
            return $query->whereHas('info', function ($query) use ($from, $to, $id) {
                $query->where('age', '>=', $from)
                    ->where('age', '<=', $to)
                    ->where('user_id', '!=', $id)
                    ->where('profile_picture', '!=', '');
            });
        } else {
            return $query->whereHas('info', function ($query) use ($from, $to, $gender, $id) {
                $query->where('age', '>=', $from)
                    ->where('age', '<=', $to)
                    ->where('gender', $gender)
                    ->where('user_id', '!=', $id)
                    ->where('profile_picture', '!=', '');
            });
        }
    }

    public function scopeSearchWithoutLikesAndDislikes($query, $id)
    {
        return $query->whereDoesntHave('userLiked', function ($query) use ($id) {
            $query->where('user_one', $id);
        })
            ->whereDoesntHave('dislikes', function ($query) use ($id) {
                $query->where('user_one', $id);
            });
    }

    public function scopeSearchMatches($query, $id)
    {
        return $query->whereHas('userLiked', function ($query) use ($id) {
            $query->where('user_one', $id);
        })
            ->whereHas('likedUser', function ($query) use ($id) {
                $query->where('user_two', $id);
            })
            ->whereDoesntHave('dislikes', function ($query) use ($id) {
                $query->where('user_one', $id);
            });
    }

    public function scopeSearchLikes($query, $id)
    {
        return $query->whereHas('userLiked', function ($query) use ($id) {
            $query->where('user_one', $id);
        })
            ->whereDoesntHave('likedUser', function ($query) use ($id) {
                $query->where('user_two', $id);
            })
            ->whereDoesntHave('dislikes', function ($query) use ($id) {
                $query->where('user_one', $id);
            });
    }
}
