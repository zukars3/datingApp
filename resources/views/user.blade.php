@extends('layouts.app')

@section('content')
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/storage/picture/female/pic04.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/storage/picture/female/pic05.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/storage/picture/female/pic06.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/storage/picture/female/female1.jpeg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
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
.carousel {
    width: 200px;
}
</style>
