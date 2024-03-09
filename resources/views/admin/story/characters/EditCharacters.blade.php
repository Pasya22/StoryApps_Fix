@extends('layouts.app')
@section('title', 'Edit Charaters')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Edit Character's Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('updateCharacter', $characters->id_character) }}" method="post"
                                class="cursor-hover">
                                @csrf
                                <div class="mb-3 cursor-hover">
                                    <label for="story" class="cursor-hover">Stories</label>
                                    <select name="id_story" id="id_story" class="form-control cursor-hover">
                                        @foreach ($stories as $story)
                                            <option value="{{ $story->id_story }}"
                                                {{ $story->id_story == $characters->id_story ? 'selected' : '' }}>
                                                {{ $story->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="story" class="cursor-hover">Chapter's</label>
                                    <select name="id_chapter" id="id_chapter" class="form-control cursor-hover">
                                        @foreach ($chapters as $chapter)
                                            <option value="{{ $chapter->id_chapter }}"
                                                {{ $chapter->id_chapter == $characters->id_chapter ? 'selected' : '' }}>
                                                {{ $chapter->chapter }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 cursor-hover">
                                    <label for="created_at" class="cursor-hover">Created At</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="created_at"
                                        type="datetime-local" value="{{ $characters->created_at }}">
                                </div>
                                <div class="container-input">
                                    <div class="mb-3 cursor-hover d-flex align-items-end">
                                        <label for="characters" class="cursor-hover" id="character-label">Characters
                                            1</label>&nbsp;
                                        <div class="flex-grow-1">
                                            <input class="form-control" name="character[]" type="text"
                                                value="{{ $characters->character }}" required>
                                        </div>
                                        <button type="button" onclick="addCharacterInput()" class="btn btn-primary ml-2"
                                            id="btnAddCharacter">Add Character</button>
                                    </div>
                                    <div id="characters-container" class="flex-grow-1">
                                        <!-- Existing characters will be displayed here -->
                                    </div>
                                </div>


                                <button type="submit" name="submit" class="btn btn-primary cursor-pointer">Save
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
