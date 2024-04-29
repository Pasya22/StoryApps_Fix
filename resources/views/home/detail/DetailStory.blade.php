@extends('layouts.detailStory')
@section('title', 'Detail Story')
@section('content')
    <div class="container-DetailStory">
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
            <div class="content-DetailStory">

                <div class="content-left">
                    <div class="rekomendasi">
                        <h4>Recomendation</h4>
                    </div>

                    @foreach ($data['RateRecomendationStory'] as $recomend)
                        <div class="card-rekomendasi">
                            <div class="img-card">
                                <figure>
                                    <a href="{{ route('detailStory', $recomend->id_story) }}"> {{-- masuk link halaman selanjutnya --}}
                                        <img src="/upload/{{ $recomend->images }}" alt="" />
                                    </a>
                                </figure>
                            </div>

                            <div class="text-card">
                                <div class="text-top">
                                    <div class="Love">

                                        @if (Auth::check())
                                            <form action="{{ route('favorite') }}" method="post" class="favorite-form">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id_story" value="{{ $recomend->id_story }}">

                                                @php
                                                    $favoritItem = in_array($recomend->id_story, $data['favorit']);

                                                @endphp

                                                <input type="checkbox" name="favorit" class="heart-checkbox"
                                                    style="display: none;"
                                                    id="heart-checkbox-{{ $data['stories']->id_story }}"
                                                    data-story-id="{{ $data['stories']->id_story }}"
                                                    data-story-action="{{ route('favorite') }}" style="color: red;"
                                                    {{ $favoritItem ? 'checked' : '' }}>
                                                <label for="heart-checkbox-{{ $data['stories']->id_story }}"
                                                    class="heart  {{ $favoritItem ? 'checked' : '' }}"
                                                    id="heart"></label>
                                            </form>
                                        @else
                                            <label for="heart-checkbox" class="heart" id="heart"></label>
                                            <input type="checkbox" name="favorit" class="heart-checkbox"
                                                id="heart-checkbox">
                                        @endif
                                        {{-- - - - - - - - - logo share - - - - - - - --}}
                                        <div class="dropdown2" onclick="toggleCard2()">
                                            <figure>
                                                <img src="{{ asset('/img/detailstory/share.png') }}" alt="">
                                            </figure>
                                        </div>


                                    </div>

                                </div>
                                {{-- link masuk halaman selanjutnya --}}

                                <div class="text-bottom">
                                    <h5 class="h5">{{ Str::limit($recomend->title, 13) }}</h5>
                                    <strong class="strong">Writter</strong><span class="span">:
                                        {{ Str::limit($recomend->full_name, 8) }}</span><br>
                                    <strong class="strong">Genre</strong><span class="span">:
                                        {{ Str::limit($recomend->genre, 8) }}</span>


                                    <div class="rate-5">
                                        <div class="bin2">
                                            @if ($recomend->average_rating >= 0.5 && $recomend->average_rating <= 5)
                                                @for ($i = 0.5; $i <= 5; $i++)
                                                    @if ($i <= $recomend->average_rating)
                                                        <span class="fa fa-star checked" style="cursor: pointer;"></span>
                                                    @else
                                                        @if ($i - 0.5 <= $recomend->average_rating)
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
                                                <span class="spans">
                                                    {{ '(' . number_format($recomend->average_rating, 1) . ')' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card-share2 ">
                            <figure>
                                <a href="2"><img src="{{ asset('/img/detailstory/copylink.png') }}"
                                        alt=""></a>
                                <img src="{{ asset('/img/detailstory/wisap.png') }}" alt="">
                                <img src="{{ asset('/img/detailstory/ig.png') }}" alt="">
                                <img src="{{ asset('/img/detailstory/tw.png') }}" alt="">
                            </figure>
                        </div>
                    @endforeach

                </div>



                {{-- ---------------------------------------- Detail Cerita Bagian  -------------------------------------- --}}
                <div class="content-right">

                    <div class="cerita-detail">
                        <div class="judul-cerita">
                            <h4>Description</h4>
                        </div>


                        <div class="isi-cerita">
                            <div class="img-isi-cerita">
                                <figure class="figureee">
                                    <img src="/upload/{{ $data['stories']->images }}" alt="">
                                </figure>
                                <div class="media">
                                    <div class="favorit-detail">
                                        <div class="Love123">


                                            @if (Auth::check())
                                                <form action="{{ route('favorite') }}" method="post"
                                                    class="favorite-form">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_story"
                                                        value="{{ $data['stories']->id_story }}">
                                                    @php
                                                        $favoritItem = in_array(
                                                            $data['stories']->id_story,
                                                            $data['favorit'],
                                                        );

                                                    @endphp
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        style="display: none;"
                                                        id="heart-checkbox-{{ $data['stories']->id_story }}"
                                                        data-story-id="{{ $data['stories']->id_story }}"
                                                        data-story-action="{{ route('favorite') }}" style="color: red;"
                                                        {{ $favoritItem ? 'checked' : '' }}>
                                                    <label for="heart-checkbox-{{ $data['stories']->id_story }}"
                                                        class="heart  {{ $favoritItem ? 'checked' : '' }} heartL"
                                                        id="heart"></label>
                                                </form>
                                            @else
                                                <a href="#">
                                                    <label for="heart-checkbox" class="heart" id="heart"></label>
                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        id="heart-checkbox">
                                                </a>
                                            @endif
                                        </div>
                                        <p>favorit</p>
                                    </div>
                                    <div class="bagikan-detail" onclick="toggleCard()">
                                        {{-- - - - - - - - - logo share - - - - - - - --}}
                                        <figure>
                                            <img src="{{ asset('/img/detailstory/share.png') }}" alt="">
                                        </figure>
                                        <p>Share</p>
                                    </div>

                                    <div class="rate125">
                                        <div class="tempat-rate" sty>
                                            <div style="display: flex; justify-content: space-between; "
                                                class="bintang999">
                                                @if ($data['stories']->average_rating >= 0.5 && $data['stories']->average_rating <= 5)
                                                    @for ($i = 0.5; $i <= 5; $i++)
                                                        @if ($i <= $data['stories']->average_rating)
                                                            <span class="fa fa-star checked"
                                                                style="cursor: pointer;"></span>
                                                        @else
                                                            @if ($i - 0.5 <= $data['stories']->average_rating)
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
                                                <div class="counts" style="margin-top: -3px;">
                                                    <span class="spans">
                                                        {{ '(' . number_format($data['stories']->average_rating, 1) . ')' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="text-cerita">
                                <div class="isi-text-cerita">
                                    <p style="margin-bottom: 10px;">
                                        @if (strlen($data['stories']->sinopsis) > 300)
                                            {{ Str::limit($data['stories']->sinopsis, 300) }}
                                            <a href="{{ route('ChatStory', $data['stories']->id_chapter) }}">See More</a>
                                        @else
                                            {{ $data['stories']->sinopsis }}
                                        @endif
                                    </p>

                                    <div class="bagian-detail-cerita">
                                        <p>Start: {{ Str::limit($chapters->first()->chapter, 9) }}</p>
                                    </div>
                                    <div class="bagian-detail-cerita">
                                        <p>Last: {{ Str::limit($chapters->last()->chapter, 8) }}</p>
                                    </div>
                                </div>

                                <div class="bottom-isi-cerita">


                                    <ul>
                                        <li class="tabel-isi-cerita garis-kiri">
                                            <p>Status</p>
                                            <p>:
                                                @if ($data['stories']->book_status == 1)
                                                    Publish
                                                @elseif($data['stories']->book_status == 3)
                                                    Completed
                                                @endif
                                            </p>
                                        </li>
                                        <li class="tabel-isi-cerita">
                                            <p>Writter</p>
                                            <p class="nameWr">: {{  $data['stories']->full_name  }}</p>
                                        </li>
                                        <li class="tabel-isi-cerita garis-kiri garis-bawah">
                                            <p>Rilis</p>
                                            <p>: {{ date('j F Y', strtotime($data['storyPublish']->created_at)) }}</p>

                                            </p>
                                        </li>
                                        <li class="tabel-isi-cerita garis-bawah">
                                            <p>Publish</p>
                                            <p>: {{ date('j F Y', strtotime($data['storyPublish']->updated_at)) }}</p>
                                        </li>
                                    </ul>

                                    <div class="grub-tipecerita">
                                        <div class="tipe-cerita">
                                            <p>{{ $data['stories']->genre }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-share" id="myCard">
                            <div class="close-button" onclick="toggleCard()">x</div>
                            <figure>
                                <a href="00"><img src="{{ asset('/img/detailstory/copylink.png') }}"
                                        alt=""></a>
                                <a href="11"><img src="{{ asset('/img/detailstory/wisap.png') }}"
                                        alt=""></a>
                                <a href="22"><img src="{{ asset('/img/detailstory/ig.png') }}" alt=""></a>
                                <a href="33"><img src="{{ asset('/img/detailstory/tw.png') }}" alt=""></a>
                            </figure>
                        </div>


                        {{-- bagikan --}}

                    </div>
                    {{-- ------------------------------- Bagian Cerita ------------------------------- --}}
                    <div class="content-bagian-cerita">
                        {{-- -- judul cerita -- --}}
                        <div class="judul-BagianCerita">
                            <p>Title Story</p>
                        </div>
                        {{-- bagian-ceirita --}}
                        <div class="bagian-cerita">
                            @foreach ($chapters as $item)
                                <a href="{{ route('ChatStory', $item->id_chapter) }}" class="card-bagian">
                                    <h4>{{ Str::limit($item->chapter, 30) }}</h4>
                                    <p>{{ date('j F Y', strtotime($item->created_at)) }}</p>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>

            <div class="content-DetailStory2">
                {{-- ---------- CARD KOMENTAR --------- --}}
                <div class="card-komentar">
                    <div class="judul">
                        <h4>Review</h4>
                    </div>
                    <div class="card-input">

                        <div class="tab-content">
                            <form action="{{ route('PostCommentAndRate', $data['stories']->id_story) }}" method="POST">
                                @csrf
                                <div class="bintang2">
                                    <div class="bb">
                                        <input type="text" id="rating5" name="id_story"
                                            value="{{ $data['stories']->id_story }}" />
                                        <input type="radio" id="star5" class="rate" name="rate"
                                            value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="rate"
                                            value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rate"
                                            value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rate"
                                            value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rate"
                                            value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>

                                <textarea name="comment" id="komentar" placeholder="Tulis Komentar....."></textarea>
                                <button type="submit" name="submit">Send</button>
                            </form>
                        </div>

                    </div>
                </div>



                <div class="cerita-lainnya">
                    <div class="judul">
                        <h3>Another Story</h3>
                        <div class="line"></div>
                    </div>

                    <div class="content-ceritalainnya">

                        <div class="scroll-container">
                            <button class="scroll-button left">
                                <img src="{{ asset('/img/detailstory/kiri.png') }}" alt="">
                            </button>
                            <div class="grub-card">
                                @foreach ($data['RateRecomendationStory'] as $items)

                                    <div class="card-cerita">
                                        <figure>
                                            <a href="{{ route('detailStory', $items->id_story) }}">{{-- <<<---- mausk link halaman selanjutnya --}}
                                                <img src="/upload/{{ $items->images }}" alt=""
                                                    class="imgcardlannya">
                                            </a>
                                        </figure>
                                        <div class="Love">

                                            @if (Auth::check())
                                                <form action="{{ route('favorite') }}" method="post"
                                                    class="favorite-form">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_story"
                                                        value="{{ $items->id_story }}">
                                                    @php
                                                        $favoritItem = in_array($items->id_story, $data['favorit']);

                                                    @endphp

                                                    <input type="checkbox" name="favorit" class="heart-checkbox"
                                                        style="display: none;" id="heart-checkbox-{{ $items->id_story }}"
                                                        data-story-id="{{ $items->id_story }}"
                                                        data-story-action="{{ route('favorite') }}" style="color: red;"
                                                        {{ $favoritItem ? 'checked' : '' }}>
                                                    <label for="heart-checkbox-{{ $items->id_story }}"
                                                        class="heart  {{ $favoritItem ? 'checked' : '' }}"
                                                        id="heart"></label>
                                                </form>
                                            @else
                                                <label for="heart-checkbox" class="heart" id="heart"></label>
                                                <input type="checkbox" name="favorit" class="heart-checkbox"
                                                    id="heart-checkbox">
                                            @endif

                                            {{-- - - - - - - - - logo share - - - - - - - --}}
                                            <div class="dropdown3" onclick="toggleCard3()">
                                                <img src="{{ asset('/img/detailstory/share.png') }}" alt=""
                                                    class="imgshare3" {{-- onclick="cc({{ $jumlah + 1 }})" --}}>
                                            </div>
                                            <div class="dropdown4" onclick="toggleCard4()">
                                                <img src="{{ asset('/img/detailstory/share.png') }}" alt=""
                                                    class="imgshare3" {{-- onclick="cc({{ $jumlah + 1 }})" --}}>
                                            </div>

                                        </div>
                                        {{-- masuk link halaman selanjutnya --}}
                                        <a href="2">
                                            <div class="share">
                                                <p class="text-title">{{ Str::limit($items->title, 8) }}</p>
                                                <strong style="width: 80px; display: inline-block;">Writter</strong>:
                                                <span>{{ Str::limit($items->full_name, 8) }}</span><br>
                                                <strong style="width: 80px; display: inline-block;">Genre</strong>:
                                                <span>{{ Str::limit($items->genre, 8) }}</span>

                                            </div>
                                            <div class="rate124">
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
                                                            <span class="span" style="color: black; ">
                                                                {{ '(' . number_format($items->average_rating, 1) . ')' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>


                                        <div class="card-share3">
                                            <div class="grub-sosmed-icons">
                                                <a href="12"><img src="{{ asset('/img/detailstory/copylink.png') }}"
                                                        alt="" class="sosmed-icon"></a>
                                                <a href="12"><img src="{{ asset('/img/detailstory/wisap.png') }}"
                                                        alt="" class="sosmed-icon"></a>
                                                <a href="12"><img src="{{ asset('/img/detailstory/ig.png') }}"
                                                        alt="" class="sosmed-icon"></a>
                                                <a href="12"><img src="{{ asset('/img/detailstory/tw.png') }}"
                                                        alt="" class="sosmed-icon"></a>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                            <button class="scroll-button right">
                                <img src="{{ asset('/img/detailstory/kanan.png') }}">
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
