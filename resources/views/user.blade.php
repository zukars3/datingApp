@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-6">
                    @if(count($pictures) == 0)
                        <img class="d-block w-100" src="{{ $otherUser->getPicture() }}" alt="First slide">
                    @else
                        <div id="carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ $otherUser->getPicture() }}"
                                         alt="Profile picture of the user">
                                </div>
                                @foreach($pictures as $picture)
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ $picture->getPicture() }}"
                                             alt="Picture of the user">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @endif
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
@endsection
<style>
    .carousel {
        width: 100%;
    }

    img {
        border-radius: 10px;
    }
</style>
