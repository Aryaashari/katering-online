<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'skema';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = ['created_at'];

    public function paket() {
        return $this->belongsToMany(Paket::class, 'paket_skema', 'skema_id', 'paket_id')->withPivot(['deskripsi', 'harga']);
    }
}
