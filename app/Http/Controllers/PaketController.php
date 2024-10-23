<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    
    public function detail(string $slug) {
        $paket = Paket::with('skema')->where('slug', $slug)->firstOrFail();
        $foto = $paket->foto;
        
        return view('detail-paket', compact('paket', 'foto'));
    }

}
