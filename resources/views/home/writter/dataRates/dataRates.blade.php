@extends('layouts.writer')
@section('title', 'Data Rates')
@section('content')
    <h3>List Rates</h3>

    <div class="page">
        <table>
            <tr>
                <th>Images</th>
                <th>Story</th>
                <th>User</th>
                <th>Rate</th>
            </tr>
            @foreach ($data['rates'] as $rate)
            <tr>
                <td class="cover">
                    <figure>
                        <img src="/upload/{{ $rate->images }}" alt="images" height="50px" width="50px" />
                    </figure>
                </td>
                    <td>
                        <div class="text">{{ $rate->title ?? '' }}</div>
                    </td>
                    <td>
                        <div class="text">{{ $rate->full_name ?? '' }}</div>
                    </td>
                    <td style="width: 20%; text-align: center; ">
                        @if ($rate->total_ratings > 0)
                            @if ($rate->average_rating >= 0.5 && $rate->average_rating <= 5)
                                @for ($i = 0.5; $i <= 5; $i++)
                                    @if ($i <= $rate->average_rating)
                                        <span class="fa fa-star checked" style="cursor: pointer;"></span>
                                    @else
                                        @if ($i - 0.5 <= $rate->average_rating)
                                            <span class="fa fa-star-half checked-half" style="cursor: pointer; "></span>
                                        @else
                                            <span class="fa fa-star" style="cursor: pointer;"></span>
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
                        @if ($rate->average_rating > 0)
                            <div class="counts">
                                <span class="span">{{ '(' . number_format($rate->average_rating, 1) . ')' }}</span>
                            </div>
                            <!-- Sembunyikan peringkat rata-rata jika average_rating = 0.0 -->
                        @elseif ($rate->average_rating == 0.0)
                            <div class="counts" style="display: none;">
                                <span class="span">{{ '(' . number_format($rate->average_rating, 1) . ')' }}</span>
                            </div>
                        @endif
                    </td>

            </tr>
            @endforeach
        </table>
    </div>
@endsection
{{-- @foreach ($cha as $chapter)
                        <a href="/admin/read/read/{{ $chapter->id_chapter }}" target="_blank"
                            class="btn btn-primary ml-2">Read
                            Now</a>&nbsp;
                    @endforeach --}}
