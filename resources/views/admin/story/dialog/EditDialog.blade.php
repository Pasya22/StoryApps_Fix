@extends('layouts.app')
@section('title', 'Edit Dialog')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Edit Dialog's Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('updateDialog', $dialogs->id_dialog) }}" method="post"
                                class="cursor-hover">
                                @csrf
                                <div class="mb-3 cursor-hover">
                                    <label for="story" class="cursor-hover">stories</label>
                                    <select name="id_story" id="id_story" class="form-control cursor-hover">
                                        @foreach ($stories as $story)
                                            <option value="{{ $story->id_story }}"
                                                {{ $story->id_story == $dialogs->id_story ? 'selected' : '' }}>
                                                {{ $story->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="chapter" class="cursor-hover">Chapter's</label>
                                    <select name="id_chapter" id="id_chapter" class="form-control cursor-hover">
                                        @foreach ($chapters as $chapter)
                                            <option value="{{ $chapter->id_chapter }}"
                                                {{ $chapter->id_chapter == $dialogs->id_chapter ? 'selected' : '' }}>
                                                {{ $chapter->chapter }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="character" class="cursor-hover">Character's</label>
                                    <select name="id_character" id="id_character" class="form-control cursor-hover">
                                        @foreach ($characters as $character)
                                            <option value="{{ $character->id_character }}"
                                                {{ $character->id_character == $dialogs->id_character ? 'selected' : '' }}>
                                                {{ $character->character }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="dialog" class="cursor-hover">Dialog</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="dialog"
                                        type="text" value="{{ $dialogs->dialog }}">
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="created_at" class="cursor-hover">Created At</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="created_at"
                                        type="datetime-local" value="{{ $dialogs->created_at }}">
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
