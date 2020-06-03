<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMatchedEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user;
    private $userInfo;
    private $otherUser;
    private $otherUserInfo;
    private $otherUserGender;

    public function __construct(User $user, User $otherUser)
    {
        $this->user = $user;
        $this->userInfo = $user->info;
        $this->otherUser = $otherUser;
        $this->otherUserInfo = $otherUser->info;
        $this->otherUserGender = $this->otherUserInfo->gender;
    }

    public function build()
    {
        if($this->otherUserGender == 'male') {
            $gender = ['He', 'he', 'him'];
        } else {
            $gender = ['She', 'she', 'her'];
        }

        return $this->view('emails.matched', [
            'user' => $this->user,
            'userInfo' => $this->userInfo,
            'otherUser' => $this->otherUser,
            'otherUserInfo' => $this->otherUserInfo,
            'gender' => $gender
        ]);
    }
}
