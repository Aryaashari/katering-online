<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = ['created_at'];

    public function pembayaran() {
        return $this->hasOne(Pembayaran::class);
    }

    public function pengguna() {
        return $this->belongsTo(User::class);
    }
}
