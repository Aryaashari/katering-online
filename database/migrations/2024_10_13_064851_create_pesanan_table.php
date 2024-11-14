<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('pengguna_id')->nullable();
            $table->string('nama_paket');
            $table->string('nama_skema');
            $table->string('periode');
            $table->string('harga_satuan');
            $table->unsignedInteger('kuantitas_periode');
            $table->unsignedInteger('kuantitas_orang');
            $table->string('total_harga');
            $table->date('tanggal_mulai');
            $table->string('status_order');

            $table->foreign('pengguna_id')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
