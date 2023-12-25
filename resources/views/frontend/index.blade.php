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
    <section class="page-section">
        <div class="">
            <h1 class="text-center my-4">Layanan Kami</h1>
            <hr class="divider" />
            <div class="row row-cols-1 gx-4 gx-lg-5 justify-content-center mt-100">
                <div class="bg-layanan px-4 py-5">
                    <div class="row">
                        <div class="col" data-aos="fade-up-left">
                            <div class="d-flex d-md-flex flex-wrap align-items-center justify-content-center">
                                <div class="box-img" data-aos="fade-left" data-aos-duration="1000">
                                    <img src="{{ asset('img/s-1.jpg') }}" alt="" class="img-layanan m-2">
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center ms-0 ms-md-5 mx-w50 c-grey mt-5 mt-md-0"
                                    data-aos="fade-right" data-aos-duration="1000">
                                    <h3 class="fw-bold text-white">Distribusi</h3>
                                    <p class="fw-lighter text-justify text-white">“Kami percaya ada penonton yang tepat
                                        untuk setiap
                                        karya.
                                        Kami membantu mempertemukan karya Anda dan penonton
                                        dengan mendistribusikan karya Anda ke seluruh dunia melalui lebih
                                        dari 20 platform diseluruh dunia.”
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-5">
                    <div class="row">
                        <div class="col" data-aos="fade-up-left">
                            <div class="d-none d-md-flex flex-wrap align-items-center justify-content-center">
                                <div class="d-flex flex-column align-items-center justify-content-center mx-w50 c-grey me-0 me-md-5"
                                    data-aos="fade-left" data-aos-duration="1000">
                                    <h3 class="fw-bold">Optimasi</h3>
                                    <p class="fw-lighter text-justify ">“Kami membantu meningkatkan potensi
                                        royalti dan
                                        pemasukan
                                        yang anda dapatkan. Kami memberikan konsultasi dan dan solusi terbaik untuk
                                        memastikan
                                        karya
                                        yang Anda buat sesuai dengan keinginan dan kondisi pasar. Semakin bayak
                                        penonton,
                                        semakin
                                        banyak royalti Anda.”
                                    </p>
                                </div>
                                <div class="box-img" data-aos="fade-right" data-aos-duration="1000">
                                    <img src="{{ asset('img/s-2.jpg') }}" alt="" class="img-layanan m-2">
                                </div>
                            </div>
                            <div
                                class="d-flex flex-column-reverse flex-column align-items-center justify-content-center d-inline d-md-none">
                                <div class="d-flex flex-column align-items-center justify-content-center mx-w50 c-grey me-0 me-md-5 mt-5 mt-md-0"
                                    data-aos="fade-left" data-aos-duration="1000">
                                    <h3 class="fw-bold ">Optimasi</h3>
                                    <p class="fw-lighter text-justify">“Kami membantu meningkatkan potensi
                                        royalti dan
                                        pemasukan
                                        yang anda dapatkan. Kami memberikan konsultasi dan dan solusi terbaik untuk
                                        memastikan
                                        karya
                                        yang Anda buat sesuai dengan keinginan dan kondisi pasar. Semakin bayak
                                        penonton,
                                        semakin
                                        banyak royalti Anda.”
                                    </p>
                                </div>
                                <div class="box-img" data-aos="fade-right" data-aos-duration="1000">
                                    <img src="{{ asset('img/s-2.jpg') }}" alt="" class="img-layanan m-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-layanan px-4 py-5">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-wrap align-items-center justify-content-center">
                                <div class="box-img" data-aos="fade-left" data-aos-duration="1000">
                                    <img src="{{ asset('img/bisnis.jpg') }}" alt="" class="img-layanan m-2">
                                </div>
                                <div class="d-flex flex-wrap flex-column align-items-center justify-content-center ms-0 ms-md-5 mx-w50 c-grey mt-5 mt-md-0"
                                    data-aos="fade-right" data-aos-duration="1000">
                                    <h3 class="fw-bold text-white">Perlindungan</h3>
                                    <p class="fw-lighter text-justify text-white">“Kami menjaga karya anda di berbagai
                                        platform musik
                                        untuk
                                        memastikan tidak ada orang lain yang menggunakan karya Anda tanpa hak. Kami
                                        mengurus
                                        seluruh
                                        kegiatan legal, administrasi, dan pengawasan untuk memastikan Anda lah yang
                                        mendapatkan
                                        royalti dan pemasukan dari karya Anda.”
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-5">
                    <div class="col">
                        <div class="d-none d-md-flex flex-wrap align-items-center justify-content-center">
                            <div class="d-flex flex-column align-items-center justify-content-center mx-w50 c-grey me-0 me-md-5"
                                data-aos="fade-left" data-aos-duration="1000">
                                <h3 class="fw-bold">Transparansi</h3>
                                <p class="fw-lighter text-justify ">“Kami menyediakan laporan royalti Anda
                                    secara rutin
                                    setiap
                                    bulan. Laporan yang kami berikan rinci, transparan dan lengkap. Kami juga memiliki
                                    sistem
                                    dan program khusus untuk Anda sehingga Anda dapat melihat laporan lebih mudah dan
                                    secara
                                    real time.”
                                </p>
                            </div>
                            <div class="box-img" data-aos="fade-right" data-aos-duration="1000">
                                <img src="{{ asset('img/s-3.jpg') }}" alt="" class="m-2 img-layanan">
                            </div>
                        </div>
                        <div
                            class="d-flex flex-column-reverse flex-column align-items-center justify-content-center d-md-none">
                            <div class="d-flex flex-column align-items-center justify-content-center mx-w50 c-grey me-0 me-md-5 mt-5 mt-md-0"
                                data-aos="fade-left" data-aos-duration="1000">
                                <h3 class="fw-bold ">Transparansi</h3>
                                <p class="fw-lighter text-justify ">“Kami menyediakan laporan royalti Anda
                                    secara rutin
                                    setiap
                                    bulan. Laporan yang kami berikan rinci, transparan dan lengkap. Kami juga memiliki
                                    sistem
                                    dan program khusus untuk Anda sehingga Anda dapat melihat laporan lebih mudah dan
                                    secara
                                    real time.”
                                </p>
                            </div>
                            <div class="box-img" data-aos="fade-right" data-aos-duration="1000">
                                <img src="{{ asset('img/s-3.jpg') }}" alt="" class="m-2 img-layanan">
                            </div>
                        </div>
                    </div>
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
                            <img src="{{ asset('img/logo/apple-music-300x72.png') }}" alt=""
                                class="img-platform">
                            <img src="{{ asset('img/logo/deezer_300_59.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/Joox-Logo-300x200.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/pandora-300x200.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/tidal-300x200.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/soundcloud-300x200.png') }}" alt=""
                                class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/ig-300x200.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/fb-300x200.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/tiktok-300x200.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/Spotify_Logo_RGB_Green-300x90.png') }}" alt=""
                                class="img-platform">
                            <img src="{{ asset('img/logo/anghami.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/AWA.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/Boomplay.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/iHeart Radio.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/imusica.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/Joox.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/kkbox.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/mixclound.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/MusicTime.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/napster.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/nuuday.png') }}" alt="" class="img-platform">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-5">
                            <img src="{{ asset('img/logo/Tidal.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/Yandex Music.png') }}" alt="" class="img-platform">
                            <img src="{{ asset('img/logo/TME.png') }}" alt="" class="img-platform">
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
