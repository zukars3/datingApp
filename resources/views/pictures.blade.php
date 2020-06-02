@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center upload">
            <form action="{{ route('pictures.add') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input id="custom" type="file" name="picture[]" onchange="this.form.submit()" required="" multiple>
                <label class="btn">
                    Add photos
                    <input
                        type="file"
                        name="picture[]"
                        onchange="this.form.submit()"
                        multiple>
                </label>
            </form>
        </div>

        @if(count($pictures) == 0)
            <div class="text-center empty">
                <h2>Nothing to show here yet...</h2>
            </div>
        @else

            <div class="row">
                @for($i = 0; $i < count($pictures); $i++)
                    <div class="col-md-4">
                        <div class="picture">
                            <img
                                src="{{ $pictures[$i]->getPicture() }}"
                                alt="Image of user"
                            >
                            <form class="test-form" action="{{ route('pictures.destroy', $pictures[$i]->id) }}"
                                  method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-responsive btn-danger" type="submit">X</button>
                            </form>
                        </div>
                    </div>
                @endfor
            </div>
        @endif
    </div>
@endsection
<style>
    .text-center.upload input {
        display: none
    }

    .text-center.upload {
        color: white;
        font-weight: bold;
        text-decoration: underline;
    }

    .text-center .btn {
        color: black;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .empty {
        margin-top: 30%;
        color: black;
        text-shadow: 3px 4px 3px rgba(0, 0, 0, 0.3);
    }

    .col-md-3 {
        padding-bottom: 20px;
    }

    .picture {
        position: relative;
    }

    .picture:before {
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
    }

    .picture img {
        border-radius: 10px;
        display: block;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        width: 100%;
        height: 340px;
    }

    .picture button {
        position: absolute;
        top: 5px;
        left: 10px;
        opacity: 0;
        transition: visibility 0s, opacity 0.5s linear;
        padding: 5px 9px;
        font-size: 10px;
        border-radius: 4px;
    }

    .picture:hover button {
        opacity: 1;
    }

    .modal-dialog {
        max-width: none;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }

    .modal-content {
        height: 92%;
    }

    .modal-body object {
        height: 95%;
    }
</style>
