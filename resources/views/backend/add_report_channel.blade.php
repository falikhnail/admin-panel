@extends('backend.layouts.app')

@section('title')
    Tambah Report Channel
@endsection

@section('title_main')
    Tambah Report Channel
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item">Reports</li>
    <li class="breadcrumb-item">
        <a href="{{ route('backend.report_channel') }}">Channel</a>
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
                        Add Report Channel
                    </div>
                    <div class="card-subtitle">
                        Fill All Blank Field And Submit
                    </div>
                    <div class="row my-5">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <form action="{{ route('backend.save_channel') }}" method="POST" class="needs-validation"
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
                                            <input type="text" class="form-control" id="label_name" name="label_name"
                                                placeholder="Type Label Name" required>
                                            <label for="label_name">Label Name</label>
                                            <div class="invalid-feedback">
                                                Please Fill Label Name
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="channel_name" name="channel_name"
                                                placeholder="Type Channel Name" required>
                                            <label for="channel_name">Channel Name</label>
                                            <div class="invalid-feedback">
                                                Please Fill Channel Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="channel_id" name="channel_id"
                                                placeholder="Type Channel ID" required>
                                            <label for="channel_id">Channel ID</label>
                                            <div class="invalid-feedback">
                                                Please Fill Channel ID
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control datepicker" id="reporting_period"
                                                name="reporting_period" placeholder="Masukkan Reporting Period" required>
                                            <div class="invalid-feedback">
                                                Please Fill Reporting Period
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
