<?php

/**
 * Classe de visao para Chamado
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace app3s\view;

use app3s\controller\OcorrenciaController;
use app3s\model\Ocorrencia;
use app3s\dao\UsuarioDAO;


class PainelKambanView
{

    private $matrixStatus;
    private $dao;

    public function mostrarQuadro($listaDeChamados, $atendentes = array())
    {
        $this->dao = new UsuarioDAO();
        $this->matrixStatus = array();

        echo '

<div class="container-fluid pt-3" >
    <div class="row flex-row flex-sm-nowrap py-3">';
        echo '
        <div class="col-sm-6 col-md-4 col-xl-4">';

        echo '
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-truncate py-2">Chamados Abertos</h6>
                    <div class="items border border-light">';
        echo '
                        <div class="row">';



        foreach ($listaDeChamados as $chamado) {
            if (
                $chamado->getStatus() == OcorrenciaController::STATUS_ABERTO
                || $chamado->getStatus() == OcorrenciaController::STATUS_REABERTO
                || $chamado->getStatus() == OcorrenciaController::STATUS_RESERVADO
            ) {
                $this->exibirCartao($chamado, null, $atendentes);
            }
        }


        echo '
                        </div>';
        echo '
                    </div>
                </div>
            </div>
        </div>';

        echo '<div class="col-sm-6 col-md-4 col-xl-4">';
        echo '<div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-truncate py-2">Em Atendimento</h6>
                    <div class="items border border-light">';


        echo '
                <div class="row">';


        foreach ($listaDeChamados as $chamado) {
            if (
                $chamado->getStatus() == OcorrenciaController::STATUS_ATENDIMENTO
                || $chamado->getStatus() == OcorrenciaController::STATUS_EM_ESPERA
                ||  $chamado->getStatus() == OcorrenciaController::STATUS_AGUARDANDO_ATIVO
                ||  $chamado->getStatus() == OcorrenciaController::STATUS_AGUARDANDO_USUARIO
            ) {
                $this->exibirCartao($chamado, null, $atendentes);
            }
        }

        echo '</div>';


        echo '
                    </div>
                </div>
            </div>
        </div>';

        echo '<div class="col-sm-6 col-md-4 col-xl-4">';
        echo '
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-truncate py-2">Fechado</h6>
                    <div class="items border border-light">';



        echo '
                <div class="row">';


        foreach ($listaDeChamados as $chamado) {
            if (
                $chamado->getStatus() == OcorrenciaController::STATUS_FECHADO
                || $chamado->getStatus() == OcorrenciaController::STATUS_FECHADO_CONFIRMADO
            ) {
                $this->exibirCartao($chamado, null,  $atendentes);
            }
        }

        echo '</div>';


        echo '

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
    }


    public function exibirCartao(Ocorrencia $chamado, $class = 6, $atendentes = array())
    {
        echo '<div class="col-sm-12 col-md-12 col-xl-6">';
        $bgCard = "";
        $link = "text-light font-weight-bold p-3";
        $texto = "text-black-50";

        switch ($chamado->getStatus()) {
            case OcorrenciaController::STATUS_ABERTO:
                $bgCard = 'bg-warning';
                $texto = "text-light";
                break;
            case OcorrenciaController::STATUS_ATENDIMENTO:
                $bgCard = 'bg-info';
                $texto = "text-light";
                break;
            case OcorrenciaController::STATUS_FECHADO:
                $bgCard = 'bg-success';
                $texto = "text-light";
                break;
            case OcorrenciaController::STATUS_FECHADO_CONFIRMADO:
                $bgCard = 'bg-success';
                $texto = "text-light";
                break;
            case OcorrenciaController::STATUS_CANCELADO:
                $bgCard = 'bg-light';
                $texto = "text-light";
                break;
            case OcorrenciaController::STATUS_RESERVADO:
                $bgCard = 'bg-secondary';
                $texto = "text-light";
                break;
            case OcorrenciaController::STATUS_EM_ESPERA:
                $bgCard = 'bg-secondary';
                $texto = "text-light";
                break;
            case OcorrenciaController::STATUS_AGUARDANDO_USUARIO:
                $bgCard = 'bg-secondary';
                $texto = "text-light";
                break;
            case OcorrenciaController::STATUS_AGUARDANDO_ATIVO:
                $bgCard = 'bg-danger';
                $texto = "text-light";
                break;
        }



        echo '
                        <div class="card draggable shadow-sm ' . $bgCard . '"  style="height: 260px;">
                            <div class="card-body p-2">
                                <div class="card-title">

                                    <a href="?page=ocorrencia&selecionar=' . $chamado->getId() . '" class="' . $link . '">
                                       #' . $chamado->getId() . '
                                    </a>';

        echo '

                                </div>
                                <p class="' . $texto . '">
                                   ' . substr($chamado->getDescricao(), 0, 75) . '[...]
                                </p>';


        $nome = explode(" ", $chamado->getUsuarioCliente()->getNome());
        echo '<small  class="' . $texto . '">Demandante: ';
        if (isset($nome[0])) {
            echo ucfirst(strtolower($nome[0]));
        }
        if (isset($nome[1])) {
            echo ' ' . ucfirst(strtolower($nome[1]));
        }



        echo ' </small><br>';
        echo '<small  class="' . $texto . '">' . $this->getStrStatus($chamado->getStatus()) . '</small>';



        if ($chamado->getStatus() == OcorrenciaController::STATUS_RESERVADO) {
            if ($chamado->getIdUsuarioIndicado() != null) {
                $nome = $atendentes[$chamado->getIdUsuarioIndicado()]->getNome();
                $nome = explode(" ", $nome);
                echo '<br><small class="' . $texto . '">Responsável: ' . ucfirst(strtolower($nome[0])) . ' ' . ucfirst(strtolower($nome[1])) . '</small>';
            }
        } else if ($chamado->getStatus() != OcorrenciaController::STATUS_ABERTO) {
            if ($chamado->getIdUsuarioAtendente() != null) {
                $nome = $atendentes[$chamado->getIdUsuarioAtendente()]->getNome();
                $nome = explode(" ", $nome);
                echo '<br><small class="' . $texto . '">Responsável: ' . ucfirst(strtolower($nome[0])) . ' ' . ucfirst(strtolower($nome[1])) . '</small>';
            }
        }



        echo '<br><small class="' . $texto . '">Aberto em ' . date("d/m/Y G:i:s", strtotime($chamado->getDataAbertura())) . ' </small>';


        if ($chamado->getDataFechamento() != null) {
            echo '<br><small class="' . $texto . '">Fechado em ' . date("d/m/Y G:i:s", strtotime($chamado->getDataFechamento())) . ' </small>';
        }



        echo '
                            </div>
                        </div>
                        ';
        echo '</div>';
    }
    public function getStrStatus($status)
    {
        $strStatus = "Aberto";
        switch ($status) {
            case OcorrenciaController::STATUS_ABERTO:
                $strStatus = "Aberto";
                break;
            case OcorrenciaController::STATUS_ATENDIMENTO:
                $strStatus = "Em atendimento";
                break;
            case OcorrenciaController::STATUS_FECHADO:
                $strStatus = "Fechado";
                break;
            case OcorrenciaController::STATUS_FECHADO_CONFIRMADO:
                $strStatus = "Fechado Confirmado";
                break;
            case OcorrenciaController::STATUS_CANCELADO:
                $strStatus = "Cancelado";
                break;
            case OcorrenciaController::STATUS_REABERTO:
                $strStatus = "Reaberto";
                break;
            case OcorrenciaController::STATUS_RESERVADO:
                $strStatus = "Reservado";
                break;
            case OcorrenciaController::STATUS_EM_ESPERA:
                $strStatus = "Em espera";
                break;
            case OcorrenciaController::STATUS_AGUARDANDO_USUARIO:
                $strStatus = "Aguardando Usuário";
                break;
            case OcorrenciaController::STATUS_AGUARDANDO_ATIVO:
                $strStatus = "Aguardando ativo da DTI";
                break;
        }
        return $strStatus;
    }
}
