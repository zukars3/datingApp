@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Complete your profile <br>(you wont be able to see others while you dont complete your profile)</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method='post' action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="form-group row">
                                <label for="picture"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Select your profile picture:') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control-file" type="file" id="picture" name="picture">
                                    <img src="{{ $userInfo->getPicture() }}" width="300px">
                                    @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
