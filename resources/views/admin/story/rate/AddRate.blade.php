@extends('layouts.app')
@section('title', 'Add Rate')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Rate Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostRate') }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="mb-3 cursor-hover">
                                    <label for="story" class="cursor-hover">Story</label>
                                    <select name="id_story" id="id_story" class="form-control cursor-hover">
                                        <option value="">-- Choice Story --</option>
                                        @foreach ($stories as $story)
                                            <option value="{{ $story->id_story }}">{{ $story->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="user" class="cursor-hover">User</label>
                                    <select name="id_user" id="id_user" class="form-control cursor-hover">
                                        <option value="">-- Choice User --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover" style="display: flex; ">
                                    <label for="rate" class="cursor-hover">Rate</label>
                                    <div class="rate" style="margin-bottom: -19px;">
                                        <input type="radio" id="star5" class="rate" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rate" value="2">
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                                {{-- <div class="mb-3 cursor-hover">
                                    <label for="comment" class="cursor-hover">Comment</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="comment" type="text"
                                        placeholder="Please Input Comment For Stories...." required>
                                </div> --}}
                                <button type="submit" name="submit" class="btn btn-primary cursor-pointer">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
