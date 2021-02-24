<?php

/**
 * Classe de visao para Chamado
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\custom\view;

use novissimo3s\model\Ocorrencia;
use novissimo3s\custom\controller\StatusOcorrenciaCustomController;
use novissimo3s\model\Usuario;
use novissimo3s\custom\dao\StatusOcorrenciaCustomDAO;
use novissimo3s\dao\UsuarioDAO;


class PainelKambanView
{

    private $matrixStatus; 
    private $dao; 
    
    public function mostrarQuadro($listaDeChamados, $matrixStatus = array())
    {        
        $this->dao = new UsuarioDAO();
        $this->matrixStatus = $matrixStatus;
        
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
        

        
        foreach($listaDeChamados as $chamado){
            if($chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_ABERTO 
                || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_REABERTO 
                || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_RESERVADO)
            {
                $this->exibirCartao($chamado);
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

        
        foreach($listaDeChamados as $chamado){
            if($chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_ATENDIMENTO
                || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_EM_ESPERA 
                ||  $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_AGUARDANDO_ATIVO
                ||  $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_AGUARDANDO_USUARIO)
            {
                $this->exibirCartao($chamado);
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
        
        
        foreach($listaDeChamados as $chamado){
            if($chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO
                || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO
                ){
                $this->exibirCartao($chamado);
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


    public function exibirCartao(Ocorrencia $chamado, $class = 6)
    {
        echo '<div class="col-sm-12 col-md-12 col-xl-'.$class.'">';
        $bgCard = "";
        $link = "text-light font-weight-bold p-3";
        $texto = "text-black-50";
        
        switch ($chamado->getStatus()) {
            case StatusOcorrenciaCustomController::STATUS_ABERTO :
                $bgCard = 'bg-warning';
                $texto = "text-light";
                break;
            case StatusOcorrenciaCustomController::STATUS_ATENDIMENTO:
                $bgCard = 'bg-info';
                $texto = "text-light";
                break;
            case StatusOcorrenciaCustomController::STATUS_FECHADO:
                $bgCard = 'bg-success';
                $texto = "text-light";
                break;
            case StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO:
                $bgCard = 'bg-success';
                $texto = "text-light";
                break;
            case StatusOcorrenciaCustomController::STATUS_CANCELADO:
                $bgCard = 'bg-light';
                $texto = "text-light";
                break;
            case StatusOcorrenciaCustomController::STATUS_RESERVADO:
                $bgCard = 'bg-secondary';
                $texto = "text-light";
                break;
            case StatusOcorrenciaCustomController::STATUS_EM_ESPERA:
                $bgCard = 'bg-secondary';
                $texto = "text-light";
                break;
            case StatusOcorrenciaCustomController::STATUS_AGUARDANDO_USUARIO:
                $bgCard = 'bg-danger';
                $texto = "text-light";
                break;
            case StatusOcorrenciaCustomController::STATUS_AGUARDANDO_ATIVO:
                $bgCard = 'bg-danger';
                $texto = "text-light";
                break;
            
        }
        
        
        
        echo '
                        <div class="card draggable shadow-sm '.$bgCard.'"  style="height: 250px;">
                            <div class="card-body p-2">
                                <div class="card-title">

                                    <a href="?pagina=ocorrencia&selecionar='.$chamado->getId().'" class="'.$link.'">
                                       #'.$chamado->getId().'
                                    </a>';
        
        echo '

                                </div>
                                <p class="'.$texto.'">
                                   '.substr($chamado->getDescricao(), 0, 75).'[...]
                                </p>';
        
 
        $nome = explode(" ", $chamado->getUsuarioCliente()->getNome());
        echo '<small  class="'.$texto.'">Demandante: ';
        if(isset($nome[0])){
            echo ucfirst(strtolower($nome[0]));
        }
        if(isset($nome[1])){
            echo ' '.ucfirst(strtolower($nome[1]));
        }
        
        
        
        echo ' </small><br>';
        $ocorrenciaView = new OcorrenciaCustomView();
        echo '<small  class="'.$texto.'">'.$ocorrenciaView->getStrStatus($chamado->getStatus()).'</small>';
        
        
        
        if($chamado->getIdUsuarioAtendente() > 0){
            $usuario = new Usuario();
            $usuario->setId($chamado->getIdUsuarioAtendente());
            $nomeAtendente = explode(" ", "TEste");
            if(count($nomeAtendente) > 1){
                echo '<br><small class="'.$texto.'">Atendente: '.ucfirst(strtolower($nomeAtendente[0])).' '.ucfirst(strtolower($nomeAtendente[1])).'</small>';
            }
        }
        $abertura = "";
        $dataAtendimento = "";
        
        if(isset($this->matrixStatus[$chamado->getId()])){
            foreach($this->matrixStatus[$chamado->getId()] as $elemento){
                if($abertura == ""){
                    $abertura = $elemento->getDataMudanca();
                }
                if($dataAtendimento == ""){
                    if($elemento->getStatus()->getSigla() == StatusOcorrenciaCustomController::STATUS_ATENDIMENTO){
                        $dataAtendimento = $elemento->getDataMudanca();
                    }
                }
            }
        }
        
        
        if($chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_ABERTO 
            || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_REABERTO 
            || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO){
                
            
                $timeAbert = strtotime($abertura);
                $timeHoje =  time();
                $diferenca = $timeHoje - $timeAbert;
                $dias = $diferenca/(86400);
                $resto = $diferenca % 86400;
                $resto = intval($resto/(60*60));
                echo '<br><small class="'.$texto.'">Aberto há '.intval($dias).' dia';
                if($dias > 1){
                    echo 's';
                    if(isset($resto)){
                        
                        echo ' e '.$resto.' horas';
                    }
                }else if($dias < 1){
                    echo ' e '.$resto.' horas';
                }
                echo '</small>';
            
            
        }
        if($chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_ATENDIMENTO 
            || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_EM_ESPERA 
            || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_AGUARDANDO_ATIVO
            || $chamado->getStatus() == StatusOcorrenciaCustomController::STATUS_AGUARDANDO_USUARIO){
            
            $timeAbert = strtotime($dataAtendimento);
            $timeHoje =  time();
            $diferenca = $timeHoje - $timeAbert;
            $dias = $diferenca/(86400);
            $resto = $diferenca % 86400;
            $resto = intval($resto/(60*60));
            echo '<br><small class="'.$texto.'">Em atendimento há '.intval($dias).' dia';
            if($dias > 1){
                echo 's';
                if(isset($resto)){   
                    echo ' e '.$resto.' horas';
                }
            }
            echo '</small>';
            
            
        }
        echo '
                            </div>
                        </div>
                        ';
        echo '</div>';
    }





    public function mensagem($mensagem)
    {
        echo '
                                            
                                            
                                            
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
                                            
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">' . $mensagem . '</h1>
									</div>
                                            
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
	</div>';
    }
}