@extends('layouts.app3')
@section('title', 'Profiles')
@section('content')
    <div class="content">

        <div class="container-profil">
            @if (session('success-password'))
                <div id="successMessage" class="alert alert-success mt-2">
                    {{ session('success-password') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger mt-2">
                    Failed.
                </div>
            @endif
            <div class="home">
                <a href="{{ route('StoryApps') }}"><svg width="20" height="17" viewBox="0 0 20 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M20 16.918C17.5535 13.9315 15.381 12.237 13.482 11.834C11.5835 11.4315 9.776 11.3705 8.059 11.6515V17L0 8.2725L8.059 0V5.0835C11.2335 5.1085 13.932 6.2475 16.155 8.5C18.3775 10.7525 19.6595 13.5585 20 16.918Z"
                            fill="#005AC8" />
                    </svg></a>
                <a href="{{ route('StoryApps') }}">
                    <h5>Home</h5>
                </a>
                <p>/</p>
                <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                    <h5>Profile</h5>
                </a>


            </div>
            <div class="cards">
                <div class="left-column desktop">
                    <div class="cards">
                        <div class="cards-header2">
                            <h2>Menu</h2>
                        </div>
                        <div class="cards-body2">
                            <a href="#" class="tab-link" data-tab="profile">Profile</a>
                            <a href="#" class="tab-link" data-tab="change-password">Change Password</a>
                            <a href="#" class="tab-link" data-tab="favorite">Favorite</a>
                        </div>
                    </div>
                </div>
                <div class="left-column mobile">
                    <div class="cards">
                        <div class="cards-header2">
                            <h2>Menu</h2>
                        </div>
                        <div class="cards-body2">
                            <select name="" id="">
                                <option value="profile"> <a href="#" class="tab-link" data-tab="profile">Profile</a>
                                </option>
                                <option value="change-password"> <a href="#" class="tab-link"
                                        data-tab="change-password">Change Password</a></option>
                                <option value="favorite"> <a href="#" class="tab-link"
                                        data-tab="favorite">Favorite</a></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="right-column">
                    <div class="cards">
                        <div class="cards-header">
                            <h2 id="card-title">Profil User</h2>
                        </div>
                        <div class="cards-body" id="profile">
                            <form action="{{ route('UpdateUser', $data['user']->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container-form">
                                    <div class="left">
                                        <label class="file-input">
                                            <input type="file" name="image_user" class="file"
                                                value="{{ $data['user']->image_user }}">
                                            <input type="hidden" name="old_image_user"
                                                value="{{ $data['user']->image_user }}">
                                            @if (empty($data['user']->image_user))
                                                <img src="{{ asset('/img/default.png') }}" alt="icon">
                                            @else
                                                <img src="{{ asset('/upload/' . $data['user']->image_user) }}"
                                                    alt="icon">
                                            @endif
                                        </label>
                                    </div>
                                    <div class="right">
                                        <div class="form-group">
                                            <input type="text" name="full_name" class="input"
                                                value="{{ $data['user']->full_name }}">
                                            <i class="text"><i class="fa fa-user"></i> Full Name</i>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" class="input"
                                                value="{{ $data['user']->username }}">
                                            <i class="text"><i class="fa fa-user"></i> Username</i>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="phone_number" class="input"
                                                value="{{ $data['user']->phone_number }}">
                                            <i class="text"><i class="fa fa-phone"></i> Phone Number</i>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="input"
                                                value="{{ $data['user']->email }}">
                                            <i class="text"><i class="fa fa-envelope"></i> Email</i>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    @if (Auth::user()->id_role == 3)
                                        <button id="requestWriterBtn" data-user-id="{{ $data['user']->id }}"
                                            type="button" class="custom-btn btn-12"><span>Click!</span>
                                            <span>Request Writer</span></button>
                                    @endif
                                    <div id="errorMessage" style="color: red;"></div>

                                </div>
                                <div class="container-button" style="display: flex; justify-content: flex-end;">
                                    <button type="submit" class="btn"
                                        style="width: 50%; text-align: center;">Save</button>
                                </div>

                            </form>
                        </div>

                        <div class="cards-body" id="change-password" style="display: none;">
                            <form action="{{ route('UpdatePassword', $data['user']->id) }}" method="post">
                                @csrf
                                <div class="container-form">
                                    <div class="right">
                                        <div class="form-group">
                                            <input type="password" class="input" name="password" id="password">

                                            <i class="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text visibility-toggle"
                                                        onclick="togglePasswordVisibility('password')">
                                                        <i class="fa fa-eye visibility-icon" style="cursor: pointer;"></i>
                                                    </span>
                                                </div>&nbsp; Password
                                            </i>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="input" name="password_confirmation"
                                                id="password_confirmation">
                                            <i class="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text visibility-toggle"
                                                        onclick="togglePasswordVisibility('password_confirmation')">
                                                        <i class="fa fa-eye visibility-icon" style="cursor: pointer;"></i>
                                                    </span>
                                                </div> &nbsp;Confrim Password
                                            </i>
                                        </div>


                                    </div>
                                </div>

                                <div class="container-button" style="display: flex; justify-content: flex-end;">
                                    <button type="submit" class="btn">Simpan</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#requestWriterBtn').click(function() {
                var userId = $(this).data('user-id');

                $.ajax({
                    url: '/RequestBeWriter/' + userId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Handle success response
                            alert(response.message);
                        } else {
                            // Handle unsuccessful response
                            $('#errorMessage').text(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        var errorMessage = xhr.responseJSON.message;
                        $('#errorMessage').text(errorMessage);
                    }
                });
            });
        });
    </script>

@endsection
