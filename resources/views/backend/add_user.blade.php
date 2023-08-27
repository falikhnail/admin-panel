@extends('backend.layouts.app')

@section('title')
    Add User
@endsection

@section('title_main')
    Add User
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item">
        <a href="{{ route('backend.users') }}">User</a>
    </li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    <?php $data = []; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-0">
                        Add User
                    </div>
                    <div class="card-subtitle">
                        Fill All Blank Field And Submit
                    </div>
                    <div class="row my-5">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <form action="{{ route('backend.save_user') }}" method="POST" class="needs-validation"
                                novalidate>
                                @csrf
                                <div class="row row-cols-1">
                                    <div class="col mb-3">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Type Name" required>
                                            <div class="invalid-feedback">
                                                Please Fill Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <div class="form-group">
                                            <label for="user_type" class="form-label">User Type</label>
                                            <select class="form-control" id="user_type" name="user_type" required>
                                                <option selected disabled value="">Select User Type</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col  mb-3">
                                        <div class="form-group">
                                            <label for="artist" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Type Email" required>
                                            <div class="invalid-feedback">
                                                Please Fill Email
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <div class="form-group">
                                            <label for="passwordUser" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="passwordUser" name="password_user"
                                                    placeholder="Type Password" required>
                                                <button type="button" class="bi bi-eye-fill input-group-text"
                                                    id="btn-show-pw" data-show="0"></button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Fill Password
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider my-4"></div>
                                <div class="d-flex justify-content-center align-items-center mt-4">
                                    <button type="submit"
                                        class="btn-act btn-act-primary btn-act-xl text-center w-40">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-show-pw").on('click', (event) => {
                const isShow = event.target.getAttribute('data-show') == 1
                if (isShow) {
                    event.target.setAttribute('data-show', 0)
                    $("#passwordUser").get(0).type = 'password'

                    event.target.classList.remove('bi-eye-slash-fill')
                    event.target.classList.add('bi-eye-fill')
                } else {
                    event.target.setAttribute('data-show', 1)
                    $("#passwordUser").get(0).type = 'text'

                    event.target.classList.remove('bi-eye-fill')
                    event.target.classList.add('bi-eye-slash-fill')
                }

            })
        })
    </script>
@endpush
