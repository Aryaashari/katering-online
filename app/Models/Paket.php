<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

class Paket extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'paket';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = ['created_at'];

    protected $casts = [
        'foto' => 'array'
    ];

    
    public function skema() {
        return $this->belongsToMany(Skema::class, 'paket_skema', 'paket_id', 'skema_id')->withPivot(['deskripsi', 'harga']);
    }

    public function paketSkema() {
        return $this->hasMany(PaketSkema::class);
    }
}
