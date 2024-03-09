@extends('layouts.app')

@section('title', 'Data Characters')

@section('content')
    <div class="container">
        <h1>Data Characters</h1>
        <div class="container-box">
            <form action="/stories" method="get">
                <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                    class="form-control ds-input" id="search-input" />
            </form>
            <!-- Table of data stories -->
            <a href="/admin/story/createCharacters" class="btn btn-success" style="margin-bottom: 5px;"><i
                    class="fa fa-plus" aria-hidden="true" style="margin-right:5px;"></i>Add Characters</a>

        </div>
        <!-- Search bar -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="20%">Story</th>
                    <th scope="col" width="20%">Chapters</th>
                    <th scope="col" width="20%">Characters</th>
                    <th scope="col" width="20%">Created At</th>
                    <th scope="col" width="20%">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $character)
                    <tr>
                        <td>{{ $character->title }}</td>
                        <td>{{ $character->chapter }}</td>
                        <td>{{ $character->character }}</td>
                        <td>{{ $character->created_at }}</td>
                        <td>{{ $character->updated_at }}</td>

                        <td style="display: flex; ">

                            <a href="/admin/story/edit-characters/{{ $character->id_character }}"
                                class="btn btn-warning mr-2">Edit</a>
                            <a class="btn btn-danger" href="#" data-toggle="modal"
                                data-target="#DeleteModal{{ $character->id_character }}">
                                Delete
                            </a>
                            <div class="modal fade" id="DeleteModal{{ $character->id_character }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">X</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Are You Seroius Delete This Data?</div>
                                        <div class="modal-footer">
                                            <form action="{{ route('deleteCharacter', $character->id_character) }}"
                                                method="GET">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagnation">
            {{ $data->links() }}
        </div>
    </div>
@endsection
