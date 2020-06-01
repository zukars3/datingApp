@extends('layouts.app')

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if($user->info->profile_picture == null)
                        <div class="card-header">
                            Complete your profile
                            <br>
                            (you wont be able to see others while you dont complete your profile)
                        </div>
                    @else
                        <div class="card-header">
                            Edit your profile
                        </div>
                    @endif

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
                                    <img src="{{ $userInfo->getPicture() }}" width="300px" alt="Your profile picture">
                                    @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="search_age_range"
                                       class="col-md-4 col-form-label text-md-right">{{ __('I am looking for') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="js-range-slider" name="search_age_range"
                                           id="search_age_range"
                                           value=""
                                           data-type="double"
                                           data-min="18"
                                           data-max="100"
                                           data-from="{{ $userSettings->search_age_from }}"
                                           data-to="{{ $userSettings->search_age_to }}"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genderMale"
                                       class="col-md-4 col-form-label text-md-right">{{ __('I am looking for') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="search_male"
                                               id="search_male" value="1"
                                               @if($userSettings->search_male == 1)
                                               checked
                                            @endif>
                                        <label class="form-check-label" for="search_male">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="search_female"
                                               id="search_female" value="1"
                                               @if($userSettings->search_female == 1)
                                               checked
                                            @endif
                                        >
                                        <label class="form-check-label" for="search_female">Female</label>
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".js-range-slider").ionRangeSlider();
        document.registrationForm.ageInputId.oninput = function () {
            document.registrationForm.ageOutputId.value = document.registrationForm.ageInputId.value;
        }
    </script>
@endsection
