<?php

/**
 * Classe de visao para Chamado
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class ChamadoView
{

    public function mostrarQuadro($listaDeChamados, $listaFechados)
    {        
        
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
            if($chamado->getStatus() == 'Aberto' || $chamado->getStatus() == 'Reaberto' || $chamado->getStatus() == 'Reservado'){
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
            if($chamado->getStatus() == 'Em atendimento' || $chamado->getStatus() == 'Em espera' || substr($chamado->getStatus(), 0, 10) == 'Aguardando' )
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
        foreach($listaFechados as $chamado){
            if(substr($chamado->getStatus(), 0, 7) == 'Fechado'){
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

    public function exibirCartao(Chamado $chamado, $class = 6)
    {
        echo '<div class="col-sm-12 col-md-12 col-xl-'.$class.'">';
        $bgCard = "";
        $link = "text-light font-weight-bold p-3";
        $texto = "text-black-50";
        
        switch ($chamado->getStatus()) {
            case 'Aberto':
                $bgCard = 'bg-warning';
                $texto = "text-light";
                break;
            case 'Em atendimento':
                $bgCard = 'bg-info';
                $texto = "text-light";
                break;
            case 'Fechado':
                $bgCard = 'bg-success';
                $texto = "text-light";
                break;
            case 'Fechado Confirmado':
                $bgCard = 'bg-success';
                $texto = "text-light";
                break;
            case 'Cancelado':
                $bgCard = 'bg-light';
                $texto = "text-light";
                break;
            case 'Reservado':
                $bgCard = 'bg-secondary';
                $texto = "text-light";
                break;
            case 'Em espera':
                $bgCard = 'bg-secondary';
                $texto = "text-light";
                break;
            case 'Aguardando Usuário':
                $bgCard = 'bg-danger';
                $texto = "text-light";
                break;
            case 'Aguardando ativo da DTI':
                $bgCard = 'bg-danger';
                $texto = "text-light";
                break;
            
        }
        
        
        
        echo '
                        <div class="card draggable shadow-sm '.$bgCard.'"  style="height: 250px;">
                            <div class="card-body p-2">
                                <div class="card-title">

                                    <a href="http://3s.unilab.edu.br/painel.php?m=ocorrencias&t=visualizar&id='.$chamado->getId().'" class="'.$link.'">
                                       #'.$chamado->getId().'
                                    </a>';
        
        echo '

                                </div>
                                <p class="'.$texto.'">
                                   '.substr($chamado->getDescricao(), 0, 75).'[...]
                                </p>';
        
        $nome = explode(" ", $chamado->getDemandante());
        echo '<small  class="'.$texto.'">Demandante: '.ucfirst(strtolower($nome[0])).' '.ucfirst(strtolower($nome[1])).' ('.trim($chamado->getSetorDemandante()).') </small><br>';
        echo '<small  class="'.$texto.'">'.$chamado->getStatus().'</small>';
        
        
        $nomeAtendente = explode(" ", $chamado->getAtendente());
        if(count($nomeAtendente) > 1){
            echo '<br><small class="'.$texto.'">Atendente: '.ucfirst(strtolower($nomeAtendente[0])).' '.ucfirst(strtolower($nomeAtendente[1])).'</small>';
        }
        if($chamado->getStatus() == 'Aberto' || $chamado->getStatus() == 'Reaberto' || $chamado->getStatus() == 'Reservado'){
            
            $timeAbert = strtotime($chamado->getAbertura());
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
            }
            echo '</small>';
            
            
        }
        if($chamado->getStatus() == 'Em atendimento' || $chamado->getStatus() == 'Em espera' || substr($chamado->getStatus(), 0, 10) == 'Aguardando' ){
            
            $timeAbert = strtotime($chamado->getAtendimento());
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

    public static function diferencaEntreDatas($data1, $data2){
        
    }
    public function exibirLista($lista)
    {
        echo '
                                            
                                            
                                            
	<div class="card o-hidden border-0 shadow-lg my-5">
              <div class="card mb-4">
                <div class="card-header">
                  Lista
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>id</th>
						<th>descricao</th>
						<th>abertura</th>
						<th>atendimento</th>

					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>id</th>
                        <th>descricao</th>
                        <th>abertura</th>
                        <th>atendimento</th>

					</tr>
				</tfoot>
				<tbody>';

        foreach ($lista as $elemento) {
            echo '<tr>';
            echo '<td>' . $elemento->getId() . '</td>';
            echo '<td>' . $elemento->getDescricao() . '</td>';
            echo '<td>' . $elemento->getAbertura() . '</td>';
            echo '<td>' . $elemento->getAtendimento() . '</td>';

            echo '</tr>';
        }

        echo '
				</tbody>
			</table>
		</div>
            
            
            
            
      </div>
  </div>
</div>
            
';
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