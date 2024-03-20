@extends('layouts.writer')
@section('title', 'Add Dialogs')
@section('content')
    <div class="container">
        <h3 class="title">Add Dialogs</h3>

        <a href="{{ route('dataDialogs') }}">
            <i class="fa fa-arrow-left" id="left-icon"></i>
        </a>
        <div class="input-btn-add">
            <input type="button" onclick="addDialogInput()" class="btn-add btn-primary ml-2" id="btnAddDialog"
                value="Add Dialogs">
        </div>

        <form action="{{ route('addDialogs') }}" method="POST">
            @csrf
            <div class="form">
                <div class="form-type">
                    <label for="text1">Stories</label><br>
                    <select id="id_story" name="id_story">
                        <option disabled selected>-- Choice Stories --</option>
                        @foreach ($stories as $item)
                            <option value="{{ $item->id_story }}">{{ $item->title }}</option>
                        @endforeach
                    </select><br><br>
                </div>
                <div class="form-type">
                    <label for="text1">Chapters</label><br>
                    <select name="id_chapter" id="id_chapter">
                        <option disabled selected>-- Choice Chapters --</option>
                        @foreach ($chapters as $chapter)
                            <option value="{{ $chapter->id_chapter }}">{{ $chapter->chapter }}
                            </option>
                        @endforeach
                    </select><br><br>
                </div>
            </div>
            <div class="form">
                <div class="form-type">
                    <label for="text1">Characters</label><br>
                    <select id="id_character" name="id_character[]">
                        <option disabled selected>-- Choice Characters --</option>
                        @foreach ($characters as $character)
                            @if ($character->character > 2)
                                <option value="{{ $character->id_character }}">
                                    {{ $character->character . ' chapter' . $character->id_chapter }}
                                </option>
                            @endif
                        @endforeach
                    </select><br><br>
                </div>

            </div>
            <div class="form-title">
                <label for="text1">Dialogs</label><br>
                <textarea type="text" name="dialog[]" class="sinopsis2" cols="30" rows="10"></textarea> <!-- Moved textarea inside -->
                <br>
                <div id="dialogs-container"> <!-- Added ID for dialogs container -->
                    <br>
                </div>
            </div>
            <div class="btn-submit"><button type="submit" class="btn" style="cursor: pointer;">Submit</button></div>
        </form>
    </div>

@endsection
