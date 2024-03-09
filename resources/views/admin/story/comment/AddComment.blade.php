@extends('layouts.app')
@section('title', 'Add Comment')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Comment Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostComment') }}" method="post" class="cursor-hover">
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
                                    <label for="title" class="cursor-hover">Comment</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="comment" type="text"
                                        placeholder="Please Input Your Comment" required>
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
