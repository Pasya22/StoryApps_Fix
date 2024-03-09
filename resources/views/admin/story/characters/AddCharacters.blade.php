@extends('layouts.app')
@section('title', 'Add Characters')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Character's Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostCharacter') }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="mb-3 cursor-hover">
                                    <label for="chapter" class="cursor-hover">Story</label>
                                    <select name="id_story" id="id_story" class="form-control cursor-hover">
                                        <option value="">-- Choice Story --</option>
                                        @foreach ($stories as $story)
                                            <option value="{{ $story->id_story }}">{{ $story->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="chapter" class="cursor-hover">Chapter's</label>
                                    <select name="id_chapter" id="id_chapter" class="form-control cursor-hover">
                                        <option value="">-- Choice Chapter's --</option>
                                        @foreach ($chapters as $chapter)
                                            <option value="{{ $chapter->id_chapter }}">{{ $chapter->chapter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="mb-3 cursor-hover">
                                    <label for="character" class="cursor-hover">Characters</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="character" type="text"
                                        placeholder="Please Input Chpater Stories...." required>
                                </div> --}}
                                <div class="container-input">
                                    <div class="mb-3 cursor-hover d-flex align-items-end">
                                        <label for="characters" class="cursor-hover" id="character-label">Characters
                                            1</label>&nbsp;
                                        <div class="flex-grow-1">
                                            <input class="form-control" name="character[]" type="text"
                                                placeholder="Please Input Character Stories...." required>
                                        </div>
                                        <input type="button" onclick="addCharacterInput()" class="btn btn-primary ml-2"
                                            id="btnAddCharacter" value="Add Character">

                                    </div>

                                    <div id="characters-container" class="flex-grow-1">

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
