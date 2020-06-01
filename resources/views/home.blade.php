@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @if($user->info->profile_picture == null)
                <div class="col-8 offset-2 text-center" id="no_picture">
                <h1>Please complete your profile by adding a profile picture!</h1>
                </div>
            @else

                @foreach($users as $otherUser)
                    <div class="row justify-content-center">
                        <div class="col-6 text-right">
                            <img src="{{ $otherUser->info->getPicture() }}"
                                 alt="Image of the person"
                                 id="profile_picture"
                            >
                        </div>
                        <div class="col-6">
                            <h2>{{ $otherUser->info->name . ' ' . $otherUser->info->surname . ', ' . $otherUser->info->age }}</h2>
                            <br>
                            <h3>Bio:</h3>
                            <p id="description">{{ $otherUser->info->description}}</p>
                            <a href="{{ $users->previousPageUrl() }}">Previous</a>
                            <a href="{{ $users->nextPageUrl() }}">Next</a>
                            <a href="{{ route('user.show', $otherUser->id) }}">Open profile</a>
                            <div class="row reaction">

                                <div class="col-4">
                                    <form action="{{ route('like', $otherUser->id) }}" method="post">
                                        @csrf
                                        <button class="btn" type="submit"><img
                                                src="https://img.icons8.com/cotton/64/000000/like--v3.png"
                                                style="width: 100px"></button>
                                    </form>
                                </div>

                                <div class="col-4 offset-4">
                                    <form action="{{ route('dislike', $otherUser->id) }}" method="post">
                                        @csrf
                                        <button class="btn" type="submit"><img
                                                src="https://img.icons8.com/ios/100/000000/--broken-heart.png"></button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
@endsection
<style>
    .row.justify-content-center {
        width: 100%;
    }

    #no_picture {
        padding-top: 30px;
    }

    #profile_picture {
        width: 100%;
        max-height: 100%;
    }

    #description {
        font-size: 18px;
    }

    .reaction .btn {

    }
</style>
