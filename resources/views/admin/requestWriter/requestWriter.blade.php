@extends('layouts.app')

@section('title', 'Data Request')

@section('content')
    <div class="container">
        <div class="container-box">
            <form action="/stories" method="get">
                <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                    class="form-control ds-input" id="search-input" />
            </form>

            <!-- Modal Delete All -->
            <div class="modal fade" id="DeleteModalAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                {{-- <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete All</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="modal-body">Are You Serious Delete All Data?</div>
                        <div class="modal-footer">
                            <form action="{{ route('deleteAllCompanies') }}" method="get">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- Table of data stories -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="20%">User</th>
                    <th scope="col" width="20%">Username</th>
                    <th scope="col" width="20%">Email</th>
                    <th scope="col" width="20%">Phone Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->full_name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone_number }}</td>

                        <td class="action-buttons">

                            @if ($item->status_approve == 1)
                                <a class="disable" href="#" data-toggle="modal"
                                    data-target="#DeleteModal{{ $item->id_request }}">
                                    Approve
                                </a>
                            @elseif($item->status_approve == 0)
                                <a class="btn btn-info" href="#" data-toggle="modal"
                                    data-target="#DeleteModal{{ $item->id_request }}">
                                    Approve
                                </a>
                            @endif
                            <div class="modal fade" id="DeleteModal{{ $item->id_request }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confrimation Request</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">X</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Do you has check before approve?</div>
                                        <div class="modal-footer">
                                            <form action="{{ route('ApprovalRequest', $item->id_request) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary" type="submit">Konfirmasi</button>
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
    </div>

@endsection
