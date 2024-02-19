<?php

use App\Enums\CDS;
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
        Schema::create('current_data', function (Blueprint $table) {
            $table->id();
            
            $table->string('centro')->index();
            $table->string('movil')->index();
            $table->string('operador')->index();
            $table->string('punto')->index();
            $table->timestamp('inicio')->index();
            $table->timestamp('primer_punto')->index();
            $table->time('tiempo_tma');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_data');
    }
};
