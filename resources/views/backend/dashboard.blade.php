@extends('backend.layouts.app')

@section('title')
    {{ $userSession->tipe_user === 'admin' ? 'Admin' : 'User' }} Dashboard
@endsection

@section('title_main')
    {{ $userSession->tipe_user === 'admin' ? 'Admin' : 'User' }} Dashboard
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item active">{{ $userSession->tipe_user === 'admin' ? 'Admin' : 'User' }} Dashboard</li>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $userSession->tipe_user === 'admin' ? 'Total Withdraws Current Month' : 'Saldo' }}</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $lastBalance }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ ($userSession->tipe_user === 'admin' ? 'Total Witdraws ' : '') . $last2MonthName }}</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $lastBalance2Month }}</h6>
                                <span class="text-muted small pt-1 fw-bold">{{ $lastBalance2MonthPercentage }}%</span>
                                <span class="text-muted small pt-2 ps-1">{{ $info2LastMonth }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ ($userSession->tipe_user === 'admin' ? 'Total Witdraws ' : '') . $last1MonthName }}</span>
                        </h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $lastBalance1Month }}</h6>
                                <span class="text-muted small pt-1 fw-bold">{{ $lastBalance1MonthPercentage }}%</span>
                                <span class="text-muted small pt-2 ps-1">{{ $info1LastMonth }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ ($userSession->tipe_user === 'admin' ? 'Total Witdraws ' : '') . $lastMonthName }}</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $lastBalance }}</h6>
                                <span class="text-muted small pt-1 fw-bold">{{ $lastBalancePercentage }} %</span>
                                <span class="text-muted small pt-2 ps-1">{{ $infoLastMonth }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Income Chart</h5>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="income-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            var options = {
                series: [{
                    name: 'Income',
                    data: [{{ formatOnlyNumber($lastBalance2Month) }},
                        {{ formatOnlyNumber($lastBalance1Month) }},
                        {{ formatOnlyNumber($lastBalance) }}, 0, 0, 0, 0, 0, 0, 0, 0, 0
                    ]
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        //borderRadius: 10,
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        if (val === 0) return '';
                        return '$' + val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: ["{{ $last2MonthName }}", '{{ $last1MonthName }}', "{{ $lastMonthName }}",
                        '-', '-', '-', '-', '-', '-', '-', '-', '-',
                    ],
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            if (val === 0) return '';
                            return '$' + val;
                        }
                    }

                },
                title: {
                    text: 'Monthly Income Chart',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#income-chart"), options);
            chart.render();
        });
    </script>
@endpush
