<?php

/**
 * Classe feita para manipulação do objeto MensagemForumApiRestController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\MensagemForumDAO;
use app3s\util\Sessao;
use app3s\dao\OcorrenciaDAO;
use app3s\model\Ocorrencia;

class MensagemForumApiRestController
{


    protected $dao;

    public function __construct()
    {
        $this->dao = new MensagemForumDAO();
    }

    public function main()
    {
        $sessao = new Sessao();
        if ($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO) {
            return;
        }
        header('Content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            return;
        }

        if (!isset($_REQUEST['api'])) {
            return;
        }
        $this->get();
    }

    public function parteInteressada(Ocorrencia $selecionado)
    {
        $sessao = new Sessao();
        if ($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO || $sessao->getNivelAcesso() == Sessao::NIVEL_ADM) {
            return true;
        }
        if ($selecionado->getUsuarioCliente()->getId() == $sessao->getIdUsuario()) {
            return true;
        }
        return false;
    }

    public function get()
    {
        $url = explode("/", $_REQUEST['api']);

        $id = intval($url[2]);
        if ($id === 0) {
            return;
        }
        $ocorrencia = new Ocorrencia();
        $ocorrencia->setId($id);
        $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
        $ocorrenciaDao->fillById($ocorrencia);

        if (!$this->parteInteressada($ocorrencia)) {
            echo "{Acesso Negado}";
            return;
        }


        if (isset($url[3]) && $url[3] != '') {
            $idM = intval($url[3]);
            $ocorrenciaDao->fetchMensagensPag($ocorrencia, $idM);
        } else {
            $ocorrenciaDao->fetchMensagens($ocorrencia);
        }

        $list = $ocorrencia->getMensagens();

        if (count($list) == 0) {
            echo "{}";
            return;
        }


        $listagem = array();
        foreach ($list as $linha) {
            $listagem[] = array(
                'id' => $linha->getId(),
                'tipo' => $linha->getTipo(),
                'mensagem' => strip_tags($linha->getMensagem()),
                'data_envio' => $linha->getDataEnvio(),
                'nome_usuario' => $linha->getUsuario()->getNome()
            );
        }
        echo json_encode($listagem);
    }
}
