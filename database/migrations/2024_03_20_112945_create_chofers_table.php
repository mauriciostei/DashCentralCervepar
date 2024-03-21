<?php

use App\Enums\CDS;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chofers', function (Blueprint $table) {
            $table->primary(['centro', 'id']);
            $table->enum('centro', CDS::toArray())->index();
            $table->integer('id')->unsigned()->index();
            $table->unsignedBigInteger('tiers_id')->index();
            $table->string('nombre');
            $table->integer('documento')->unsigned();
            $table->string('operadora')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chofers');
    }
};
