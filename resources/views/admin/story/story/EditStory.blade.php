@extends('layouts.app')
@section('title', 'Edit Stories')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Write Your Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('updateStory', $data->id_story) }}" method="post"
                                enctype="multipart/form-data" class="cursor-hover">
                                @csrf
                                {{-- <div class="mb-3 cursor-hover">
                                    <label for="category" class="cursor-hover">Category</label>
                                    <select name="id_category" id="id_category" class="form-control cursor-hover">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id_category }}"
                                                {{ $category->id_category == $data->id_category ? 'selected' : '' }}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="mb-3 cursor-hover">
                                    <label for="genre" class="cursor-hover">Genre</label>
                                    <select name="id_genre" id="id_genre" class="form-control cursor-hover">
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->id_genre }}"
                                                {{ $genre->id_genre == $data->id_genre ? 'selected' : '' }}>
                                                {{ $genre->genre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 cursor-hover">
                                    <label for="title" class="cursor-hover">Title</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="title" type="text"
                                        placeholder="Ya Habibi" value="{{ $data->title }}">
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="images" class="cursor-hover">Images</label>

                                    @if ($data->images)
                                        <img src="{{ asset('/upload/' . $data->images) }}" alt="Current Image Preview"
                                            width="50px" height="50px">
                                    @else
                                        <img src="{{ asset('/upload/placeholder-image.jpg') }}"
                                            alt="Placeholder Image Preview" width="50px" height="50px">
                                    @endif

                                    <input class="form-control" id="exampleFormControlInput1" name="images" type="file"
                                        value="{{ $data->images }}">
                                </div>

                                <div class="mb-3 cursor-hover">
                                    <label for="sinopsis" class="cursor-hover">sinopsis</label>
                                    <textarea class="form-control" id="exampleFormControlInput1" name="sinopsis"
                                        placeholder="Sinopsis : example He is student">{{ $data->sinopsis }}</textarea>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="book_status" class="cursor-hover">Status</label>
                                    <select name="book_status" id="book_status" class="form-control cursor-hover">
                                        @foreach ([1 => 'Published', 2 => 'Draft', 3 => 'Completed', 4 => 'On Hold'] as $key => $status)
                                            <option value="{{ $key }}"
                                                {{ $key == $data->book_status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary cursor-pointer">Submit
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
