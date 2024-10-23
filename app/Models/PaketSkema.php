<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PaketSkema extends Pivot
{
    use HasFactory;

    protected $table = 'paket_skema';

    protected $guarded = ['created_at'];

    public function paket() {
        return $this->belongsTo(Paket::class);
    }

    public function skema() {
        return $this->belongsTo(Skema::class);
    }
}
