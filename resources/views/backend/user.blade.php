@extends('backend.layouts.app')

@section('title')
    Users
@endsection

@section('title_main')
    Users
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Users
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Tanggal Daftar</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody class="text-center">
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
                url: '{{ route('backend.users_list') }}',
                data: function(d) {

                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ],
            ordering: false,
            lengthChange: false,
        });
    </script>
@endpush
