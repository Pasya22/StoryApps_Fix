@extends('layouts.app')

@section('title', 'Data Categories')

@section('content')
    <div class="container">

        <h1>Data Categories</h1>

        <div class="container-box">
            <form action="/stories" method="get">
                <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                    class="form-control ds-input" id="search-input" />
            </form>
            @if (session('AddCategories'))
                {{ session('AddCategories') }}
            @elseif (session('error'))
                failed
            @endif
            @if (session('updateCategories'))
                {{ session('updateCategories') }}
            @elseif (session('error'))
                failed
            @endif
            <!-- Table of data stories -->
            <div class="d-flex align-items-end">
                <a href="{{route('createCategories')}}" class="btn btn-success " style="margin-bottom: 5px;"><i
                        class="fa fa-plus" aria-hidden="true" style="margin-right:5px;"></i>Add Data Categories</a>

            </div>


        </div>
        <!-- Search bar -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="80%">Categories</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $item->category }}</td>

                        <td style="display: flex; ">

                            <a href="/admin/categories/edit-categories/{{ $item->id_category }}"
                                class="btn btn-warning mr-2">Edit</a>
                            <a class="btn btn-danger" href="#" data-toggle="modal"
                                data-target="#DeleteModal{{ $item->id_category }}">
                                Delete
                            </a>
                            <div class="modal fade" id="DeleteModal{{ $item->id_category }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('deleteCategories', $item->id_category) }}" method="GET">
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

        {{ $categories->links() }}

    </div>
@endsection
