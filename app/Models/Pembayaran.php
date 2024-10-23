<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['created_at'];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class);
    }
}
