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
        Schema::create('paket_skema', function (Blueprint $table) {
            $table->id();
            $table->uuid('paket_id');
            $table->uuid('skema_id');
            $table->text('deskripsi');
            $table->string('harga');
            $table->foreign('paket_id')->references('id')->on('paket')->cascadeOnDelete();
            $table->foreign('skema_id')->references('id')->on('skema')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_skema');
    }
};
