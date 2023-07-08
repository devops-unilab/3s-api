<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Renomear a coluna existente para uma coluna temporária
        Schema::table('order_messages', function (Blueprint $table) {
            $table->renameColumn('type', 'type_temp');
        });

        // Criar uma nova coluna com o tipo string
        Schema::table('order_messages', function (Blueprint $table) {
            $table->string('type', 255)->nullable();
        });

        // Preencher os valores da nova coluna com base na coluna temporária
        DB::table('order_messages')->update([
            'type' => DB::raw("CASE
                WHEN type_temp = '1' THEN 'text'
                WHEN type_temp = '2' THEN 'file'
            END"),
        ]);

        // Remover a coluna temporária
        Schema::table('order_messages', function (Blueprint $table) {
            $table->dropColumn('type_temp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reverter as alterações em caso de rollback
        Schema::table('order_messages', function (Blueprint $table) {
            $table->renameColumn('type', 'type_temp');
            $table->integer('type')->nullable();
        });

        DB::table('order_messages')->update([
            'type' => DB::raw("CASE
                WHEN type_temp = 'text' THEN '1'
                WHEN type_temp = 'file' THEN '2'
            END"),
        ]);

        Schema::table('order_messages', function (Blueprint $table) {
            $table->dropColumn('type_temp');
        });
    }
};
