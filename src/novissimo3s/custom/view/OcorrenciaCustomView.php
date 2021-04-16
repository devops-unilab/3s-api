<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\custom\view;
use novissimo3s\view\OcorrenciaView;
use novissimo3s\util\Sessao;
use novissimo3s\model\Ocorrencia;
use novissimo3s\custom\controller\StatusOcorrenciaCustomController;
use novissimo3s\model\Usuario;
use novissimo3s\dao\UsuarioDAO;
use DateTime;




class OcorrenciaCustomView extends OcorrenciaView {

   
    
    public function mostraFormInserir2($listaServico){
        
        $sessao = new Sessao();
        
        echo '
            
            
            
  <div class="card card-body">
            
            
<form  id="insert_form_ocorrencia"  method="post" action="" enctype="multipart/form-data">
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
            echo '
                        <option value="'.$servico->getId().'">'.$servico->getNome();
            if($servico->getDescricao() != ""){
                echo ' - ('.$servico->getDescricao().') ';
                

            }
            echo '</option>';
            
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

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="anexo" id="anexo" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*">
                      <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
                    </div>
            
                </div>
            </div>

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
                    <input class="form-control" type="number" name="ramal" id="ramal" value="">
                </div>
            
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="email" >E-mail*</label>
                    <input class="form-control" type="email" name="email" id="email" value="'.trim($sessao->getEmail()).'" required>
                </div>
                        
            </div>
        </div>
    </div>
    <input type="hidden" name="enviar_ocorrencia" value="1">
                        
</form>
                        
                        
  </div><br><br>
<div class="d-flex justify-content-center m-3">
        <button id="btn-inserir-ocorrencia" form="insert_form_ocorrencia" type="submit" class="btn btn-primary">Cadastrar Ocorrência</button>
                        
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
    public function exibirListaTab($lista)
    {
        
        echo '
            
            
                   <div class="alert-group">';
        
        
        
        
        echo '
            
<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Campus</th>
						<th>Setor</th>
						<th>Servico</th>
						<th>Usuario Cliente</th>
                        <th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Campus</th>
						<th>Setor</th>
						<th>Servico</th>
						<th>Usuario Cliente</th>
                        <th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
        
        foreach($lista as $elemento){
            $strClass = 'alert-warning';
            if($elemento->getStatus() == 'a'){
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'e'){//Em atendimento
                $strClass = 'alert-info';
            }else if($elemento->getStatus() == 'f'){//Fechado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'g'){//Fechado confirmado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'h'){//Cancelado
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
            

            
            echo '<tr class="alert '.$strClass.' alert-dismissable">';
            echo '<td>'.$elemento->getId().'</td>';
            echo '<td>'.$elemento->getCampus().'</td>';
            echo '<td>'.$elemento->getAreaResponsavel()->getNome().'</td>';
            echo '<td>'.$elemento->getServico()->getNome().'</td>';
            echo '<td>'.$elemento->getUsuarioCliente()->getNome().'</td>';
            echo '<td>
                    <a href="?page=ocorrencia&selecionar='.$elemento->getId().'" class="btn btn-info text-white"><i class="fa fa-search icone-maior"></i></a>
                  </td>';
            echo '</tr>';
            

            //      <a href="" class="list-group-item active"> -</a>
            
        }
        echo '
				</tbody>
			</table>
		</div>';
        
        echo '
                    </div>';
        
        
        
        
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
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'g'){//Fechado confirmado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'h'){//Cancelado
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
                <a href="?page=ocorrencia&selecionar='.$elemento->getId().'" class="close"><i class="fa fa-search icone-maior"></i></a>
                    
                <strong>#'.$elemento->getId().'</strong>
                 '.substr($elemento->getDescricao(), 0, 80).'...
            </div>
                  ';
            
        }
        
        if(count($lista) == 0){
            echo '
                
            <div class="alert alert-light alert-dismissable text-center">
                <strong>Nenhuma Ocorrência</strong>
                
            </div>
                  ';
        }
        echo '
                    </div>';
        
        
        
        
    }
    
    public function exibirListaPaginada($lista, $id = '')
    {
        $strId = "";
        if($id != ''){
            $strId = " id = ".$id;
        }
        echo '
            
            
                   <div '.$strId.' class="alert-group">';
        
        $strClass = 'alert-warning';
        foreach($lista as $elemento){
            
            if($elemento->getStatus() == 'a'){
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'e'){//Em atendimento
                $strClass = 'alert-info';
            }else if($elemento->getStatus() == 'f'){//Fechado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'g'){//Fechado confirmado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'h'){//Cancelado
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
                <a href="?page=ocorrencia&selecionar='.$elemento->getId().'" class="close"><i class="fa fa-search icone-maior"></i></a>
                    
                <strong>#'.$elemento->getId().'</strong>
                 '.substr($elemento->getDescricao(), 0, 80).'...
            </div>
                  ';
            
        }
        
        if(count($lista) == 0){
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
    public function getStrStatus($status){
        $strStatus = "Aberto";
        switch ($status){
            case StatusOcorrenciaCustomController::STATUS_ABERTO:
                $strStatus = "Aberto";
                break;
            case StatusOcorrenciaCustomController::STATUS_ATENDIMENTO:
                $strStatus = "Em atendimento";
                break;
            case StatusOcorrenciaCustomController::STATUS_FECHADO:
                $strStatus = "Fechado";
                break;
            case StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO:
                $strStatus = "Fechado Confirmado";
                break;
            case StatusOcorrenciaCustomController::STATUS_CANCELADO:
                $strStatus = "Cancelado";
                break;
            case StatusOcorrenciaCustomController::STATUS_REABERTO:
                $strStatus = "Reaberto";
                break;
            case StatusOcorrenciaCustomController::STATUS_RESERVADO:
                $strStatus = "Reservado";
                break;
            case StatusOcorrenciaCustomController::STATUS_EM_ESPERA:
                $strStatus = "Em espera";
                break;
            case StatusOcorrenciaCustomController::STATUS_AGUARDANDO_USUARIO:
                $strStatus = "Aguardando Usuário";
                break;
            case StatusOcorrenciaCustomController::STATUS_AGUARDANDO_ATIVO:
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

            
            
            <div class="row">';
        echo '
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    ';
        
        echo '
                <div class="card mb-4">
                    <div class="card-body">';
        echo '
                   <b> Descricao: </b>'.strip_tags($ocorrencia->getDescricao()).'<br>';
        
        
        
        

        if(trim($ocorrencia->getPatrimonio()) != "" || trim($ocorrencia->getAnexo()) != ""){
            echo '<hr>';
        }

        if(trim($ocorrencia->getPatrimonio()) != ""){
            echo '<b>Patrimonio: </b>'.$ocorrencia->getPatrimonio().' <br> ';
        }
        if(trim($ocorrencia->getAnexo()) != ""){
            echo '<b>Anexo: </b><a target="_blank" href="uploads/'.$ocorrencia->getAnexo().'"> Clique aqui</a> <br>';
        }

        echo '
            
            
                    </div>
                </div>


';


            echo '
                <div class="card mb-4">
                    <div class="card-body">';
            
           echo '<b>Solucao: </b>'.strip_tags($ocorrencia->getSolucao()).'<br>';
           
           $statusView = new StatusOcorrenciaCustomView();
           $controller = new StatusOcorrenciaCustomController();
           

           if($controller->possoEditarSolucao($ocorrencia)){
               $statusView->botaoEditarSolucao();
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
                        <b>Classificação do Chamado: </b>'.$ocorrencia->getServico()->getNome().'<br>';
        if($controller->possoEditarServico($ocorrencia)){
            $statusView->botaoEditarServico();
        }
        echo '<hr>';
        
        $this->painelSLA($ocorrencia, $listaStatus, $dataAbertura, $dataSolucao);
        
        echo '
                    </div>
                </div>

';
        echo '
            
            <div class="card mb-4">
                <div class="card-body">
                    <b>Requisitante: </b>'.$ocorrencia->getUsuarioCliente()->getNome().' <br>';
        if(trim($ocorrencia->getLocal()) != ""){
            echo ' <b>Setor do Requisitante:</b> '.$ocorrencia->getLocal().'<br>';
        }
        echo '
                    <b>Campus: </b>'.$ocorrencia->getCampus().' <br>
                    <b>Email: </b>'.$ocorrencia->getEmail().' <br> ';
        
        
        if(trim($ocorrencia->getLocalSala()) != ""){
            echo ' <b>Local/Sala: </b>'.$ocorrencia->getLocalSala().'<br>';
        }
        if(trim($ocorrencia->getRamal()) != ""){
            echo '<b>Ramal: </b>'.$ocorrencia->getRamal().'<br>';
        }
        
        echo '
                </div>
            </div>';
        
        
        echo '
            
        <div class="card mb-4">
            <div class="card-body">';
        echo '<b>Setor Responsável: </b>'.$ocorrencia->getAreaResponsavel()->getNome().
        ' - '.$ocorrencia->getAreaResponsavel()->getDescricao().'<br>';
        
        $usuarioDao = new UsuarioDAO();
        
        if($ocorrencia->getIdUsuarioAtendente() != null){
            $atendente = new Usuario();
            $atendente->setId($ocorrencia->getIdUsuarioAtendente());
            $usuarioDao->fillById($atendente);
            echo '<b>Técnico Responsável:</b> '.$atendente->getNome().'<br>';
        }
        if($ocorrencia->getIdUsuarioIndicado() != null){
            $indicado = new Usuario();
            $indicado->setId($ocorrencia->getIdUsuarioIndicado());
            $usuarioDao->fillById($indicado);
            echo '<b>Técnico Indicado: </b>'.$indicado->getNome().'<br>';
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
    
    public function painelSLA(Ocorrencia $ocorrencia, $listaStatus, $dataAbertura, $dataSolucao){
 

        
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
            if($ocorrencia->getServico()->getTempoSla() > 1)
            {
                echo '<b>SLA: </b>'.$ocorrencia->getServico()->getTempoSla(). ' Horas úteis<br>';
            }else if($ocorrencia->getServico()->getTempoSla() == 1){
                echo '<b>SLA: </b> 1 Hora útil<br>';
                
            }else{
                echo ' SLA não definido. <br>';
                return;
            }
        }
        
        echo '
            
            <b>Data de Abertura: </b>'.date("d/m/Y" , strtotime($dataAbertura)).' '.date("H" , strtotime($dataAbertura)).'h'.date("i" , strtotime($dataAbertura)).' min <br>';
        
        
        if($ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO)
        {
            return;
        }
        if($ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO)
        {
            return;
        }
        if($ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO)
        {
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
        $hours = $hours + ($diff->days*24);
        $minutos = $diff->i;
        $segundos  = $diff->s;
            
            
            
            
        if($timeHoje > $timeSolucaoEstimada){
            
            
            
            echo '<span class="text-danger"><b>Solução Estimada: </b>'.date("d/m/Y" , strtotime($dataSolucao)).' '.date("H" , strtotime($dataSolucao)).'h'.date("i" , strtotime($dataSolucao)).' min </span><br>';
            echo '<span class="escondido" id="tempo-total">'. str_pad($hours, 2 , '0' , STR_PAD_LEFT).':'.str_pad($minutos, 2 , '0' , STR_PAD_LEFT).':'.str_pad($segundos, 2 , '0' , STR_PAD_LEFT).'</span>';

            $sessao = new Sessao();
            if($ocorrencia->getUsuarioCliente()->getId() == $sessao->getIdUsuario()){
                if(!isset($_SESSION['pediu_ajuda'])){
                    $this->modalPedirAjuda($ocorrencia);
                }else{
                    echo '<br>Você solicitou ajuda, aguarde a resposta.';
                }
            }
            //O form do modal vai chamar o ajax no controller
            
            
        }else{
            $percentual = ($timeRecorrido *100)/$total;
            echo '
                    <p class="text-primary"><b>Solução Estimada: </b>'.date("d/m/Y" , strtotime($dataSolucao)).' '.date("H" , strtotime($dataSolucao)).'h'.date("i" , strtotime($dataSolucao)).' min.';
            echo '<p class="escondido">Tempo Total: <span id="tempo-total">'. str_pad($hours, 2 , '0' , STR_PAD_LEFT).':'.str_pad($minutos, 2 , '0' , STR_PAD_LEFT).':'.str_pad($segundos, 2 , '0' , STR_PAD_LEFT).'</span></p>';
            echo '';
            
            $date1 = new DateTime();
            $date2 = new DateTime($dataSolucao);
            $diff = $date2->diff($date1);
            $hours = $diff->h;
            $hours = $hours + ($diff->days*24);
            $minutos = $diff->i;
            $segundos  = $diff->s;
                
                
            echo '<p class="escondido">Tempo Restante:<span id="tempo-restante">'. str_pad($hours, 2 , '0' , STR_PAD_LEFT).':'.str_pad($minutos, 2 , '0' , STR_PAD_LEFT).':'.str_pad($segundos, 2 , '0' , STR_PAD_LEFT).'</span></p>
                            
';
                
                echo '
            <!-- <img src="img/bonequinho.gif" height="75"> -->
            <div class="progress">
				<div id="barra-progresso" class="progress-bar" role="progressbar" aria-valuenow="'.$percentual.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentual.'%;" data-toggle="tooltip" data-placement="top" title="Solução">
					<span id="label-progresso" class="sr-only">'.$percentual.'% Completo</span>
					<span id="label-progresso2" class="progress-type">Progresso '.intval($percentual).'% </span>
				</div>
			</div>
					    
';
                
        }
            
            
        
        

    }
    public function painelTopoSLA(Ocorrencia $ocorrencia, $listaStatus, $dataAbertura, $dataSolucao){
        
        
        if($ocorrencia->getServico()->getTempoSla() > 1)
        {
            echo '<b>Prazo de Resolução: </b>'.$ocorrencia->getServico()->getTempoSla(). ' Horas úteis ';
            echo '<br><b>Abertura: </b>'.date("d/m/Y G:i:s", strtotime($dataAbertura)).' </span>';
        }else if($ocorrencia->getServico()->getTempoSla() == 1){
            echo '<b>Prazo de Resolução: </b> 1 Hora útil';
            echo '<br><b>Abertura: </b>'.date("d/m/Y G:i:s", strtotime($dataAbertura)).' </span>';
        }else{
            echo ' SLA não definido. ';
            echo '<br><b>Abertura: </b>'.date("d/m/Y G:i:s", strtotime($dataAbertura)).' </span>';
            return;
        }
        
        
        
        
        
        
        
    }
    public function modalPedirAjuda(Ocorrencia $ocorrencia){
        echo '

<!-- Button trigger modal -->
<button type="button" id="botao-pedir-ajuda" class="dropdown-item text-right" data-toggle="modal" data-target="#modalPedirAjuda">
  Pedir Ajuda
</button>
            
<!-- Modal -->
<div class="modal fade" id="modalPedirAjuda" tabindex="-1" role="dialog" aria-labelledby="labelAddRecesso" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddRecesso">Pedir Ajuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_pedir_ajuda" class="user" method="post">
            <input type="hidden" name="pedir_ajuda" value="1">
            <input type="hidden" name="ocorrencia" value="'.$ocorrencia->getId().'">
            
            <span>Clique em solicitar ajuda para enviar um e-mail aos responsáveis pelo setor</span>    
            
		</form>
            
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_pedir_ajuda" type="submit" class="btn btn-primary">Solicitar Ajuda</button>
      </div>
    </div>
  </div>
</div>
            
            
            
';
    }


}