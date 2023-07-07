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
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('status', 'status_temp');
        });

        // Criar uma nova coluna com o tipo enum
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['opened', 'pending customer response', 'reserved', 'closed', 'pending it resource', 'canceled', 'committed', 'in progress'])->nullable();
        });

        // Preencher os valores da nova coluna com base na coluna temporária
        DB::table('orders')->update([
            'status' => DB::raw("CASE
                WHEN status_temp = 'a' THEN 'opened'
                WHEN status_temp = 'r' THEN 'opened'
                WHEN status_temp = 'c' THEN 'opened'
                WHEN status_temp = 'd' THEN 'pending customer response'
                WHEN status_temp = 'b' THEN 'reserved'
                WHEN status_temp = 'g' THEN 'committed'
                WHEN status_temp = 'i' THEN 'pending it resource'
                WHEN status_temp = 'h' THEN 'canceled'
                WHEN status_temp = 'f' THEN 'closed'
                WHEN status_temp = 'e' THEN 'in progress'
            END"),
        ]);

        // Remover a coluna temporária
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status_temp');
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
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('status', 'status_temp');
            $table->string('status')->nullable();
        });

        DB::table('orders')->update([
            'status' => DB::raw("CASE
                WHEN status_temp = 'opened' THEN 'a'
                WHEN status_temp = 'pending customer response' THEN 'd'
                WHEN status_temp = 'reserved' THEN 'b'
                WHEN status_temp = 'closed' THEN 'f'
                WHEN status_temp = 'pending it resource' THEN 'i'
                WHEN status_temp = 'canceled' THEN 'h'
                WHEN status_temp = 'committed' THEN 'g'
                WHEN status_temp = 'in progress' THEN 'e'
            END"),
        ]);

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status_temp');
        });
    }
};
