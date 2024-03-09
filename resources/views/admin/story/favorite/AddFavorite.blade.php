@extends('layouts.app')
@section('title', 'Add Favorite')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Favorite Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="#" method="POST" class="cursor-hover" id="favoriteForm">
                                @method('POST')
                                @csrf
                                <div class="mb-3 cursor-hover ">
                                    <label for="id_story" class="cursor-hover" id="id_story">Stories</label>
                                    <select name="id_story" id="id_story" class="form-control cursor-hover"
                                        data-characters="id_story">
                                        <option value="">-- Choice stories --</option>
                                        @foreach ($data['stories'] as $story)
                                            <option value="{{ $story->id_story }}">{{ $story->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover ">
                                    <label for="id" class="cursor-hover" id="id">Users</label>
                                    <select name="id_user" id="id_user" class="form-control cursor-hover"
                                        data-characters="id">
                                        <option value="">-- Choice stories --</option>
                                        @foreach ($data['users'] as $user)
                                            <option value="{{ $user->id }}">{{ $user->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <p>Favorites</p>
                                    <br>
                                    <input id="heart-checkbox" name="favorit" type="checkbox" class="heart-checkbox"
                                        value="1">
                                    <label for="heart-checkbox" class="heart" name="favorit" id="heart"></label>

                                </div>

                                <button type="button" name="submit" id="submitForm"
                                    class="btn btn-primary cursor-pointer">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
