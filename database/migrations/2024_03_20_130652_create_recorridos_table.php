<?php

use App\Enums\CDS;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recorridos', function (Blueprint $table) {
            $table->primary(['centro', 'fecha', 'chofers_id', 'movils_id', 'puntos_id', 'tiers_id', 'viaje']);
            $table->enum('centro', CDS::toArray())->index();
            $table->date('fecha')->useCurrent()->index();
            $table->unsignedBigInteger('chofers_id');
            $table->unsignedBigInteger('movils_id');
            $table->unsignedBigInteger('puntos_id');
            $table->unsignedBigInteger('tiers_id');
            $table->unsignedBigInteger('viaje');

            $table->dateTime('inicio');
            $table->dateTime('target');
            $table->dateTime('ponderacion');
            $table->dateTime('fin')->nullable();
            $table->string('estado');

            $table->foreign(['centro', 'chofers_id'])->references(['centro', 'id'])->on('chofers');
            $table->foreign(['centro', 'movils_id'])->references(['centro', 'id'])->on('movils');
            $table->foreign(['centro', 'puntos_id'])->references(['centro', 'id'])->on('puntos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recorridos');
    }
};
