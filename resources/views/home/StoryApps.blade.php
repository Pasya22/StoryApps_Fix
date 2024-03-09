@extends('layouts.app2')
@section('title', 'Story Apps')


@section('content')

    <div class="content">
        {{-- {{asset('/img/konten/'.$user->image)}} --}}


        <div class="container-3">
            <img src="{{ asset('/img/konten/header.svg') }}">
            <div class="content-1">
                <div class="text-5">
                    <h1>Hallo, Selamat Membaca Cerita Whatsapp</h1>
                    <p>Cerita Whatsapp ini di hadirkan untuk menghibur para pembaca semua</p>
                </div>
                <div class="buton">
                    <a href="{{ route('storyList') }}" class="button">
                        <h2>Read</h2>
                    </a>
                    <a href="{{ route('writter') }}" class="button">
                        <h2>Writte</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="container-1">
            <div class="container-2">
                <div class="container-2">
                    <div class="slideshow-container">
                        <div class="mySlides fade">
                            <img src="{{ asset('/img/konten/pic-slide.svg') }}">
                        </div>

                        <div class="mySlides fade">
                            <img src="{{ asset('/img/konten/pic-slide1.svg') }}">
                        </div>

                        <div class="mySlides fade">
                            <img src="{{ asset('/img/konten/pic-slide2.svg') }}">
                        </div>

                        <!-- Dot navigation -->
                        <div class="dot-container" style="text-align:center">
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container-2">
                <img src="{{ asset('/img/konten/kanan-atas.svg') }}" alt="" class="pic-cont">
                <img src="{{ asset('/img/konten/kanan-bawah.svg') }}" alt="" class="pic-cont">
            </div>
        </div>
        <div class="cerita-terbaru">
            <div class="judul">
                <h3>New Stories</h3>
                <div class="line"></div>
            </div>
            <div class="content-ceritaterbaru">
                <div class="scroll-container">
                    <button class="scroll-button left">
                        <span class="material-symbols-outlined">
                            arrow_back_ios
                        </span>
                    </button>
                    <div class="grub-card">
                        @foreach ($data['NewStoryRate'] as $items)
                            @if ($items->book_status == 1 || $items->book_status == 3)

                                <div class="card">
                                    <a href="{{ route('detailStory', $items->id_story) }}">
                                        <figure>
                                            <img src="/upload/{{ $items->images }}" alt=""
                                                style="width: 100%; height:163px">
                                        </figure>
                                    </a>
                                    <div class="share">
                                        <div class="rate-1">
                                            <!-- Tampilkan checkbox favorit -->
                                            {{-- @if (Auth::check() && isset($data['favorit']) && is_object($data['favorit']))
                                                <form action="{{ route('favorite') }}" method="post"
                                                    class="favorite-form">
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
                                                        class="heart  {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}"
                                                        id="heart"></label>
                                                </form>
                                            @else
                                                <a href="#">
                                                    <label for="heart-checkbox" class="heart" id="heart"></label>
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox">
                                                </a>
                                            @endif --}}
                                            @if (Auth::check())
                                                <form action="{{ route('favorite') }}" method="post"
                                                    class="favorite-form">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_story" value="{{ $items->id_story }}">
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox-{{ $items->id_story }}"
                                                        data-story-id="{{ $items->id_story }}"
                                                        data-story-action="{{ route('favorite') }}" style="color: red;"
                                                        {{ in_array($items->id_story, $data['favorit']) ? 'checked' : '' }}>
                                                    <label for="heart-checkbox-{{ $items->id_story }}"
                                                        class="heart  {{ in_array($items->id_story, $data['favorit']) ? 'checked' : '' }}"
                                                        id="heart"></label>
                                                </form>
                                            @else
                                                <a href="#">
                                                    <label for="heart-checkbox" class="heart" id="heart"></label>
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox">
                                                </a>
                                            @endif
                                            <!-- Tampilkan dropdown untuk berbagi -->
                                            <div class="dropdown">
                                                <button class="dropbtn">
                                                    <i class="fas fa-share-alt dropdown-icon"></i>
                                                </button>
                                                <div class="dropdown-content">
                                                    <a href="#">
                                                        <i class="fa fa-instagram dropdown-icon"></i>
                                                    </a>
                                                    <a href="#">
                                                        <i class="fa fa-twitter dropdown-icon"></i>
                                                    </a>
                                                    <!-- Add more icons and links as needed -->
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                        <strong style="width: 80px; display: inline-block; ">Writter</strong>:
                                        <!-- Tampilkan nama penulis yang dipotong jika terlalu panjang -->
                                        <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                        <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                        <span>{{ Str::limit($items->genre, 8) }}</span>
                                        <div class="rate">
                                            <div>
                                                <div style="display: flex; justify-content: space-between; ">
                                                    <!-- Tampilkan bintang jika total_ratings > 0 -->
                                                    @if ($items->total_ratings > 0)
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
                                                        @endif
                                                        <!-- Tampilkan bintang default jika total_ratings = 0 -->
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                    <!-- Tampilkan peringkat rata-rata jika average_rating > 0 -->
                                                    @if ($items->average_rating > 0)
                                                        <div class="counts">
                                                            <span
                                                                class="span">{{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                        <!-- Sembunyikan peringkat rata-rata jika average_rating = 0.0 -->
                                                    @elseif ($items->average_rating == 0.0)
                                                        <div class="counts" style="display: none;">
                                                            <span
                                                                class="span">{{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($items->book_status == 2 || $items->book_status == 4)
                                <div class="card1" style="display: none;">
                                    <a href="{{ route('detailStory', $items->id_story) }}">
                                        <figure>
                                            <img src="/upload/{{ $items->images }}" alt=""
                                                style="width: 100%; height:163px">
                                        </figure>
                                    </a>
                                    <div class="share">
                                        <div class="rate-1">
                                            <!-- Tampilkan checkbox favorit -->
                                            @if (Auth::check())
                                                <form action="{{ route('favorite') }}" method="post"
                                                    class="favorite-form">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_story"
                                                        value="{{ $items->id_story }}">
                                                    @php
                                                        $favoritItem = $data['favorit']->where('id_story', $items->id_story)->first();
                                                    @endphp
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox-{{ $items->id_story }}"
                                                        data-story-id="{{ $items->id_story }}"
                                                        data-story-action="{{ route('favorite') }}" style="color: red;"
                                                        {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                    <label for="heart-checkbox-{{ $items->id_story }}"
                                                        class="heart  {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}"
                                                        id="heart"></label>
                                                </form>
                                            @else
                                                <a href="#">
                                                    <label for="heart-checkbox" class="heart" id="heart"></label>
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox">
                                                </a>
                                            @endif
                                            <!-- Tampilkan dropdown untuk berbagi -->
                                            <div class="dropdown">
                                                <button class="dropbtn">
                                                    <i class="fas fa-share-alt dropdown-icon"></i>
                                                </button>
                                                <div class="dropdown-content">
                                                    <a href="#">
                                                        <i class="fa fa-instagram dropdown-icon"></i>
                                                    </a>
                                                    <a href="#">
                                                        <i class="fa fa-twitter dropdown-icon"></i>
                                                    </a>
                                                    <!-- Add more icons and links as needed -->
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                        <strong style="width: 80px; display: inline-block; ">Writter</strong>:
                                        <!-- Tampilkan nama penulis yang dipotong jika terlalu panjang -->
                                        <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                        <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                        <span>{{ Str::limit($items->genre, 8) }}</span>
                                        <div class="rate">
                                            <div>
                                                <div style="display: flex; justify-content: space-between; ">
                                                    <!-- Tampilkan bintang jika total_ratings > 0 -->
                                                    @if ($items->total_ratings > 0)
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
                                                        @endif
                                                        <!-- Tampilkan bintang default jika total_ratings = 0 -->
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                    <!-- Tampilkan peringkat rata-rata jika average_rating > 0 -->
                                                    @if ($items->average_rating > 0)
                                                        <div class="counts">
                                                            <span
                                                                class="span">{{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                        <!-- Sembunyikan peringkat rata-rata jika average_rating = 0.0 -->
                                                    @elseif ($items->average_rating == 0.0)
                                                        <div class="counts" style="display: none;">
                                                            <span
                                                                class="span">{{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button class="scroll-button right">
                        <span class="material-symbols-outlined">
                            arrow_forward_ios
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="cerita-populer">
            <div class="judul">
                <h3>Populer Stories</h3>
                <div class="line"></div>
            </div>
            <div class="content-ceritapopuler">
                <div class="scroll-container1">
                    <button class="scroll-button1 left1">
                        <span class="material-symbols-outlined">
                            arrow_back_ios
                        </span>
                    </button>
                    <div class="grub-card1">

                        @foreach ($data['RateStoryPopuler'] as $items)
                            @if ($items->book_status == 1 || $items->book_status == 3)
                                <div class="card">
                                    <a href="{{ route('detailStory', $items->id_story) }}">
                                        <figure>
                                            <img src="/upload/{{ $items->images }}" alt=""
                                                style="width: 100%; height:163px">
                                        </figure>
                                    </a>
                                    <div class="share">
                                        <div class="rate-1">
                                            {{--

                                            @if (Auth::check())
                                                <form action="{{ route('favorite') }}" method="post"
                                                    class="favorite-form">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_story"
                                                        value="{{ $items->id_story }}">
                                                    @php
                                                        $favoritItem = $data['favorit']->where('id_story', $items->id_story)->first();
                                                    @endphp

                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox-{{ $items->id_story }}"
                                                        data-story-id="{{ $items->id_story }}"
                                                        data-story-action="{{ route('favorite') }}" style="color: red;"
                                                        {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                    <label for="heart-checkbox-{{ $items->id_story }}"
                                                        class="heart  {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}"
                                                        id="heart"></label>
                                                </form>
                                            @else
                                                <a href="#">
                                                    <label for="heart-checkbox" class="heart" id="heart"></label>
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox">
                                                </a>
                                            @endif --}}
                                            @if (Auth::check())
                                                <form action="{{ route('favorite') }}" method="post"
                                                    class="favorite-form">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_story"
                                                        value="{{ $items->id_story }}">
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox-{{ $items->id_story }}"
                                                        data-story-id="{{ $items->id_story }}"
                                                        data-story-action="{{ route('favorite') }}" style="color: red;"
                                                        {{ in_array($items->id_story, $data['favorit']) ? 'checked' : '' }}>
                                                    <label for="heart-checkbox-{{ $items->id_story }}"
                                                        class="heart  {{ in_array($items->id_story, $data['favorit']) ? 'checked' : '' }}"
                                                        id="heart"></label>
                                                </form>
                                            @else
                                                <a href="#">
                                                    <label for="heart-checkbox" class="heart" id="heart"></label>
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox">
                                                </a>
                                            @endif

                                            <div class="dropdown">
                                                <button class="dropbtn">
                                                    <i class="fas fa-share-alt dropdown-icon"></i>
                                                </button>
                                                <div class="dropdown-content">
                                                    <a href="#">
                                                        <i class="fa fa-instagram dropdown-icon"></i>
                                                    </a>
                                                    <a href="#">
                                                        <i class="fa fa-twitter dropdown-icon"></i>
                                                    </a>
                                                    <!-- Add more icons and links as needed -->
                                                </div>
                                            </div>
                                        </div>

                                        <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                        <strong style="width: 80px; display: inline-block;">Writter</strong>:
                                        <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                        <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                        <span>{{ Str::limit($items->genre, 8) }}</span>
                                        <div class="rate">
                                            <div>
                                                <div style="display: flex; justify-content: space-between; ">
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
                                                        <span class="span">
                                                            {{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($items->book_status == 2 || $items->book_status == 4)
                                <div class="card" style="display: none;">
                                    <a href="{{ route('detailStory', $items->id_story) }}">
                                        <figure>
                                            <img src="/upload/{{ $items->images }}" alt=""
                                                style="width: 100%; height:163px">
                                        </figure>
                                    </a>
                                    <div class="share">
                                        <div class="rate-1">


                                            @if (Auth::check())
                                                <form action="{{ route('favorite') }}" method="post"
                                                    class="favorite-form">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_story"
                                                        value="{{ $items->id_story }}">
                                                    @php
                                                        $favoritItem = $data['favorit']->where('id_story', $items->id_story)->first();
                                                    @endphp

                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox-{{ $items->id_story }}"
                                                        data-story-id="{{ $items->id_story }}"
                                                        data-story-action="{{ route('favorite') }}" style="color: red;"
                                                        {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                    <label for="heart-checkbox-{{ $items->id_story }}"
                                                        class="heart  {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}"
                                                        id="heart"></label>
                                                </form>
                                            @else
                                                <a href="#">
                                                    <label for="heart-checkbox" class="heart" id="heart"></label>
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox">
                                                </a>
                                            @endif


                                            <div class="dropdown">
                                                <button class="dropbtn">
                                                    <i class="fas fa-share-alt dropdown-icon"></i>
                                                </button>
                                                <div class="dropdown-content">
                                                    <a href="#">
                                                        <i class="fa fa-instagram dropdown-icon"></i>
                                                    </a>
                                                    <a href="#">
                                                        <i class="fa fa-twitter dropdown-icon"></i>
                                                    </a>
                                                    <!-- Add more icons and links as needed -->
                                                </div>
                                            </div>
                                        </div>

                                        <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                        <strong style="width: 80px; display: inline-block;">Writter</strong>:
                                        <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                        <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                        <span>{{ Str::limit($items->genre, 8) }}</span>
                                        <div class="rate">
                                            <div>
                                                <div style="display: flex; justify-content: space-between; ">
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
                                                        <span class="span">
                                                            {{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                    <button class="scroll-button1 right1">
                        <span class="material-symbols-outlined">
                            arrow_forward_ios
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="rekomendasi">
            <div class="judul">
                <h3>Recomendation</h3>
                <div class="line"></div>
            </div>
            <div class="content-rekomendasi">
                <div class="scroll-container2">
                    <button class="scroll-button2 left2">
                        <span class="material-symbols-outlined">
                            arrow_back_ios
                        </span>
                    </button>
                    <div class="grub-card2">
                        @if (Auth::check())


                            @foreach ($data['RateRecomendationStory'] as $items)
                                @if ($items->book_status == 1 || $items->book_status == 3)
                                    <div class="card">
                                        <a href="{{ route('detailStory', $items->id_story) }}">
                                            <figure>
                                                <img src="/upload/{{ $items->images }}" alt=""
                                                    style="width: 100%; height:163px">
                                            </figure>
                                        </a>
                                        <div class="share">
                                            <div class="rate-1">


                                                {{-- @if (Auth::check())
                                                    <form action="{{ route('favorite') }}" method="post"
                                                        class="favorite-form">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_story"
                                                            value="{{ $items->id_story }}">
                                                        @php
                                                            $favoritItem = $data['favorit']->where('id_story', $items->id_story)->first();
                                                        @endphp

                                                        <input type="checkbox" name="favorit" class="heart-checkbox"
                                                            id="heart-checkbox-{{ $items->id_story }}"
                                                            data-story-id="{{ $items->id_story }}"
                                                            data-story-action="{{ route('favorite') }}"
                                                            style="color: red;"
                                                            {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                        <label for="heart-checkbox-{{ $items->id_story }}"
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
                                                @endif --}}
                                                @if (Auth::check())
                                                    <form action="{{ route('favorite') }}" method="post"
                                                        class="favorite-form">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_story"
                                                            value="{{ $items->id_story }}">
                                                        <input type="checkbox" name="favorit" class="heart-checkbox"
                                                            id="heart-checkbox-{{ $items->id_story }}"
                                                            data-story-id="{{ $items->id_story }}"
                                                            data-story-action="{{ route('favorite') }}"
                                                            style="color: red;"
                                                            {{ in_array($items->id_story, $data['favorit']) ? 'checked' : '' }}>
                                                        <label for="heart-checkbox-{{ $items->id_story }}"
                                                            class="heart  {{ in_array($items->id_story, $data['favorit']) ? 'checked' : '' }}"
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

                                                <div class="dropdown">
                                                    <button class="dropbtn">
                                                        <i class="fas fa-share-alt dropdown-icon"></i>
                                                    </button>
                                                    <div class="dropdown-content">
                                                        <a href="#">
                                                            <i class="fa fa-instagram dropdown-icon"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa fa-twitter dropdown-icon"></i>
                                                        </a>
                                                        <!-- Add more icons and links as needed -->
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                            <strong style="width: 80px; display: inline-block;">Writter</strong>:
                                            <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                            <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                            <span>{{ Str::limit($items->genre, 8) }}</span>
                                            <div class="rate">
                                                <div>
                                                    <div style="display: flex; justify-content: space-between; ">
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
                                                            <span class="span">
                                                                {{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($items->book_status == 2 || $items->book_status == 4)
                                    <div class="card" style="display: none;">
                                        <a href="{{ route('detailStory', $items->id_story) }}">
                                            <figure>
                                                <img src="/upload/{{ $items->images }}" alt=""
                                                    style="width: 100%; height:163px">
                                            </figure>
                                        </a>
                                        <div class="share">
                                            <div class="rate-1">


                                                @if (Auth::check())
                                                    <form action="{{ route('favorite') }}" method="post"
                                                        class="favorite-form">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_story"
                                                            value="{{ $items->id_story }}">
                                                        @php
                                                            $favoritItem = $data['favorit']->where('id_story', $items->id_story)->first();
                                                        @endphp

                                                        <input type="checkbox" name="favorit" class="heart-checkbox"
                                                            id="heart-checkbox-{{ $items->id_story }}"
                                                            data-story-id="{{ $items->id_story }}"
                                                            data-story-action="{{ route('favorite') }}"
                                                            style="color: red;"
                                                            {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                        <label for="heart-checkbox-{{ $items->id_story }}"
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


                                                <div class="dropdown">
                                                    <button class="dropbtn">
                                                        <i class="fas fa-share-alt dropdown-icon"></i>
                                                    </button>
                                                    <div class="dropdown-content">
                                                        <a href="#">
                                                            <i class="fa fa-instagram dropdown-icon"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa fa-twitter dropdown-icon"></i>
                                                        </a>
                                                        <!-- Add more icons and links as needed -->
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                            <strong style="width: 80px; display: inline-block;">Writter</strong>:
                                            <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                            <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                            <span>{{ Str::limit($items->genre, 8) }}</span>
                                            <div class="rate">
                                                <div>
                                                    <div style="display: flex; justify-content: space-between; ">
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
                                                            <span class="span">
                                                                {{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            @foreach ($data['RateRecomendationStory'] as $items)
                                @if ($items->book_status == 1 || $items->book_status == 3)
                                    <div class="card">
                                        <a href="{{ route('detailStory', $items->id_story) }}">
                                            <figure>
                                                <img src="/upload/{{ $items->images }}" alt=""
                                                    style="width: 100%; height:163px">
                                            </figure>
                                        </a>
                                        <div class="share">
                                            <div class="rate-1">


                                                @if (Auth::check())
                                                    <form action="{{ route('favorite') }}" method="post"
                                                        class="favorite-form">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_story"
                                                            value="{{ $items->id_story }}">
                                                        @php
                                                            $favoritItem = $data['favorit']->where('id_story', $items->id_story)->first();
                                                        @endphp

                                                        <input type="checkbox" name="favorit" class="heart-checkbox"
                                                            id="heart-checkbox-{{ $items->id_story }}"
                                                            data-story-id="{{ $items->id_story }}"
                                                            data-story-action="{{ route('favorite') }}"
                                                            style="color: red;"
                                                            {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                        <label for="heart-checkbox-{{ $items->id_story }}"
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


                                                <div class="dropdown">
                                                    <button class="dropbtn">
                                                        <i class="fas fa-share-alt dropdown-icon"></i>
                                                    </button>
                                                    <div class="dropdown-content">
                                                        <a href="#">
                                                            <i class="fa fa-instagram dropdown-icon"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa fa-twitter dropdown-icon"></i>
                                                        </a>
                                                        <!-- Add more icons and links as needed -->
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                            <strong style="width: 80px; display: inline-block;">Writter</strong>:
                                            <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                            <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                            <span>{{ Str::limit($items->genre, 8) }}</span>
                                            <div class="rate">
                                                <div>
                                                    <div style="display: flex; justify-content: space-between; ">
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
                                                            <span class="span">
                                                                {{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($items->book_status == 2 || $items->book_status == 4)
                                    <div class="card" style="display: none;">
                                        <a href="{{ route('detailStory', $items->id_story) }}">
                                            <figure>
                                                <img src="/upload/{{ $items->images }}" alt=""
                                                    style="width: 100%; height:163px">
                                            </figure>
                                        </a>
                                        <div class="share">
                                            <div class="rate-1">


                                                @if (Auth::check())
                                                    <form action="{{ route('favorite') }}" method="post"
                                                        class="favorite-form">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_story"
                                                            value="{{ $items->id_story }}">
                                                        @php
                                                            $favoritItem = $data['favorit']->where('id_story', $items->id_story)->first();
                                                        @endphp

                                                        <input type="checkbox" name="favorit" class="heart-checkbox"
                                                            id="heart-checkbox-{{ $items->id_story }}"
                                                            data-story-id="{{ $items->id_story }}"
                                                            data-story-action="{{ route('favorite') }}"
                                                            style="color: red;"
                                                            {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                        <label for="heart-checkbox-{{ $items->id_story }}"
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


                                                <div class="dropdown">
                                                    <button class="dropbtn">
                                                        <i class="fas fa-share-alt dropdown-icon"></i>
                                                    </button>
                                                    <div class="dropdown-content">
                                                        <a href="#">
                                                            <i class="fa fa-instagram dropdown-icon"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa fa-twitter dropdown-icon"></i>
                                                        </a>
                                                        <!-- Add more icons and links as needed -->
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                            <strong style="width: 80px; display: inline-block;">Writter</strong>:
                                            <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                            <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                            <span>{{ Str::limit($items->genre, 8) }}</span>
                                            <div class="rate">
                                                <div>
                                                    <div style="display: flex; justify-content: space-between; ">
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
                                                            <span class="span">
                                                                {{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        @endif
                    </div>
                </div>
                <button class="scroll-button2 right2">
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
                </button>
            </div>
        </div>
    </div>
@endsection
