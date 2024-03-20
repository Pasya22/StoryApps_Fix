@extends('layouts.writer')
@section('title', 'Add Chapters')
@section('content')
    <div class="container">
        <h3 class="title">Add Chapter</h3>

        <a href="{{ route('dataChapters') }}">
            <i class="fa fa-arrow-left" id="left-icon"></i>
        </a>
        <form action="{{ route('addChapters') }}" method="POST">
            @csrf
            <div class="form-title">
                <label for="text1">Chapters</label><br>
                <input type="text" name="chapter" id="chapter">
            </div>
            <div class="form">
                <div class="form-type">
                    <label for="text1">Stories</label><br>
                    <select id="id_story" name="id_story">
                        <option disabled selected>-- Choice Stories --</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id_story }}">{{ $item->title }}</option>
                        @endforeach
                    </select><br><br>
                </div>

                <div class="form-type">
                    <label for="text1">Create At</label><br>
                    <input type="date" id="Create" name="created_at"><br><br>
                </div>

            </div>

            <div class="btn-submit"><button type="submit" class="btn" style="cursor: pointer;">Submit</button></div>
        </form>
    </div>
@endsection
