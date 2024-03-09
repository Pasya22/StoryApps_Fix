@extends('layouts.app')

@section('title', 'Data Company')

@section('content')
    <div class="container">
        <div class="container-box">
            <form action="/stories" method="get">
                <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                    class="form-control ds-input" id="search-input" />
            </form>

            <div class="d-flex align-items-end">
                <a href="/admin/faqs/createFaqs" class="btn btn-success " style="margin-bottom: 5px;">
                    <i class="fa fa-plus" aria-hidden="true" style="margin-right:5px;"></i>Add Data Faqs
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
                    <th scope="col" width="20%">faqs</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $item)
                    <tr>
                        <td>{{ $item->faq }}</td>

                        <td style="display: flex; ">
                            <a href="/admin/faqs/edit-faqs/{{ $item->id_faq }}"
                                class="btn btn-warning mr-2">Edit</a>
                            <a class="btn btn-danger" href="#" data-toggle="modal"
                                data-target="#DeleteModal{{ $item->id_faq }}">
                                Delete
                            </a>
                            <!-- Modal Delete One -->
                            <div class="modal fade" id="DeleteModal{{ $item->id_faq }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('deleteContact', $item->id_faq) }}" method="GET">
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
