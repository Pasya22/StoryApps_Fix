@extends('layouts.app')
@section('title', 'Add Chapters')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Chapter's Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostChapter') }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="mb-3 cursor-hover ">
                                    <label for="id_story" class="cursor-hover" id="id_story">Stories</label>
                                    <select name="id_story" id="id_story" class="form-control cursor-hover">
                                        <option value="">-- Choice stories --</option>
                                        @foreach ($data as $story)
                                            <option value="{{ $story->id_story }}">{{ $story->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="chapter" class="cursor-hover">Chapters</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="chapter" type="text"
                                        placeholder="Please Input Chpater Stories...." required>
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
