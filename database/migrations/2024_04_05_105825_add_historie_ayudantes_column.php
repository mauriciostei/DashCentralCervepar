<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->string('ayudante')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropColumn(['ayudante']);
        });
    }
};
