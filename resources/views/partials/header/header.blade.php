 <html lang="en">

 <head>

     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>@yield('title')</title>

     {{-- <link rel="stylesheet" href="{{ asset('css/DetailStory.css') }}"> --}}

     <link rel="stylesheet" href="{{ asset('css/home.css') }}">

     <link rel="shortcut icon" href="{{ asset('/img/default.png') }}" type="image/x-icon" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css">
     <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
     <link href="{{ asset('vendor/fontawesome-free/css/fontawesome.min.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Lora&family=Poppins:wght@100;200&display=swap"
         rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Lora&family=Poppins:wght@100;200;400;600&display=swap"
         rel="stylesheet">
 </head>

 <body>



     <div class="navs" id="nav">
         <div class="nav-area">
             <a class="brand" href="">
                 <h3>Story Apps</h3>
             </a>

             <div class="nav-burger" {{-- onclick="gganjai()" --}}>
                 <span class="material-symbols-outlined ">

                     menu
                 </span>
             </div>

             <div class="nav-menu">
                 <div class="nav-menu-1 pc">
                     <a href="#" onclick="list()">Genre <i id="iconnav" class="fa fa-caret-down"></i></a>
                 </div>
                 <div class="nav-menus-1 menu-nav-mb mobile">
                     <a href="#" onclick="toggleDropdown()">Genre <i id="iconnav"
                             class="fa fa-caret-down"></i></a>
                     <div class="container-dw-mobile" id="list-mobile">
                         @foreach ($data['genre'] as $genre)
                             <div class="row2-mobile">
                                 <div class="column2-mobile">
                                     <a href="{{ route('StoryByGenre', $genre->genre) }}">{{ $genre->genre }}</a>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 </div>
                 <div class="nav-menu-2">
                     <a href="{{ route('storyList') }}">Daftar Cerita</a>
                 </div>
                 <a href="{{ route('storyList') }}">Membaca</a>
                 <a href="{{ route('writter') }}">Menulis</a>
                 @if (Auth::check())
                     <a href="{{ route('storyFavorite', Auth::user()->id) }}">
                         Favorite
                     </a>
                     <div class="login-btn-Mobile">
                         <a href="{{ route('logoutUser') }}">Logout</a>
                     </div>
                 @else
                     <div class="login-btn-Mobile">
                         <a href="{{ route('registerUser') }}">Register</a>
                         <a href="{{ route('loginUser') }}">Login</a>

                     </div>
                 @endif

             </div>

             <div class="search-box">
                 <input type="text" id="searchInput" placeholder="Cari Cerita Favorit Anda">

                 {{-- untuk membuka pencarian --}}

                 <button type="button" class="btn-serch" data-action="search" onclick="toggleSearch(this)"
                     id="searchButton">
                     <span class="material-symbols-outlined">
                         search
                     </span>
                 </button>
                 {{-- untuk mencari --}}
                 <button type="button" class="btn-serch2">
                     <span class="material-symbols-outlined">
                         search
                     </span>
                 </button>
             </div>


             {{-- <div class="nav-menu-dekstop">
                @if (Auth::check())
                    <a href="{{ route('logoutUser') }}">Logout</a>
                @else
                    <a href="{{ route('registerUser') }}">Register</a>
                    <a href="{{ route('loginUser') }}">Login</a>
                @endif
            </div> --}}
             <div class="nav-menu-dekstop">
                 @if (Auth::check())
                     <a href="{{ route('storyFavorite', Auth::user()->id) }}">
                         <i class="fas fa-heart"></i>
                     </a>
                     <div class="dropdown-custom">
                         <a class="dropbtn-custom">
                             <i class="fas fa-user"></i>
                         </a>
                         <div class="dropdown-content-custom">
                             <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                 <i class="fas fa-user"></i> Profile
                             </a>
                             <a href="{{ route('logoutUser') }}">
                                 <i class="fas fa-sign-out-alt"></i> Logout
                             </a>
                         </div>
                     </div>
                 @else
                     <a href="{{ route('registerUser') }}">Register</a>
                     <a href="{{ route('loginUser') }}">Login</a>
                 @endif
             </div>


         </div>
     </div>




     <div class="overlay" onclick="hideList()" id="overlay"></div>
     <div class="container-dw" id="listss">
         @foreach ($data['genre'] as $genre)
             <div class="row">
                 <div class="column">
                     <a href="{{ route('StoryByGenre', $genre->genre) }}">{{ $genre->genre }}</a>
                 </div>
             </div>
         @endforeach
     </div>
