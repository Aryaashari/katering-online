@extends('layouts.base')

@push('css')
    <style>
        .price-text {
            font-size: 24px;
            font-weight: 600;
            color: #ED3237;
        }

        @media (max-width: 767.98px) {
            .price-text {
                font-size: 18px;
            }

            .popular-caption h3 {
                font-size: 24px;
            }
        }
    </style>
@endpush

@section('content')
    <main>

        <div class="container">
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="hero-cap text-center">
                            <h2>Penuhi Kebutuhanmu di Telyu 👋</h2>
                        </div>
                        <div class="hero__caption">
                            <p>"Dari katering, hingga seluruh kebutuhan harian kamu di Telkom University"</p>
                        </div>
                        <div class="hero__btn d-flex justify-content-center" data-animation="fadeInLeft" data-delay=".8s"
                            data-duration="2000ms">
                            <a href="#" class="btn hero-btn">Cek Disini</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-area mt-5">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img big-img" style="background-image: url(assets/img/gallery/galeri1.png);">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6">
                                <div class="single-gallery mb-30">
                                    <div class="gallery-img small-img"
                                        style="background-image: url(assets/img/gallery/galeri2.png);"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12  col-md-6 col-sm-6">
                                <div class="single-gallery mb-30">
                                    <div class="gallery-img small-img"
                                        style="background-image: url(assets/img/gallery/galeri3.png);"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <section class="popular-items latest-padding">
            <div class="container">
                <div class="text-center">
                    <h3>Bingung mau makan apa tiap hari?</h3>
                    <div class="section_title">
                        <h2 class="text-danger">Paket Katering</h2>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            @foreach ($paket as $item)
                                <div class="col-xl-3 col-lg-3 col-6">
                                    <a href="{{ url('paket') . '/' . $item->slug }}">
                                        <div class="single-popular-items mb-50 text-center">
                                            <div class="popular-img">
                                                <img src="{{ asset('storage' . '/' . $item->thumbnail) }}" alt="">
                                                <div class="img-cap">
                                                    <a href="{{ url('paket') . '/' . $item->slug }}">
                                                        <span>Lihat Paket</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="popular-caption">
                                                <h3>{{ $item->nama_paket }}</h3>
                                                @if (count($item->skema) > 0)
                                                    <p class="price-text">Rp
                                                        {{ number_format($item->skema[0]->pivot->harga, 0, ',', '.') }} /
                                                        {{ $item->skema[0]->satuan }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- End Nav Card -->
            </div>
        </section>
        <!-- Latest Products End -->
    </main>
@endsection
