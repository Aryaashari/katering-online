@extends('layouts.base')

@section('title', 'Katering Online - Detail Paket')

@push('js')
    <script src="{{ asset('assets/js/detail-paket.js') }}"></script>
@endpush

@section('content')
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>{{ $paket->nama_paket }}</h2>
                                <a href="{{ url('/') }}" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <!--================Single Product Area =================-->
        <div class="product_image_area">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="product_img_slide owl-carousel">

                            @foreach ($foto as $item)
                                <div class="single_product_img">
                                    <img src="{{ asset('storage'. '/' . $item)  }}" alt="#" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="single_product_text text-center">
                            <h3>Deskripsi Paket</h3>
                            <p>
                                {!! $paket->deskripsi !!}
                            </p>
                        </div>
                    </div>

                    <div class="col-12">
                        <h2 class="font-bold text-center">Skema Paket</h2>
                    </div>

                    @foreach ($paket->skema as $skema)
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-title">
                                    <h3 class="text-center">{{ $skema->nama_skema }}</h3>
                                </div>
                                <div class="card-body">
                                    <p>{!! $skema->pivot->deskripsi !!}</p>
                                </div>
                                <div class="card-footer">
                                    <h4 class="text-center">Rp {{number_format($skema->pivot->harga, 0, ',', '.')}}/{{ $skema->satuan }}</h4>
                                    <a href="#" class="btn btn-primary btn-block" data-toggle="modal"
                                        data-target="#{{$skema->nama_skema}}">Pesan {{ $skema->nama_skema }}</a>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="{{$skema->nama_skema}}" tabindex="-1" role="dialog"
                                aria-labelledby="{{$skema->nama_skema}}Label" aria-hidden="true" style="z-index: 999999;">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ url('/pesan') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{$skema->nama_skema}}Label">Detail Pemesanan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close" onclick="closeModal();">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label>Pesan Untuk Berapa {{ $skema->satuan }}?</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" min="1" value="1"
                                                                class="form-control" name="kuantitas" data-price="{{$skema->pivot->harga}}"
                                                                onchange="tes();" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"
                                                                    id="basic-addon2">{{ $skema->satuan }}</span>
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

                                            </div>
                                            <div class="modal-footer">
                                                <h4>Rp {{number_format($skema->pivot->harga, 0, ',', '.')}}</h4>
                                                <button type="submit" class="btn btn-primary">Pesan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
