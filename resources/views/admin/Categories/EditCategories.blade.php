@extends('layouts.app')
@section('title', 'Edit Categories')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Edit Categories</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('updateCategories', $categories->id_category) }}" method="post"
                                class="cursor-hover">
                                @csrf
                                <div class="container-inputDialog" id="dialogs-container">

                                    <div class="mb-3 cursor-hover">
                                        <label for="category" class="cursor-hover">Category</label>
                                        <input class="form-control" id="exampleFormControlInput1" name="category"
                                            type="text" placeholder="Please Input Chpater Stories...." required
                                            value="{{ $categories->category }}">
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="created_at" class="cursor-hover">Created At</label>
                                        <input class="form-control" id="exampleFormControlInput1" name="created_at"
                                            type="text" placeholder="Please Input Chpater Stories...." required
                                            value="{{ $categories->created_at }}">
                                    </div>

                                </div>
                                <div class="d-md-flex justify-content-ct">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary d-grid gap-2 col-6 mx-auto">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
