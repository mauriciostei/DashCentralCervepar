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
        Schema::create('jornada_warehouses', function (Blueprint $table) {
            $table->primary(['centro', 'id']);
            $table->enum('centro', CDS::toArray())->index();
            $table->integer('id')->unsigned()->index();

            $table->unsignedBigInteger('colaboradores_id');
            $table->unsignedBigInteger('puntos_id');
            $table->date('fecha');
            $table->dateTime('fecha_hora');

            $table->foreign(['centro', 'colaboradores_id'])->references(['centro', 'id'])->on('colaboradores');
            $table->foreign(['centro', 'puntos_id'])->references(['centro', 'id'])->on('puntos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jornada_warehouses');
    }
};
