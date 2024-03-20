@extends('layouts.writer')
@section('title', 'Add Characters')
@section('content')
    <div class="container">
        <h3 class="title">Add Characters</h3>

        <a href="{{ route('dataCharacters') }}">
            <i class="fa fa-arrow-left" id="left-icon"></i>
        </a>
        <div class="input-btn-add">
        <input type="button" onclick="addCharacterInput()" class="btn-add btn-primary ml-2" id="btnAddCharacter"
            value="Add Character">
        </div>
        <form action="{{ route('addCharacters') }}" method="POST">
            @csrf
            <div class="form-title">
                <label for="text1">Characters</label><br>
                <input type="text" name="character[]" id="character">
            </div>
            <div class="form">
                <div class="form-type">
                    <label for="text1">Stories</label><br>
                    <select id="id_story" name="id_story">
                        <option disabled selected>-- Choice Stories --</option>
                        @foreach ($data['stories'] as $item)
                            <option value="{{ $item->id_story }}">{{ $item->title }}</option>
                        @endforeach
                    </select><br><br>
                </div>
                <div class="form-type">
                    <label for="text1">Chapters</label><br>
                    <select id="id_chapter" name="id_chapter">
                        <option disabled selected>-- Choice Stories --</option>
                        @foreach ($data['chapters'] as $item)
                            <option value="{{ $item->id_chapter }}">{{ $item->chapter }}</option>
                        @endforeach
                    </select><br><br>
                </div>
            </div>

            <div id="characters-container" class="flex-grow-1">

            </div>
            <div class="btn-submit"><button type="submit" class="btn" style="cursor: pointer;">Submit</button></div>
        </form>
    </div>
@endsection
