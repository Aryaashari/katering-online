@extends('layouts.base')

@section('title', 'Katering Online - Riwayat Pesanan')

@push('css')
    <style>
        .table th {
            font-size: 18px !important;
            font-weight: 600 !important;
            color: rgb(31, 31, 31) !important;
        }
    </style>
@endpush

@section('content')
    <main>
        <!--================Cart Area =================-->
        <section class="cart_area">
            <div class="container">
                <div class="single_product_text">
                    <h3>Riwayat Pesanan</h3>
                </div>
                <div class="cart_inner">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Paket</th>
                                    <th scope="col">Skema Paket</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pesanan as $item)
                                    <tr>
                                        <td>
                                            {{ $item->nama_paket }}
                                        </td>
                                        <td>
                                            {{ $item->nama_skema }}
                                        </td>
                                        <td>
                                            @if ($item->status_order == 'NEW')
                                                <div class="badge badge-primary" style="font-size: 16px">
                                                    {{ $item->status_order }}
                                                </div>
                                            @elseif ($item->status_order == 'PENDING')
                                                <div class="badge badge-warning" style="font-size: 16px">
                                                    {{ $item->status_order }}
                                                </div>
                                            @else
                                                <div class="badge badge-danger" style="font-size: 16px">
                                                    {{ $item->status_order }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ url('/pesan/detail' . '/' . $item->id) }}"
                                                class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </section>
        <!--================End Cart Area =================-->
    </main>
@endsection
