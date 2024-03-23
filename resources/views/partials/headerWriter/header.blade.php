<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/writer.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Poppins:wght@100;200;400;600&display=swap"
        rel="stylesheet" />
    {{-- <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>@yield('title')</title>
</head>

<body style="background: #00224d;">
    <div class="nav">
        <div class="nav-area">
            <div class="nav-burger" onclick="toggleSidebar()">
                <span class="material-symbols-outlined"> menu </span>
            </div>
            <div class="search-box">
                <input type="text" name="" value="" placeholder="Cari Cerita Favorit Anda" />
                <button type="submit" name="button">
                    <span class="material-symbols-outlined"> search </span>
                </button>
            </div>
            <div class="nav-menu-dekstop">
                <div class="notif">
                    <div class="dropdown1">
                        <a href="#"  onclick="toggleDropdown('dropdownNotif')" class="dropbtn1">
                            <span class="material-symbols-outlined"> notifications </span>
                            <span class="badge  badge-counter"></span>
                        </a>
                        <div id="dropdownNotif" class="dropdown-content1">

                        </div>
                    </div>
                </div>
                <div class="akun">
                    <div class="dropdown">
                        <a href="#" onclick="toggleDropdown('dropdown1')" class="dropbtn">
                            <span class="material-symbols-outlined dropbtn ">
                                person
                            </span>
                        </a>
                        <div id="dropdown1" class="dropdown-content">
                            <div class="akun1">
                                <div class="akun2">
                                    <a href="{{ route('profiles', ['id' => Auth::user()->id]) }}">
                                        <span class="material-symbols-outlined"> person </span>
                                        Profile
                                    </a>
                                </div>
                            </div>
                            <div class="akun1">
                                <div class="akun2">
                                    <a href="{{ route('logoutUser') }}">
                                        <span class="material-symbols-outlined">login</span>
                                        Log Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
