<?php

use App\Enums\CDS;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->primary(['centro', 'fecha', 'chofers_id', 'movils_id', 'viaje']);
            $table->enum('centro', CDS::toArray())->index();
            $table->date('fecha')->useCurrent()->index();
            $table->unsignedBigInteger('chofers_id');
            $table->unsignedBigInteger('movils_id');
            $table->unsignedBigInteger('viaje');
            $table->time('hora_esperada')->nullable();
            $table->boolean('corresponde');

            $table->foreign(['centro', 'chofers_id'])->references(['centro', 'id'])->on('chofers');
            $table->foreign(['centro', 'movils_id'])->references(['centro', 'id'])->on('movils');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
