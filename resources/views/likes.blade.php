@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($users as $otherUser)
                <div class="card">
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
                            @if(!$user->match($otherUser) == null)
                                <h3>It's a match!</h3>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
<style>
    .row.justify-content-center {
        width: 100%;
    }

    .card {
        padding: 20px;
        margin: 20px;
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
