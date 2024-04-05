<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->unsignedBigInteger('ayudantes_id')->nullable();
            $table->foreign(['centro', 'ayudantes_id'])->references(['centro', 'id'])->on('ayudantes');
        });
    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('ayudantes_id');
            $table->dropColumn(['ayudantes_id']);
        });
    }
};
