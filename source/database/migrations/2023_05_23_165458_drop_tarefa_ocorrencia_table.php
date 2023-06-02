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
        Schema::dropIfExists('tarefa_ocorrencia');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('tarefa_ocorrencia', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ocorrencia');
            $table->integer('tarefa');
            $table->integer('id_usuario');
            $table->timestamp('data_inclusao');
        });
    }
};
