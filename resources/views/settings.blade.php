@extends('layouts.app')

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>


@section('content')

    <div class="container">

        <div class="container mt-5">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-4 pb-5">
                    <div class="author-card pb-3">
                        <div class="author-card-profile">
                            <div class="author-card-avatar">
                                <img src="{{ $userInfo->getPicture() }}"
                                     id="profile_picture"
                                     alt="Picture of you" style="width: 100%">
                                <div class="text-center upload">
                                    <form action="{{ route('profile.updateProfilePicture') }}"
                                          enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('put')
                                        <input id="custom" type="file" name="picture" onchange="this.form.submit()"
                                               required="" multiple>
                                        <label class="btn">
                                            Change profile photo
                                            <input
                                                type="file"
                                                name="picture"
                                                onchange="this.form.submit()"
                                                multiple>
                                        </label>
                                    </form>
                                </div>
                            </div>
                            <div class="author-card-details">
                                <h5 id="full-name" class="author-card-name text-lg">{{ $userInfo->name . ' ' . $userInfo->surname }}</h5>
                                <h6 id="joined" class="author-card-position">Joined {{ $user->created_at }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="wizard">
                        <nav class="list-group list-group-flush">
                            <a id="inactive" class="list-group-item" href="{{ route('profile.updateProfile') }}">Edit
                                Profile</a>
                            <a id="active" class="list-group-item active" href="{{ route('profile.updateSettings') }}">Edit
                                Settings</a>
                            <form id="destroy" action="{{ route('profile.destroy') }}" method="post">
                                @csrf
                                @method('delete')

                                <a id="delete" class="list-group-item" href="javascript:$('#destroy').submit();">Delete Profile</a>
                            </form>
                        </nav>
                    </div>
                </div>

                <div class="col-lg-8 pb-5 settings">
                    <form method='post' action="{{ route('profile.updateSettings') }}">
                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <label for="search_age_range"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Age range') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="js-range-slider"
                                       name="search_age_range"
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

                        <div class="col-12">
                            <hr class="mt-2 mb-3">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <button type="submit" id="update-button" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
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

    #profile_picture {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #full-name {
        font-weight: bold;
        text-align: center;
    }

    #joined {
        font-style: italic;
        text-align: center;
    }

    .settings {
        padding-top: 10%;
    }

    .list-group {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #active {
        background: #212529;
        border: none;
    }

    #inactive {
        color: #212529;
    }

    #delete {
        background: red;
        color: white;
        margin-bottom: -14px;
    }

    #update-button {
        background: #212529;
        border: none;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
