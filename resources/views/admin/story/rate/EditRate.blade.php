@extends('layouts.app')
@section('title', 'Edit Rate')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Edit Rate Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('updateRate', $rate->id_rate) }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="mb-3 cursor-hover">
                                    <label for="chapter" class="cursor-hover">Story</label>
                                    <select name="id_story" id="id_story" class="form-control cursor-hover">
                                        <option value="">-- Choice Story --</option>
                                        @foreach ($stories as $story)
                                            <option value="{{ $story->id_story }}"
                                                {{ $story->id_story == $rate->id_story ? 'selected' : '' }}>
                                                {{ $story->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="chapter" class="cursor-hover">User</label>
                                    <select name="id_user" id="id_user" class="form-control cursor-hover">
                                        <option value="">-- Choice User --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == $rate->id_user ? 'selected' : '' }}>
                                                {{ $user->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 cursor-hover" style="display: flex; ">
                                    <label for="rate" class="cursor-hover">Rate</label>
                                    <div class="rate" styeditstle="margin-bottom: -19px;">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" class="rate" name="rate"
                                                value="{{ $i }}" {{ $i == $rate->rate ? 'checked' : '' }} />
                                            <label for="star{{ $i }}"
                                                title="{{ $i }} stars">{{ $i }} stars</label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mb-3 cursor-hover">
                                    <label for="created_at" class="cursor-hover">Created At</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="created_at"
                                        type="datetime-local" value="{{ $rate->created_at }}">
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
