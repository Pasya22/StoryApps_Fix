@extends('layouts.app')

@section('title', 'Data Stories')

@section('content')
    {{-- <div class="container"> --}}
    <h1>
        Data Stories</h1>
    <div class="container-box">
        <form action="/stories" method="get">
            <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                class="form-control ds-input" id="search-input" />
        </form>
        <!-- Table of data stories -->
        <a href="/admin/writteStories" class="btn btn-success" style="margin-bottom: 5px;"><i class="fa fa-plus"
                aria-hidden="true" style="margin-right:5px;"></i>Add Stories</a>

    </div>
    <!-- Search bar -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                {{-- <th scope="col" width="10%">Category</th> --}}
                <th scope="col" width="10%">Genre</th>
                <th scope="col" width="13%">Title</th>
                <th scope="col" width="10%">Image</th>
                <th>Amount Chapters</th>
                <th>Amount Pages</th>
                <th scope="col">Create At</th>
                <th scope="col">Book Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stories as $story)
                <tr>
                    {{-- <td>{{ $story->category }}</td> --}}
                    <td>{{ $story->genre_name }}</td>

                    <td>{{ $story->title }}</td>
                    <td>
                        <img src="/upload/{{ $story->images }}" alt="images" height="50px" width="50px" />
                    </td>
                    <td>{{ $story->jumlah_chapter }}</td>
                    <td>
                        @if (isset($story->jumlah_halaman_dialogs))
                            {{ $story->jumlah_halaman_dialogs }}
                        @else
                            0
                        @endif
                    </td>
                    <td>{{ $story->created_at }}</td>
                    <td>
                        @if ($story->book_status == 1)
                            Publish
                        @elseif($story->book_status == 2)
                            Draf
                        @elseif($story->book_status == 3)
                            Completed
                        @elseif($story->book_status == 4)
                            On Hold
                        @endif
                    </td>
                    <td style="display: flex; ">
                        {{-- Dropdown untuk mengubah status cerita --}}

                        <select class="form-control" onchange="changeStatus('{{ $story->id_story }}', this)"
                            style="width: 150px;">
                            <option value="1" {{ $story->book_status == 1 ? 'selected' : '' }}>Publish</option>
                            <option value="2" {{ $story->book_status == 2 ? 'selected' : '' }}>Draft</option>
                            <option value="3" {{ $story->book_status == 3 ? 'selected' : '' }}>Completed</option>
                            <option value="4" {{ $story->book_status == 4 ? 'selected' : '' }}>On Hold</option>
                        </select>&nbsp;

                        {{-- @foreach ($cha as $chapter)
                            <a href="/admin/read/read/{{ $chapter->id_chapter }}" target="_blank"
                                class="btn btn-primary ml-2">Read
                                Now</a>&nbsp;
                        @endforeach --}}
                        <a href="/admin/edit-story/{{ $story->id_story }}" class="btn btn-warning mr-2">Edit</a>
                        <a class="btn btn-danger" href="#" data-toggle="modal"
                            data-target="#DeleteModal{{ $story->id_story }}">
                            Delete
                        </a>
                        <div class="modal fade" id="DeleteModal{{ $story->id_story }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">X</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Are You Seroius Delete This Data?</div>
                                    <div class="modal-footer">
                                        <form action="{{ route('deleteStory', $story->id_story) }}" method="GET">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-primary" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>


    </table>

    <div class="pagnation">
        {{ $stories->links() }}
    </div>

    {{-- </div> --}}
@endsection
