@extends('layouts.app')
@section('title', 'Add Dialog')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Dialog's Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostDialog') }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="container-inputDialog" id="dialogs-container">
                                    <div class="gap-2 d-md-flex justify-content-md-end">
                                        <input type="button" onclick="addDialogInput()" class="btn btn-primary"
                                            id="btnAddDialog" value="Add Dialog">
                                    </div>

                                    <div class="mb-3 cursor-hover ">
                                        <label for="story" class="cursor-hover" id="Stories-labelDialog">Stories</label>
                                        <select name="id_story" id="id_story" class="form-control cursor-hover"
                                            data-stories="id_story">
                                            <option value="">-- Choice Stories --</option>
                                            @foreach ($stories as $story)
                                                <option value="{{ $story->id_story }}">{{ $story->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 cursor-hover ">
                                        <label for="chapter" class="cursor-hover"
                                            id="Chapters-labelDialog">Chpater's</label>
                                        <select name="id_chapter" id="id_chapter" class="form-control cursor-hover"
                                            data-chapters="id_chapter">
                                            <option value="">-- Choice Chapter's --</option>
                                            @foreach ($chapters as $chapter)
                                                <option value="{{ $chapter->id_chapter }}">{{ $chapter->chapter }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 cursor-hover ">
                                        <label for="chapter" class="cursor-hover"
                                            id="Charaters-labelDialog">Character's</label>
                                        <select name="id_character[]" id="id_character" class="form-control cursor-hover"
                                            data-characters="id_character[]">
                                            <option value="">-- Choice Character's --</option>
                                            @foreach ($characters as $character)
                                                @if ($character->character > 2)
                                                    <option value="{{ $character->id_character }}">
                                                        {{ $character->character . ' chapter'.$character->id_chapter }}
                                                    </option>

                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="character" class="cursor-hover">Dialog</label>
                                        <textarea class="form-control" id="exampleFormControlInput1" name="dialog[]" type="text"
                                            placeholder="Please Input Chpater Stories...." required></textarea>
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-ct">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary d-grid gap-2 col-6 mx-auto">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
