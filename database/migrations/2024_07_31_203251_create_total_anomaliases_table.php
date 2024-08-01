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
        Schema::create('total_anomaliases', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->primary(['centro', 'fecha']);
            $table->enum('centro', CDS::toArray())->index();
            $table->date('fecha')->useCurrent()->index();
            $table->integer('total')->unsigned();
            $table->integer('tratadas')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_anomaliases');
    }
};
