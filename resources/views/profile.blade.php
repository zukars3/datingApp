@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit profile</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ $user->name }}

                        <img src="{{ $user->getPicture() }}" width="300px">

                        <div class="form-group">
                            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <label for="name">Name:</label><br>
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{ old('name', $user->name) }}"><br>
                                <label for="picture">Select a profile picture:</label><br>
                                <input class="form-control-file" type="file" id="picture" name="picture">
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
