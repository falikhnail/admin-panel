@extends('backend.layouts.app')

@section('title')
    Tambah Report General
@endsection

@section('title_main')
    Tambah Report General
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item">Reports</li>
    <li class="breadcrumb-item">
        <a href="{{ route('backend.report_general') }}">General</a>
    </li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <?php $data = []; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-0">
                        Add Report General
                    </div>
                    <div class="card-subtitle">
                        Fill All Blank Field And Submit
                    </div>
                    <div class="row my-5">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <form action="{{ route('backend.save_general') }}" method="POST" class="needs-validation"
                                novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="user" name="user_id" required>
                                                <option value="" disabled selected>Pilih User</option>
                                                @foreach ($user as $u)
                                                    <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                                @endforeach
                                            </select>
                                            <label for="user">User</label>
                                            <div class="invalid-feedback">
                                                Please Select User
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="platform" name="platform"
                                                placeholder="Type Platform" required >
                                            <label for="platform">Platform</label>
                                            <div class="invalid-feedback">
                                                Please Fill Platform
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="artist" name="artist"
                                                placeholder="Type Artist" required>
                                            <label for="artist">Artist</label>
                                            <div class="invalid-feedback">
                                                Please Fill Artist
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="isrc" name="isrc"
                                                placeholder="Type ISRC" required>
                                            <label for="isrc">ISRC</label>
                                            <div class="invalid-feedback">
                                                Please Fill ISRC
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control number" id="upc" placeholder="Type UPC" name="upc" required>
                                            <label for="upc">UPC</label>
                                            <div class="invalid-feedback">
                                                Please Fill UPC
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control datepicker" id="reporting_period" name="reporting_period"
                                                placeholder="Masukkan Reporting Period" required>
                                            {{-- <label for="reporting_period">Reporting Period</label> --}}
                                            <div class="invalid-feedback">
                                                Please Fill Reporting Period
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="label_name" name="label_name"
                                                placeholder="Type Label Name" required>
                                            <label for="label_name">Label Name</label>
                                            <div class="invalid-feedback">
                                                Please Label Name
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="album" name="album"
                                                placeholder="Type Album" required>
                                            <label for="album">Album</label>
                                            <div class="invalid-feedback">
                                                Please Album
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Type Title" required>
                                            <label for="title">Title</label>
                                            <div class="invalid-feedback">
                                                Please Fill Title
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control number" id="revenue" name="revenue"
                                                placeholder="Type Revenue" required>
                                            <label for="revenue">Revenue</label>
                                            <div class="invalid-feedback">
                                                Please Fill Revenue
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider my-4"></div>
                                <div class="d-flex justify-content-center align-items-center mt-4">
                                    <button type="submit"
                                        class="btn-act btn-act-primary btn-act-xl text-center w-40">Simpan</button>
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
    <script type="text/javascript"></script>
@endpush
