@extends('layouts.app')
@section('title', 'Add Genre')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Genre Story</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostGenre') }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="mb-3 cursor-hover">
                                    <label for="title" class="cursor-hover">Genre</label>
                                    <input class="form-control" id="exampleFormControlInput1" name="genre" type="text"
                                        placeholder="Comedy,Action,Love,Horor,Drama,etc.." required>
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
