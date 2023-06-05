<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->renameColumn('id_ocorrencia', 'order_id');
            $table->renameColumn('id_status', 'status');
            $table->renameColumn('mensagem', 'message');
            $table->renameColumn('id_usuario', 'user_id');
            $table->renameColumn('data_mudanca', 'created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->renameColumn('order_id', 'id_ocorrencia');
            $table->renameColumn('status', 'id_status');
            $table->renameColumn('message', 'mensagem');
            $table->renameColumn('user_id', 'id_usuario');
            $table->renameColumn('created_at', 'data_mudanca');
            $table->dropColumn('updated_at');
        });

    }

};
