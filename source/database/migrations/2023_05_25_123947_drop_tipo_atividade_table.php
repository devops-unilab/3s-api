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
        Schema::table('tipo_atividade', function (Blueprint $table) {
            Schema::dropIfExists('tipo_atividade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('tipo_atividade', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nome');
        });
    }
};
