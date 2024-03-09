@extends('layouts.app')
@section('title', 'Edit Faqs')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Faqs</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('updateFaqs', $faqs->id_faq) }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="container-inputDialog" id="dialogs-container">
                                    <div class="mb-3 cursor-hover">
                                        <label for="faq" class="cursor-hover">Faqs</label>
                                        <input class="form-control" id="exampleFormControlInput1" name="faq"
                                            type="text" placeholder="Please Input Faqs" value="{{ $faqs->faq }}"
                                            required>
                                    </div>

                                </div>
                                <div class="d-md-flex justify-content-ct">
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
