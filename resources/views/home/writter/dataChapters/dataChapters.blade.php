@extends('layouts.writer')
@section('title', 'Data Chapters')
@section('content')
    <h3>List Chapters</h3>
    <button type="submit" class="add">
        <a href="{{ route('addChaptersPage') }}">+ Add New Chapter</a>
    </button>
    <div class="page">
        <table>
            <thead>
                <tr>
                    <th>Chapters</th>
                    <th>Stories</th>
                    <th>Created At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $chapter)
                    <tr>
                        <td>
                            <div class="text">{{ $chapter->chapter }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $chapter->title }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $chapter->created_at }}</div>
                        </td>
                        <td class="cover">
                            <div class="aksi">

                                <a href="/writter/edit-chapters/{{ $chapter->id_chapter }}"
                                    class=" btn-warning mr-2">Edit</a>
                                <a href="#" class=" btn-danger delete-btn"
                                    data-id="{{ $chapter->id_chapter }}">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
