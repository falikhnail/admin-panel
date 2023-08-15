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
                        <div class="position-relative">
                            <img src="{{ asset(!empty($userData->image_path) ? $userData->image_path : 'img/user.png') }}"
                                alt="" class="rounded-circle" width="100" height="100" id="img-profile">
                            <a href="javascript:void(0)" class="position-absolute bottom-0 right-2"
                                onclick="pickImg(event)">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <input type="file" accept="image/*" id="img-profile-pick" style="display: none;"
                                onchange="onChangeImgProfile(event)">
                        </div>
                        <h2 class="mt-3">{{ $userData->nama }}</h2>
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
                                    <input type="none" name="userId" value="{{ $userData->users_id }}" hidden />
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
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Change
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="password" type="password" class="form-control" id="password" value="{{ $userData->password }}">
                                                <button type="button" class="bi bi-eye-fill input-group-text"
                                                    id="btn-show-pw" data-show="0"></button>
                                            </div>
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
                                    <input type="none" name="userId" value="{{ $userData->users_id }}" hidden />
                                    <div class="row mb-3">
                                        <label for="client_name" class="col-md-4 col-lg-3 col-form-label">Client
                                            Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="client_name" type="text" class="form-control"
                                                id="client_name" value="{{ $userData->nama }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="bank_name" class="col-md-4 col-lg-3 col-form-label">Bank Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="bank_name" type="text" class="form-control" id="bank_name"
                                                value="{{ $userData->bank_name }}">
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
    <script>
        $(document).ready(function() {
            $("#btn-show-pw").on('click', (event) => {
                const isShow = event.target.getAttribute('data-show') == 1
                if (isShow) {
                    event.target.setAttribute('data-show', 0)
                    $("#password").get(0).type = 'password'

                    event.target.classList.remove('bi-eye-slash-fill')
                    event.target.classList.add('bi-eye-fill')
                } else {
                    event.target.setAttribute('data-show', 1)
                    $("#password").get(0).type = 'text'

                    event.target.classList.remove('bi-eye-fill')
                    event.target.classList.add('bi-eye-slash-fill')
                }

            })
        })

        const getFile = (id) => {
            return $('#' + id + '').val() ? $('#' + id + '').get(0).files[0] : null;
        };

        function pickImg(event) {
            event.preventDefault();
            $("#img-profile-pick").trigger('click')
        }

        function onChangeImgProfile(event) {
            var selectedFile = event.target.files[0];
            var reader = new FileReader();

            var imgtag = document.getElementById("img-profile");
            imgtag.title = selectedFile.name;

            reader.onload = function(event) {
                imgtag.src = event.target.result;
            };

            reader.readAsDataURL(selectedFile);

            if (selectedFile) {
                savePhotoProfile()
            }
        }

        function savePhotoProfile() {
            if (!getFile('img-profile-pick')) {
                Swal.fire(
                    'Photo Empty',
                    'Select Image to update photo',
                    'warning'
                )
                return
            }

            let formData = new FormData()
            formData.append('userId', "{{ request()->route('id') }}")
            formData.append('photo', getFile('img-profile-pick'))

            $.ajax({
                type: 'POST',
                url: "{{ route('backend.save_photo_profile') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    Swal.fire(
                        'Success Update',
                        'Profile Picture Has Been Updated',
                        'success'
                    )
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
@endpush
