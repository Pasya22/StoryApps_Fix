<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- <link rel="stylesheet" href="{{ asset('css/DetailStory.css') }}">
    <link rel="stylesheet" href="{{ asset('css/storyList.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/chatstory.css') }}">

    <link rel="icon" href="{{ asset('/img/default.png') }}" type="image/x-icon"/>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/fontawesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Poppins:wght@100;200;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/fontawesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Poppins:wght@100;200&display=swap"
        rel="stylesheet">

</head>

<body>

    <div class="navs" id="nav">
        <div class="nav-area">
            <a class="brand" href="">
                <h3>LOGO</h3>
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
                    <a href="{{ route('logoutUser') }}">Logout</a>
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

                <button type="button" class="btn-serch" data-action="search" onclick="toggleSearch(this)">
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
                    <a href="{{ route('listFavorite') }}">
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
                            <a href="{{ route('listFavorite') }}">
                                <i class="fas fa-heart"></i> Favorite
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

    <div class="content">
        @yield('content') {{-- content ini dipanggil dengan menggunakan method yield home,daftar cerita, detail cerita, atau lain nya   --}}

    </div>
    {{-- <footer>
        <div class="footer-col-1">
            <div class="text-1">
                <h3>Ikuti info terbaru dari kami</h3>
            </div>
            <div class="text-1">
                <div class="email-box">
                    <input type="text" name="" value="" placeholder="Cari Cerita Favorit Anda">
                    <button type="submit" name="button">
                        <figure>
                            <a href="#">
                                <img src="{{ asset('/img/konten/send.svg') }}" alt="">
                            </a>
                        </figure>
                    </button>
                </div>
            </div>
        </div>
        <div class="footer-col-2">
            <div class="text">
                <a href="#">
                    <div class="text-3">Tentang Kami</div>
                </a>
                <a href="#">
                    <div class="text-3">Kebijakan Privasi</div>
                </a>
                <a href="#">
                    <div class="text-3">Syarat dan Ketentuan</div>
                </a>
                <a href="#">
                    <div class="text-3">FAQ</div>
                </a>
            </div>
            <div class="social" style="display: flex;">
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-whatsapp"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>

            </div>
            <hr>
            <div class="text-footer">&copy;2023 CV Javawebster All Rights Reserved</div>
        </div>
    </footer> --}}
</body>

</html>


</body>

</html>



<script src="{{ asset('js/DetailStory.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- header -->
<script src="{{ asset('js/home.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function loginDulu() {
        alert("Anda belum Login!");
        window.location = {{ route('loginUser') }};
    }
</script>
<!--swiper-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.heart-checkbox').on('change', function() {
            var checkbox = $(this);
            var id = checkbox.attr('data-story-id');
            var action = checkbox.attr('data-story-action');
            console.log(checkbox.parent('.favorite-form').serialize());
            // Update Heart Styles
            updateHeartStyles(checkbox);

            // console.log(checkbox.prop('checked') ? '1' : '0');

            // Set checkbox value based on checked status
            checkbox.val(checkbox.prop('checked') ? '1' : '0');

            // console.log('checkbox'. checkbox);

            // Perform Ajax request
            $.ajax({
                type: 'POST',
                url: action,
                data: checkbox.parent('.favorite-form').serialize(),
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        console.log(response.message);
                        alert('Add The Stories To Your Favorite!');
                        window.location.href =
                            '/';
                        // Add logic here to update UI based on the response (if needed)
                    } else {
                        console.error('Server error:', response.message);
                    }
                },
                error: function(error) {
                    confirm('Upami bade masihan love, kudu login hela!');
                    window.location.href =
                        '/Auth'; // Gunakan href untuk mengarahkan ke URL lengkap
                    console.error(error);
                }
            });
        });

        function updateHeartStyles(checkbox) {
            var heart = checkbox.next();
            var checkboxToHide = checkbox.next().next();

            if (checkbox.prop('checked')) {
                heart.addClass('checked');
                checkboxToHide.hide(); // Hide the checkbox
            } else {
                heart.removeClass('checked');
                checkboxToHide.show(); // Show the checkbox
            }
        }
    });
</script>

<script>
    function list() {
        var litss = document.getElementById('listss');
        var overlay = document.getElementById('overlay');
        var iconnav = document.getElementById('iconnav');
        litss.classList.toggle('show');
        overlay.classList.toggle('show');
        iconnav.classList.toggle('show');
    }

    function hideList() {
        var listss = document.getElementById('listss');
        listss.classList.remove('show');
        var overlay = document.getElementById('overlay');
        overlay.classList.remove('show'); // Pastikan overlay disembunyikan saat daftar juga disembunyikan
    }
</script>
<script>
    function toggleDropdown() {
        var contentList = document.getElementById('list-mobile');
        contentList.classList.toggle('show');
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen-elemen dropdown
        var dropdownBtns = document.querySelectorAll('.dropbtn2');
        var megaDropdown = document.querySelector('.mega-dropdown');

        // Tambahkan event listener untuk dropdown
        dropdownBtns.forEach(function(btn) {
            btn.addEventListener('mouseenter', function() {
                this.classList.toggle('active');
                var icon = this.querySelector('.fa-caret-down');
                icon.classList.toggle('fa-caret-up');
            });

            btn.addEventListener('mouseleave', function() {
                this.classList.remove('active');
                var icon = this.querySelector('.fa-caret-down');
                icon.classList.remove('fa-caret-up');
            });
        });

        // Tambahkan event listener untuk mega dropdown
        megaDropdown.addEventListener('mouseenter', function() {
            this.classList.add('show', 'rollDown');
        });

        megaDropdown.addEventListener('mouseleave', function() {
            this.classList.remove('show', 'rollDown');
            this.classList.add('rollUp');
        });
    });
</script>
