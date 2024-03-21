@extends('layouts.app')

@section('title', 'Detail-User')

@section('content')
    <div class="container">

        <div class="card mb-3">
            <div class="card-header">
                <h2>User Profile</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Profile Image Section with Image Upload -->
                        <img id="previewImage" class="img-profile card-img-top rounded-circle"
                            src="{{ asset('/upload/' . $user->image_user) }}" alt="Profile Image" width="100px">
                        <form action="{{ route('PostImageUser', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image_user">Upload New Image:</label>
                                <input type="file" class="form-control" id="image_user" name="image_user"
                                    onchange="previewImage(event)">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Image</button>
                            @if (session('success-message'))
                                <i id="successMessage" class="alert alert-success">{{ session('success-message') }}</i>
                            @elseif (session('error'))
                                <span class="badge badge-danger">Failed.</span>
                            @endif
                        </form>

                    </div>
                    <div class="col-md-8">
                        <!-- User Details Section with Profile Information Form -->
                        <form action="{{ route('updateUser', $user->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">Full Name:</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                    value="{{ $user->full_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ $user->phone_number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number:</label>
                                <select name="id_role" id="id_role" class="form-control cursor-hover">
                                    @foreach ($roles as $items)
                                        <option value="{{ $items->id_role }}"
                                            {{ $items->id_role == $user->id_role ? 'selected' : '' }}>
                                            {{ $items->role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update User</button>
                            @if (session('success'))
                                <i id="successMessage" class="alert alert-success">{{ session('success') }}</i>
                            @elseif (session('error'))
                                <span class="badge badge-danger">Failed.</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- <hr> --}}
        <div class="card mb-3">
            <div class="card-header">
                <h2>Password Information</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('updateUserPassword', $user->id) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text visibility-toggle"
                                    onclick="togglePasswordVisibility('password')">
                                    <i class="fa fa-eye visibility-icon"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                            <div class="input-group-append">
                                <span class="input-group-text visibility-toggle"
                                    onclick="togglePasswordVisibility('password_confirmation')">
                                    <i class="fa fa-eye visibility-icon"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>

                    @if (session('success-password'))
                        <div id="successMessage" class="alert alert-success mt-2">
                            {{ session('success-password') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger mt-2">
                            Failed.
                        </div>
                    @endif
                </form>
            </div>
        </div>
        {{-- <hr> --}}

        <div class="card mb-3">
            <div class="card-header">
                <h2>Data Story Count</h2>
            </div>
            <div class="card-body">
                <!-- Data Story Count Section -->
                <h3 class="card-title"><strong>Number of Stories:</strong>
                    {{-- jumlah cerita dari user --}}

                    @if ($story < 0)
                        0
                    @else
                        {{ $story }}
                    @endif
                </h3>
                <!-- You can add more details about each story if needed -->
            </div>
        </div>

    </div>
@endsection
