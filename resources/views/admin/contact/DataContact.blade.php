@extends('layouts.app')

@section('title', 'Data Contact')

@section('content')
    <div class="container">
        <div class="container-box">
            <form action="/stories" method="get">
                <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                    class="form-control ds-input" id="search-input" />
            </form>

            <div class="d-flex align-items-end">
                <a href="/admin/contact/createContact" class="btn btn-success " style="margin-bottom: 5px;">
                    <i class="fa fa-plus" aria-hidden="true" style="margin-right:5px;"></i>Add Data Contact
                </a>
                {{-- &nbsp;
                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#DeleteModalAll"
                    style="margin-bottom: 5px;">
                    Delete All
                </a> --}}
            </div>

            <!-- Modal Delete All -->
            <div class="modal fade" id="DeleteModalAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
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
                </div>
            </div>
        </div>
        <!-- Table of data stories -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="20%">Email</th>
                    <th scope="col" width="20%">Phone Number Company</th>
                    <th scope="col" width="20%">Social Media</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contact as $item)
                    <tr>
                        <td>{{ $item->email_company }}</td>
                        <td>{{ $item->phone_company }}</td>
                        <td>{{ $item->sosial_media }}</td>

                        <td style="display: flex; ">
                            <a href="/admin/contact/edit-contact/{{ $item->id_contact }}"
                                class="btn btn-warning mr-2">Edit</a>
                            <a class="btn btn-danger" href="#" data-toggle="modal"
                                data-target="#DeleteModal{{ $item->id_contact }}">
                                Delete
                            </a>
                            <!-- Modal Delete One -->
                            <div class="modal fade" id="DeleteModal{{ $item->id_contact }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">X</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Are You Serious Delete This Data?</div>
                                        <div class="modal-footer">
                                            <form action="{{ route('deleteContact', $item->id_contact) }}" method="GET">
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
    </div>

@endsection
