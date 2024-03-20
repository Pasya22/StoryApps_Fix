@extends('layouts.writer')
@section('title', 'Data Dialogs')
@section('content')
    <h3>List Characters</h3>
    <button type="submit" class="add">
        <a href="{{ route('addDialogsPage') }}">+ Add New Characters</a>
    </button>
    <div class="page">
        <table>
            <thead>
                <tr>
                    <th>Chapter's</th>
                    <th>Stories</th>
                    <th>Character's</th>
                    <th>Dialog</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $items)
                    <tr>
                        <td>
                            <div class="text">{{ $items->chapter }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $items->title }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $items->character }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $items->dialog }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $items->created_at }}</div>
                        </td>
                        <td>
                            <div class="text">{{ $items->updated_at }}</div>
                        </td>
                        <td class="cover">
                            <div class="aksi">

                                <a href="/writter/Edit-dialogs/{{ $items->id_dialog }}"
                                    class=" btn-warning mr-2">Edit</a>
                                <a href="#" class=" btn-danger delete-btn"
                                    data-id="{{ $items->id_dialog }}">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
