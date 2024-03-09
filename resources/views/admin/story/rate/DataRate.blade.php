@extends('layouts.app')

@section('title', 'Data Rate')

@section('content')
    {{-- <div class="container"> --}}
    <h1>Data Rate</h1>
    <div class="container-box">
        <form action="/stories" method="get">
            <input type="search" name="search" placeholder="Search stories..." value="{{ $search ?? '' }}"
                class="form-control ds-input" id="search-input" />
        </form>
        <!-- Table of data stories -->
        <a href="/admin/story/createRate" class="btn btn-success" style="margin-bottom: 5px;"><i class="fa fa-plus"
                aria-hidden="true" style="margin-right:5px;"></i>Add Rate</a>

    </div>
    <!-- Search bar -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" width="15%">Story</th>
                <th scope="col" width="12%">User</th>
                <th scope="col" width="12%">Rate</th>
                {{-- <th scope="col" width="20%">Comment</th> --}}
                <th scope="col" width="15%">Created At</th>
                <th scope="col" width="15%">Updated</th>
                <th scope="col" width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rates as $rate)
                <tr>
                    <td>{{ $rate->title ?? '' }}</td>
                    <td>{{ $rate->username ?? '' }}</td>
                    <td>
                        @if ($rate->rate >= 1 && $rate->rate <= 5)
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rate->rate)
                                    {{-- <i class="fa fa-star"></i> --}}

                                    <span class="fa fa-star checked" style="cursor: pointer;"
                                        onclick="rateStory({{ $rate->id_rate }}, {{ $i }})"></span>
                                @else
                                    <span class="fa fa-star" style="cursor: pointer;"
                                        onclick="rateStory({{ $rate->id_rate }}, {{ $i }})"></span>
                                @endif
                            @endfor
                        @else
                            Invalid Rate
                        @endif
                    </td>

                    {{-- <td>{{ $rate->comment }}</td> --}}
                    <td>{{ $rate->created_at }}</td>
                    <td>{{ $rate->updated_at }}</td>

                    <td style="display: flex; ">

                        <a href="/admin/story/edit-rate/{{ $rate->id_rate }}" class="btn btn-warning mr-2">Edit</a>
                        <a class="btn btn-danger" href="#" data-toggle="modal"
                            data-target="#DeleteModal{{ $rate->id_rate }}">
                            Delete
                        </a>
                        <div class="modal fade" id="DeleteModal{{ $rate->id_rate }}" tabindex="-1" role="dialog"
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
                                        <form action="{{ route('deleteRate', $rate->id_rate) }}" method="GET">
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
        {{ $rates->links() }}

    </div>
    {{-- </div> --}}
@endsection
