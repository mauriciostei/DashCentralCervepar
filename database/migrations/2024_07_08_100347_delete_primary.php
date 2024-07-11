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
        Schema::table('recorridos', function (Blueprint $table) {
            $table->dropPrimary();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recorridos', function (Blueprint $table) {
            $table->primary(['centro', 'fecha', 'chofers_id', 'movils_id', 'puntos_id', 'tiers_id', 'viaje']);
        });
    }
};
