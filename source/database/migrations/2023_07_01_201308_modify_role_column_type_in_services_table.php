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
        Schema::table('services', function (Blueprint $table) {
            $table->renameColumn('role', 'role_temp');
        });

        // Criar uma nova coluna com o tipo string
        Schema::table('services', function (Blueprint $table) {
            $table->string('role', 255)->nullable();
        });

        // Preencher os valores da nova coluna com base na coluna temporária
        DB::table('services')->update([
            'role' => DB::raw("CASE
                WHEN role_temp = '0' THEN 'disabled'
                WHEN role_temp = '1' THEN 'customer'
                WHEN role_temp = '2' THEN 'provider'
            END"),
        ]);

        // Remover a coluna temporária
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('role_temp');
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
        Schema::table('services', function (Blueprint $table) {
            $table->renameColumn('role', 'role_temp');
            $table->integer('role')->nullable();
        });

        DB::table('services')->update([
            'role' => DB::raw("CASE
                WHEN role_temp = 'disabled' THEN '0'
                WHEN role_temp = 'customer' THEN '1'
                WHEN role_temp = 'provider' THEN '2'
            END"),
        ]);

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('role_temp');
        });
    }
};
