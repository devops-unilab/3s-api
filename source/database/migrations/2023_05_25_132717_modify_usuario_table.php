<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->renameColumn('senha', 'password');
            $table->renameColumn('nome', 'name');
            $table->renameColumn('id_setor', 'division_id');
            $table->renameColumn('nivel', 'role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->renameColumn('password', 'senha');
            $table->renameColumn('name', 'nome');
            $table->renameColumn('division_id', 'id_setor');
            $table->renameColumn('role', 'nivel');
            $table->dropColumn(['email_verified_at', 'remember_token']);
            $table->dropTimestamps();
        });
    }
};
