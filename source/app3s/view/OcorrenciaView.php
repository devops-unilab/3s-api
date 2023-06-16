<?php

/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace app3s\view;

use DateTime;
use app3s\controller\StatusOcorrenciaController;
use app3s\dao\UsuarioDAO;
use app3s\model\Ocorrencia;
use app3s\model\Usuario;
use app3s\util\Sessao;
use Illuminate\Support\Facades\DB;

class OcorrenciaView
{


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
        }
        return $strStatus;
    }



    /**
     *
     * @param Ocorrencia $ocorrencia
     * @param array:StatusOcorrencia $listaStatus
     */
    public function mostrarSelecionado2(Ocorrencia $ocorrencia, $listaStatus, $dataAbertura, $dataSolucao)
    {
        $controller = new StatusOcorrenciaController();

        echo '



            <div class="row">';
        echo '
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    ';

        echo '
                <div class="card mb-4">
                    <div class="card-body">';
        echo '
                   <b> Descricao: </b>' . strip_tags($ocorrencia->getDescricao()) . '<br>';








        if (trim($ocorrencia->getAnexo()) != "") {
            echo '<b>Anexo: </b><a target="_blank" href="uploads/' . $ocorrencia->getAnexo() . '"> Clique aqui</a> <br>';
        }

        echo '


                    </div>
                </div>


';

        echo '
                <div class="card mb-4">
                    <div class="card-body">';

        echo '<b>Patrimônio: </b>' . strip_tags($ocorrencia->getPatrimonio()) . '<br>';




        if ($controller->possoEditarPatrimonio($ocorrencia)) {
            echo '<button id="botao-editar-patrimonio" type="button" acao="editar_patrimonio"  class="dropdown-item text-right"   data-toggle="modal" data-target="#modalStatus">
  Editar Patrimônio
</button>';
        }

        echo '

                    </div>
                </div>


';


        echo '
                <div class="card mb-4">
                    <div class="card-body">';

        echo '<b>Solucao: </b>' . strip_tags($ocorrencia->getSolucao()) . '<br>';




        if ($controller->possoEditarSolucao($ocorrencia)) {
            echo '<button id="botao-editar-solucao" type="button" acao="editar_solucao"  class="dropdown-item text-right"   data-toggle="modal" data-target="#modalStatus">
  Editar Solução
</button>';
        }

        echo '



                    </div>
                </div>


';



        echo '
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    ';
        echo '
                <div class="card mb-4">
                    <div class="card-body">
                        <b>Classificação do Chamado: </b>' . $ocorrencia->getServico()->getNome() . '<br>';
        if ($controller->possoEditarServico($ocorrencia)) {
            echo '<button type="button" id="botao-editar-servico" acao="editar_servico"  class="dropdown-item text-right"  data-toggle="modal" data-target="#modalStatus">
  Editar Serviço
</button>';
        }
        echo '<hr>';
        $order = DB::table('ocorrencia')->where('id', $ocorrencia->getId())->first();
        $this->painelSLA($ocorrencia, $dataAbertura, $dataSolucao, $order);

        echo '
                    </div>
                </div>

';
        echo '

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
            </div>';


        echo '

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
            echo '<!-- Button trigger modal -->
<button id="botao-editar-area" type="button" acao="editar_area"  class="dropdown-item text-right"   data-toggle="modal" data-target="#modalStatus">
  Editar Setor Responsável
</button>';
        }

        echo '



            </div>
        </div>



';
        echo '
                </div>
';
        echo '</div>';
    }

    public function painelSLA(Ocorrencia $ocorrencia, $dataAbertura, $dataSolucao, $order)
    {



        $sessao = new Sessao();
        if ($sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
            if ($ocorrencia->getServico()->getTempoSla() > 1) {
                echo '<b>SLA: </b>' . $ocorrencia->getServico()->getTempoSla() . ' Horas úteis<br>';
            } else if ($ocorrencia->getServico()->getTempoSla() == 1) {
                echo '<b>SLA: </b> 1 Hora útil<br>';
            } else {
                echo ' SLA não definido. <br>';
                return;
            }
        }

        echo '

            <b>Data de Abertura: </b>' . date("d/m/Y", strtotime($order->data_abertura)) . ' '
            . date("H", strtotime($order->data_abertura)) . 'h'
            . date("i", strtotime($order->data_abertura)) . ' min <br>';

        if ($order->status == StatusOcorrenciaController::STATUS_FECHADO ||
            $order->status == StatusOcorrenciaController::STATUS_FECHADO_CONFIRMADO ||
            $order->status == StatusOcorrenciaController::STATUS_FECHADO) {
            return;
        }


        $timeHoje = time();
        $timeSolucaoEstimada = strtotime($dataSolucao);
        $timeAbertura = strtotime($dataAbertura);
        $timeRecorrido = $timeHoje - $timeAbertura;
        $total = $timeSolucaoEstimada - $timeAbertura;



        $date1 = new DateTime($dataAbertura);
        $date2 = new DateTime($dataSolucao);
        $diff = $date2->diff($date1);
        $hours = $diff->h;
        $hours = $hours + ($diff->days * 24);
        $minutos = $diff->i;
        $segundos  = $diff->s;




        if ($timeHoje > $timeSolucaoEstimada) {



            echo '<span class="text-danger"><b>Solução Estimada: </b>' . date("d/m/Y", strtotime($dataSolucao)) . ' ' . date("H", strtotime($dataSolucao)) . 'h' . date("i", strtotime($dataSolucao)) . ' min </span><br>';
            echo '<span class="escondido" id="tempo-total">' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutos, 2, '0', STR_PAD_LEFT) . ':' . str_pad($segundos, 2, '0', STR_PAD_LEFT) . '</span>';

            $sessao = new Sessao();

            if ($ocorrencia->getUsuarioCliente()->getId() == $sessao->getIdUsuario()) {
                if (!isset($_SESSION['pediu_ajuda'])) {
                    echo view('partials.modal-order-help', ['order' => $order]);
                } else {
                    echo '<br>Você solicitou ajuda, aguarde a resposta.';
                }
            }
            //O form do modal vai chamar o ajax no controller


        } else {
            $percentual = ($timeRecorrido * 100) / $total;
            echo '
                    <p class="text-primary"><b>Solução Estimada: </b>' . date("d/m/Y", strtotime($dataSolucao)) . ' ' . date("H", strtotime($dataSolucao)) . 'h' . date("i", strtotime($dataSolucao)) . ' min.';
            echo '<p class="escondido">Tempo Total: <span id="tempo-total">' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutos, 2, '0', STR_PAD_LEFT) . ':' . str_pad($segundos, 2, '0', STR_PAD_LEFT) . '</span></p>';
            echo '';

            $date1 = new DateTime();
            $date2 = new DateTime($dataSolucao);
            $diff = $date2->diff($date1);
            $hours = $diff->h;
            $hours = $hours + ($diff->days * 24);
            $minutos = $diff->i;
            $segundos  = $diff->s;


            echo '<p class="escondido">Tempo Restante:<span id="tempo-restante">' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutos, 2, '0', STR_PAD_LEFT) . ':' . str_pad($segundos, 2, '0', STR_PAD_LEFT) . '</span></p>

';

            echo '
            <img src="img/bonequinho.gif" height="75" class="escondido">
            <div class="progress escondido">
				<div id="barra-progresso" class="progress-bar" role="progressbar" aria-valuenow="' . $percentual . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percentual . '%;" data-toggle="tooltip" data-placement="top" title="Solução">
					<span id="label-progresso" class="sr-only">' . $percentual . '% Completo</span>
					<span id="label-progresso2" class="progress-type">Progresso ' . intval($percentual) . '% </span>
				</div>
			</div>

';
        }
    }

}
