@extends('layouts.detailStory') {{-- pemanggilan header,footer,content ada di halaman app2 --}}
@section('title', 'Story List') {{-- guna untuk membantu memberikan identitas halaman yaitu dengan judul halaman/title --}}


@section('content') {{-- ini adalah content nya --}}
    {{-- ini contoh manggil gambar dengan sifat dinamis
    atau pemanggilan seperti menggunakan foreach dan di kombinasi kan dengan di public --}}


    <div class="container-cerita-terbaru">
        <div class="cerita-terbaru container">
            <div class="cerita-terbaru card">
                <div class="cerita-terbaruNav">
                    <a href="{{ route('StoryApps') }}">
                        <img src="{{ asset('/img/konten/turnLeft.svg') }}" alt="" class="iconleft">
                    </a>
                    <a href="#" class="Cerita-Terbaru HomeNav">Home</a>
                    <p>/</p>
                    <a href="#" class="Cerita-Terbaru KeranjangNav">Story List</a>
                </div>
                <div class="Cerita-Terbaru card2">
                    <div class="Cerita-Terbaru RekomLeft">
                        <div class="Cerita-Terbaru TitleLeft">Recomendation</div>

                        @foreach ($data['RateRecomendationStory'] as $items)
                            <div class="Cerita-Terbaru cardLeft1">
                                <div class="Cerita-Terbaru contentLeft1">
                                    <div class="columns">
                                        <a href="{{ route('detailStory', $items->id_story) }}">
                                            <figure>
                                                <img src="/upload/{{ $items->images }}"class="img-1">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="column-2">
                                        <div class="Cerita-Terbaru isicontentLeft1">
                                            <div class="dropdown" onclick="toggleCard2()">
                                                <button class="dropbtn">
                                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10.5364 5.4225C11.6437 5.4225 12.5413 4.52491 12.5413 3.41767C12.5413 2.31043 11.6437 1.41284 10.5364 1.41284C9.42921 1.41284 8.53162 2.31043 8.53162 3.41767C8.53162 4.52491 9.42921 5.4225 10.5364 5.4225Z"
                                                            stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M2.51713 10.1004C3.62436 10.1004 4.52196 9.20282 4.52196 8.09559C4.52196 6.98835 3.62436 6.09076 2.51713 6.09076C1.40989 6.09076 0.512299 6.98835 0.512299 8.09559C0.512299 9.20282 1.40989 10.1004 2.51713 10.1004Z"
                                                            stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M10.5364 14.7784C11.6437 14.7784 12.5413 13.8808 12.5413 12.7736C12.5413 11.6663 11.6437 10.7687 10.5364 10.7687C9.42921 10.7687 8.53162 11.6663 8.53162 12.7736C8.53162 13.8808 9.42921 14.7784 10.5364 14.7784Z"
                                                            stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.24796 9.10474L8.81228 11.7645" stroke="black"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M8.8056 4.42676L4.24796 7.0865" stroke="black"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>

                                            </div>
                                            {{-- <label for="heart-checkbox-" id="heart-" class="heart">
                                                <input type="checkbox" name="" class="heart-checkbox"
                                                    id="heart-checkbox-" onchange="toggleHeartColor()">
                                            </label> --}}

                                            @if (Auth::check())
                                                <form action="{{ route('favorite') }}" method="post" class="favorite-form">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_story" value="{{ $items->id_story }}">
                                                    @php
                                                        $favoritItem = $data['favorit']->where('id_story', $items->id_story)->first();
                                                    @endphp

                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox-{{ $items->id_story }}"
                                                        data-story-id="{{ $items->id_story }}"
                                                        data-story-action="{{ route('favorite') }}" style="color: red;"
                                                        {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                    <label for="heart-checkbox-{{ $items->id_story }}"
                                                        class="heart  {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }} hearts"
                                                        id="heart hearts"></label>
                                                </form>
                                            @else
                                                <a href="#">
                                                    <label for="heart-checkbox" class="heart" id="heart"></label>
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox">
                                                </a>
                                            @endif


                                            <div class="Cerita-Terbaru TextcontentLeft1">

                                                <p class="text-title">{{ Str::limit('Title', 8) }}</p>
                                                <strong style="width: 65px; display: inline-block;">Writter</strong>
                                                <span>: {{ Str::limit('Title', 8) }}</span><br>
                                                <strong style="width: 65px; display: inline-block;">Genre</strong>
                                                <span>: {{ Str::limit('Komedi', 8) }}</span>

                                            </div>
                                            <div class="rate">

                                                <div class="bin">
                                                    @if ($items->average_rating >= 0.5 && $items->average_rating <= 5)
                                                        @for ($i = 0.5; $i <= 5; $i++)
                                                            @if ($i <= $items->average_rating)
                                                                <span class="fa fa-star checked"
                                                                    style="cursor: pointer;"></span>
                                                            @else
                                                                @if ($i - 0.5 <= $items->average_rating)
                                                                    <span class="fa fa-star-half checked-half"
                                                                        style="cursor: pointer; "></span>
                                                                @else
                                                                    <span class="fa fa-star"
                                                                        style="cursor: pointer;"></span>
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                    <div class="counts">
                                                        <span class="counts">
                                                            {{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="storyList-share">
                                    <div class="close-button" onclick="toggleCard()"></div>
                                    <figure>
                                        <a href="00"><img src="{{ asset('/img/img/instagram.png') }}"
                                                alt=""></a>
                                        <a href="11"><img src="{{ asset('/img/img/wa.png') }}" alt=""></a>
                                        <a href="22"><img src="{{ asset('/img/img/tw.png') }}" alt=""></a>
                                        {{-- <a href="33"><img src="{{ asset('/img/detailstory/tw.png')}}" alt=""></a> --}}
                                    </figure>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="Cerita-Terbaru garis"></div>

                    <div class="Cerita-Terbaru ceritaterbaruRight">
                        <div class="Cerita-Terbaru titleright">Story List</div>
                        <div class="Cerita-Terbaru ddropdown">
                            <!-- Dropdown pertama -->
                            <label for="dropdown1"></label>
                            <select id="dropdown1">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="pilihan1">Pilihan Kategori 1</option>
                                <option value="pilihan2">Pilihan Kategori 2</option>
                                <option value="pilihan3">Pilihan Kategori 3</option>
                            </select>
                            <!-- Dropdown kedua -->
                            <label for="dropdown2"></label>
                            <select id="dropdown2">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="pilihan4">Pilihan Status 1</option>
                                <option value="pilihan5">Pilihan Status 2</option>
                                <option value="pilihan6">Pilihan Status 3</option>
                            </select>
                            <!-- Dropdown ketiga -->
                            <label for="dropdown3"></label>
                            <select id="dropdown3">
                                <option value="" disabled selected>Pilih Order</option>
                                <option value="pilihan7">Pilihan Order 1</option>
                                <option value="pilihan8">Pilihan Order 2</option>
                                <option value="pilihan9">Pilihan Order 3</option>
                            </select>
                        </div>

                        <div class="row">
                            @foreach ($data['stories'] as $story)
                                <div class="cardcerita">
                                    <a href="{{ route('detailStory', $story->id_story) }}">
                                        <figure>
                                            <img src="/upload/{{ $story->images }}"class="gmbcrt">
                                        </figure>
                                    </a>
                                    <div class="textcerita">
                                        <div class="bagikan-cerita">
                                            <div class="dropdownshare" onclick="card()">
                                                {{-- <label for="heart-checkbox-card-" id="heart-card-" class="heart-card">
                                                    <input type="checkbox" name="" id="heart-checkbox-card-"
                                                        class="heart-checkbox-card" onchange="toggleHeartCardColor()">
                                                </label> --}}
                                                @if (Auth::check())
                                                    <form action="{{ route('favorite') }}" method="post"
                                                        class="favorite-form">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_story"
                                                            value="{{ $story->id_story }}">
                                                        @php
                                                            $favoritItem = $data['favorit']->where('id_story', $story->id_story)->first();
                                                        @endphp

                                                        <input type="checkbox" name="favorit" class="heart-checkbox"
                                                            id="heart-checkbox-{{ $story->id_story }}"
                                                            data-story-id="{{ $story->id_story }}"
                                                            data-story-action="{{ route('favorite') }}"
                                                            style="color: red;"
                                                            {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                        <label for="heart-checkbox-{{ $story->id_story }}"
                                                            class="heart  {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}"
                                                            id="heart"></label>
                                                    </form>
                                                @else
                                                    <a href="#">
                                                        <label for="heart-checkbox" class="heart"
                                                            id="heart"></label>
                                                        <input type="checkbox" name="favorit" class="heart-checkbox"
                                                            id="heart-checkbox">
                                                    </a>
                                                @endif

                                                <svg class="share-icon" id="share-icon" width="13" height="14"
                                                    viewBox="0 0 13 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.088 4.52287C11.1439 4.52287 11.9998 3.66694 11.9998 2.61111C11.9998 1.55527 11.1439 0.699341 10.088 0.699341C9.0322 0.699341 8.17627 1.55527 8.17627 2.61111C8.17627 3.66694 9.0322 4.52287 10.088 4.52287Z"
                                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M2.44106 8.98364C3.4969 8.98364 4.35283 8.12772 4.35283 7.07188C4.35283 6.01604 3.4969 5.16011 2.44106 5.16011C1.38522 5.16011 0.529297 6.01604 0.529297 7.07188C0.529297 8.12772 1.38522 8.98364 2.44106 8.98364Z"
                                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M10.088 13.4444C11.1439 13.4444 11.9998 12.5885 11.9998 11.5327C11.9998 10.4768 11.1439 9.62089 10.088 9.62089C9.0322 9.62089 8.17627 10.4768 8.17627 11.5327C8.17627 12.5885 9.0322 13.4444 10.088 13.4444Z"
                                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M4.09155 8.03417L8.444 10.5704" stroke="black"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M8.43763 3.57334L4.09155 6.10962" stroke="black"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div class="list-share">
                                                <a href="#"><img src="{{ '/img/img/wa.png' }}"></a>
                                                <a href=""><img src="{{ '/img/img/instagram.png' }}"></a>
                                                <a href=""><img src="{{ '/img/img/tw.png' }}"></a>
                                            </div>

                                        </div>
                                        <div class="judul-cerita">
                                            <h3>{{ Str::limit($story->title, 8) }}</h3>
                                            <p>Penulis &nbsp;&nbsp;: {{ Str::limit($story->full_name, 8) }}</p>
                                            <p>Kategori : {{ Str::limit($story->genre, 8) }}</p>
                                        </div>
                                        <div class="rate-5">

                                            <div class="bin2">
                                                @if ($story->average_rating >= 0.5 && $story->average_rating <= 5)
                                                    @for ($i = 0.5; $i <= 5; $i++)
                                                        @if ($i <= $story->average_rating)
                                                            <span class="fa fa-star checked"
                                                                style="cursor: pointer;"></span>
                                                        @else
                                                            @if ($i - 0.5 <= $story->average_rating)
                                                                <span class="fa fa-star-half checked-half"
                                                                    style="cursor: pointer; "></span>
                                                            @else
                                                                <span class="fa fa-star" style="cursor: pointer;"></span>
                                                            @endif
                                                        @endif
                                                    @endfor
                                                @else
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                @endif
                                                <div class="counts">
                                                    <span class="span">
                                                        {{ '(' . number_format($story->average_rating, 1) . ')' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleListBagian() {
            var listbagian = document.getElementById("listbagian");
            listbagian.classList.toggle("show");
        }
    </script>
    <script>
        function toggleListBagian2() {
            var listbagian = document.getElementById("listbagian2");
            listbagian.classList.toggle("show");
        }
    </script>
    <script>
        function toggleListBagian3() {
            var listbagian = document.getElementById("listbagian3");
            listbagian.classList.toggle("show");
        }

        function toggleHeartColor(s) {
            var heart = document.getElementById("heart-" + s);
            var checkbox = document.getElementById("heart-checkbox-" + s);

            if (checkbox.checked) {
                heart.classList.add("checked");
            } else {
                heart.classList.remove("checked");
            }
        }


        function toggleHeartCardColor(i) {
            var heart = document.getElementById("heart-card-" + i);
            var checkbox = document.getElementById("heart-checkbox-card-" + i);

            console.log(i);

            if (checkbox.checked) {
                heart.classList.add("checked");
            } else {
                heart.classList.remove("checked");
            }
        }
    </script>

    <script>
        // Get references to the SVG and the share list
        const shareIcon = document.getElementById('share-icon');
        const shareList = document.querySelector('.cerita-terbaru .textcerita .bagikan-cerita .list-share');

        // Add a click event listener to the SVG
        shareIcon.addEventListener('click', function() {
            const parentWithClass = shareIcon.closest('.bagikan-cerita');
            console.log(parentWithClass);
            // Toggle the 'show' class on the share list
            shareList.classList.toggle('show');
        });
    </script>
    <script>
        function toggleSearch() {
            var searchBox = document.querySelector('.search-box');
            var searchInput = document.getElementById('searchInput');
            var navBurger = document.querySelector('.nav-burger');
            var brand = document.querySelector('.brand');

            if (!searchBox.classList.contains('open')) {
                // Jika kotak pencarian belum terbuka, buka dan fokus ke input
                searchBox.classList.add('open');
                searchInput.focus();
                navBurger.classList.add('hidden'); // Sembunyikan menu desktop
                brand.classList.add('hidden'); // Sembunyikan menu desktop
            } else {
                // Jika kotak pencarian sudah terbuka, tutup dan tampilkan elemen yang disembunyikan
                searchBox.classList.remove('open');
                searchInput.value = '';
                navBurger.classList.remove('hidden'); // Tampilkan kembali menu desktop
                brand.classList.remove('hidden'); // Tampilkan kembali menu desktop
            }
        }

        // Tambahkan event listener untuk menangani scroll
        window.addEventListener('scroll', function() {
            var searchBox = document.querySelector('.search-box');

            // Tutup kotak pencarian jika terbuka
            if (searchBox.classList.contains('open')) {
                searchBox.classList.remove('open');

                // Tampilkan kembali elemen yang disembunyikan
                var navBurger = document.querySelector('.nav-burger');
                var brand = document.querySelector('.brand');
                navBurger.classList.remove('hidden');
                brand.classList.remove('hidden');
            }
        });

        // Tambahkan event listener untuk menangani klik di luar kotak pencarian
        document.addEventListener('click', function(event) {
            var searchBox = document.querySelector('.search-box');
            var isClickInsideSearchBox = searchBox.contains(event.target);

            // Tutup kotak pencarian jika terbuka dan klik dilakukan di luar kotak pencarian
            if (searchBox.classList.contains('open') && !isClickInsideSearchBox) {
                searchBox.classList.remove('open');

                // Tampilkan kembali elemen yang disembunyikan
                var navBurger = document.querySelector('.nav-burger');
                var brand = document.querySelector('.brand');
                navBurger.classList.remove('hidden');
                brand.classList.remove('hidden');
            }
        });


        // ----------------- dropdown share
        const toggleBtns = document.querySelectorAll('.dropdown');
        const dropdowns = document.querySelectorAll('.storyList-share');

        toggleBtns.forEach((toggleBtn, index) => {
            toggleBtn.onclick = (event) => toggleCard2(event, index);
        });

        function toggleCard2(event, index) {
            // Menutup semua dropdown yang terbuka
            closeAllDropdowns();

            // Membuka dropdown yang sesuai dengan indeks yang diberikan
            dropdowns[index].classList.toggle('open');
            const isOpen = dropdowns[index].classList.contains('open');

            if (isOpen) {
                document.addEventListener('click', outsideClickListener2);
                // Tambah event listener untuk menangani scroll
                window.addEventListener('scroll', scrollListener2);
            } else {
                document.removeEventListener('click', outsideClickListener2);
                // Hapus event listener scroll ketika elemen .card-share ditutup
                window.removeEventListener('scroll', scrollListener2);
            }

            event.stopPropagation();
        }

        function outsideClickListener2(event) {
            dropdowns.forEach((dropdown, index) => {
                if (!dropdown.contains(event.target) && !toggleBtns[index].contains(event.target)) {
                    dropdown.classList.remove('open');
                    document.removeEventListener('click', outsideClickListener2);
                    // Hapus event listener scroll ketika elemen .card-share ditutup
                    window.removeEventListener('scroll', scrollListener2);
                }
            });
        }

        function scrollListener2() {
            // Handler untuk menutup dropdown ketika halaman di-scroll
            closeAllDropdowns();
        }

        function closeAllDropdowns() {
            dropdowns.forEach((dropdown) => {
                dropdown.classList.remove('open');
            });
            document.removeEventListener('click', outsideClickListener2);
            // Hapus event listener scroll ketika elemen .card-share ditutup
            window.removeEventListener('scroll', scrollListener2);
        }
    </script>
@endsection
