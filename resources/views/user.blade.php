@extends('layouts.app')

@section('content')
    <div class="container body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ $otherUser->getPicture() }}" width="100%" alt="Image of the person">
                        </div>
                        <div class="col-6">
                            <h3>{{ $otherUser->name . ' ' . $otherUser->surname . ', ' . $otherUser->age }}</h3>
                            <br>
                            <p>Description:</p>
                            <p>{{ $otherUser->description}}</p>
                        </div>
                    </div>
            </div>
        </div>

    </div>
@endsection
<style>

</style>
