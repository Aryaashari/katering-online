<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\PaketSkema;
use App\Models\Pesanan;
use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class PesananController extends Controller
{
    
    public function pesan(Request $request) {
        $request->validate(
            [
                'kuantitas' => 'required|integer|min:1',
                'tanggal' => 'required|date'
            ]
        );

        $paket = Paket::where('id', $request->paket_id)->firstOrFail();
        $skema = Skema::where('id', $request->skema_id)->firstOrFail();
        $paketSkema = PaketSkema::where('paket_id', $paket->id)->where('skema_id', $skema->id)->firstOrFail();
        $user = Auth::user();
        $pesanan = Pesanan::create([
            "id" => Uuid::uuid4()->toString(),
            "pengguna_id" => $user->id,
            "nama_paket" => $paket->nama_paket,
            "nama_skema" => $skema->nama_skema,
            "periode_hari" => $skema->periode_hari,
            "harga_satuan" => $paketSkema->harga,
            "kuantitas" => $request->kuantitas,
            "total_harga" => intval($paketSkema->harga)*intval($request->kuantitas),
            "total_periode_hari" => intval($skema->periode_hari)*intval($request->kuantitas),
            "tanggal_mulai" => $request->tanggal,
            "satuan" => $skema->satuan,
            "status_order" => "NEW"
        ]);

        return redirect('/pesan/detail/'.$pesanan->id);
        
    }

    public function detail(string $id) {

        $pesanan = Pesanan::findOrFail($id);

        return view('detail-pesanan', compact('pesanan'));


    }

    public function riwayat() {
        $user = Auth::user();

        $pesanan = Pesanan::select(['id', 'nama_paket', 'nama_skema', 'status_order', 'created_at'])->where('pengguna_id', $user->id)->orderBy('created_at')->get();

        return view('riwayat-pesanan', compact('pesanan'));
    }

}
