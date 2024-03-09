@extends('layouts.app')
@section('title', 'Edit Contact')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Edit Contact</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('updateContact', $contact->id_contact) }}" method="post"
                                class="cursor-hover">
                                @csrf
                                <div class="container-inputDialog" id="dialogs-container">
                                    <div class="mb-3 cursor-hover">
                                        <label for="email_company" class="cursor-hover">Email Company</label>
                                        <input class="form-control" id="exampleFormControlInput1" name="email_company"
                                            type="email" placeholder="example@gmail.com"
                                            value="{{ $contact->email_company }}" required>
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="phone_company" class="cursor-hover">Phone Number Company</label>
                                        <input class="form-control" id="exampleFormControlInput1" name="phone_company"
                                            placeholder="Please Input About Us...." value="{{ $contact->phone_company }}" required> 
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="sosial_media" class="cursor-hover">Sosial Media</label>
                                        <input type="url" class="form-control" id="exampleFormControlInput1"
                                            name="sosial_media" placeholder="https://sosialmedia/your-account"
                                            value="{{ $contact->sosial_media }}" required>
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
