@extends('backend.layouts.app')

@section('title')
    Report Channel
@endsection

@section('title_main')
    Report Channel
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item">Reports</li>
    <li class="breadcrumb-item active">Channel</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Report Channel
                    </div>
                    <div class="row mb-xl-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="#reportDate" class="form-label">Report Date</label>
                                <input type="text" class="form-control datepicker" id="reportDate"
                                    name="report-date" placeholder="Input Report Date">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="divider mb-3"></div>
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
                            </div>
                        </div>
                    </div> --}}
                    <div class="divider mb-3"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Label Name</th>
                                        <th>Channel Name</th>
                                        <th>Revenue</th>
                                        <th>Report Date</th>
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
                url: '{{ route('backend.channel_list') }}',
                data: function(d) {
                    d.platform = $('#platform').val();
                    d.reportDate = $('#reportDate').val();

                    console.log('params', d);
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                {
                    data: 'label_name',
                    name: 'label_name'
                },
                {
                    data: 'channel_name',
                    name: 'channel_name',
                },
                {
                    data: 'revenue',
                    name: 'revenue',
                    className: "text-center"
                },
                {
                    data: 'report_date',
                    name: 'report_date',
                    className: "text-center"
                },
            ],
            ordering: false,
            lengthChange: false,
            // oLanguage: {
            //     "sSearch": "Cari Nama Alumni"
            // }
        });

        $('#reportDate').change(function() {
            table.draw();
        });

        $("#btn-refresh").click(() => {
            table.draw();
        });

        $("#btn-upload").click((event) => {
            event.preventDefault();
            $('#m_upload_general').modal('show');
        });
    </script>
@endpush
