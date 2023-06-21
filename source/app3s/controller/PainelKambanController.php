<?php

namespace app3s\controller;


use app3s\view\PainelKambanView;
use app3s\model\Ocorrencia;
use app3s\util\Sessao;
use app3s\dao\PainelKambanDAO;
use app3s\dao\AreaResponsavelDAO;
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
        $divisions = DB::table('area_responsavel')->get();

        echo '<div class="card mb-4">';


        echo view('partials.form-filter-kamban', ['divisions' => $divisions]);
        echo '

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
        $arrStatus[] = OcorrenciaController::STATUS_ABERTO;
        $arrStatus[] = OcorrenciaController::STATUS_AGUARDANDO_ATIVO;
        $arrStatus[] = OcorrenciaController::STATUS_AGUARDANDO_USUARIO;
        $arrStatus[] = OcorrenciaController::STATUS_ATENDIMENTO;
        $arrStatus[] = OcorrenciaController::STATUS_REABERTO;
        $arrStatus[] = OcorrenciaController::STATUS_RESERVADO;
        return $arrStatus;
    }

    public function arrayStatusFinalizado()
    {

        $arrStatus = array();
        $arrStatus[] = OcorrenciaController::STATUS_FECHADO;
        $arrStatus[] = OcorrenciaController::STATUS_FECHADO_CONFIRMADO;
        $arrStatus[] = OcorrenciaController::STATUS_CANCELADO;
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
