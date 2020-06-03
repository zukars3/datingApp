Hey, {{ $userInfo->name }}!

We have some good news for you.. You've got a match!

Your match is:

{{ $otherUserInfo->name . ' ' . $otherUserInfo->surname . ' ' . $otherUserInfo->age }}

{{ $gender[0] }} is from {{ $otherUserInfo->country }} and {{ $gender[1] }} speaks {{ $otherUserInfo->languages }} language.

To contact {{ $gender[2] }} you can use this email {{ $otherUser->email }} or phone number {{ $otherUserInfo->phone }}
