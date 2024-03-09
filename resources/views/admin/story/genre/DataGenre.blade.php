@extends('layouts.app')

@section('title', 'Data Genre')

@section('content')
    <div class="container">
        <h1>Data Genre</h1>
        <div class="container-box">
            <form action="/stories" method="get">
                <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                    class="form-control ds-input" id="search-input" />
            </form>
            <!-- Table of data stories -->
            <a href="/admin/story/createGenre" class="btn btn-success" style="margin-bottom: 5px;"><i class="fa fa-plus"
                    aria-hidden="true" style="margin-right:5px;"></i>Add Genre</a>

        </div>
        <!-- Search bar -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="20%">Genre</th>
                    <th scope="col" width="20%">Created At</th>
                    <th scope="col" width="30%">Update At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genres as $genre)
                    <tr>
                        <td>{{ $genre->genre }}</td>
                        <td>{{ $genre->created_at }}</td>
                        <td>{{ $genre->updated_at }}</td>

                        <td style="display: flex; ">

                            <a href="/admin/story/edit-genre/{{ $genre->id_genre }}" class="btn btn-warning mr-2">Edit</a>
                            <a class="btn btn-danger" href="#" data-toggle="modal"
                                data-target="#DeleteModal{{ $genre->id_genre }}">
                                Delete
                            </a>
                            <div class="modal fade" id="DeleteModal{{ $genre->id_genre }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('deleteGenre', $genre->id_genre) }}" method="GET">
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
            {{ $genres->links() }}
        </div>
    </div>
@endsection
