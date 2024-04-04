@extends('layouts.detailStory')
@section('title', 'foundStory')
@section('content')
 <div class="popup" id="popup" style="display: {{ session('success') || session('error') ? 'block' : 'none' }}">
        <span class="close" onclick="closePopup()">&times;</span>
        <div class="popup-content">
            @if (session('success'))
                success-notification
            @elseif(session('error'))
                error-notification
            @elseif ($errors->any())
                @foreach ($errors->all() as $error)
                    error-notification
                @endforeach
            @endif

        </div>
    </div>
    <div class="contener-search">
        <div class="conten">
            <div class="link">
                <a href="{{ route('StoryApps') }}"><img src="{{ asset('/img/detailstory/keluar.png') }}" alt=""></a>

                <a href="">
                    <p>Home</p>
                </a>
                <p>/</p>
                <a href="">
                    <p>Detail Story</p>
                </a>
            </div>
            <div class="search">
                <div class="card">
                    <div class="card-header">
                        <h2><strong>Story List</strong></h2>
                    </div>
                    <div class="card-body">
                        <div class="container-card">
                            @if (session('error'))
                                <div class="popup">{{ session('error') }}</div>
                            @else
                                @foreach ($datas as $items)
                                    <div class="card-conten-search">
                                        <div class="card-conten">
                                            <figure> <img src="/upload/{{ $items->images }}" alt=""></figure>
                                            <div class="titles">
                                                <p class="text-titles">{{ Str::limit($items->title, 8) }}</p>
                                                <strong style="width: 80px; display: inline-block; ">Writter</strong>:
                                                <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                                <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                                <span>{{ $items->genre_name }}</span>
                                                <div class="ratee">
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
                                            <div class="share2">
                                                <div class="rate1">
                                                    <a href="#">

                                                        @if (Auth::check())
                                                            <form action="{{ route('favorite') }}" method="post"
                                                                class="favorite-form">
                                                                @csrf
                                                                @method('POST')
                                                                <input type="hidden" name="id_story"
                                                                    value="{{ $items->id_story }}">
                                                                @php
                                                                    $favoritItem = in_array(
                                                                        $items->id_story,
                                                                        $data['favorit'],
                                                                    );

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
                                                    </a>
                                                </div>
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
                                            <div class="day">
                                                <span class="days">1 day ago</span>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
