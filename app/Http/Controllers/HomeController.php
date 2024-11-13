<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index() {
        $paket = Paket::query()->with(['skema' => function($query) {
            $query->where('periode_hari', '30')->first();
        }])->get();

        return view('index', compact('paket'));
    }

}
