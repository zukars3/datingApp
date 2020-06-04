<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class EmojiService
{
    private $positiveEmojis = [
        'picture/emoji/crazy_poz.png',
        'picture/emoji/heart_kiss_poz.png',
        'picture/emoji/hearts_poz.png',
        'picture/emoji/smile_poz.png',
        'picture/emoji/smile_side_poz.png',
        'picture/emoji/smirking_face_poz.png'

    ];

    private $negativeEmojis = [
        'picture/emoji/angry_neg.png',
        'picture/emoji/eye_roll_neg.png',
        'picture/emoji/green_neg.png',
        'picture/emoji/neg.png',
        'picture/emoji/scared_neg.png',
        'picture/emoji/terrified_neg.png'
    ];

    public function getPositiveEmojiUrl(): string
    {
        $emojiId = rand(0, count($this->positiveEmojis) - 1);
        return Storage::url($this->positiveEmojis[$emojiId]);
    }

    public function getNegativeEmojiUrl(): string
    {
        $emojiId = rand(0, count($this->negativeEmojis) - 1);
        return Storage::url($this->negativeEmojis[$emojiId]);
    }
}
