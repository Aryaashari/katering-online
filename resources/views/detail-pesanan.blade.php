@extends('layouts.base')

@section('title', 'Detail Pesanan')

@push('js')
    <script
        src="{{ env('MIDTRANS_IS_PRODUCTION') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script src="{{ asset('assets/js/detail-pesanan.js') }}"></script>
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
                                <h2>Detail Pesanan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================ confirmation part start =================-->
        <section class="confirmation_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="order_details_iner">
                            <h3>Detail Pesanan</h3>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="2">Nama Paket</th>
                                        <th scope="col">Skema Paket</th>
                                        <th scope="col">Periode Hari</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Kuantitas</th>
                                        <th scope="col">Total Periode Hari</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2"><span>{{ $pesanan->nama_paket }}</span></th>
                                        <th> <span>{{ $pesanan->nama_skema }}</span></th>
                                        <th> <span>{{ $pesanan->periode_hari }} hari</span></th>
                                        <th> <span>Rp {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}</span></th>
                                        <th> <span>{{ $pesanan->kuantitas }}x</span></th>
                                        <th> <span>{{ $pesanan->total_periode_hari }} hari</span></th>
                                        <th> <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></th>
                                    </tr>
                                    {{-- <tr>
                                        <th colspan="5">Pajak</th>
                                        <th>Rp 10.000</th>
                                    </tr> --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="font-size: 20px; font-weight: bold" scope="col" colspan="7">Total
                                            Harga</th>
                                        <th style="font-size: 20px; font-weight: bold">Rp
                                            {{ number_format($pesanan->total_harga, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <h4>Status Pembayaran:
                            @if ($pesanan->pembayaran == null || $pesanan->pembayaran->status == 'new')
                                <span class="badge badge-primary">BELUM MEMILIH PEMBAYARAN</span>
                            @elseif ($pesanan->pembayaran->status == 'settlement')
                                <span class="badge badge-success">PEMBAYARAN BERHASIL</span>
                            @elseif ($pesanan->pembayaran->status == 'pending')
                                <span class="badge badge-warning">MENUNGGU PEMBAYARAN</span>
                            @elseif ($pesanan->pembayaran->status == 'expire')
                                <span class="badge badge-danger">PEMBAYARAN KADALUARSA</span>
                            @else
                                <span class="badge badge-danger">PEMBAYARAN GAGAL</span>
                            @endif
                        </h4>
                    </div>
                    <div class="col-12 mt-4 d-flex justify-content-end">
                        <input type="hidden" id="pesananId" value="{{ $pesanan->id }}">
                        @if ($pesanan->pembayaran == null || $pesanan->pembayaran->status == 'new')
                            <button class="btn btn-primary btn-block" onclick="bayar()">Bayar Sekarang</button>
                        @elseif ($pesanan->pembayaran->status == 'pending')
                            <button class="btn btn-primary btn-block" onclick="bayar()">Selesaikan Pembayaran</button>
                        @else
                            <a href="{{ url('/') }}" class="btn btn-success btn-block">Telusuri Paket Katering</a>
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!--================ confirmation part end =================-->
    </main>
@endsection
