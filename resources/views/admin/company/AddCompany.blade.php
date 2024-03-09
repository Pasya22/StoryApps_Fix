@extends('layouts.app')
@section('title', 'Add Company')

@section('content')
    <div class="container">
        <div id="default">
            <div class="card mb-4">
                <div class="card-header cursor-hover">Add Company</div>
                <div class="card-body cursor-hover">
                    <div class="sbp-preview cursor-hover">
                        <div class="sbp-preview-content cursor-hover">
                            <form action="{{ route('PostCompany') }}" method="post" class="cursor-hover">
                                @csrf
                                <div class="container-inputDialog" id="dialogs-container"> 
                                    <div class="mb-3 cursor-hover">
                                        <label for="company_name" class="cursor-hover">Company Name</label>
                                        <input class="form-control" id="exampleFormControlInput1" name="company_name"
                                            type="text" placeholder="Please Input Company Name...." required>
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="about_us" class="cursor-hover">About Us</label>
                                        <textarea class="form-control" id="exampleFormControlInput1" name="about_us" placeholder="Please Input About Us...."
                                            required></textarea>
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="term" class="cursor-hover">Term</label>
                                        <textarea class="form-control" id="exampleFormControlInput1" name="term" placeholder="Please Input Term...."
                                            required></textarea>
                                    </div>
                                    <div class="mb-3 cursor-hover">
                                        <label for="privacy" class="cursor-hover">Privacy</label>
                                        <textarea class="form-control" id="exampleFormControlInput1" name="privacy" placeholder="Please Input Privacy...."
                                            required></textarea>
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
