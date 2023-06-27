<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Invoice Withdraws</title>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @vite('resources/js/backend.js')

    <style>
        body {
            background-color: #efefef;
        }

        @media print {

            html,
            body {
                width: 750px;
            }
        }

        .invoice-container {
            margin: 15px auto;
            padding: 70px;
            max-width: 850px;
            background-color: #fff;
            border: 1px solid #ccc;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            -o-border-radius: 6px;
            border-radius: 6px;
        }

        @media (max-width: 895px) {
            .invoice-container {
                margin: 15px;
            }
        }

        @media (max-width: 767px) {
            .invoice-container {
                padding: 45px 45px 70px 45px;
            }
        }

        @media (max-width: 499px) {
            .invoice-header {
                text-align: center;
            }
        }

        .invoice-col {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 500px) {
            .invoice-col {
                float: left;
                width: 50%;
            }

            .invoice-col.right {
                float: right;
                text-align: right;
            }
        }

        .invoice-container .invoice-status {
            margin: 20px 0 0 0;
            text-transform: uppercase;
            font-size: 24px;
            font-weight: bold;
        }

        /* Invoice Status Colors */

        .draft {
            color: #888;
        }

        .unpaid {
            color: #cc0000;
        }

        .paid {
            color: #779500;
        }

        .refunded {
            color: #224488;
        }

        .rejected {
            color: #888;
        }

        .collections {
            color: #ffcc00;
        }

        /* Payment Button Formatting */

        .invoice-container .payment-btn-container {
            margin-top: 5px;
            text-align: center;
        }

        .invoice-container .payment-btn-container table {
            margin: 0 auto;
        }

        /* Text Formatting */

        .invoice-container .small-text {
            font-size: 0.9em;
        }

        /* Invoice Items Table Formatting */

        .invoice-container td.total-row {
            background-color: #f8f8f8;
        }

        .invoice-container td.no-line {
            border: 0;
        }

        .invoice-container .invoice-header img {
            max-width: 100%;
        }

        /* Overlay */

        #fullpage-overlay {
            display: table;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
        }

        #fullpage-overlay .outer-wrapper {
            position: relative;
            height: 100%;
        }

        #fullpage-overlay .inner-wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            height: 30%;
            width: 50%;
            margin: -3% 0 0 -25%;
            text-align: center;
        }

        #fullpage-overlay .msg {
            display: inline-block;
            padding: 20px;
            max-width: 400px;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="container-fluid bg-white card w-75 mt-5">
            <div class="p-5">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-6">
                        <h1 class="text-black fw-bold">Aggregator</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="float-end">
                            <h3 class="c-act-primary fw-bold">Invoice #2459</h3>
                        </div>
                    </div>
                </div>
                <hr>
                <h4 class="text-center my-2 c-act-primary fw-bold">{{ ucwords($withdraws->status) }}</h4>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Pay To</strong>
                        <address class="small-text">
                            {{ $withdraws->nama }}<br />
                            {{ $withdraws->email }} <br>
                            {{ $withdraws->bank_name }}<br>
                            a/n {{ $withdraws->account_name }} <br>
                            {{ $withdraws->account_number }}
                        </address>
                    </div>
                    <div class="col-md-6">
                        <div class="float-end text-end">
                            <strong>Invoiced To</strong>
                            <address class="small-text">
                                Super Aggregator<br />
                                PT Aggregator<br />
                                Jalan Matraman Raya Nomor 148, Blok C - 22<br />
                                Matraman,Jakarta Timur 13150<br />
                                Indonesia
                            </address>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Payment Method</strong><br>
                        <span class="small-text" data-role="paymethod-info">
                            Bank Transfer</span>
                        <br />
                    </div>
                    <div class="col-md-6">
                        <div class="float-end text-end">
                            <strong>Invoice Date</strong><br>
                            <span class="small-text">
                                {{ $withdraws->request_date }}<br><br>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="card p-3">
                        <div class="card-title">
                            <h3 class="panel-title"><strong>Invoice Items</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <td><strong>Description</strong></td>
                                            <td width="20%" class="text-center"><strong>Amount</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Royalty Payment ({{ $withdraws->request_date }}) *</td>
                                            <td class="text-center">{{ format_usd($withdraws->amount) }} </td>
                                        </tr>
                                        <tr>
                                            <td class="total-row text-right"><strong>Sub Total</strong></td>
                                            <td class="total-row text-center">{{ format_usd($withdraws->amount) }} </td>
                                        </tr>
                                        <tr>
                                            <td class="total-row text-right"><strong>Total</strong></td>
                                            <td class="total-row text-center">{{ format_usd($withdraws->amount) }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <strong>Withdraw Notes</strong>
                            <ul>
                                <li>Kurs : 14.510
                                    Untuk sekarang pemerintah mewajibkan pemotongan pajak sebesar 3% untuk yang tidak
                                    punya
                                    npwp
                                    dan 2.5% untuk yang punya npwp</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
