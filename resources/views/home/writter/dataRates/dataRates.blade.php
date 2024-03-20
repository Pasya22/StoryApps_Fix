@extends('layouts.writer')
@section('title', 'Data Rates')
@section('content')
    <h3>List Rates</h3>

    <div class="page">
        <table>
            <tr>
                <th>Images</th>
                <th>Title</th>
                <th>Username</th>
                <th>Rate</th>
                <th>Create At</th>
            </tr>
            <tr>
                @foreach ($data['rates'] as $item)
                    <td class="cover">
                        <figure>
                            <img src="/upload/{{ $item->images }}" alt="images" height="50px" width="50px" />
                        </figure>
                    </td> 
                    <td>
                        <div class="text">{{ $item->title }}</div>
                    </td>
                    {{-- <td>
                        <div class="text">Jumlah Chapter</div>
                    </td> --}}
                    {{-- <td>
                        <div class="text">Jumlah Halaman</div>
                    </td> --}}
                    <td>
                        <div class="text">
                            @if ($story->book_status == 1)
                                Publish
                            @elseif($story->book_status == 2)
                                Draf
                            @elseif($story->book_status == 3)
                                Completed
                            @elseif($story->book_status == 4)
                                On Hold
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="text">
                            @if ($story->book_status == 1)
                                Publish
                            @elseif($story->book_status == 2)
                                Draft
                            @elseif($story->book_status == 3)
                                Completed
                            @elseif($story->book_status == 4)
                                On Hold
                            @endif
                        </div>
                    </td>

                    <td class="cover">
                        <div class="aksi" style="display: flex; ">
                            <select class="form-control" onchange="changeStatus('{{ $story->id_story }}', this)"
                                style="width: 150px;">
                                <option value="1" {{ $story->book_status == 1 ? 'selected' : '' }}>Publish</option>
                                <option value="2" {{ $story->book_status == 2 ? 'selected' : '' }}>Draft</option>
                                <option value="3" {{ $story->book_status == 3 ? 'selected' : '' }}>Completed</option>
                                <option value="4" {{ $story->book_status == 4 ? 'selected' : '' }}>On Hold</option>
                            </select>


                            <a href="/writter/edit-story/{{ $story->id_story }}" class="btn btn-warning mr-2">Edit</a>
                            <a href="#" class="btn btn-danger delete-btn" data-id="{{ $story->id_story }}">Delete</a>
                        </div>
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
