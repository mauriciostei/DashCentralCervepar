<?php

use App\Enums\CDS;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->primary(['centro', 'id']);
            $table->enum('centro', CDS::toArray())->index();
            $table->integer('id')->unsigned()->index();
            $table->string('nombre');
            $table->time('minimo');
            $table->time('maximo');
            $table->boolean('tiempos_financieros');
            $table->string('tipo_tiempo');
            $table->boolean('tiempos_fisicos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puntos');
    }
};
