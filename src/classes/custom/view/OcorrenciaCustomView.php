<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class OcorrenciaCustomView extends OcorrenciaView {

    
    public function mostraFormInserir2($listaServico){
        
        $sessao = new Sessao();
        
        echo '

            

  <div class="card card-body">
            
            
<form  id="form_enviar_ocorrencia"  method="post" action="" enctype="multipart/form-data">
    <span class="titulo medio">Informe os dados para cadastro</span><br>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="select-demanda">Serviço*</label>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <select id="select-servicos" name="servico" required>
                        <option value="" selected="selected">Selecione um serviço</option>';        
        foreach($listaServico as $servico){
            if($servico->getDescricao() == ""){
                $descricao = $servico->getNome();
            }else{
                $descricao = $servico->getDescricao();
            }
            echo '
                        <option value="'.$servico->getId().'">'.$descricao.'</option>';
        }
        echo '
            
            
            
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="descricao">Descrição*</label>
                    <textarea class="form-control" rows="3" name="descricao" id="descricao" required></textarea>
                </div>
            </div>
            <br>
<!--
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="anexo" id="anexo">
                      <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
                    </div>
            
                </div>
            </div>
    -->        
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row"><!--Campus Local Sala Contato(Ramal e email)-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="campus">Campus*</label>
                    <select name="campus" id="select-campus" required>
                        <option value="" selected>Selecione um Campus</option>
                        <option value="liberdade">Campus Liberdade</option>
                        <option value="auroras">Campus Auroras</option>
                        <option value="palmares">Campus Palmares</option>
                        <option value="males">Campus dos Malês</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="local_sala">Local/Sala</label>
                    <input class="form-control" type="text" name="local_sala" id="local_sala" value="" >
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="patrimonio">Patrimônio</label>
                    <input class="form-control" type="text" name="patrimonio" id="patrimonio" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >Ramal</label>
                    <input class="form-control" type="text" name="ramal" id="ramal" value="">
                </div>
            
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="email" >E-mail*</label>
                    <input class="form-control" type="text" name="email" id="email" value="'.$sessao->getEmail().'" required>
                </div>
            
            </div>
        </div>
    </div>
    <input type="hidden" name="enviar_ocorrencia" value="1">
    
</form>
            
      
  </div><br><br>
<div class="d-flex justify-content-center m-3">
        <button form="form_enviar_ocorrencia" type="submit" class="btn btn-primary">Cadastrar Ocorrência</button>
        
</div><br><br>

            
';
    }
    public function mostraFormEditar2(Ocorrencia $ocorrencia, $listaServico){
        $sessao = new Sessao();
        echo '
            
            
  <div class="card card-body">
            
            
<form method="post" action="" enctype="multipart/form-data">
    <span class="titulo medio">Informe os dados para cadastro</span><br>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="select-demanda">Serviço*</label>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <select id="select-servicos" name="item_ocorrencia" required>
                        <option value="" selected="selected">Selecione um serviço</option>';
        foreach($listaServico as $servico){
            if($servico->getDescricao() == ""){
                $descricao = $servico->getNome();
            }else{
                $descricao = $servico->getDescricao();
            }
            echo '
                        <option value="'.$servico->getId().'">'.$descricao.'</option>';
        }
        echo '
            
            
            
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="desc_problema">Descrição*</label>
                    <textarea class="form-control" rows="3" name="desc_problema" id="desc_problema" required>'.ltrim($ocorrencia->getDescricao()).'</textarea>
                </div>
            </div>
            <br>
<!--
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="anexo" id="anexo">
                      <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
                    </div>
            
                </div>
            </div>
-->
            
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row"><!--Campus Local Sala Contato(Ramal e email)-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="campus">Campus*</label>
                    <select name="campus" id="select-campus" required>
                        <option value="" selected>Selecione um Campus</option>
                        <option value="liberdade">Campus Liberdade</option>
                        <option value="auroras">Campus Auroras</option>
                        <option value="palmares">Campus Palmares</option>
                        <option value="males">Campus dos Malês</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="local_sala">Local/Sala</label>
                    <input class="form-control" type="text" name="local_sala" id="local_sala" value="" >
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="etiq_equipamento">Patrimônio</label>
                    <input class="form-control" type="text" name="etiq_equipamento" id="etiq_equipamento" rel="tooltip" title="Identificação do Equipamento. (Opcional)" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >Ramal</label>
                    <input class="form-control" type="text" name="ramal" id="ramal" value="">
                </div>
            
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >E-mail*</label>
                    <input class="form-control" type="text" name="email" id="email" value="'.$sessao->getEmail().'" required>
                </div>
                        
            </div>
        </div>
    </div>
                        
</form>
                        
                        
  </div><br><br>
<div class="d-flex justify-content-center m-3">
        <input type="submit" id="btn-submit" name="enviar_ocorrencia" value="Cadastrar Ocorrência" class="btn btn-primary" >
</div><br><br>
                        
                        
';
    }
    public function exibirLista($lista)
    {
        
        echo '


                   <div class="alert-group">';
        
        $strClass = 'alert-warning';
	    foreach($lista as $elemento){
	        
	        if($elemento->getStatus() == 'a'){
	            $strClass = 'alert-warning';
	        }else if($elemento->getStatus() == 'e'){//Em atendimento
	            $strClass = 'alert-info';
	        }else if($elemento->getStatus() == 'f'){//Fechado
	            continue;
	            $strClass = 'alert-success';
	        }else if($elemento->getStatus() == 'g'){//Fechado confirmado
	            continue;
	            $strClass = 'alert-success';
	        }else if($elemento->getStatus() == 'h'){//Cancelado
	            continue;
	            $strClass = 'alert-secondary';
	        }else if($elemento->getStatus() == 'r'){//reaberto
	            $strClass = 'alert-warning';
	        }else if($elemento->getStatus() == 'b'){//reservado
	            $strClass = 'alert-warning';
	        }else if($elemento->getStatus() == 'c'){//em espera
	            $strClass = 'alert-info';
	        }else if($elemento->getStatus() == 'd'){//Aguardando usuario
	            $strClass = 'alert-danger';
	        }else if($elemento->getStatus() == 'i'){//Aguardando ativo
	            $strClass = 'alert-danger';
	        }
	        
	        echo '

            <div class="alert '.$strClass.' alert-dismissable">
                <a href="?pagina=ocorrencia&selecionar='.$elemento->getId().'" class="close"><i class="fa fa-search icone-maior"></i></a>
                
                <strong>#'.$elemento->getId().'</strong> 
                 '.$elemento->getServico()->getNome().'
            </div>
                  ';
	        
	        //      <a href="" class="list-group-item active"> -</a>
	        
	    }
	    
	    if(count($lista) == 0){
	        echo '
	            
            <div class="alert alert-light alert-dismissable text-center">              
                <strong>Você não tem nenhum chamado aberto</strong>

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
    public function getStrStatus($status){
        $strStatus = "Aberto";
        switch ($status){
            case 'a':
                $strStatus = "Aberto";
                break;
            case 'e':
                $strStatus = "Em atendimento";
                break;
            case 'f':
                $strStatus = "Fechado";
                break;
            case 'g':
                $strStatus = "Fechado Confirmado";
                break;
            case 'h':
                $strStatus = "Cancelado";
                break;
            case 'r':
                $strStatus = "Reaberto";
                break;
            case 'b':
                $strStatus = "Aberto";
                break;
            case 'b':
                $strStatus = "Reservado";
                break;
            case 'c':
                $strStatus = "Em espera";
                break;
            case 'd':
                $strStatus = "Aguardando Usuário";
                break;
            case 'i':
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
    public function mostrarSelecionado2(Ocorrencia $ocorrencia, $listaStatus, $dataAbertura, $dataSolucao){
        
        echo '
            
     
                <div class="card mb-4">
                    <div class="card-body">
                        <p>Abertura: '.date("d/m/Y H:i:s" , strtotime($dataAbertura)).'</p>';
        echo '
                        <p>Prazo de Resolução: '.$ocorrencia->getServico()->getTempoSla();
        
        $strClass = "";
        $strText = "";
        if($ocorrencia->getServico()->getTempoSla() >= 1)
        {                
            echo ' Horas úteis';
        }else if($ocorrencia->getServico()->getTempoSla() == 0){
            echo 'SLA não definido.';
        }
        
        
        
            echo '
                        </p>';
            
            

            if($ocorrencia->getStatus() != 'f' && $ocorrencia->getStatus() != 'g' && $ocorrencia->getServico()->getTempoSla() != 0){
                
                $timeHoje = time();
                $timeSolucaoEstimada = strtotime($dataSolucao);
                $timeAbertura = strtotime($dataAbertura);
                $timeRecorrido = $timeHoje - $timeAbertura;
                
                if($timeHoje > $timeSolucaoEstimada){
                    $strClass = "text-danger";
                    $strText = "Solução em Atraso. <br>Caso queira pressionar o atendente  <a href=\"send\">clique aqui</a>";
                    echo '
                        <p class="'.$strClass.'">Solução Estimada: '.date("d/m/Y H:i:s" , strtotime($dataSolucao)).'<br>'.$strText.'</p>';
                }else{
                    
                    $strClass = "text-primary";
                    $strText = "Dentro do prazo. ";
                    $resultante = $timeSolucaoEstimada - $timeHoje;
                    $strText .= 'Tempo Restante: <span id="tempo-restante">'. gmdate("H:i:s", $resultante).'</span>';
                    $total = $timeSolucaoEstimada - $timeAbertura;
                    $percentual = ($timeRecorrido *100)/$total;
                     
                    echo '
                        <p class="'.$strClass.'">Solução Estimada: '.date("d/m/Y H:i:s" , strtotime($dataSolucao)).'<br>'.$strText.'</p>';
                    echo '
                        
            <div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="'.$percentual.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentual.'%;" data-toggle="tooltip" data-placement="top" title="Solução">
					<span class="sr-only">'.$percentual.'% Complete</span>
					<span class="progress-type">Aguarde</span>
				</div>
			</div><br>
                        
';
                    
                }
                
                
            }
            
            echo '<p>Status: '.$this->getStrStatus($ocorrencia->getStatus()).'</p>
                        Descricao: '.$ocorrencia->getDescricao().'<br>      
                    </div>
                </div>
            
            <div class="card mb-4">
                <div class="card-body">
                    Cliente: '.$ocorrencia->getUsuarioCliente()->getNome().'<br>
                    Campus: '.$ocorrencia->getCampus().'<br>
                    Local: '.$ocorrencia->getLocal().'<br>
                    Local Sala: '.$ocorrencia->getLocalSala().'<br>
                    Ramal: '.$ocorrencia->getRamal().'<br>
                    Email: '.$ocorrencia->getEmail().'<br>
                </div>
            </div>

                 
        <div class="card mb-4">
            <div class="card-body">
                Patrimonio: '.$ocorrencia->getPatrimonio().'<br>
                Solucao: '.$ocorrencia->getSolucao().'<br>
                Prioridade: '.$ocorrencia->getPrioridade().'<br>
                Avaliacao: '.$ocorrencia->getAvaliacao().'<br>
                Id Usuario Atendente: '.$ocorrencia->getIdUsuarioAtendente().'<br>
                Id Usuario Indicado: '.$ocorrencia->getIdUsuarioIndicado().'<br>
                Anexo: '.$ocorrencia->getAnexo().'<br>
                
                Area Responsavel: '.$ocorrencia->getAreaResponsavel().'<br>
                
               
                    
            </div>
        </div>
                    
                    
                    
';
    }
    
    ////////Digite seu código customizado aqui.
    


}