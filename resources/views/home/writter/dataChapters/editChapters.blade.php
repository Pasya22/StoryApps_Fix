@extends('layouts.writer')
@section('title', 'Edit Chapters')
@section('content')
    <div class="container">
        <h3 class="title">Edit Chapter</h3>
        <a href="{{ route('dataChapters') }}">
            <i class="fa fa-arrow-left" id="left-icon"></i>
        </a>
        <form action="{{ route('updateChapters', $chapters->id_chapter) }}" method="POST">

            @csrf
            @method('POST')
            <div class="form-title">
                <label for="text">Chapters</label><br>
                <input type="text" id="Chapters" name="chapter" value="{{ $chapters->chapter }}"
                    style="text-align: center;"><br><br>
            </div>
            <div class="form">
                <div class="form-group">
                    <div class="form-type">
                        <label for="Genre">Story</label><br>
                        <select id="id_story" name="id_story">
                            <option disabled selected>-- Choice Genre --</option>
                            @foreach ($stories as $story)
                                <option value="{{ $story->id_story }}"
                                    {{ $story->id_story == $chapters->id_story ? 'selected' : '' }}>
                                    {{ $story->title }}
                                </option>
                            @endforeach
                        </select><br><br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-type">
                        <label for="text1">Create At</label><br>
                        <input type="datetime-local" id="created_at" name="created_at"><br><br>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn" style="cursor: pointer;">Submit</button>
        </form>
    </div>
@endsection
