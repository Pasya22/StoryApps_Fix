@extends('layouts.app')

@section('title', 'Data User')

@section('content')
    <div class="container">
        <h1> Data User</h1>
        <div class="d-md-flex justify-content-md-end">
            <a href="/admin/user/createUser" class="btn btn-success" style="margin-bottom: 5px;"><i class="fa fa-plus"
                    aria-hidden="true" style="margin-right:5px;"></i>Add New User
            </a>
        </div>

        <hr class="sidebar-divider">

        <!-- Heading -->

        <div class="row">

            @foreach ($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($user->image_user == 'default.png')
                            <img src="{{ asset('/img/' . $user->image_user) }}" class="card-img-top" alt="User Image"
                                height="300px">
                        @elseif ($user->image_user)
                            <img src="/upload/{{ $user->image_user }}" class="card-img-top" alt="User Image" height="300px">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $user->full_name }}</h5>
                            <p class="card-text">{{ $user->email }}</p>
                            <span>{{ $user->role }}</span>
                            <div class="d-md-flex justify-content-md-end">
                                <a href="/admin/user/detail-user/{{ $user->id }}"
                                    class="btn
                                    btn-info">Detail</a>
                                &nbsp;
                                <a class="btn btn-danger" href="#" data-toggle="modal"
                                    data-target="#DeleteModal{{ $user->id }}">
                                    Delete
                                </a>
                                <div class="modal fade" id="DeleteModal{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">X</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Are You Seroius Delete This Data?</div>
                                            <div class="modal-footer">
                                                <form action="{{ route('deleteUser', $user->id) }}" method="GET">
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

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="paganation">
            {{ $users->links() }}
        </div>
    </div>

@endsection
