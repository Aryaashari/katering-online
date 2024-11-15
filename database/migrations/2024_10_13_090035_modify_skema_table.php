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
        Schema::table('skema', function (Blueprint $table) {
            $table->renameColumn('periode', 'periode_hari');
            $table->string('satuan')->after('periode_hari'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skema', function (Blueprint $table) {
            $table->renameColumn('periode_hari', 'periode');
            $table->dropColumn('satuan');
        });
    }
};
