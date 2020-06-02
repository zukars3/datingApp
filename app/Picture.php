<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    protected $fillable = [
        'user_id',
        'path'
    ];

    public function getPicture()
    {
        if($this->path == null)
        {
            return Storage::url('/picture/default.png');
        }

        return Storage::url($this->path);
    }
}
