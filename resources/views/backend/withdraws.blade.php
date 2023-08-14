@extends('backend.layouts.app')

@section('title')
    Withdraws
@endsection

@section('title_main')
    Withdraws
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item active">Withdraws</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Withdraws
                    </div>
                    <div class="divider mb-3"></div>
                    @if ($userSession->tipe_user === 'user')
                        <div class="row">
                            <div class="col">
                                <h4 class="c-act-primary">Balance</h4>
                                <span class="badge bg-act-primary p-2">{{ $balance }}</span>
                            </div>
                            <span class="text-danger mt-3 f-15">Minimal Withdraws $30.00</h4>
                        </div>
                        <div class="divider mb-3"></div>
                    @endif
                    <div class="row my-5">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="float-start">
                                @if ($userSession->tipe_user === 'user')
                                    <button type="button" class="btn-act btn-act-primary btn-act-md" id="btn-wd">
                                        <i class="bi bi-envelope-paper"></i> Withdraws
                                    </button>
                                    <button type="button" class="btn-act btn-act-primary btn-act-md" data-bs-toggle="modal"
                                        data-bs-target="#m_bank_account">
                                        <i class="bi bi-newspaper"></i> Bank Account
                                    </button>
                                    @include('backend.includes.modal_bank_account')
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        @if ($userSession->tipe_user === 'admin')
                                            <th>User</th>
                                        @endif
                                        <th>Amount</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="tbody-datatable">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.includes.modal_withdraws')
@endsection

@push('after-scripts')
    <script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript">
        const tipeUser = '{{ $userSession->tipe_user }}';
        const table = $('#datatable').DataTable({
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
                url: '{{ route('backend.withdraws_list') }}',
                data: function(d) {

                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                @if ($userSession->tipe_user === 'admin')
                    {
                        data: 'user',
                        name: 'user'
                    },
                @endif {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'request_date',
                    name: 'request_date',
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ],
            ordering: false,
            lengthChange: false,
            // oLanguage: {
            //     "sSearch": "Cari Nama Alumni"
            // }
        });

        $('#btn-wd').click(() => {
            $('#userId').val('{{ $userSession->id }}');
            $('#m_withdraws').modal('show');
        });

        $('#tbody-datatable').on('click', '#btn-approval', function(event) {
            const withdrawsData = JSON.parse($(this).attr('data-json'));
            const balance = $(this).attr('data-balance');

            if (tipeUser === 'admin') {
                switch (withdrawsData.status) {
                    case 'pending':
                        $('#withdrawId').val(withdrawsData.id);
                        $('#balance').val(balance);
                        $('#amount').val(withdrawsData.amount);
                        $('#m_withdraws').modal('show');
                        break;
                    default:
                        const url = $(this).attr('data-url-invoice');
                        window.open(url, '_blank');
                        break;
                }
            } else {
                const url = $(this).attr('data-url-invoice');
                window.open(url, '_blank');
            }
        });

        $("#submit-withdraws").click((event) => {
            event.preventDefault();
            if (tipeUser === 'admin') {
                $("#status").val('approved')
            }

            document.getElementById('withdraws-form').submit();
        });

        $('#declined-withdraws').click((event) => {
            event.preventDefault();
            $("#status").val('declined')
            document.getElementById('withdraws-form').submit();
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
    </script>
@endpush
