@extends('layouts.writer')
@section('title', 'Data Characters')
@section('content')
    <h3>List Characters</h3>
    <button type="submit" class="add">
        <a href="{{ route('addCharactersPage') }}">+ Add New Characters</a>
    </button>
    <div class="page">
        <table>
            <thead>
                <tr>
                    <th>Characters</th>
                    <th>Chapters</th>
                    <th>Stories</th>
                    <th>Created At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $items)
                    <tr>
                        <td>
                            <div class="text">{{ $items->character }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $items->chapter }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $items->title }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $items->created_at }}</div>
                        </td>
                        <td class="cover">
                            <div class="aksi">

                                <a href="/writter/Edit-character/{{ $items->id_character }}"
                                    class=" btn-warning mr-2">Edit</a>
                                <a href="#" class=" btn-danger delete-btn"
                                    data-id="{{ $items->id_character }}">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
