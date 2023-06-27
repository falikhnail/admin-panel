@extends('backend.layouts.app')

@section('title')
    Users Profile
@endsection

@section('title_main')
    Users Profile
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item active bg-transparent">Users Profile</li>
@endsection

@section('content')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2>{{ $userData->nama }}</h2>
                        <h3>{{ $userData->email }}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bank-account">Bank
                                    Account</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade profile-edit pt-3 show active bg-white" id="profile-edit">
                                <form action="{{ route('backend.save_profile') }}" method="POST">
                                    <input type="none" name="userId" value="{{ $userData->users_id }}" hidden/>
                                    <div class="row mb-3">
                                        <label for="nama" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text" class="form-control" id="nama"
                                                value="{{ $userData->nama }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text" class="form-control" id="email"
                                                value="{{ $userData->email }}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn-act btn-act-primary btn-act-md">Edit
                                            Profile</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane profile-edit fade pt-3 bg-white" id="bank-account">
                                <form action="{{ route('backend.save_bank_account') }}" method="POST">
                                    <input type="none" name="userId" value="{{ $userData->users_id }}" hidden/>
                                    <div class="row mb-3">
                                        <label for="client_name" class="col-md-4 col-lg-3 col-form-label">Client
                                            Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="client_name" type="text" class="form-control" id="client_name" value="{{ $userData->nama }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="bank_name" class="col-md-4 col-lg-3 col-form-label">Bank Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="bank_name" type="text" class="form-control" id="bank_name" value="{{ $userData->bank_name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="account_number" class="col-md-4 col-lg-3 col-form-label">Account
                                            Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="account_number" type="text" class="form-control number"
                                                id="account_number" value="{{ $userData->account_number }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="account_name" class="col-md-4 col-lg-3 col-form-label">Name On
                                            Account</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="account_name" type="text" class="form-control"
                                                id="account_name" value="{{ $userData->account_name }}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn-act btn-act-primary btn-act-md">Edit Bank
                                            Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('after-scripts')
@endpush
