@extends('backend.layouts.app')

@section('title')
    Report Platform
@endsection

@section('title_main')
    Report Platform
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item">Reports</li>
    <li class="breadcrumb-item active">Platform</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Report Platform
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
                    <div class="divider mb-3"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Platform</th>
                                        <th>Artist</th>
                                        <th>Revenue</th>
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
                url: '{{ route('backend.platform_list') }}',
                data: function(d) {
                    d.platform = $('#platform').val();
                    d.reportDate = $('#reportDate').val();
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
                    data: 'platform',
                    name: 'platform'
                },
                {
                    data: 'artist',
                    name: 'artist',
                },
                {
                    data: 'revenue',
                    name: 'revenue',
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
