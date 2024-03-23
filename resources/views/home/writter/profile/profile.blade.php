@extends('layouts.writer')
@section('title', 'Profiles')
@section('content')
    <div id="page" class="tabcontent-profil">
        <div class="page">
            <div class="container-profile">
                <!-- Alert Messages -->
                @if (session('success-password'))
                    <div id="successMessage" class="alert alert-success mt-2">
                        {{ session('success-password') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger mt-2">
                        Failed.
                    </div>
                @endif

                <!-- Navigation -->
                <div class="navigation">
                    <a href="{{ route('StoryApps') }}">
                        <svg width="20" height="17" viewBox="0 0 20 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M20 16.918C17.5535 13.9315 15.381 12.237 13.482 11.834C11.5835 11.4315 9.776 11.3705 8.059 11.6515V17L0 8.2725L8.059 0V5.0835C11.2335 5.1085 13.932 6.2475 16.155 8.5C18.3775 10.7525 19.6595 13.5585 20 16.918Z"
                                fill="#005AC8" />
                        </svg>
                    </a>
                    <a href="{{ route('StoryApps') }}">
                        <h5>Home</h5>
                    </a>
                    <p>/</p>
                    <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                        <h5>Profile</h5>
                    </a>
                </div>

                <!-- Content -->
                <div class="content">
                    <!-- Menu Tabs -->
                    <div class="menu-tabs cards">
                        <div class="tab desktop tab-link" data-tab="profile">Profile</div>
                        <div class="tab tab-link" data-tab="change-password">Change Password</div>
                    </div>

                    <!-- Profile Content -->

                    <div id="profile" class="tab-content cards-body">
                        <form action="{{ route('UpdateUser', $data['user']->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="profile-card">
                                <div class="left-column">
                                    <label class="file-input">

                                        @if (empty($data['user']->image_user))
                                            <img src="{{ asset('/img/default.png') }}" alt="icon">
                                        @else
                                            <img src="{{ asset('/upload/' . $data['user']->image_user) }}" alt="icon">
                                        @endif
                                        <input type="file" name="image_user" class="file"
                                            value="{{ $data['user']->image_user }}">
                                        <input type="hidden" name="old_image_user" value="{{ $data['user']->image_user }}">
                                    </label>
                                </div>
                                <div class="right-column">
                                    <div class="form-group">
                                        <div class="text"><i class="fa fa-user"></i> Full Name</div>
                                        <input type="text" name="full_name" class="input"
                                            value="{{ $data['user']->full_name }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="text"><i class="fa fa-user"></i> Username</div>
                                        <input type="text" name="username" class="input"
                                            value="{{ $data['user']->username }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="text"><i class="fa fa-phone"></i> Phone Number</div>
                                        <input type="number" name="phone_number" class="input"
                                            value="{{ $data['user']->phone_number }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="text"><i class="fa fa-envelope"></i> Email</div>
                                        <input type="email" name="email" class="input"
                                            value="{{ $data['user']->email }}">
                                    </div>
                                </div>
                            </div>
                            <!-- Profile Buttons -->
                            <div class="profile-buttons">

                                <div class="right-buttons">
                                    <button type="submit" class="btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Content -->


                <div id="change-password" class="tab-content cards-body" style="display: none; width: 100%;">
                    <form action="{{ route('UpdatePassword', $data['user']->id) }}" method="post">
                        @csrf
                        <div class="container-form">
                            <div class="right-column">
                                <div class="form-group">
                                    <label for="password" class="labels">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="input" name="password" id="password">
                                        <div class="input-group-append">
                                            <span class="input-group-text visibility-toggle"
                                                onclick="togglePasswordVisibility('password')">
                                                <i class="fa fa-eye visibility-icon" style="cursor: pointer;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="labels">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="input" name="password_confirmation"
                                            id="password_confirmation">
                                        <div class="input-group-append">
                                            <span class="input-group-text visibility-toggle2"
                                                onclick="togglePasswordVisibility('password_confirmation')">
                                                <i class="fa fa-eye visibility-icon" style="cursor: pointer;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="container-button">
                            <button type="submit" class="btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
