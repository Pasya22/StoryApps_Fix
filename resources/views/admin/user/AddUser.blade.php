@extends('layouts.app')
@section('title', 'Add User')

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
                            src="{{ asset('/upload/default.png') }}" alt="Profile Image" width="100px">

                    </div>
                    <div class="col-md-8">
                        <!-- User Details Section with Profile Information Form -->
                        <form action="{{ route('PostUser') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image_user">Upload Image:</label>
                                <input type="file" class="form-control" id="image_user" name="image_user"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="form-group">
                                <label for="role" class="cursor-hover">Role</label>
                                <select name="id_role" id="id_role" class="form-control cursor-hover">
                                    <option value="">-- Choice Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id_role }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="full_name">Full Name:</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                    placeholder="Full Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="example@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="Phone Number" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username" required>
                            </div>
                            <!-- New Password Section -->
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="password Confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Save</button>
                            @if (session('success'))
                                <span class="badge badge-success">Saved.</span>
                            @elseif (session('error'))
                                <span class="badge badge-danger">Failed.</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
