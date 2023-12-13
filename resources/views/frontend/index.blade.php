@extends('frontend.layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <header class="masthead">
        @include('flash::message')
        <div class="container px-4 px-lg-5 h-100" data-aos="fade-up">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Mudahkan Pengelolaan Bisnis Anda Dengan Kami</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Tingkatkan Laba Bisnis Anda Secara Masif Dan Buat Laporan Bisnis Anda
                        Secara Mudah</p>
                    <a class="btn btn-primary btn-xl" href="#about">Pelajari</a>
                </div>
            </div>
        </div>
    </header>
    <section class="page-section bg-primary" id="">
        <div class="container px-4 px-lg-5" data-aos="fade-up">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Kami Menyediakan Kebutuhan BisnisMu</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-75 mb-4">Keuntungan Bisnis Meningkat Hampir 200% Dengan Jasa Kami</p>
                    <a class="btn btn-light btn-xl" href="#services">Telusuri</a>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section" id="services">
        <div class="container px-4 px-lg-5" data-aos="fade-up">
            <h2 class="text-center mt-0">Platform</h2>
            <hr class="divider" />
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/apple-music-300x72.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/deezer_300_59.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/Joox-Logo-300x200.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/pandora-300x200.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/tidal-300x200.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/soundcloud-300x200.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/ig-300x200.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/fb-300x200.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/tiktok-300x200.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endpush
