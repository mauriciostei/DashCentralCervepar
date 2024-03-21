<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('puntos', function (Blueprint $table) {
            $table->boolean('ruta')->default('false');
            $table->boolean('liquidacion')->default('false');
            $table->boolean('caja')->default('false');
            $table->boolean('warehouse')->default('false');
            $table->boolean('desplazamiento')->default('false');
            $table->boolean('espera')->default('false');
            $table->boolean('atendimiento')->default('false');
        });
    }

    public function down(): void
    {
        Schema::table('puntos', function (Blueprint $table) {
            $table->dropColumn(['ruta', 'liquidacion', 'caja', 'warehouse', 'desplazamiento', 'espera', 'atendimiento']);
        });
    }
};
