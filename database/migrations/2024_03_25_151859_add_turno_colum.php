<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recorridos', function (Blueprint $table) {
            $table->enum('turno', ['Noche', 'Mañana', 'Tarde'])->default('Mañana');
        });
    }

    public function down(): void
    {
        Schema::table('recorridos', function (Blueprint $table) {
            $table->dropColumn(['turno']);
        });
    }
};
