<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('mensagem_forum', 'order_messages');

        Schema::table('order_messages', function (Blueprint $table) {
            $table->renameColumn('id_ocorrencia', 'order_id');
            $table->renameColumn('tipo', 'type');
            $table->renameColumn('mensagem', 'message');
            $table->renameColumn('id_usuario', 'user_id');
            $table->renameColumn('data_envio', 'created_at');
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
        Schema::table('order_messages', function (Blueprint $table) {
            $table->renameColumn('order_id', 'id_ocorrencia');
            $table->renameColumn('type', 'tipo');
            $table->renameColumn('message', 'mensagem');
            $table->renameColumn('user_id', 'id_usuario');
            $table->renameColumn('created_at', 'data_envio');
            $table->dropColumn('updated_at');
        });

        Schema::rename('order_messages', 'mensagem_forum');
    }
};
