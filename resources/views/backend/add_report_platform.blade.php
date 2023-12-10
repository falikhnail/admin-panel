@extends('backend.layouts.app')

@section('title')
    Tambah Report Platform
@endsection

@section('title_main')
    Tambah Report Platform
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item">Reports</li>
    <li class="breadcrumb-item">
        <a href="{{ route('backend.report_platform') }}">Platform</a>
    </li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@push('after-styles')
    .gj-datepicker{
    height: 20px !important;
    }
@endpush

@section('content')
    <?php $data = []; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-0">
                        Add Report Platform
                    </div>
                    <div class="card-subtitle">
                        Fill All Blank Field And Submit
                    </div>
                    <div class="row my-5">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <form action="{{ route('backend.save_platform') }}" method="POST" class="needs-validation"
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
                                            <select class="form-control" id="platform" name="platform">
                                                <option disabled selected value="">Select Platform</option>
                                                @foreach ($platforms as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control datepicker" id="reporting_period"
                                                name="reporting_period" placeholder="Masukkan Reporting Period" required>
                                            <div class="invalid-feedback">
                                                Please Fill Reporting Period
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control number" id="revenue"
                                                name="revenue" placeholder="Type Revenue" required>
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
            $("#reporting_period").css('padding', '15px')
        })
    </script>
@endpush
