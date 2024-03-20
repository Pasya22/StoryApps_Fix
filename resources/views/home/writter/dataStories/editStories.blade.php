@extends('layouts.writer')
@section('title', 'Edit Stories')
@section('content')
    <div class="container">
        <h3 class="title">Edit Stories</h3>
        <a href="{{ route('dataStories') }}">
            <i class="fa fa-arrow-left" id="left-icon"></i>
        </a>
        <form action="{{ route('updateStoryS', $data->id_story) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-title">
                <label for="text">Title</label><br>
                <input type="text" id="Title" name="title" value="{{ $data->title }}"
                    style="text-align: center;"><br><br>
            </div>
            <div class="form">
                <div class="form-group">
                    <div class="form-type">
                        <label for="file">Image</label><br>
                        @if ($data->images)
                            <img src="{{ asset('/upload/' . $data->images) }}" alt="Current Image Preview" width="50px"
                                height="50px">
                        @else
                            <img src="{{ asset('/upload/placeholder-image.jpg') }}" alt="Placeholder Image Preview"
                                width="50px" height="50px">
                        @endif
                        <input type="file" id="file" name="images"><br><br>
                    </div>
                    <div class="form-type">
                        <label for="Genre">Genre</label><br>
                        <select id="id_genre" name="id_genre">
                            <option disabled selected>-- Choice Genre --</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id_genre }}"
                                    {{ $genre->id_genre == $data->id_genre ? 'selected' : '' }}>
                                    {{ $genre->genre }}
                                </option>
                            @endforeach
                        </select><br><br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-type">
                        <label for="text1">Create At</label><br>
                        <input type="datetime-local" id="Create" name="created_at"><br><br>
                    </div>

                    <div class="form-type">
                        <label for="text1">Book Status</label><br>
                        <select id="book_status" name="book_status">
                            <option disabled selected>-- Status --</option>
                            @foreach ([1 => 'Published', 2 => 'Draft', 3 => 'Completed', 4 => 'On Hold'] as $key => $status)
                                <option value="{{ $key }}" {{ $key == $data->book_status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select><br><br>
                    </div>
                </div>
            </div>
            <div class="form-title">
                <label for="text1">sinopsis</label><br>
                <textarea type="text" name="sinopsis" id="sinopsis" cols="30" rows="10">{{ $data->sinopsis }}</textarea>
            </div>
            <div class="btn-submit"><button type="submit" class="btn" style="cursor: pointer;">Submit</button></div>
        </form>
    </div>
@endsection
