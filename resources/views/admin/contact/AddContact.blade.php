@extends('layouts.app')
@section('title', 'Add Contact')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Contact</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostContact') }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="container-inputDialog" id="dialogs-container">
                                    <div class="mb-3 cursor-hover">
                                        <label for="email_company" class="cursor-hover">Email Company</label>
                                        <input class="form-control" id="exampleFormControlInput1" name="email_company"
                                            type="email" placeholder="example@gmail.com" required>
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="phone_company" class="cursor-hover">Phone Number Company</label>
                                        <textarea class="form-control" id="exampleFormControlInput1" name="phone_company" placeholder="Please Input About Us...."
                                            required></textarea>
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="sosial_media" class="cursor-hover">Sosial Media</label>
                                        <input type="url" class="form-control" id="exampleFormControlInput1" name="sosial_media" placeholder="https://sosialmedia/your-account"
                                            required>
                                    </div>

                                </div>
                                <div class="d-md-flex justify-content-ct">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary ">Save</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
