@extends('frontend.layouts.app')

@push('after-styles')
    <style>

    </style>
@endpush

@section('title')
    About
@endsection

@section('content')
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
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('img/Ulil.jpg') }}" class="img-profile card rounded shadow-lg">
                    <h5 class="mt-2 fw-900">
                        Ulil
                    </h5>
                    <hr class="short-divider" />
                    <h5 class="fw-900">
                        Digital distribution manager
                    </h5>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('img/Angga.jpg') }}" class="img-profile card rounded shadow-lg">
                    <h5 class="mt-2 fw-900">
                        Angga
                    </h5>
                    <hr class="short-divider" />
                    <h5 class="fw-900">
                        Legal & Hr Manager
                    </h5>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('img/Handre.jpg') }}" class="img-profile card rounded shadow-lg">
                    <h5 class="mt-2 fw-900">
                        Handre
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
        <div class="row gx-4 gx-lg-5" data-aos="fade-up-right">
            <div class="col-lg-4 col-md-4">
                <div class="d-flex align-items-center">
                    <i class="bi bi-eye fs-88 text-white"></i>
                    <div class="row row-cols-1 text-white ms-2">
                        <div class="col">
                            <h2 class="">16 Juta+</h2>
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
                            <h2 class="">22 Juta+</h2>
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
                            <h2 class="">220+</h2>
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
                <div class="col"  data-aos="fade-up-left">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('img/s-1.jpg') }}" alt="" class="card rounded-lg img-fluid m-5">
                        <div class="d-flex flex-column align-items-center justify-content-center ms-5 mx-w50 c-grey">
                            <h3 class="fw-normal">Distribusi</h3>
                            <p class="fw-lighter text-justify">“Kami percaya ada penonton yang tepat untuk setiap karya.
                                Kami membantu mempertemukan karya Anda dan penonton
                                dengan mendistribusikan karya Anda ke seluruh dunia melalui lebih
                                dari 20 platform diseluruh dunia.”
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col mt-100"  data-aos="fade-up-left">
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center justify-content-center mx-w50 c-grey me-5">
                            <h3 class="fw-normal">Optimasi</h3>
                            <p class="fw-lighter text-justify">“Kami membantu meningkatkan potensi royalti dan pemasukan
                                yang anda dapatkan. Kami memberikan konsultasi dan dan solusi terbaik untuk memastikan karya
                                yang Anda buat sesuai dengan keinginan dan kondisi pasar. Semakin bayak penonton, semakin
                                banyak royalti Anda.”
                            </p>
                        </div>
                        <img src="{{ asset('img/s-2.jpg') }}" alt="" class="card rounded-lg img-fluid m-5">
                    </div>
                </div>
                <div class="col mt-100"  data-aos="fade-up-right">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('img/bisnis.jpg') }}" alt="" class="card rounded-lg img-fluid m-5">
                        <div class="d-flex flex-column align-items-center justify-content-center ms-5 mx-w50 c-grey">
                            <h3 class="fw-normal">Perlindungan</h3>
                            <p class="fw-lighter text-justify">“Kami menjaga karya anda di berbagai platform musik untuk
                                memastikan tidak ada orang lain yang menggunakan karya Anda tanpa hak. Kami mengurus seluruh
                                kegiatan legal, administrasi, dan pengawasan untuk memastikan Anda lah yang mendapatkan
                                royalti dan pemasukan dari karya Anda.”
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col mt-100"  data-aos="fade-up-left">
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center justify-content-center mx-w50 c-grey me-5">
                            <h3 class="fw-normal">Transparansi</h3>
                            <p class="fw-lighter text-justify">“Kami menyediakan laporan royalti Anda secara rutin setiap
                                bulan. Laporan yang kami berikan rinci, transparan dan lengkap. Kami juga memiliki sistem
                                dan program khusus untuk Anda sehingga Anda dapat melihat laporan lebih mudah dan secara
                                real time.”
                            </p>
                        </div>
                        <img src="{{ asset('img/s-3.jpg') }}" alt="" class="card rounded-lg img-fluid m-5">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section bg-primary">
        <div class="container px-4 px-lg-5">
            <h1 class="text-center text-white my-4">FAQS</h1>
            <hr class="divider divider-light" />
            <div class="row row-cols-1 gx-4 gx-lg-5 text-white">
                <div class="col">
                    <h5>Hal Umum</h5>
                    <div class="row row-cols-1 ms-2 mt-3">
                        <div class="col">
                            <div class="d-flex flex-column">
                                <a href="#faq-1" class="d-flex none" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">Apa itu aggregator?</span>
                                </a>
                                <div id="faq-1" class="collapse mt-3">
                                    <span>
                                        Aggregator adalah pihak yang mengurus pendaftaran hak cipta dari karya Anda. Kami
                                        mengurus seluruh kegiatan legal, administrasi, dan pengawasan yang diperlukan.
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-3">
                    <h5>Kerja Sama</h5>
                    <div class="row row-cols-1 ms-2 mt-3">
                        <div class="col">
                            <div class="d-flex flex-column">
                                <a href="#faq-2" class="d-flex none" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">Berapa lama proses yang diperlukan untuk mendaftar?</span>
                                </a>
                                <div id="faq-2" class="collapse mt-3">
                                    <span>
                                        Proses pendaftaran cepat, dapat selesai dalam waktu 1-2 hari. Anda hanya memberi
                                        dokumen yang diperlukan dan tanda tangan.
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-3" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">Apakah karya yang dibuat sebelum saya daftar bisa di
                                        klaim/lindungi?</span>
                                </a>
                                <div id="faq-3" class="collapse mt-3">
                                    <span>
                                        Bisa, jika karya tersebut dimasukkan ke dalam perjanjian kerja sesuai ketentuan yang
                                        berlaku
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-4" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">Berapa lama kerja sama yang akan berlaku?</span>
                                </a>
                                <div id="faq-4" class="collapse mt-3">
                                    <span>
                                        Masa kerjasama bervariasi tergantung kesepakatan. Namun yang umum adalah selama 1
                                        tahun
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-5" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">Apakah saya bisa berhenti sebelum waktu berakhir?</span>
                                </a>
                                <div id="faq-5" class="collapse mt-3">
                                    <span>
                                        Bisa, namun ada beberapa perjanjian yang tetap berlaku. Informasi lebih lanjut dapat
                                        menghubungi kami di (+62)899333712
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-6" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">Kemana karya saya di distribusikan?</span>
                                </a>
                                <div id="faq-6" class="collapse mt-3">
                                    <span>
                                        Karya Anda akan kami distribusikan ke lebih dari 20 platform kami, termasuk
                                        diantaranya adalah Youtube, Spotify, dan Deezer
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-7" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2"> Apa yang akan terjadi dengan karya saya jika saya menggunakan
                                        perlindungan?</span>
                                </a>
                                <div id="faq-7" class="collapse mt-3">
                                    <span>
                                        Karya Anda tetap menjadi milik Anda. Kami akan melindungi karya Anda dari penggunaan
                                        tanpa ijin.
                                        Beberapa penggunaan yang kami lindungi yaitu: cover, remix, dan reupload
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-7" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">
                                        Jika saya mengetahui seseorang memakai karya saya tanpa izin, apa yang saya dapat
                                        lakukan? </span>
                                </a>
                                <div id="faq-7" class="collapse mt-3">
                                    <span>
                                        Anda bisa melaporkan kepada kami dengan memberikan foto, rekaman atau tangkapan
                                        layar terkait hal tersebut
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-7" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">
                                        Apa yang akan terjadi jika seseorang memakai karya saya? </span>
                                </a>
                                <div id="faq-7" class="collapse mt-3">
                                    <span>
                                        Kami akan menghubungi pihak tersebut.
                                        Pihak tersebut dapat memilih untuk meminta perizinan kepada Anda atau berhenti
                                        menggunakan karya Anda.
                                        Kami akan mengurus segala perizinan, dokumen dan legal.
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-7" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">
                                        Apa syarat sebuah karya dapat didaftarkan? </span>
                                </a>
                                <div id="faq-7" class="collapse mt-3">
                                    <span>
                                        Karya tersebut harus milik Anda dan belum terdaftar di perusahan aggregator lain.
                                        Jika Anda ingin beralih kepada kami, kami akan memberi bantuan dalam proses
                                        perpindahan.
                                        Mengenai persyaratan lain dapat berkonsultasi kepada kami di (+62) 813 1102 6860
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="d-flex flex-column">
                                <a href="#faq-7" class="d-flex none align-items-center" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2">
                                        Apakah ada laporan royalti mengenai yang saya dapatkan? </span>
                                </a>
                                <div id="faq-7" class="collapse mt-3">
                                    <span>
                                        Ada. Kami akan memberikan laporan royalti dari karya-karya anda setiap bulan.
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-3">
                    <h5>Pertanyaan Lain</h5>
                    <div class="row row-cols-1 ms-2 mt-3">
                        <div class="col">
                            <div class="d-flex flex-column">
                                <a href="#faq-1" class="d-flex none" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down-square"></i>
                                    <span class="ms-2"> Saya ada pertanyaan lain</span>
                                </a>
                                <div id="faq-1" class="collapse mt-3">
                                    <span>
                                        Jika anda memiliki pertanyaan lain, dapat klik disini atau menghubungi kami melalui
                                        whatsapp di (+62) 813 1102 6860
                                    </span>
                                </div>
                                <hr class="text-white">
                            </div>
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
