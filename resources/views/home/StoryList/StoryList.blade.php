@extends('layouts.detailStory') {{-- pemanggilan header,footer,content ada di halaman app2 --}}
@section('title', 'Story List') {{-- guna untuk membantu memberikan identitas halaman yaitu dengan judul halaman/title --}}


@section('content') {{-- ini adalah content nya --}}
    {{-- ini contoh manggil gambar dengan sifat dinamis
    atau pemanggilan seperti menggunakan foreach dan di kombinasi kan dengan di public --}}


    <div class="container-cerita-terbaru">
        <div class="cerita-terbaru container">
            <div class="cerita-terbaru card" id="storyContainer">
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
                            @if ($items->book_status == 1 || $items->book_status == 3)
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
                                                        <svg width="14" height="16" viewBox="0 0 14 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10.5364 5.4225C11.6437 5.4225 12.5413 4.52491 12.5413 3.41767C12.5413 2.31043 11.6437 1.41284 10.5364 1.41284C9.42921 1.41284 8.53162 2.31043 8.53162 3.41767C8.53162 4.52491 9.42921 5.4225 10.5364 5.4225Z"
                                                                stroke="black" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M2.51713 10.1004C3.62436 10.1004 4.52196 9.20282 4.52196 8.09559C4.52196 6.98835 3.62436 6.09076 2.51713 6.09076C1.40989 6.09076 0.512299 6.98835 0.512299 8.09559C0.512299 9.20282 1.40989 10.1004 2.51713 10.1004Z"
                                                                stroke="black" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M10.5364 14.7784C11.6437 14.7784 12.5413 13.8808 12.5413 12.7736C12.5413 11.6663 11.6437 10.7687 10.5364 10.7687C9.42921 10.7687 8.53162 11.6663 8.53162 12.7736C8.53162 13.8808 9.42921 14.7784 10.5364 14.7784Z"
                                                                stroke="black" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <form action="{{ route('favorite') }}" method="post"
                                                        class="favorite-form">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_story"
                                                            value="{{ $items->id_story }}">
                                                        @php
                                                            // Memeriksa apakah cerita adalah favorit pengguna saat ini
                                                            $isFavorite = in_array($items->id_story, $data['favorit']);
                                                        @endphp

                                                        <input type="checkbox" name="favorit" class="heart-checkbox"
                                                            id="heart-checkbox-{{ $items->id_story }}"
                                                            data-story-id="{{ $items->id_story }}"
                                                            data-story-action="{{ route('favorite') }}" style="color: red;"
                                                            {{ $isFavorite ? 'checked' : '' }}>
                                                        <label for="heart-checkbox-{{ $items->id_story }}"
                                                            class="heart  {{ $isFavorite ? 'checked' : '' }} hearts"
                                                            id="heart hearts"></label>
                                                    </form>
                                                @else
                                                    <div class="heartswe">
                                                        <a href="#">
                                                            <label for="heart-checkbox" class="heart"
                                                                id="heart"></label>
                                                            <input type="checkbox" name="favorit" class="heart-checkbox"
                                                                id="heart-checkbox">
                                                        </a>
                                                    </div>
                                                @endif



                                                <div class="Cerita-Terbaru TextcontentLeft1">
                                                    <p class="text-title">pangestu septian</p>
                                                    <strong>Writer</strong>
                                                    <span>: {{ $items->full_name }}</span><br>
                                                    <strong>Genre</strong>
                                                    <span>: {{ $items->genre }}</span>
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
                            @endif
                        @endforeach
                    </div>
                    <div class="Cerita-Terbaru garis"></div>

                    <div class="Cerita-Terbaru ceritaterbaruRight">
                        <div class="Cerita-Terbaru titleright">Story List</div>
                        <div class="Cerita-Terbaru ddropdownaa">
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

                        </div>

                        <div class="row">
                            @foreach ($data['stories'] as $story)
                                @if ($story->book_status == 1 || $story->book_status == 3)
                                    @php
                                        // Mengecek apakah cerita termasuk dalam daftar favorit pengguna yang sedang login
                                        $favoritItem = in_array($story->id_story, $data['favorit']);
                                    @endphp
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
                                                                $favoritItem = in_array(
                                                                    $story->id_story,
                                                                    $data['favorit'],
                                                                );

                                                            @endphp

                                                            <!-- Menampilkan checkbox dan ikon hati sesuai dengan status cerita -->
                                                            <input type="checkbox" name="favorit" class="heart-checkbox"
                                                                id="heart-checkbox-{{ $story->id_story }}"
                                                                data-story-id="{{ $story->id_story }}"
                                                                data-story-action="{{ route('favorite') }}"
                                                                style="color: red;" {{ $favoritItem ? 'checked' : '' }}>
                                                            <label for="heart-checkbox-{{ $story->id_story }}"
                                                                class="heart {{ $favoritItem ? 'checked' : '' }}"
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


                                                    <svg class="share-icon" id="share-icon" width=""
                                                        height="14" viewBox="0 0 13 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10.088 4.52287C11.1439 4.52287 11.9998 3.66694 11.9998 2.61111C11.9998 1.55527 11.1439 0.699341 10.088 0.699341C9.0322 0.699341 8.17627 1.55527 8.17627 2.61111C8.17627 3.66694 9.0322 4.52287 10.088 4.52287Z"
                                                            stroke="black" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M2.44106 8.98364C3.4969 8.98364 4.35283 8.12772 4.35283 7.07188C4.35283 6.01604 3.4969 5.16011 2.44106 5.16011C1.38522 5.16011 0.529297 6.01604 0.529297 7.07188C0.529297 8.12772 1.38522 8.98364 2.44106 8.98364Z"
                                                            stroke="black" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M10.088 13.4444C11.1439 13.4444 11.9998 12.5885 11.9998 11.5327C11.9998 10.4768 11.1439 9.62089 10.088 9.62089C9.0322 9.62089 8.17627 10.4768 8.17627 11.5327C8.17627 12.5885 9.0322 13.4444 10.088 13.4444Z"
                                                            stroke="black" stroke-linecap="round"
                                                            stroke-linejoin="round" />
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
                                                <h3 class="text-title">{{ $story->title }}</h3>
                                                <p>Writer &nbsp;&nbsp;: {{ $story->full_name }}</p>
                                                <p>Genre &nbsp;&nbsp;: {{ $story->genre }}</p>
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
                                                            {{ '(' . number_format($story->average_rating, 1) . ')' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
