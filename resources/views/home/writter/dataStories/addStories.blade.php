@extends('layouts.writer')
@section('title', 'Add Stories')
@section('content')
    <div class="container">
        <h3 class="title">Add Stories</h3>

        <a href="{{ route('dataStories') }}">
            <i class="fa fa-arrow-left" id="left-icon"></i>
        </a>
        <form action="{{ route('addStory') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-title">
                <label for="text1">Title</label><br>
                <input type="text" id="Title" name="title" style="text-align: center;"><br><br>
            </div>
            <div class="form">
                <div class="form-group">
                    <div class="form-type">
                        <label for="file">Image</label><br>
                        <input type="file" id="file" name="images"><br><br>
                    </div>
                    <div class="form-type">
                        <label for="Genre">Genre</label><br>
                        <select id="id_genre" name="id_genre">
                            <option disabled selected>-- Choice Genre --</option>
                            @foreach ($data as $genre)
                                <option value="{{ $genre->id_genre }}">{{ $genre->genre }}</option>
                            @endforeach
                        </select><br><br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-type">
                        <label for="text1">Create At</label><br>
                        <input type="date" id="Create" name="created_at"><br><br>
                    </div>

                    <div class="form-type">
                        <label for="text1">Book Status</label><br>
                        <select id="book_status" name="book_status">
                            <option disabled selected>-- Status --</option>
                            <option value="1">Published</option>
                            <option value="2">Draft</option>
                            <option value="3">Completed</option>
                            <option value="4">On Hold</option>
                        </select><br><br>
                    </div>
                </div>
            </div>
            <div class="form-title">
                <label for="text1">sinopsis</label><br>
                <textarea type="text" name="sinopsis" id="sinopsis" cols="30" rows="10"></textarea>
            </div>
            <div class="btn-submit"><button type="submit" class="btn" style="cursor: pointer;">Submit</button></div>
        </form>
    </div>
@endsection
