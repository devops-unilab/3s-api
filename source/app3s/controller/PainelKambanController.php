<?php

namespace app3s\controller;


use app3s\view\PainelKambanView;
use app3s\model\Ocorrencia;
use app3s\util\Sessao;
use app3s\dao\PainelKambanDAO;
use app3s\dao\AreaResponsavelDAO;

class PainelKambanController
{

    private $view;
    private $dao;
    public function __construct()
    {
        $this->view = new PainelKambanView();
        $this->dao = new PainelKambanDAO();
    }


    public function main()
    {
        $areaDao = new AreaResponsavelDAO($this->dao->getConnection());
        $listaAreas = $areaDao->fetch();


        echo '

<div class="card mb-4">
        <div class="card-header pb-4 mb-4 font-italic">
                    Painel Kamban';

        $this->view->formFiltro($listaAreas);

        echo '
                <button id="btn-expandir-tela" type="button" class="float-right btn ml-3 btn-warning btn-circle btn-lg collapsed"><i class="fa fa-expand icone-maior"></i></button>
            </div>
            <div class="card-body" id="quadro-kamban">';
        $this->quadroKamban();
        echo '
	</div>
</div>




';
    }

    public function arrayStatusPendente()
    {
        $arrStatus = array();
        $arrStatus[] = StatusOcorrenciaController::STATUS_ABERTO;
        $arrStatus[] = StatusOcorrenciaController::STATUS_AGUARDANDO_ATIVO;
        $arrStatus[] = StatusOcorrenciaController::STATUS_AGUARDANDO_USUARIO;
        $arrStatus[] = StatusOcorrenciaController::STATUS_ATENDIMENTO;
        $arrStatus[] = StatusOcorrenciaController::STATUS_REABERTO;
        $arrStatus[] = StatusOcorrenciaController::STATUS_RESERVADO;
        return $arrStatus;
    }

    public function arrayStatusFinalizado()
    {

        $arrStatus = array();
        $arrStatus[] = StatusOcorrenciaController::STATUS_FECHADO;
        $arrStatus[] = StatusOcorrenciaController::STATUS_FECHADO_CONFIRMADO;
        $arrStatus[] = StatusOcorrenciaController::STATUS_CANCELADO;
        return $arrStatus;
    }
    public function quadroKamban()
    {
        $sessao = new Sessao();
        if (
            $sessao->getNivelAcesso() != Sessao::NIVEL_TECNICO
            &&
            $sessao->getNivelAcesso() != Sessao::NIVEL_ADM
        ) {
            echo "Acesso Negado";
            return;
        }
        $filtro = "";
        if (isset($_GET['setores'])) {
            $arrStrSetores = explode(",", $_GET['setores']);
            $filtro = 'AND( area_responsavel.id = ' . implode(" OR area_responsavel.id = ", $arrStrSetores) . ' )';
        }




        $ocorrencia = new Ocorrencia();
        $matrixStatus = array();
        $pendentes = $this->dao->pesquisaKamban($ocorrencia, $this->arrayStatusPendente(), $matrixStatus, $filtro);
        $finalizados = $this->dao->pesquisaKamban($ocorrencia, $this->arrayStatusFinalizado(), $matrixStatus, $filtro);



        $lista = array_merge($pendentes['ocorrencias'], $finalizados['ocorrencias']);
        $atendentes = array();
        foreach ($pendentes['responsaveis'] as $chave => $valor) {
            $atendentes[$chave] = $valor;
        }
        foreach ($finalizados['responsaveis'] as $chave => $valor) {
            $atendentes[$chave] = $valor;
        }

        $this->view->mostrarQuadro($lista, $atendentes);
    }
}
