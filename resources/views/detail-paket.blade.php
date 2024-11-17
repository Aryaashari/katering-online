@extends('layouts.base')

@section('title', 'Katering Online - Detail Paket')

@push('js')
    <script>
        // Passing URLs as a JSON object
        const extraImages = [
            "{{ asset('assets/img/gallery/1.png') }}",
            "{{ asset('assets/img/gallery/2.png') }}",
            "{{ asset('assets/img/gallery/1.png') }}",
            "{{ asset('assets/img/gallery/1.png') }}",
            "{{ asset('assets/img/gallery/1.png') }}",
        ];
    </script>
    <script src="{{ asset('assets/js/detail-paket.js') }}"></script>
@endpush
@push('css')
    <style>
        .product_img_big {
            width: 100%;
            height: 400px;
        }

        .product_img_big img {
            width: 100%;
            height: 100%;
            transition: transform 0.1s ease;
            object-fit: cover;
        }

        .img-lainnya {
            width: 30%;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .img-lainnya:hover {
            cursor: pointer;
        }

        .img-lainnya p {
            color: #fff;
            z-index: 99;
            position: relative;
        }

        .img-lainnya::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .slider {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
        }

        .slider.show {
            display: flex;
        }

        .slider.hide {
            display: none !important;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slide img {
            max-width: 800px;
            height: auto;
        }

        .prev,
        .next,
        .close {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .prev:hover,
        .next:hover,
        {
        background-color: rgba(0, 0, 0, 0.8);
        }

        .prev {
            left: 0;
        }

        .next {
            right: 0;
        }

        .close {
            top: 60px;
            right: 0;
            transform: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/lib/swiper/swiper.css') }}">
@endpush

@section('content')
    <main>
        <div class="product_image_area">
            <div class="container">

                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="{{ url('/') }}" style="color: #0B1C39; font-weight: 300; font-size: 24px"><img src="{{ asset('assets/img/icons/arrow-left.png') }}" alt="arrow-left" class="mr-3" width="30"> Kembali</a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-12">
                        <div class="product_img_big">
                            <img id="mainImg" src="{{ asset('storage' . '/' . $paket->thumbnail) }}" alt="main-img">
                        </div>
                        <div class="product_img_small">
                            <img src="{{ asset('storage' . '/' . $paket->foto[0]) }}" class="thumb" data-index="0"
                                alt="main-img">
                            <img src="{{ asset('storage' . '/' . $paket->foto[1]) }}" class="thumb" data-index="1"
                                alt="main-img">
                            <div class="img-lainnya"
                                style="background-image: url(' {{ asset('storage' . '/' . $paket->foto[2]) }}')"
                                id="showMore" data-index="2">
                                <p>{{ count($paket->foto)-2 }} lainnya</p>
                            </div>
                        </div>

                        <div id="img-preview">
                            <div class="slider">
                                <div class="slides">
                                    @foreach ($paket->foto as $foto)
                                        <div class="slide">
                                            <img src="{{ asset('storage' . '/' . $foto) }}" width="400">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="prev">&#10094;</button>
                                <button class="next">&#10095;</button>
                                <button class="close">X</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-8 col-12">
                        <div class="single_product_text">
                            <h3>{{ $paket->nama_paket }}</h3>
                            <p>
                                {!! $paket->deskripsi !!}
                            </p>


                            <!--Nav Button  -->
                            <nav class="popular-items">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach ($paket->skema as $skema)
                                        <a class="nav-item nav-link {{ $paket->skema[0]->nama_skema == $skema->nama_skema ? 'active' : '' }}"
                                            id="nav-{{ $skema->nama_skema }}-tab" data-toggle="tab"
                                            href="#nav-{{ $skema->nama_skema }}" role="tab"
                                            aria-controls="nav-{{ $skema->nama_skema }}"
                                            aria-selected="true">{{ $skema->nama_skema }}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <!--End Nav Button  -->

                            <div class="tab-content" id="nav-tabContent">
                                @foreach ($paket->skema as $skema)
                                    <div class="tab-pane fade show {{ $paket->skema[0]->nama_skema == $skema->nama_skema ? 'active' : '' }}"
                                        id="nav-{{ $skema->nama_skema }}" role="tabpanel"
                                        aria-labelledby="nav-{{ $skema->nama_skema }}-tab">
                                        <form action="{{ url('/pesan') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <label>Pesan Untuk Berapa {{ $skema->satuan }}?</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" min="1" value="1"
                                                            class="form-control inputKuantitas" name="kuantitas_periode"
                                                            data-price="{{ $skema->pivot->harga }}"
                                                            onchange="changeQuantity();" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                id="basic-addon2">{{ $skema->satuan }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label>Pesan Untuk Berapa Orang?</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" min="1" value="1"
                                                            class="form-control inputKuantitasOrang" name="kuantitas_orang"
                                                            onchange="changeQuantity();" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">Orang</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label>Pilih Tanggal Mulai (Min h+2)</label>
                                                    <input type="date" name="tanggal" class="form-control" required>
                                                </div>
                                                <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                <input type="hidden" name="skema_id" value="{{ $skema->id }}">
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <h5>
                                                        Total harga
                                                        <span class="font-weight-bold text-danger"
                                                            style="font-size: 28px"><span class="price">Rp
                                                                {{ number_format($skema->pivot->harga, 0, ',', '.') }}</span>/{{ $skema->satuan }}</span>
                                                        <h5>
                                                            <div class="hero__btn d-flex" data-animation="fadeInLeft"
                                                                data-delay=".8s" data-duration="2000ms">
                                                                <button type="submit" class="btn hero-btn">Pesan
                                                                    Sekarang</button>
                                                            </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
