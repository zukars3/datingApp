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

    public static function boot(): void
    {
        parent::boot();

        static::deleting(function (Picture $picture) {
            Storage::delete([
                Storage::disk('public')->delete($picture->path),
            ]);
        });
    }

    public function getPicture()
    {
        if($this->path == null)
        {
            return Storage::url('/picture/default.png');
        }

        return Storage::url($this->path);
    }
}
