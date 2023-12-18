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

        <section class="page-section-grey">
            <h2 class="text-center w-100 me-3" style="width: 40%;">Our Platform</h2>
            <hr class="divider" />
            @include('frontend.includes.slideshow_platform')
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
