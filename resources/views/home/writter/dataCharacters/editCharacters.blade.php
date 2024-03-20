@extends('layouts.writer')
@section('title', 'Edit Characters')
@section('content')
    <div class="container">
        <h3 class="title">Edit Characters</h3>

        <a href="{{ route('dataCharacters') }}">
            <i class="fa fa-arrow-left" id="left-icon"></i>
        </a>
        <div class="input-btn-add">
            <input type="button" onclick="addCharacterInput()" class="btn-add btn-primary ml-2" id="btnAddCharacter"
                value="Add Character">
        </div>
        <form action="{{ route('updateCharacters', $characters->id_character) }}" method="POST">
            @csrf
            <div class="form-title">
                <label for="text1">Characters</label><br>
                <input type="text" name="character[]" id="character" value="{{ $characters->character }}">
            </div>
            <div class="form">
                <div class="form-type">
                    <label for="text1">Stories</label><br>
                    <select id="id_story" name="id_story">
                        <option disabled selected>-- Choice Stories --</option>
                        @foreach ($stories as $item)
                            <option value="{{ $item->id_story }}"
                                {{ $item->id_story == $characters->id_story ? 'selected' : '' }}>
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </select><br><br>
                </div>
                <div class="form-type">
                    <label for="text1">Chapters</label><br>
                    <select id="id_chapter" name="id_chapter">
                        <option disabled selected>-- Choice Stories --</option>
                        @foreach ($chapters as $item)
                            <option value="{{ $item->id_chapter }}"
                                {{ $item->id_chapter == $characters->id_chapter ? 'selected' : '' }}>
                                {{ $item->chapter }}
                            </option>
                        @endforeach
                    </select><br><br>
                </div>
            </div>
            <div class="form-title">
                <label for="text1">Date Created</label><br>
                <input type="date" name="created_at" id="created_at" value="{{ $characters->created_at }}">
            </div>

            <div id="characters-container" class="flex-grow-1">

            </div>
            <div class="btn-submit"><button type="submit" class="btn" style="cursor: pointer;">Submit</button></div>
        </form>
    </div>
@endsection
