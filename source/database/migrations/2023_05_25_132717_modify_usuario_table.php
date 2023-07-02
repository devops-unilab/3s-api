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
            $table->renameColumn('senha', 'password')->nullable();
            $table->renameColumn('nome', 'name');
            $table->renameColumn('id_setor', 'division_id')->nullable();
            $table->string('division_sig')->nullable();
            $table->integer('division_sig_id')->nullable();
            $table->renameColumn('nivel', 'role')->nullable();
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
            $table->renameColumn('password', 'senha')->nullable();;
            $table->renameColumn('name', 'nome')->nullable();
            $table->renameColumn('division_id', 'id_setor')->nullable();
            $table->renameColumn('role', 'nivel')->nullable();
            $table->dropColumn(['email_verified_at', 'remember_token', 'division_sig', 'division_sig_id']);
            $table->dropTimestamps();
        });
    }
};
