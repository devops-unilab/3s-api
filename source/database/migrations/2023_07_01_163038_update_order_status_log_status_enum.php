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
        // // Renomear a coluna existente para uma coluna temporária
        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->renameColumn('status', 'status_temp');
        });

        // Criar uma nova coluna com o tipo enum
        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->enum('status', ['opened', 'pending customer response', 'reserved', 'closed', 'pending it resource', 'canceled', 'committed', 'in progress'])->nullable();
        });

        // Preencher os valores da nova coluna com base na coluna temporária
        DB::table('order_status_logs')->update([
            'status' => DB::raw("CASE
                WHEN status_temp = '2' THEN 'opened'
                WHEN status_temp = '7' THEN 'opened'
                WHEN status_temp = '8' THEN 'opened'
                WHEN status_temp = '10' THEN 'pending customer response'
                WHEN status_temp = '1' THEN 'reserved'
                WHEN status_temp = '5' THEN 'closed'
                WHEN status_temp = '9' THEN 'pending it resource'
                WHEN status_temp = '6' THEN 'canceled'
                WHEN status_temp = '4' THEN 'committed'
                WHEN status_temp = '3' THEN 'in progress'
            END"),
        ]);

        // Remover a coluna temporária
        Schema::table('order_status_logs', function (Blueprint $table) {
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
        // // Reverter as alterações em caso de rollback
        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->renameColumn('status', 'status_temp');
            $table->string('status')->nullable();
        });

        DB::table('order_status_logs')->update([
            'status' => DB::raw("CASE
                WHEN status_temp = 'opened' THEN '2'
                WHEN status_temp = 'pending customer response' THEN '10'
                WHEN status_temp = 'reserved' THEN '1'
                WHEN status_temp = 'closed' THEN '5'
                WHEN status_temp = 'pending it resource' THEN '9'
                WHEN status_temp = 'canceled' THEN '6'
                WHEN status_temp = 'committed' THEN '4'
                WHEN status_temp = 'in progress' THEN '3'
            END"),
        ]);

        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->dropColumn('status_temp');
        });
    }
};
