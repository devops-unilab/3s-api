<?php

/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace app3s\view;

use app3s\controller\StatusOcorrenciaController;
use app3s\dao\UsuarioDAO;
use app3s\model\Ocorrencia;
use app3s\model\Usuario;

class OcorrenciaView
{

    public function exibirListaPaginada($lista, $id = '')
    {
        $strId = "";
        if ($id != '') {
            $strId = " id = " . $id;
        }
        echo '


                   <div ' . $strId . ' class="alert-group">';

        $strClass = 'alert-warning';
        foreach ($lista as $elemento) {

            if ($elemento->getStatus() == 'a'
                || $elemento->getStatus() == 'r'
                || $elemento->getStatus() == 'b') {//aberto//reaberto//reservado
                $strClass = 'alert-warning';
            } elseif ($elemento->getStatus() == 'e') { //Em atendimento
                $strClass = 'alert-info';
            } elseif ($elemento->getStatus() == 'f') { //Fechado
                $strClass = 'alert-success';
            } elseif ($elemento->getStatus() == 'g') { //Fechado confirmado
                $strClass = 'alert-success';
            } elseif ($elemento->getStatus() == 'h') { //Cancelado
                $strClass = 'alert-secondary';
            } elseif ($elemento->getStatus() == 'c') { //em espera
                $strClass = 'alert-info';
            } elseif ($elemento->getStatus() == 'd') { //Aguardando usuario
                $strClass = ' alert-secondary';
            } elseif ($elemento->getStatus() == 'i') { //Aguardando ativo
                $strClass = 'alert-danger';
            }

            $descricao = "";
            $descricao = htmlspecialchars($elemento->getDescricao());
            if (strlen($descricao) > 200) {
                $descricao = substr($descricao, 0, 200) . '...';
            }
            echo '

            <div class="alert ' . $strClass . ' alert-dismissable">
                <a href="?page=ocorrencia&selecionar=' . $elemento->getId() . '"
                    class="close"><i class="fa fa-search icone-maior"></i></a>

                <strong>#' . $elemento->getId() . ' </strong>';
            echo $descricao;
            echo '</div>
                  ';
        }

        if (count($lista) == 0) {
            echo '

            <div class="alert alert-light alert-dismissable text-center">
                <strong>Nenhuma Ocorrência</strong>

            </div>
                  ';
        }
        echo '
                    </div>';
    }


    /**
     * Passe a sigla do status
     * @param string $status
     */
    public function getStrStatus($status)
    {
        $strStatus = "Aberto";
        switch ($status) {
            case StatusOcorrenciaController::STATUS_ABERTO:
                $strStatus = "Aberto";
                break;
            case StatusOcorrenciaController::STATUS_ATENDIMENTO:
                $strStatus = "Em atendimento";
                break;
            case StatusOcorrenciaController::STATUS_FECHADO:
                $strStatus = "Fechado";
                break;
            case StatusOcorrenciaController::STATUS_FECHADO_CONFIRMADO:
                $strStatus = "Fechado Confirmado";
                break;
            case StatusOcorrenciaController::STATUS_CANCELADO:
                $strStatus = "Cancelado";
                break;
            case StatusOcorrenciaController::STATUS_REABERTO:
                $strStatus = "Reaberto";
                break;
            case StatusOcorrenciaController::STATUS_RESERVADO:
                $strStatus = "Reservado";
                break;
            case StatusOcorrenciaController::STATUS_EM_ESPERA:
                $strStatus = "Em espera";
                break;
            case StatusOcorrenciaController::STATUS_AGUARDANDO_USUARIO:
                $strStatus = "Aguardando Usuário";
                break;
            case StatusOcorrenciaController::STATUS_AGUARDANDO_ATIVO:
                $strStatus = "Aguardando ativo da DTI";
                break;
            default:
                break;
        }
        return $strStatus;
    }



    /**
     *
     * @param Ocorrencia $ocorrencia
     * @param array:StatusOcorrencia $listaStatus
     */
    public function mostrarSelecionado2(Ocorrencia $ocorrencia)
    {
        $controller = new StatusOcorrenciaController();

        echo '
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                <div class="card mb-4">
                    <div class="card-body">
                    <b> Descricao: </b>' . strip_tags($ocorrencia->getDescricao()) . '<br>';

        if (trim($ocorrencia->getAnexo()) != "") {
            echo '<b>Anexo: </b>
                    <a target="_blank" href="uploads/' . $ocorrencia->getAnexo() . '">
                        Clique aqui
                    </a> <br>';
        }

        echo '


                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <b>Patrimônio: </b>' . strip_tags($ocorrencia->getPatrimonio()) . '<br>';




        if ($controller->possoEditarPatrimonio($ocorrencia)) {
            echo '<button id="botao-editar-patrimonio" type="button" acao="editar_patrimonio"
            class="dropdown-item text-right"
             data-toggle="modal" data-target="#modalStatus">
          Editar Patrimônio
        </button>';
        }

        echo '

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                    <b>Solucao: </b>' . strip_tags($ocorrencia->getSolucao()) . '<br>';




        if ($controller->possoEditarSolucao($ocorrencia)) {
            echo '
            <button id="botao-editar-solucao" type="button" acao="editar_solucao"
                class="dropdown-item text-right"
                 data-toggle="modal" data-target="#modalStatus">
              Editar Solução
            </button>';
        }

        echo '



                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <b>Classificação do Chamado: </b>' . $ocorrencia->getServico()->getNome() . '<br>';
        if ($controller->possoEditarServico($ocorrencia)) {
            echo '<button type="button" id="botao-editar-servico" acao="editar_servico"
            class="dropdown-item text-right"
            data-toggle="modal" data-target="#modalStatus">
          Editar Serviço
        </button>';
        }


        echo '
                    </div>
                </div>
            <div class="card mb-4">
                <div class="card-body">
                    <b>Requisitante: </b>' . $ocorrencia->getUsuarioCliente()->getNome() . ' <br>';
        if (trim($ocorrencia->getLocal()) != "") {
            echo ' <b>Setor do Requisitante:</b> ' . $ocorrencia->getLocal() . '<br>';
        }
        echo '
                    <b>Campus: </b>' . $ocorrencia->getCampus() . ' <br>
                    <b>Email: </b>' . $ocorrencia->getEmail() . ' <br> ';


        if (trim($ocorrencia->getLocalSala()) != "") {
            echo ' <b>Local/Sala: </b>' . $ocorrencia->getLocalSala() . '<br>';
        }
        if (trim($ocorrencia->getRamal()) != "") {
            echo '<b>Ramal: </b>' . $ocorrencia->getRamal() . '<br>';
        }

        echo '
                </div>
            </div>
        <div class="card mb-4">
            <div class="card-body">';
        echo '<b>Setor Responsável: </b>' . $ocorrencia->getAreaResponsavel()->getNome() .
            ' - ' . $ocorrencia->getAreaResponsavel()->getDescricao() . '<br>';

        $usuarioDao = new UsuarioDAO();



        if ($ocorrencia->getStatus() == StatusOcorrenciaController::STATUS_RESERVADO) {
            if ($ocorrencia->getIdUsuarioIndicado() != null) {
                $indicado = new Usuario();
                $indicado->setId($ocorrencia->getIdUsuarioIndicado());
                $usuarioDao->fillById($indicado);
                echo '<b>Técnico Responsável: </b>' . $indicado->getNome() . '<br>';
            }
        } else {
            if ($ocorrencia->getIdUsuarioAtendente() != null) {

                $atendente = new Usuario();
                $atendente->setId($ocorrencia->getIdUsuarioAtendente());
                $usuarioDao->fillById($atendente);
                echo '<b>Técnico Responsável:</b> ' . $atendente->getNome() . '<br>';
            }
        }

        if ($controller->possoEditarAreaResponsavel($ocorrencia)) {
            echo '
            <button id="botao-editar-area" type="button" acao="editar_area"
                class="dropdown-item text-right"
                 data-toggle="modal" data-target="#modalStatus">
              Editar Setor Responsável
            </button>';
        }

        echo '</div>
        </div></div></div>';
    }
}
