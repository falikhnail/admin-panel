@extends('backend.layouts.app')

@section('title')
    Report General
@endsection

@section('title_main')
    Report General
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item">Reports</li>
    <li class="breadcrumb-item active">General</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Report General
                    </div>
                    <div class="row mb-xl-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="#platform" class="form-label">Platform</label>
                                <select class="form-control" id="platform">
                                    <option value="">Semua Platform</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="#accounting-period" class="form-label">Accounting Period</label>
                                <select class="form-control" id="accounting-period">
                                    <option value="">Semua Tanggal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">

                        </div>
                    </div>
                    <div class="divider mb-3"></div>
                    <div class="row my-5">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="float-start">
                                @if ($userSession->tipe_user === 'admin')
                                    <a href="{{ route('backend.report_general_add') }}"
                                        class="btn-act btn-act-primary btn-act-md">
                                        <i class="bi bi-plus-circle"></i> Tambah
                                    </a>
                                    <button class="btn-act btn-act-primary btn-act-md" id="btn-upload">
                                        <i class="bi bi-arrow-up-circle"></i> Upload
                                    </button>
                                    @include('backend.includes.modal_upload_general')
                                @endif
                                <a class="btn-act btn-act-primary btn-act-md" href="{{ route('backend.export_general') }}"
                                    target="_blank">
                                    <i class="bi bi-arrow-down-circle"></i> Download
                                </a>
                                {{-- <button type="button" class="btn-act btn-act-primary btn-act-md" id="btn-refresh">
                                    <i class="bi bi-plus-circle"></i> Refresh
                                </button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="divider mb-3"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Noid</th>
                                        <th>Reporting Period</th>
                                        <th>Platforms</th>
                                        <th>Label Name</th>
                                        <th>Artist</th>
                                        <th>Album</th>
                                        <th>Title</th>
                                        <th>ISRC</th>
                                        <th>UPC</th>
                                        <th>Revenue</th>
                                        <!-- 10 rows -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript">
        let table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            responsive: true,
            "searching": false,
            responsive: true,
            "autoWidth": false,
            'language': {
                "loadingRecords": "&nbsp;",
                "processing": "Loading Data ..."
            },
            ajax: {
                url: '{{ route('backend.general_list') }}',
                data: function(d) {
                    d.platform = $('#platform').val();
                    d.accountringPeriod = $('#accountringPeriod').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'reporting_period',
                    name: 'reporting_period'
                },
                {
                    data: 'platform',
                    name: 'platform',
                },
                {
                    data: 'label_name',
                    name: 'label_name'
                },
                {
                    data: 'artist',
                    name: 'artist',
                },
                {
                    data: 'album',
                    name: 'album',
                },
                {
                    data: 'title',
                    name: 'title',
                },
                {
                    data: 'isrc',
                    name: 'isrc',
                },
                {
                    data: 'upc',
                    name: 'upc',
                },
                {
                    data: 'revenue',
                    name: 'revenue',
                },
            ],
            ordering: false,
            lengthChange: false,
            // oLanguage: {
            //     "sSearch": "Cari Nama Alumni"
            // }
        });

        $('#platform').change(function() {
            table.draw();
        });

        $('#accounting-period').change(function() {
            table.draw();
        });

        $("#btn-refresh").click(() => {
            table.draw();
        });

        $("#btn-upload").click((event) => {
            event.preventDefault();
            $('#m_upload_general').modal('show');
        });

        $("#btn-upload-general").click((event) => {
            event.preventDefault();
            document.getElementById('form-upload-general').submit();
        });
    </script>
@endpush
