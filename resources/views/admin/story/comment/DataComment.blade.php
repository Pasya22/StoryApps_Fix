@extends('layouts.app')

@section('title', 'Data Comment')

@section('content')
    <div class="container">
        <h1>Data Comment</h1>
        <div class="container-box">
            <form action="/stories" method="get">
                <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                    class="form-control ds-input" id="search-input" />
            </form>
            <!-- Table of data stories -->
            <a href="{{route('createComment')}}" class="btn btn-success" style="margin-bottom: 5px;"><i class="fa fa-plus"
                    aria-hidden="true" style="margin-right:5px;"></i>Add Comment</a>

        </div>
        <!-- Search bar -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="20%">User</th>
                    <th scope="col" width="20%">Stories</th>
                    <th scope="col" width="20%">Comment</th>
                    <th scope="col" width="20%">Created At</th>
                    <th scope="col" width="30%">Update At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->full_name }}</td>
                        <td>{{ $comment->title }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>{{ $comment->updated_at }}</td>

                        <td style="display: flex; ">

                            <a href="/admin/story/comment/edit-comment/{{ $comment->id_comment }}"
                                class="btn btn-warning mr-2">Edit</a>
                            <a class="btn btn-danger" href="#" data-toggle="modal"
                                data-target="#DeleteModal{{ $comment->id_comment }}">
                                Delete
                            </a>
                            <div class="modal fade" id="DeleteModal{{ $comment->id_comment }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('deleteComment', $comment->id_comment) }}"
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
            {{ $comments->links() }}
        </div>
    </div>
@endsection
