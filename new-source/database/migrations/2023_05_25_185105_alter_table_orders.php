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

        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('id_area_responsavel', 'division_id');
            $table->renameColumn('id_servico', 'service_id');
            $table->renameColumn('id_usuario_cliente', 'client_user_id');
            $table->renameColumn('id_usuario_atendente', 'provider_user_id');
            $table->renameColumn('id_usuario_indicado', 'assigned_user_id');
            $table->renameColumn('id_local', 'division_sig_id');
            $table->dropColumn('prioridade');
            $table->renameColumn('descricao', 'description');
            $table->renameColumn('patrimonio', 'tag');
            $table->renameColumn('local', 'division_sig');
            $table->renameColumn('solucao', 'solution');
            $table->renameColumn('data_abertura', 'created_at');
            $table->renameColumn('data_atendimento', 'service_at');
            $table->renameColumn('data_fechamento', 'finished_at');
            $table->renameColumn('data_fechamento_confirmado', 'confirmed_at');
            $table->renameColumn('avaliacao', 'rating');

            $table->renameColumn('ramal', 'phone_number');
            $table->renameColumn('anexo', 'attachment');
            $table->renameColumn('local_sala', 'place');
            $table->timestamp('updated_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->renameColumn('division_id', 'id_area_responsavel');
            $table->renameColumn('service_id', 'id_servico');
            $table->renameColumn('client_user_id', 'id_usuario_cliente');
            $table->renameColumn('division_sig_id', 'id_local');
            $table->char('prioridade', 1)->after('solucao')->nullable();
            $table->renameColumn('description', 'descricao');
            $table->renameColumn('tag', 'patrimonio');
            $table->renameColumn('division', 'local');
            $table->renameColumn('solution', 'solucao');
            $table->renameColumn('created_at', 'data_abertura');
            $table->renameColumn('service_at', 'data_atendimento');
            $table->renameColumn('finished_at', 'data_fechamento');
            $table->renameColumn('confirmed_at', 'data_fechamento_confirmado');
            $table->renameColumn('rating', 'avaliacao');
            $table->renameColumn('provider_user_id', 'id_usuario_atendente');
            $table->renameColumn('assigned_user_id', 'id_usuario_indicado');
            $table->renameColumn('phone_number', 'ramal');
            $table->renameColumn('attachment', 'anexo');
            $table->renameColumn('place', 'local_sala');
            $table->dropColumn('updated_at');
        });
    }
};
