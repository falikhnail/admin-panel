@extends('frontend.layouts.app')


@section('title')
    About
@endsection

@section('content')
    <div style="">
        <section class="page-section-xl bg-primary">
            <div class="container px-4 px-lg-5" data-aos="fade-up">
                <h1 class="text-center text-white my-4">About</h1>
                <hr class="divider divider-light" />
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white-75 mb-4 lh-15">
                            Cari tahu tentang kami dan bagaimana kami dapat membantu Anda menghasilkan uang dari karya Anda.
                            Telusuri dibawah
                        </h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section">
            <div class="container px-4 px-lg-5" data-aos="fade-right">
                <h1 class="text-center my-4">Kami</h1>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mb-4 lh-15">
                            Cari tahu tentang kami dan bagaimana kami dapat membantu Anda menghasilkan uang dari karya Anda.
                            Telusuri dibawah
                        </h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section">
            <div class="container px-4 px-lg-5" data-aos="fade-right">
                <h1 class="text-center my-4">Tim Kami</h1>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-4 text-center mb-5 mb-md-0" data-aos="fade-up" data-aos-duration="1000">
                        <img src="{{ asset('img/Handre.jpg') }}" class="card rounded-5 img-fluid shadow-lg">
                        <h5 class="mt-2 fw-900">
                            Handre
                        </h5>
                        <hr class="short-divider" />
                        <h5 class="fw-900">
                            Digital Distribution Manager
                        </h5>
                    </div>
                    <div class="col-lg-4 text-center mb-5 mb-md-0" data-aos="fade-down" data-aos-duration="1000">
                        <img src="{{ asset('img/Angga.jpg') }}" class="card rounded-5 img-fluid shadow-lg">
                        <h5 class="mt-2 fw-900">
                            Angga
                        </h5>
                        <hr class="short-divider" />
                        <h5 class="fw-900">
                            Legal & Hr Manager
                        </h5>
                    </div>
                    <div class="col-lg-4 text-center mb-5 mb-md-0" data-aos="fade-up" data-aos-duration="1000">
                        <img src="{{ asset('img/Ulil.jpg') }}" class="card rounded-5 img-fluid shadow-lg">
                        <h5 class="mt-2 fw-900">
                            Ulil
                        </h5>
                        <hr class="short-divider" />
                        <h5 class="fw-900">
                            Finance Manager
                        </h5>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-primary p-3 d-flex align-items-center justify-content-center">
            <div class="row gx-4 gx-lg-5" data-aos-once="true" data-aos="zoom-in-up" data-aos-duration="1000">
                <div class="col-lg-4 col-md-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-eye fs-88 text-white"></i>
                        <div class="row row-cols-1 text-white ms-2">
                            <div class="col">
                                <h2>
                                    <span class="count" data-target="16">0</span>
                                    <span>Juta+</span>
                                </h2>
                            </div>
                            <div class="col">
                                View / Minggu
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people fs-88 text-white"></i>
                        <div class="row row-cols-1 text-white ms-2">
                            <div class="col">
                                <h2>
                                    <span class="count" data-target="22">0</span>
                                    <span>Juta+</span>
                                </h2>
                            </div>
                            <div class="col">
                                Subscribers
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-hand-thumbs-up fs-88 text-white"></i>
                        <div class="row row-cols-1 text-white  ms-2">
                            <div class="col">
                                <h2>
                                    <span class="count" data-target="220">0</span>
                                    <span>+</span>
                                </h2>
                            </div>
                            <div class="col">
                                Mitra & Klien
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section">
            <div class="container px-4 px-lg-5">
                <h1 class="text-center my-4">Layanan Kami</h1>
                <hr class="divider" />
                <div class="row row-cols-1 gx-4 gx-lg-5 justify-content-center mt-150">
                    <div class="col" data-aos="fade-up-left">
                        <div class="d-flex d-md-flex flex-wrap align-items-center justify-content-center">
                            <div class="box-img" data-aos="fade-left" data-aos-duration="1000">
                                <img src="{{ asset('img/s-1.jpg') }}" alt="" class="img-layanan m-2">
                            </div>
                            <div class="d-flex flex-column align-items-center justify-content-center ms-0 ms-md-5 mx-w50 c-grey mt-5 mt-md-0"
                                data-aos="fade-right" data-aos-duration="1000">
                                <h3 class="fw-normal">Distribusi</h3>
                                <p class="fw-lighter text-justify">“Kami percaya ada penonton yang tepat untuk setiap karya.
                                    Kami membantu mempertemukan karya Anda dan penonton
                                    dengan mendistribusikan karya Anda ke seluruh dunia melalui lebih
                                    dari 20 platform diseluruh dunia.”
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-100" data-aos="fade-up-left">
                        <div class="d-none d-md-flex flex-wrap align-items-center justify-content-center">
                            <div class="d-flex flex-column align-items-center justify-content-center mx-w50 c-grey me-0 me-md-5"
                                data-aos="fade-left" data-aos-duration="1000">
                                <h3 class="fw-normal">Optimasi</h3>
                                <p class="fw-lighter text-justify">“Kami membantu meningkatkan potensi royalti dan
                                    pemasukan
                                    yang anda dapatkan. Kami memberikan konsultasi dan dan solusi terbaik untuk memastikan
                                    karya
                                    yang Anda buat sesuai dengan keinginan dan kondisi pasar. Semakin bayak penonton,
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
                                <h3 class="fw-normal">Optimasi</h3>
                                <p class="fw-lighter text-justify">“Kami membantu meningkatkan potensi royalti dan
                                    pemasukan
                                    yang anda dapatkan. Kami memberikan konsultasi dan dan solusi terbaik untuk memastikan
                                    karya
                                    yang Anda buat sesuai dengan keinginan dan kondisi pasar. Semakin bayak penonton,
                                    semakin
                                    banyak royalti Anda.”
                                </p>
                            </div>
                            <div class="box-img" data-aos="fade-right" data-aos-duration="1000">
                                <img src="{{ asset('img/s-2.jpg') }}" alt="" class="img-layanan m-2">
                            </div>
                        </div>
                    </div>
                    <div class="col mt-100">
                        <div class="d-flex flex-wrap align-items-center justify-content-center">
                            <div class="box-img" data-aos="fade-left" data-aos-duration="1000">
                                <img src="{{ asset('img/bisnis.jpg') }}" alt="" class="img-layanan m-2">
                            </div>
                            <div class="d-flex flex-wrap flex-column align-items-center justify-content-center ms-0 ms-md-5 mx-w50 c-grey mt-5 mt-md-0"
                                data-aos="fade-right" data-aos-duration="1000">
                                <h3 class="fw-normal">Perlindungan</h3>
                                <p class="fw-lighter text-justify">“Kami menjaga karya anda di berbagai platform musik
                                    untuk
                                    memastikan tidak ada orang lain yang menggunakan karya Anda tanpa hak. Kami mengurus
                                    seluruh
                                    kegiatan legal, administrasi, dan pengawasan untuk memastikan Anda lah yang mendapatkan
                                    royalti dan pemasukan dari karya Anda.”
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-100">
                        <div class="d-none d-md-flex flex-wrap align-items-center justify-content-center">
                            <div class="d-flex flex-column align-items-center justify-content-center mx-w50 c-grey me-0 me-md-5"
                                data-aos="fade-left" data-aos-duration="1000">
                                <h3 class="fw-normal">Transparansi</h3>
                                <p class="fw-lighter text-justify">“Kami menyediakan laporan royalti Anda secara rutin
                                    setiap
                                    bulan. Laporan yang kami berikan rinci, transparan dan lengkap. Kami juga memiliki
                                    sistem
                                    dan program khusus untuk Anda sehingga Anda dapat melihat laporan lebih mudah dan secara
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
                                <h3 class="fw-normal">Transparansi</h3>
                                <p class="fw-lighter text-justify">“Kami menyediakan laporan royalti Anda secara rutin
                                    setiap
                                    bulan. Laporan yang kami berikan rinci, transparan dan lengkap. Kami juga memiliki
                                    sistem
                                    dan program khusus untuk Anda sehingga Anda dapat melihat laporan lebih mudah dan secara
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
        </section>
        <section class="page-section-grey">
            <h2 class="text-center w-100 me-3" style="width: 40%;">Our Platform</h2>
            <hr class="divider" />
            <div class="d-flex align-items-center justify-content-center">
                <div class="slideshow">
                    <div class="move">
                        <div class="d-flex align-items-center">
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/apple-music-300x72.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/deezer_300_59.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/Joox-Logo-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/yt_logo_rgb_light-300x67.png') }}" alt=""
                                    width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/Spotify_Logo_RGB_Green-300x90.png') }}" alt=""
                                    width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/ig-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/fb-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/tiktok-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/soundcloud-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/pandora-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/tidal-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/more-300x200.png') }}" alt="" width="150">
                            </a>
                        </div>
                    </div>
                    <div class="move">
                        <div class="d-flex align-items-center">
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/apple-music-300x72.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/deezer_300_59.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/Joox-Logo-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/yt_logo_rgb_light-300x67.png') }}" alt=""
                                    width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/Spotify_Logo_RGB_Green-300x90.png') }}" alt=""
                                    width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/ig-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/fb-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/tiktok-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/soundcloud-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/pandora-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/tidal-300x200.png') }}" alt="" width="150">
                            </a>
                            <a href="#" class="me-5">
                                <img src="{{ asset('img/logo/more-300x200.png') }}" alt="" width="150">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('frontend.includes.faqs')
    </div>
@endsection

@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            const counters = document.querySelectorAll(".count");
            const speed = 150;

            counters.forEach((counter) => {
                const updateCount = () => {
                    const target = parseInt(+counter.getAttribute("data-target"));
                    const count = parseInt(+counter.innerText);
                    let increment = Math.trunc(target / speed);
                    if (target < 50) {
                        increment = 1
                    }

                    if (count < target) {
                        counter.innerText = count + increment;
                        setTimeout(updateCount, target < 50 ? 100 : 1);
                    } else {
                        count.innerText = target;
                    }
                };

                updateCount();
            });

            function animateHorizontalScroll(element) {

            }

            animateHorizontalScroll($('#our-platform'));
            $('#our-platform').hover($('#our-platform').stop(), animateHorizontalScroll)

        });
    </script>
@endpush
