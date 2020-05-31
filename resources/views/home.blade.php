@extends('layouts.app')

@section('content')
    <div class="container body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($users as $otherUser)
                    @if($user->match($otherUser) !== null)
                        <h3>Its a match!</h3>
                    @endif

                    @if($user->dislike($otherUser) !== null)
                        <h3>Its a dislike :(</h3>
                    @endif

                    <div class="row">
                        <div class="col-6">
                            <img src="{{ $otherUser->info->getPicture() }}" width="100%" alt="Image of the person">
                        </div>
                        <div class="col-6">
                            <h3>{{ $otherUser->info->name . ' ' . $otherUser->info->surname . ', ' . $otherUser->info->age }}</h3>
                            <br>
                            <p>Description:</p>
                            <p>{{ $otherUser->info->description}}</p>
                            <a href="{{ $users->previousPageUrl() }}">Previous</a>
                            <a href="{{ $users->nextPageUrl() }}">Next</a>
                            <a href="{{ route('user.show', $otherUser->id) }}">Open profile</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 offset-6">
                            <form action="{{ route('dislike', $otherUser->id) }}" method="post">
                                @csrf
                                <button class="btn btn-responsive btn-danger" type="submit">Dislike</button>
                            </form>
                        </div>

                        <div class="col-2">
                            <form action="{{ route('like', $otherUser->id) }}" method="post">
                                @csrf
                                <button class="btn btn-responsive btn-success" type="submit">Like</button>
                            </form>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

    </div>
@endsection
<style>

</style>
