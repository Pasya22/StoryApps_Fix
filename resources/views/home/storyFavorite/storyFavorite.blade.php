@extends('layouts.storyFavorit')
@section('title', 'Cerita Favorit')
@section('content')
    <div class="container">
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
            <div class="ceritafavorit">
                <div class="card">
                    <div class="card-header">
                        <h2><strong>Cerita Favorit</strong></h2>
                    </div>
                    <div class="card-body">
                        <div class="dropdown">
                            <button class="button" onclick="toggleListKategori()">Pilih Genre <svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                </svg></button>
                            <button class="button" onclick="toggleListStatus()">Pilih Status <svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                </svg></button>

                        </div>
                        <div class="list-dw">
                            <div class="kategori" id="listkategori">
                                <ul>
                                    @foreach ($data['genre'] as $item)
                                        <li><a href="#">{{ $item->genre }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="status" id="liststatus">
                                <ul>
                                    <li><a href="#">Aktif</a></li>
                                    <li><a href="#">Tidak Aktif</a></li>
                                </ul>
                            </div>



                        </div>
                        <div class="container-card">
                            @foreach ($data['sto'] as $story)
                                <div class="card">
                                    <a href="{{ route('detailStory', $story->id_story) }}">
                                        <img class="banner" src="/upload/{{ $story->images }}" alt="">
                                    </a>
                                    <div class="share">
                                        @if (Auth::check())
                                            <form action="{{ route('favorite') }}" method="post" class="favorite-form">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id_story" value="{{ $story->id_story }}">
                                                @php
                                                    $favoritItem = $data['favorit']
                                                        ->where('id_story', $story->id_story)
                                                        ->first();
                                                @endphp

                                                <input type="checkbox" name="favorit" class="heart-checkbox"
                                                    id="heart-checkbox-{{ $story->id_story }}"
                                                    data-story-id="{{ $story->id_story }}"
                                                    data-story-action="{{ route('favorite') }}" style="color: red;"
                                                    {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}>
                                                <label for="heart-checkbox-{{ $story->id_story }}"
                                                    class="heart  {{ $favoritItem && $favoritItem->favorit == 1 ? 'checked' : '' }}"
                                                    id="heart1"></label>
                                            </form>
                                        @else
                                            <a href="#">
                                                <label for="heart-checkbox" class="heart" id="heart1"></label>
                                                <input type="checkbox" name="favorit" class="heart-checkbox"
                                                    id="heart-checkbox">
                                            </a>
                                        @endif
                                        <img class="imgshare" src="{{ '/img/ceritafavorit/share.png' }}" alt="">
                                        <div class="list-share">
                                            <ul>
                                                <li><a href="#"><img src="{{ '/img/ceritafavorit/shared.png' }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="#"><img src="{{ '/img/ceritafavorit/wa.png' }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="#"><img src="{{ '/img/ceritafavorit/fb.png' }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="#"><img src="{{ '/img/ceritafavorit/tw.png' }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="text-judul">

                                            <h4>{{ Str::limit($story->title, 8) }}</h4>
                                            <p>Penulis &nbsp;&nbsp;: {{ Str::limit($story->full_name, 8) }}</p>
                                            <p>Kategori : {{ Str::limit($story->genre, 8) }}</p>
                                        </div>
                                    </a>
                                    <div class="rate">
                                        @if ($story->average_rating >= 0.5 && $story->average_rating <= 5)
                                            @for ($i = 0.5; $i <= 5; $i++)
                                                @if ($i <= $story->average_rating)
                                                    <span class="fa fa-star checked" style="cursor: pointer;"></span>
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endsection
