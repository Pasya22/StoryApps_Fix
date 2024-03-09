@extends('layouts.app')
@section('title', 'Writte Stories')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Write Your Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostStories') }}" method="post" enctype="multipart/form-data"
                                class="cursor-hover">
                                @csrf
                                {{-- <div class="mb-3 cursor-hover">
                                    <label for="category" class="cursor-hover">Category</label>
                                    <select name="id_category" id="id_category" class="form-control cursor-hover">
                                        <option value="">-- Choice Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id_category }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="mb-3 cursor-hover">
                                    <label for="genre" class="cursor-hover">Genre</label>
                                    <select name="id_genre" id="id_genre" class="form-control cursor-hover">
                                        <option value="">-- Choice Genre --</option>
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->id_genre }}">{{ $genre->genre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="title" class="cursor-hover">Title</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="title" type="text"
                                        placeholder="Ya Habibi">
                                </div>

                                <div class="mb-3 cursor-hover">
                                    <label for="images" class="cursor-hover">Images</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="images" type="file">
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="sinopsis" class="cursor-hover">sinopsis</label>
                                    <textarea class="form-control" id="exampleFormControlInput1" name="sinopsis"
                                        placeholder="Sinopsis : example He is student"></textarea>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="book_status" class="cursor-hover">Status</label>
                                    <select name="book_status" id="book_status" class="form-control cursor-hover">
                                        <option value="">-- Select Status --</option>
                                        <option value="1">Published</option>
                                        <option value="2">Draft</option>
                                        <option value="3">Completed</option>
                                        <option value="4">On Hold</option>
                                    </select>
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
