<?php

/**
 * Classe feita para manipulação do objeto MensagemForumApiRestController
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\OcorrenciaDAO;
use app3s\model\Ocorrencia;
use Illuminate\Support\Facades\DB;

class MensagemForumApiRestController
{

    public function main()
    {
        header('Content-type: application/json');
        $this->get();
    }

    public function get()
    {

        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            return;
        }

        if (!isset($_REQUEST['api'])) {
            return;
        }

        $url = explode("/", $_REQUEST['api']);
        if (count($url) == 0 || $url[0] == "") {
            return;
        }
        if (!isset($url[1])) {
            return;
        }
        if ($url[1] != 'mensagem_forum') {
            return;
        }
        if (!isset($url[2])) {
            return;
        }
        if (isset($url[2]) == "") {
            return;
        }

        $id = intval($url[2]);

        $ocorrencia = new Ocorrencia();
        $ocorrencia->setId($id);
        $ocorrenciaDao = new OcorrenciaDAO();
        $ocorrenciaDao->fillById($ocorrencia);


        $messageQuery = DB::table('mensagem_forum')
            ->join('usuario', 'mensagem_forum.id_usuario', '=', 'usuario.id')
            ->join('ocorrencia', 'mensagem_forum.id_ocorrencia', '=', 'ocorrencia.id')
            ->select(
                'mensagem_forum.id as id',
                'usuario.id as user_id',
                'usuario.nome as user_name',
                'mensagem_forum.tipo as message_type',
                'mensagem_forum.mensagem as message_content',
                'mensagem_forum.data_envio as created_at',
                'ocorrencia.status as order_status'
            )
            ->where('mensagem_forum.id_ocorrencia', $id)
            ->orderBy('mensagem_forum.id');


        if (isset($url[3]) && $url[3] != '') {
            $idM = intval($url[3]);
            $messageQuery = $messageQuery->where('mensagem_forum.id', '>', $idM);
        }
        $list = $messageQuery->get();

        if (count($list) == 0) {
            echo "{}";
            return;
        }

        $listagem = array();
        foreach ($list as $linha) {
            $listagem[] = array(
                'id' => $linha->id,
                'tipo' => $linha->message_type,
                'mensagem' => strip_tags($linha->message_content),
                'data_envio' => $linha->created_at,
                'nome_usuario' => $linha->user_name
            );
        }
        echo json_encode($listagem);
    }
}
