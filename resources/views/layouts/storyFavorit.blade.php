<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/ceritafavorit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/DetailStory.css') }}">

    <link rel="shortcut icon" href="{{ asset('/img/default.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="sweetalert2.min.css">

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

    <div class="content">
        @yield('content') {{-- content ini dipanggil dengan menggunakan method yield home,daftar cerita, detail cerita, atau lain nya   --}}

    </div>
    <footer>
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
    </footer>
</body>

</html>


</body>

</html>




<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- header -->
<script src="{{ asset('js/ceritafavorit.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Function to filter stories based on search input
    function filterStories(containerId) {
        const container = document.getElementById(containerId);
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const stories = container.querySelectorAll('.card');

        stories.forEach(function(story) {
            const title = story.querySelector('.text-title').textContent.toLowerCase();
            if (title.includes(searchInput)) {
                story.style.display = 'block';
            } else {
                story.style.display = 'none';
            }
        });
    }

    // Add event listener to search input
    document.getElementById('searchInput').addEventListener('input', function() {
        filterStories('storyContainer');
        filterStories('popularStoryContainer');
        filterStories('recommendedStoryContainer');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.heart-checkbox').on('change', function() {
            var checkbox = $(this);
            var id = checkbox.attr('data-story-id');
            var action = checkbox.attr('data-story-action');
            console.log(checkbox.parent('.favorite-form').serialize());

            updateHeartStyles(checkbox);

            checkbox.val(checkbox.prop('checked') ? '1' : '0');


            var currentUrl = window.location
                .href;

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
                            currentUrl; // Arahkan kembali ke URL saat ini
                        // Add logic here to update UI based on the response (if needed)
                    } else {
                        console.error('Server error:', response.message);
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Opps, Sabar Dulu',
                        text: 'Kamu Harus Login Dulu, jika ingin memberikan love pada cerita',
                        icon: 'info',
                        confirmButtonText: 'Tutup'
                    })

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
    // ---------------------------------- sticky nav / header ------------------------ //
    let lastScrollTop = 0;
    const navbar = document.getElementById("nav");

    window.addEventListener("scroll", function() {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScrollTop) {
            // Scroll down
            navbar.classList.add("sticky");
            document.body.classList.add("sticky-nav");
        } else {
            // Scroll up
            navbar.classList.remove("sticky");
            document.body.classList.remove("sticky-nav");
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
    });
</script>
