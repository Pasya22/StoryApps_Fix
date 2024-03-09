@extends('layouts.app')
@section('title', 'Edit Favorite Story')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Edit Favorite's Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('updateFavorite', $favorites->id_favorite) }}" method="post"
                                class="cursor-hover">
                                @csrf
                                <div class="mb-3 cursor-hover ">
                                    <label for="id_user" class="cursor-hover" id="id_user">Stories</label>
                                    <select name="id_user" id="id_user" class="form-control cursor-hover">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == $favorites->id_user ? 'selected' : '' }}>
                                                {{ $user->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover ">
                                    <label for="id_story" class="cursor-hover" id="id_story">Stories</label>
                                    <select name="id_story" id="id_story" class="form-control cursor-hover">
                                        @foreach ($stories as $story)
                                            <option value="{{ $story->id_story }}"
                                                {{ $story->id_story == $favorites->id_story ? 'selected' : '' }}>
                                                {{ $story->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <p>Favorites</p>
                                    <br>

                                    <input id="heart-checkbox" name="favorit" type="checkbox" class="heart-checkbox "
                                        value="{{ $favorites->favorit }}" {{ $favorites && $favorites->favorit == 1 ? 'checked' : '' }}>
                                    <label for="heart-checkbox" class="heart {{ $favorites && $favorites->favorit == 1 ? 'checked' : '' }}" name="favorit" id="heart"></label>

                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="created_at" class="cursor-hover">Created At</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="created_at"
                                        type="datetime-local" value="{{ $favorites->created_at }}">
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
