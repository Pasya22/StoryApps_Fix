@extends('layouts.login')
@section('title', 'Register As Writer')

@section('content')

    <form action="{{ route('regisUser') }}" method="post" id="register-form" class="register" >
        <a href="{{ route('StoryApps') }}"><i class="fa fa-arrow-left" style="color: white;"></i></a>

        @csrf
        <h2>Register As Writer</h2>
        <div class="input">
            <input type="text" id="full_name" name="full_name" placeholder="Full Name" required>
            @error('full_name')
                <span class="error">{{ $message }}</span>
            @enderror

            <div class="check">
                <input type="email" id="email" name="email" placeholder="Email" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror

                <input type="text" id="username" name="username" placeholder="Username" required>
                @error('username')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" required>
            @error('phone_number')
                <span class="error">{{ $message }}</span>
            @enderror

            <div class="check">
                <input type="password" id="password" name="password" placeholder="Password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror

                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="password_confirmation" required>
                @error('password_confirmation')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <input type="submit" value="Register" id="register-button">

    </form>
@endsection
