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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('centro');
            $table->string('movil');
            $table->string('chofer');
            $table->string('punto');
            $table->integer('viaje');
            $table->date('fecha');
            $table->dateTime('inicio');
            $table->dateTime('fin');
            $table->dateTime('target');
            $table->dateTime('ponderacion');
            $table->string('estado');
            $table->string('aplica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
