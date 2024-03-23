@extends('layouts.writer')
@section('title', 'Data Favorites')
@section('content')
    <h3>Stories That People Like</h3>
    <div class="page">
        <table>
            <tr>
                <th>Images</th>
                <th>User</th>
                <th>Stories</th>
                <th>Love</th>
            </tr>
            <tr>
                @foreach ($data['favorites'] as $favorite)
                    <td class="cover" style="width: auto; text-align: center; ">
                        <figure>
                            <img src="/upload/{{ $favorite->images }}" alt="images" height="50px" width="50px" />
                        </figure>
                    </td>
                    <td>
                        <div class="text" >{{ $favorite->full_name ?? '' }}</div>
                    </td>
                    <td>
                        <div class="text">{{ $favorite->title ?? '' }}</div>
                    </td>
                    <td style="width: 10%; text-align: center; ">
                        @if ($favorite->favorit)
                            <img src="{{ asset('img/love.png') }}" alt="Love" class="love-icon">
                        @else
                            <img src="{{ asset('img/love.png') }}" alt="Love" class="love-icon">
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
