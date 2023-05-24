<?php

namespace app3s\controller;


use app3s\view\PainelKambanView;
use app3s\util\Sessao;
use app3s\dao\PainelKambanDAO;
use Illuminate\Support\Facades\DB;

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
        $listaAreas = DB::table('area_responsavel')->get();
        echo view('admin.kamban-panel.filter', ['departments' =>  $listaAreas]);
        echo '
        <div class="card mb-4">
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
        if (!isset($_GET['setores']) || $_GET['setores'] === "") {
            echo '<h3>Para ver o painel selecione os setores</h3>';
            return;
        }
        $arrStrSetores = explode(",", $_GET['setores']);
        if (count($arrStrSetores) === 0) {
            echo '<h3>Para ver o painel selecione os setores</h3>';
            return;
        }
        $filtro = 'AND( area_responsavel.id = ' . implode(" OR area_responsavel.id = ", $arrStrSetores) . ' )';


        $pendentes = $this->dao->pesquisaKamban($this->arrayStatusPendente(), $filtro);
        $finalizados = $this->dao->pesquisaKamban($this->arrayStatusFinalizado(), $filtro);



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
