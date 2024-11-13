<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    
    public function detail(string $slug) {
        $paket = Paket::with('skema')->where('slug', $slug)->firstOrFail();
        
        return view('detail-paket', compact('paket'));
    }

}
