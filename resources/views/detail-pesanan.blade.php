@extends('layouts.base')

@section('title', 'Detail Pesanan')

@push('js')
    <script
        src="{{ env('MIDTRANS_IS_PRODUCTION') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script src="{{ asset('assets/js/detail-pesanan.js') }}"></script>
@endpush

@push('css')
    <style>

        .title {
            font-weight: 600;
            font-size: 16px;
            color: rgb(28, 28, 28);
        }

        .container-table {
            background-color: white;
            padding: 30px;
        }

        .order_details_iner {
            background-color: transparent !important; 
        }

    </style>
@endpush

@section('content')
    <main>
        <!--================ confirmation part start =================-->
        <section class="confirmation_part">
            <div class="container container-table">
                <h3 style="font-weight: 700; font-size: 30px">Detail Pesanan</h3>
                <div class="row" id="table-lg">
                    <div class="col-lg-12">
                        <div class="order_details_iner">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col" colspan="2">Nama Paket</th>
                                            <th scope="col">Skema Paket</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jumlah Orang</th>
                                            <th scope="col">Periode</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="2"><span>{{ $pesanan->nama_paket }}</span></th>
                                            <th> <span>{{ $pesanan->nama_skema }}</span></th>
                                            <th> <span>Rp {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}</span>
                                            </th>
                                            <th> <span>{{ $pesanan->kuantitas_periode }} orang</span></th>
                                            <th> <span>{{ $pesanan->kuantitas_orang }} {{ $pesanan->satuan }}</span></th>
                                            <th> <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                                            </th>
                                        </tr>
                                        {{-- <tr>
                                            <th colspan="5">Pajak</th>
                                            <th>Rp 10.000</th>
                                        </tr> --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="font-size: 20px; font-weight: bold" scope="col" colspan="7">
                                                Total
                                                Harga</th>
                                            <th style="font-size: 20px; font-weight: bold">Rp
                                                {{ number_format($pesanan->total_harga, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
                </div>

                <div class="row d-none" id="table-sm">
                    <div class="col-6">
                        <p class="title">Nama Paket</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $pesanan->nama_paket }}</p>
                    </div>

                    <div class="col-6">
                        <p class="title">Skema Paket</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $pesanan->skema_paket }}</p>
                    </div>

                    <div class="col-6">
                        <p class="title">Harga</p>
                    </div>
                    <div class="col-6">
                        <p>Rp {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}</p>
                    </div>

                    <div class="col-6">
                        <p class="title">Jumlah Orang</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $pesanan->kuantitas_orang }}</p>
                    </div>

                    <div class="col-6">
                        <p class="title">Periode</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $pesanan->kuantitas_periode }} {{ $pesanan->periode }}</p>
                    </div>

                    <div class="col-6">
                        <p class="title">Total</p>
                    </div>
                    <div class="col-6">
                        <p>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-4 d-flex">
                        <input type="hidden" id="pesananId" value="{{ $pesanan->id }}">
                        @if ($pesanan->pembayaran == null || $pesanan->pembayaran->status == 'new')
                            <button class="btn btn-primary" onclick="bayar()">Bayar Sekarang</button>
                        @elseif ($pesanan->pembayaran->status == 'pending')
                            <button class="btn btn-primary" onclick="bayar()">Selesaikan Pembayaran</button>
                        @else
                            <a href="{{ url('/') }}" class="btn btn-success">Telusuri Paket Katering</a>
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!--================ confirmation part end =================-->
    </main>
@endsection
