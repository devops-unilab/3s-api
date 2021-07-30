<?php
            
/**
 * Customize o controller do objeto Ocorrencia aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\OcorrenciaController;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\custom\view\OcorrenciaCustomView;
use novissimo3s\model\Ocorrencia;
use novissimo3s\custom\dao\ServicoCustomDAO;
use novissimo3s\util\Sessao;
use novissimo3s\model\StatusOcorrencia;
use novissimo3s\dao\StatusOcorrenciaDAO;
use novissimo3s\model\Usuario;
use novissimo3s\custom\dao\StatusOcorrenciaCustomDAO;
use novissimo3s\custom\dao\RecessoCustomDAO;
use novissimo3s\model\Servico;
use novissimo3s\dao\ServicoDAO;
use novissimo3s\dao\UsuarioDAO;
use novissimo3s\custom\dao\UsuarioCustomDAO;
use novissimo3s\util\Mail;
use novissimo3s\model\AreaResponsavel;
use novissimo3s\custom\dao\AreaResponsavelCustomDAO;
use novissimo3s\custom\dao\StatusCustomDAO;
use novissimo3s\model\Status;

class OcorrenciaCustomController  extends OcorrenciaController {
    
    
    private $selecionado;
    private $sessao;
    
    public function __construct(){
        $this->dao = new OcorrenciaCustomDAO();
        $this->view = new OcorrenciaCustomView();
    }
    
    
    
    public function fimDeSemana($data){
        $diaDaSemana = date('w', strtotime($data));
        $diaDaSemana = intval($diaDaSemana);
        if($diaDaSemana == 6 || $diaDaSemana == 0){
            return true;
        }
        return false;
    }
    public function dataPertenceALista($data, $listaRecesso){
        foreach($listaRecesso as $recesso){
            if(date("Y-m-d", strtotime($recesso->getData())) ==  date("Y-m-d", strtotime($data))){
                return true;
            }
        }
        return false;
    }
    public function foraDoExpediente($data){
        $hora = date('H', strtotime($data));
        $hora = intval($hora);
        if($hora >= 17){
            return true;
        }
        if($hora < 8)
        {
            return true;
        }
        if($hora == 11)
        {
            return true;
        }
        return false;
    }
    public function calcularHoraSolucao($dataAbertura, $tempoSla)
    {
        if($dataAbertura == null){
            return "Indefinido";
        }
        $recessoDao = new RecessoCustomDAO($this->dao->getConnection());
        $dataTeste = date("Y-m-d 08:00:00", strtotime('-1 day', strtotime($dataAbertura)));
        $listaRecesso = $recessoDao->listaApartirDe($dataTeste);
        
        
        while($this->fimDeSemana($dataAbertura)){
            $dataAbertura = date("Y-m-d 08:00:00", strtotime('+1 day', strtotime($dataAbertura)));
            
        }
        
        while($this->dataPertenceALista($dataAbertura, $listaRecesso)){
            $dataAbertura = date("Y-m-d 08:00:00", strtotime('+1 day', strtotime($dataAbertura)));
        }
        
        
        while($this->foraDoExpediente($dataAbertura)){
            $dataAbertura = date("Y-m-d H:00:00", strtotime('+1 hour', strtotime($dataAbertura)));
        }
        
        
        $timeEstimado = strtotime($dataAbertura);
        $tempoSla++;
        for($i = 0; $i < $tempoSla; $i++)
        {
            
            $timeEstimado = strtotime('+'.$i.' hour', strtotime($dataAbertura));
            $horaEstimada = date("Y-m-d H:i:s", $timeEstimado);
            while($this->fimDeSemana($horaEstimada)){
                $horaEstimada = date("Y-m-d 08:00:00", strtotime('+1 day', strtotime($horaEstimada)));
                $i = $i + 24;
                $tempoSla += 24;
            }
            
            if($this->dataPertenceALista($horaEstimada, $listaRecesso))
            {
                $horaEstimada = date("Y-m-d 08:00:00", strtotime('+1 day', strtotime($horaEstimada)));
                $i = $i + 24;
                $tempoSla += 24;
            }
            
            while($this->foraDoExpediente($horaEstimada)){
                $horaEstimada = date("Y-m-d H:i:s", strtotime('+1 hour', strtotime($horaEstimada)));
                $i++;
                $tempoSla++;
            }
        }
        $horaEstimada = date('Y-m-d H:i:s', $timeEstimado);
        return $horaEstimada;
        
    }


	public function parteInteressada(){
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO ){
	        return true;
	    }else if($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM){
	        return true;
	    }else if($this->selecionado->getUsuarioCliente()->getId() == $this->sessao->getIdUsuario()){
	        return true;
	    }else{
	        return false;
	    }
	}
	public function getColorStatusAlert($siglaStatus){
		$strCartao = ' alert-warning ';
		if($siglaStatus == 'a'){
			$strCartao = '  notice-warning';
		}else if($siglaStatus == 'e'){
			$strCartao = '   alert-primary ';
		}
		else if($siglaStatus == 'f'){
			$strCartao = ' alert-success ';
		}
		else if($siglaStatus == 'g'){
			$strCartao = ' alert-success ';
		}
		else if($siglaStatus == 'h'){
			$strCartao = ' alert-warning ';
		}
		else if($siglaStatus == 'r'){
			$strCartao = '  alert-warning ';
		}
		else if($siglaStatus == 'b'){
			$strCartao = '  alert-warning ';
		}
		else if($siglaStatus == 'c'){
			$strCartao = '  alert-warning';
		}
		else if($siglaStatus == 'd'){
			$strCartao = '  alert-warning ';
		}
		else if($siglaStatus == 'i'){
			$strCartao = ' alert-warning';
		}
		return $strCartao;

	}
	public function getColorStatus($siglaStatus){
		$strCartao = ' alert-warning ';
		if($siglaStatus == 'a'){
			$strCartao = '  notice-warning';
		}else if($siglaStatus == 'e'){
			$strCartao = '  notice-info ';
		}
		else if($siglaStatus == 'f'){
			$strCartao = 'notice-success ';
		}
		else if($siglaStatus == 'g'){
			$strCartao = 'notice-success ';
		}
		else if($siglaStatus == 'h'){
			$strCartao = ' notice-warning ';
		}
		else if($siglaStatus == 'r'){
			$strCartao = '  notice-warning ';
		}
		else if($siglaStatus == 'b'){
			$strCartao = '  notice-warning ';
		}
		else if($siglaStatus == 'c'){
			$strCartao = '   notice-warning ';
		}
		else if($siglaStatus == 'd'){
			$strCartao = '  notice-warning ';
		}
		else if($siglaStatus == 'i'){
			$strCartao = ' notice-warning';
		}
		return $strCartao;

	}
	public function selecionar(){
	    
	    if(!isset($_GET['selecionar'])){
	        return;
	    }
		
	    $this->sessao = new Sessao();
	    $this->selecionado = new Ocorrencia();
	    $this->selecionado->setId($_GET['selecionar']);
	    $this->dao->fillById($this->selecionado);
	    

	    if(!$this->parteInteressada()) 
	    {
	        echo '
            <div class="alert alert-danger" role="alert">
                Você não é cliente deste chamado, nem técnico para atendê-lo. 
            </div>
            ';
	        return;
	    }
		
	    $statusDao = new StatusOcorrenciaCustomDAO($this->dao->getConnection());
	    $listaStatus = $statusDao->pesquisaPorIdOcorrencia($this->selecionado);
	    $dataAbertura = null;
	    foreach($listaStatus as $statusOcorrencia){
            $dataAbertura = $statusOcorrencia->getDataMudanca();
            break;        
	    }

	    
	    if($dataAbertura == null){
	        echo  "Data de abertura não localizada<br>";
	        return;
	        
	    }
		$statusController = new StatusOcorrenciaCustomController();
		$statusDao = new StatusCustomDAO($this->dao->getConnection());
		$status = new Status();
		$status->setSigla($this->selecionado->getStatus());
		$statusDao->fillBySigla($status);
		

	    echo '
            <div class="row">
                <div class="col-md-12 blog-main">';
				echo '<div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';
				$statusController->painelStatus($this->selecionado, $status);
				echo '
    
                </div>

';

				
				
				echo '</div>';

				echo '
                <div class="row  border-bottom mb-3">
                    <div class="col-md-6 blog-main">
                       ';
	   
	    echo '
                    </div>
                    <div class="col-md-6 blog-main">
                    <span class="text-right">';
	    $horaEstimada = $this->calcularHoraSolucao($dataAbertura, $this->selecionado->getServico()->getTempoSla());                    
        echo '
                    </div>   
                    
                    </div>
                </div>
                <div class="col-md-8">
                            
';
	    
        
        $this->view->mostrarSelecionado2($this->selecionado, $listaStatus, $dataAbertura, $horaEstimada);
    
	    

	    
	    

	    
	    echo '
	        
	        
                </div>';

	    echo '
                <aside class="col-md-4 blog-sidebar">';
	    
	    echo '

	        
	        
                    <h4 class="font-italic">Histórico</h4>
                    <div class="container">';
	    
	    foreach($listaStatus as $status){
	        $strCartao = $this->getColorStatus($status->getStatus()->getSigla());
	        
	        
	        echo '
	            
	            
                    <div class="notice '.$strCartao.'">
            	       <strong>'.$status->getStatus()->getNome().'</strong><br>';

	        if($status->getStatus()->getSigla() == StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO){
	            
	            $avaliacao = intval($this->selecionado->getAvaliacao());
	            
	            echo '<br>';
	            for($i = 0; $i < $avaliacao; $i++){
	                echo '<img class="m-2 estrela-1" nota="1" src="img/star1.png" alt="1">';
	            }
	            
	        }
	        echo '<br>
                        

                        '.$status->getMensagem().'<br>
                        <strong>'.$status->getUsuario()->getNome().'<br>'.date('d/m/Y - H:i' ,strtotime($status->getDataMudanca())).'</strong>
            	    </div>
                            
                            
                            
';
	    }	    
	    echo '
	        
</div>
	        
	        
';
	    
	    $mensagemController = new MensagemForumCustomController();
	    
	    $this->dao->fetchMensagens($this->selecionado);
	    $mensagemController->mainOcorrencia($this->selecionado);

	    

        

	    echo '
	          
	        
	        
                </aside>
            </div>';
	    
	    
	    
	    
	    
	    
	}
	public function main(){
	    
	    echo '
	        
<div class="card mb-4">
        <div class="card-body">';
	    
	    if(isset($_GET['selecionar'])){
	        $this->selecionar();
	    }else if(isset($_GET['cadastrar'])){
	        $this->telaCadastro();
	    }
	    else{
	        $this->listar();
	    }
	    
	    
	    
	    echo '
	        
	        
	</div>
</div>
	        
	        
	        
	        
';
	    
	}
	public function painel($lista, $strTitulo, $id, $strShow = ""){
	    echo '
    <div class="panel panel-default" id="panel1">
        <div class="panel-heading">
            <h3 class="pb-4 mb-4 font-italic border-bottom" 
            data-toggle="collapse" data-target="#'.$id.'" href="#'.$id.'">
                '.$strTitulo.'
	        
            <button type="button" class="float-right btn ml-3 
                btn-warning btn-circle btn-lg"  data-toggle="collapse" href="#'.$id.'" role="button" aria-expanded="false" 
                aria-controls="'.$id.'"><i class="fa fa-expand icone-maior"></i></button>
            </h3>
	        
        </div>
        <div id="'.$id.'" class="panel-collapse collapse in '.$strShow.'">
            <div class="panel-body">';
	    $this->view->exibirListaPaginada($lista, 'easyPaginate'.$id);
	    

	    
	    echo '
	        
            </div>
        </div>
    </div>';
	}
	
	public function exibirListagem($lista1, $lista2, $listaAtrasados = array()){

	    if(count($listaAtrasados) > 0){
	        $nChamados = count($listaAtrasados);
	        $this->painel($listaAtrasados, "Ocorrências Em Atraso ($nChamados)", 'collapseAtraso', "show");
	        
	    }
	    $nChamados = count($lista1);
	    $this->painel($lista1, "Ocorrências Em Aberto($nChamados)", 'collapseAberto', 'show');
	    $nChamados = count($lista2);
	    $this->painel($lista2, "Ocorrências Encerradas", 'collapseEncerrada');
	    
       
	    
	    
	}
	public function arrayStatusPendente(){
	    $arrStatus = array();
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_ABERTO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_AGUARDANDO_ATIVO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_AGUARDANDO_USUARIO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_ATENDIMENTO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_REABERTO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_RESERVADO;
	    return $arrStatus;
	}
	public function arrayStatusFinalizado(){
	    
	    $arrStatus = array();
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_FECHADO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_CANCELADO;
	    return $arrStatus;
	}

	public function atrasado(Ocorrencia $ocorrencia)
	{
	    
	    $statusDao = new StatusOcorrenciaCustomDAO($this->dao->getConnection());
	    $listaStatus = $statusDao->pesquisaPorIdOcorrencia($ocorrencia);
	    $dataAbertura = null;
	    if($ocorrencia->getServico()->getTempoSla() < 1){
	        return false;
	    }
        
	    foreach($listaStatus as $statusOcorrencia){
	        if($statusOcorrencia->getStatus()->getSigla() == StatusOcorrenciaCustomController::STATUS_ABERTO || $statusOcorrencia->getStatus()->getSigla() == StatusOcorrenciaCustomController::STATUS_RESERVADO){
	            $dataAbertura = $statusOcorrencia->getDataMudanca();
	            break;
	        }else{
	            $dataAbertura = $statusOcorrencia->getDataMudanca();
	            break;
	        }
	    }
	    if($dataAbertura == null){
	        return false;
	    }else
	    {
	        $horaEstimada = $this->calcularHoraSolucao($dataAbertura, $ocorrencia->getServico()->getTempoSla());
	    }
	    
	    
	    $timeHoje = time();
	    $timeSolucaoEstimada = strtotime($horaEstimada);
	    
	    if($timeHoje > $timeSolucaoEstimada){
            return true;    
	    }else{
            return false;
	    }
	}
	public function filtroAvancado($listaAreas, $listaRequisitantes){

	    $dataAbertura1 = "";
	    $dataAbertura2 = "";
	    
	    if(isset($_GET['data_abertura1'])){
	        $dataAbertura1 = $_GET['data_abertura1'];
	    }
	    if(isset($_GET['data_abertura2'])){
	        $dataAbertura2 = $_GET['data_abertura2'];
	    }
	    echo '
                        <hr/>
                        <form id="form-filtro-avancado">';

        echo '
                            <div class="form-group">
                                <label for="filtro-data-1">Setor Requisitante</label>
                                <select id="select-setores-filtro">
                                  <option value="">Selecione o Setor</option>';
        foreach($listaRequisitantes as $chave => $area){
	        
	        echo '
                                    <option value="'.$chave.'">'.$area.'</option>';
	    }
	    echo '
	        
                                </select>
                              </div>';
	    echo '

	        
                            <div class="form-group">
                                <label for="filtro-data-1">Setor Responsável</label>
                                <select id="select-setores-filtro2">
                                  <option value="">Selecione o Solicitante</option>';
	    foreach($listaAreas as $area){
	        echo '
                                    <option value="'.trim($area->getId()).'">'.trim($area->getNome()).'</option>';
	    }
	    echo '
	        
                                </select>
                              </div>
	        
<hr>
                            <label for="filtro-data-1">Data de Abertura</label>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="filtro-data-1">Data Inicial</label>
                                  <input type="date" class="form-control" id="filtro-data-1" name="filtro-data-1" value="'.$dataAbertura1.'">
                                      
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label for="filtro-data-2">Data Final</label>
                                  <input type="date" class="form-control" id="filtro-data-2" name="filtro-data-2" value="'.$dataAbertura2.'">
                                      
                                </div>
                              </div>
                                      
                            </form>';
	}

	public function cardFiltro($requisitantes){
	    $sessao = new Sessao();
	    
	    $usuario = new Usuario();
	    $usuario->setId($sessao->getIdUsuario());
	    $usuarioDao = new UsuarioCustomDAO();
	    $usuarioDao->fillById($usuario);
	    
        $setor = new AreaResponsavel();
        $setor->setId($usuario->getIdSetor());
        $areaResponsavelDao = new AreaResponsavelCustomDAO();
        $areaResponsavelDao->fillById($setor);
        
        
        $usuario = new Usuario();
        $usuario->setNivel(Sessao::NIVEL_TECNICO);
        $listaTecnicos = $usuarioDao->fetchByNivel($usuario);
        $usuario->setNivel(Sessao::NIVEL_ADM);
        $listaTecnicos2 = $usuarioDao->fetchByNivel($usuario);
        $listaTecnicos = array_merge($listaTecnicos, $listaTecnicos2);
        
        
        $listaAreas = $areaResponsavelDao->fetch();
        
        $checkedSetor = "";
        if(isset($_GET['setor'])){
            $checkedSetor = 'checked';
        }
        $checkedDemanda = "";
        if(isset($_GET['demanda'])){
            $checkedDemanda = 'checked';
        }
        $checkedSolicitacao = "";
        if(isset($_GET['solicitacao'])){
            $checkedSolicitacao = 'checked';
        }
        
        
        $checkedLiberdade = "";
        $checkedAuroras = "";
        $checkedPalmares = "";
        $checkedMales = "";
        if(isset($_GET['campus'])){
            $listaCampus = explode(",", $_GET['campus']);
            foreach($listaCampus as $campus){
                switch($campus){
                    case 'liberdade':
                        $checkedLiberdade = "checked";
                        break;
                    case 'auroras':
                        $checkedAuroras = "checked";
                        break;
                    case 'palmares':
                        $checkedPalmares = "checked";
                        break;
                    case 'males':
                        $checkedMales = "checked";
                        break;
                }
            }
        }
        
        
	    echo '
                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Filtros</h4>
                        <form id="form-filtro-basico">

                            <input type="hidden" value="'.$setor->getId().'" id="meu-setor" name="meu-setor">
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="filtro-meu-setor" '.$checkedSetor.'>
                              <label class="custom-control-label" for="filtro-meu-setor">Demandas ('.$setor->getNome().') </label>
                            </div>


                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="filtro-minhas-demandas" '.$checkedDemanda.'>
                              <label class="custom-control-label" for="filtro-minhas-demandas">Meus Atendimentos</label>
                            </div>

    

                            <div class="custom-control custom-switch mb-3">
                              <input type="checkbox" class="custom-control-input" id="filtro-minhas-solicitacoes" '.$checkedSolicitacao.'>
                              <label class="custom-control-label" for="filtro-minhas-solicitacoes">Minhas Solicitações</label>
                            </div>
                        
                        
                            <div class="form-group">
                                <label for="select-tecnico">Técnico Responsável</label>
                                <select id="select-tecnico">
                                  <option value="">Selecione um atendente</option>';
	    foreach($listaTecnicos as $tecnico){
	        $selectedAtt = '';
	        if(isset($_GET['tecnico'])){
	            if($tecnico->getId() == $_GET['tecnico']){
	                $selectedAtt = 'selected';
	            }
	        }
	        echo '
                                  <option value="'.$tecnico->getId().'" '.$selectedAtt.'>'.$tecnico->getNome().'</option>';
	    }
	    
	    echo '
                                </select>
                              </div>
                        </form>';
	    $this->filtroAvancado($listaAreas, $requisitantes);
        echo '
                            <form id="form-filtro-campus">
                         <hr>
                        <label for="filtro-data-1">Campus</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="filtro-campus-liberdade" '.$checkedLiberdade.'>
                          <label class="form-check-label" for="filtro-campus-liberdade">
                            Liberdade
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="filtro-campus-palmares" '.$checkedPalmares.'>
                          <label class="form-check-label" for="filtro-campus-palmares">
                            Palmares
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="filtro-campus-auroras" '.$checkedAuroras.'>
                          <label class="form-check-label" for="filtro-campus-auroras">
                            Auroras
                          </label>
                        </div>


                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="filtro-campus-males" '.$checkedMales.'>
                          <label class=""font-weight-normal" for="filtro-campus-males">
                            Malês
                          </label>
                        </div>


                        </form>


    
                  </div>

';
	}
	public function getArrayFiltros(){
	    $arrayFiltros = array();
	    if(isset($_GET['setor'])){
	        $arrayFiltros['setor'] = intval($_GET['setor']);
	    }
	    
	    if(isset($_GET['demanda'])){
	        $arrayFiltros['demanda'] = 1;
	    }
	    if(isset($_GET['solicitacao'])){
	        $arrayFiltros['solicitacao'] = 1;
	    }
	    if(isset($_GET['tecnico'])){
	        $arrayFiltros['tecnico'] = intval($_GET['tecnico']);
	    }
	    if(isset($_GET['data_abertura1'])){
	        $arrayFiltros['data_abertura1'] = date("Y-m-d 01:01:01", strtotime($_GET['data_abertura1']));
	    }
	    if(isset($_GET['data_abertura2'])){
	        $arrayFiltros['data_abertura2'] = date("Y-m-d 23:59:59", strtotime($_GET['data_abertura2']));
	    }
	    if(isset($_GET['campus'])){
	        $arrayFiltros['campus'] = $_GET['campus'];
	    }
	    if(isset($_GET['setores_responsaveis'])){
	        $arrayFiltros['setores_responsaveis'] = $_GET['setores_responsaveis'];
	    }
	    if(isset($_GET['setores_requisitantes'])){
	        $arrayFiltros['setores_requisitantes'] = $_GET['setores_requisitantes'];
	    }
	    
	    return $arrayFiltros;
	    
	}
	public function listar(){
	    
	    $sessao = new Sessao();
	    
	    $ocorrencia = new Ocorrencia();
	    $this->sessao = new Sessao();
	    $listaAtrasados = array();
	    
	    $lista = array();
	    
	    
	    
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM)
	    {
	        $ocorrencia->getUsuarioCliente()->setId($this->sessao->getIdUsuario());
	        $lista = $this->dao->pesquisaPorCliente($ocorrencia, $this->arrayStatusPendente());
	        $lista2 = $this->dao->pesquisaPorCliente($ocorrencia, $this->arrayStatusFinalizado());
	        
	        
	    }else if($this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
	        
	        
	        $ocorrencia->getUsuarioCliente()->setId($this->sessao->getIdUsuario());
	        $ocorrencia->setIdUsuarioAtendente($this->sessao->getIdUsuario());
	        $ocorrencia->setIdUsuarioIndicado($this->sessao->getIdUsuario());
	        
	        $usuario = new Usuario();
	        $usuario->setId($this->sessao->getIdUsuario());
	        $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	        $usuarioDao->fillById($usuario);
	        $ocorrencia->getAreaResponsavel()->setId($usuario->getIdSetor());
	        
	        $arrayFiltros = array();
	        $arrayFiltros = $this->getArrayFiltros();
	        
	        $lista = $this->dao->pesquisaParaTec($ocorrencia, $this->arrayStatusPendente(), $arrayFiltros);
	        $lista2 = $this->dao->pesquisaParaTec($ocorrencia, $this->arrayStatusFinalizado(), $arrayFiltros);
	        
	        
	        
	    }else if($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM)
	    {
	        
	        $arrayFiltros = array();
	        $arrayFiltros = $this->getArrayFiltros();
	        
	        $listaPendentes = $this->dao->pesquisaParaTec($ocorrencia, $this->arrayStatusPendente(), $arrayFiltros);
	        $lista2 = $this->dao->pesquisaParaTec($ocorrencia, $this->arrayStatusFinalizado(), $arrayFiltros);
	        
	        
	        foreach($listaPendentes as $ocorrencia){
	            if($this->atrasado($ocorrencia))
	            {
	                $listaAtrasados[] = $ocorrencia;
	            }else{
	                $lista[] = $ocorrencia;
	            }
	        }
	        
	    }
	    
	    
	    
	    
	    echo '
            <div class="row">
                <div class="col-md-8 blog-main">';
	    echo '
                    <div class="panel-group" id="accordion">';
	    
	    
	    $this->exibirListagem($lista, $lista2, $listaAtrasados);
	    $requisitantes = array();
	    foreach($lista as $ocorrencia){
	        $requisitantes[$ocorrencia->getIdLocal()] = $ocorrencia->getLocal();
	    }
	    
	    foreach($lista2 as $ocorrencia){
	        $requisitantes[$ocorrencia->getIdLocal()] = $ocorrencia->getLocal();
	    }
	    
	    $requisitantes = array();
	    foreach($lista as $ocorrencia){
	        $requisitantes[$ocorrencia->getIdLocal()] = $ocorrencia->getLocal();
	    }
	    foreach($listaAtrasados as $ocorrencia){
	        $requisitantes[$ocorrencia->getIdLocal()] = $ocorrencia->getLocal();
	    }

	    
	    
	    echo '
                    </div>';//Fecha panel-group
	    echo '</div>';//fecha col-md-8
	    
	    echo '
	        
	        
	        
	        
            <aside class="col-md-4 blog-sidebar">';
	    if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
	       $this->cardFiltro($requisitantes);    
	    }
	    
	    echo '

               

	        
                  <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Sobre o Novíssimo 3s</h4>
                    <p class="mb-0">
                        Esta é uma aplicação completamente nova desenvolvida pela DTI do zero.
                        Tudo foi refeito, desde o design até a estrutura de banco de dados.
                        Os chamados antigos foram preservados em uma nova estrutura de banco de dados.
	        
                    </p>
                  </div>
                </aside><!-- /.blog-sidebar -->
            </div>';//Fecha row
	    
	    

	    
	    
	    
	}
	
	public function telaCadastro() {
	    $this->sessao = new Sessao();

		$ocorrencia = new Ocorrencia();
		$ocorrencia->getUsuarioCliente()->setId($this->sessao->getIdUsuario());
		$listaNaoAvaliados = $this->dao->fetchByUsuarioClienteNaoAvaliados($ocorrencia);		
		

	    echo '
            <div class="row">
                <div class="col-md-12 blog-main">
                    
	        
';
	    $servicoDao = new ServicoCustomDAO($this->dao->getConnection());
	    $servico = new Servico();
	    $servico->setVisao(1);
	    
	    $listaServico = $servicoDao->fetchByVisao($servico);
	    
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
	        $servico->setVisao(2);
	        $lista2 = $servicoDao->fetchByVisao($servico);
	        $listaServico = array_merge($listaServico, $lista2);
	    }
	    if(count($listaNaoAvaliados) == 0){
			echo '
			<h3 class="pb-4 mb-4 font-italic border-bottom">
                        Cadastrar Ocorrência
                    </h3>
			';
			$this->view->mostraFormInserir2($listaServico);
		}else{
			echo '
			<h3 class="pb-4 mb-4 font-italic border-bottom" data-toggle="collapse" data-target="#collapseAberto" href="#collapseAberto" aria-expanded="true">
				Para continuar confirme os chamados fechados. 
            </h3>';//public function exibirLista($lista)
			$this->view->exibirLista($listaNaoAvaliados);
			
		}
	    
	    
	    
	    
	    echo '
                </div>
            </div>';
	}
	
	
	public function mainAjax() {
	    if(!isset($_POST['enviar_ocorrencia'])){
	        return;
	    }
	    
	    
	    
	    if (! (
	        isset ( $_POST ['descricao'] ) &&
	        isset ( $_POST ['campus'] )  &&
	        isset ( $_POST ['email'] ) &&
	        isset ( $_POST ['patrimonio'] ) &&
	        isset ( $_POST ['ramal'] ) &&
	        isset ( $_POST ['local_sala'] ) &&
	        isset($_POST ['servico']))) {
	            echo ':incompleto';
	            return;
	        }
	        
	        $ocorrencia = new Ocorrencia ();
	        $usuario = new Usuario();
	        $sessao = new Sessao();
	        $usuario->setId($sessao->getIdUsuario());
	        
	        
	        $usuarioDao = new UsuarioCustomDAO($this->dao->getConnection());
	        
	        $usuarioDao->fillById($usuario);
	        
	        $idUnidade = $usuarioDao->getIdUnidade($usuario);
	        
	        if(count($idUnidade) > 0){
	            foreach($idUnidade as $id => $sigla){
	                $ocorrencia->setIdLocal ( $id );
	                $ocorrencia->setLocal ( $sigla );
	            }
	        }
	        if(trim($ocorrencia->getLocal()) == ""){
	            $ocorrencia->setLocal ( 'teste' );
	        }
	        if(trim($ocorrencia->getIdLocal()) == ""){
	            $ocorrencia->setIdLocal ( 1 );
	        }
	        
	        $ocorrencia->setStatus (StatusOcorrenciaCustomController::STATUS_ABERTO);
	        
	        $ocorrencia->getServico()->setId ( $_POST ['servico'] );
	        $servicoDao = new ServicoDAO($this->dao->getConnection());
	        $servicoDao->fillById($ocorrencia->getServico());	        
	        $ocorrencia->getAreaResponsavel()->setId ( $ocorrencia->getServico()->getAreaResponsavel()->getId());
	        
	        $ocorrencia->setDescricao ( $_POST ['descricao'] );
	        $ocorrencia->setCampus ( $_POST ['campus'] );
	        $ocorrencia->setPatrimonio ( $_POST ['patrimonio'] );
	        $ocorrencia->setRamal ( $_POST ['ramal'] );
	        $ocorrencia->setEmail ( $_POST ['email'] );
	        $ocorrencia->setDataAbertura(date("Y-m-d H:i:s"));
	        if(!file_exists('uploads/ocorrencia/anexo/')) {
	            mkdir('uploads/ocorrencia/anexo/', 0777, true);
	        }
	        
	        if($_FILES['anexo']['name'] != null){
	            if(!file_exists('uploads/')) {
	                mkdir('uploads/', 0777, true);
	            }
	            $novoNome =$_FILES['anexo']['name'];
	            
	            if(file_exists('uploads/'.$_FILES['anexo']['name']))
	            {
	                $novoNome = uniqid().'_'.$novoNome;
	                
	            }
	            
	            $extensaoArr = explode('.', $novoNome);
	            $extensao = strtolower(end($extensaoArr));
	            
	            $extensoes_permitidas = array(
	                'xlsx','xlsm','xlsb','xltx','xltm','xls','xlt','xls','xml','xml','xlam','xla','xlw','xlr',
	                'doc', 'docm', 'docx', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'pdf', 'rtf', 'txt', 'wps', 'xml', 'zip', 'rar', 'ovpn',
	                'xml', 'xps','jpg', 'gif', 'png', 'pdf', 'jpeg');
	            
	            if(!(in_array($extensao, $extensoes_permitidas))){
	                echo ':falha:Extensão não permitida. Lista de extensões permitidas a seguir. ';
	                echo '('.implode(", ", $extensoes_permitidas).')';
	                return;
	            }
	            
	            
	            if(!move_uploaded_file($_FILES['anexo']['tmp_name'], 'uploads/'. $novoNome))
	            {
	                echo ':falha:arquivo não pode ser enviado';
	                return;
	            }
	            $ocorrencia->setAnexo ( $novoNome);
	            
	        }
	        
	        $ocorrencia->setLocalSala ( $_POST ['local_sala'] );
	        
	        $ocorrencia->getUsuarioCliente()->setId ( $sessao->getIdUsuario() );
	        
	        $statusOcorrenciaDAO = new StatusOcorrenciaDAO($this->dao->getConnection());
	        
	        $statusOcorrencia = new StatusOcorrencia();
	        $statusOcorrencia->setDataMudanca(date("Y-m-d H:i:s"));
	        $statusOcorrencia->getStatus()->setId(2);
	        $statusOcorrencia->setUsuario($usuario);
	        $statusOcorrencia->setMensagem("Ocorrência liberada para que qualquer técnico possa atender.");
	        
	        $this->dao->getConnection()->beginTransaction();
	        
	        if ($this->dao->insert( $ocorrencia ))
	        {
	            $id = $this->dao->getConnection()->lastInsertId();
	            $ocorrencia->setId($id);
	            $statusOcorrencia->setOcorrencia($ocorrencia);
	            if($statusOcorrenciaDAO->insert($statusOcorrencia))
	            {
	                echo ':sucesso:'.$id;
	                $this->emailAbertura($statusOcorrencia);
	                $this->dao->getConnection()->commit();
	            }else
	            {
	                echo ':falha';
	                $this->dao->getConnection()->rollBack();
	            }
	        } else {
	            echo ':falha';
	            $this->dao->getConnection()->rollBack();
	        }
	        
	}
	
	public function emailAbertura(StatusOcorrencia $statusOcorrencia)
	{
	    $mail = new Mail();
	    $destinatario = $statusOcorrencia->getOcorrencia()->getEmail();
	    $nome = $statusOcorrencia->getUsuario()->getNome();
	    $assunto = "[3S] - Chamado Nº ".$statusOcorrencia->getOcorrencia()->getId();
	    $corpo =  '<p>Prezado(a) ' . $statusOcorrencia->getUsuario()->getNome().' ,</p>';
	    $corpo .= '<p>Sua solicitação foi realizada com sucesso, solicitação Nº'.$statusOcorrencia->getOcorrencia()->getId().'</p>';
	    $corpo .= '<ul>
                        <li>Serviço Solicitado: '. $statusOcorrencia->getOcorrencia()->getServico()->getNome().'</li>
                        <li>Descrição do Problema: '.$statusOcorrencia->getOcorrencia()->getDescricao().'</li>
                        <li>Setor Responsável: '. $statusOcorrencia->getOcorrencia()->getServico()->getAreaResponsavel()->getNome().' -
                        '.$statusOcorrencia->getOcorrencia()->getServico()->getAreaResponsavel()->getDescricao().'</li>
                </ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';
                
	    $mail->enviarEmail($destinatario, $nome, $assunto, $corpo);
	    
	}
	public function possoPedirAjuda(){
	    if($this->sessao == Sessao::NIVEL_DESLOGADO){
	        return false;
	    }
	    return true;
	}
	public function ajaxPedirAjuda(){
	    $this->sessao = new Sessao();


	    if(!isset($_POST['pedir_ajuda'])){
	        echo ':falha: Não posso pedir ajuda';
	        return;
	    }
	    if(!isset($_POST['ocorrencia'])){
	        echo ':falha:Falta ocorrencia';
	        return;
	    }
	    $ocorrencia = new Ocorrencia();
	    $ocorrencia->setId($_POST['ocorrencia']);
	    
	    $this->dao->fillById($ocorrencia);
	    
	    if(!$this->possoPedirAjuda()){
	        echo ':falha:';
	        return;
	    }
	    
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    $usuario = new Usuario();
	    $usuario->setIdSetor($ocorrencia->getAreaResponsavel()->getId());
	    
	    $lista = $usuarioDao->fetchByIdSetor($usuario);
	    

	    $mail = new Mail();
	    
	    $assunto = "[3S] - Chamado Nº ".$ocorrencia->getId();
	    $corpo = '<p>A solicitação Nº'.$ocorrencia->getId().' está com atraso em relação ao SLA e o cliente solicitou ajuda</p>';
	    $corpo .= '<ul>
                        <li>Serviço Solicitado: '. $ocorrencia->getServico()->getNome().'</li>
                        <li>Descrição do Problema: '.$ocorrencia->getDescricao().'</li>
                        <li>Setor Responsável: '. $ocorrencia->getServico()->getAreaResponsavel()->getNome().' -
                        '.$ocorrencia->getServico()->getAreaResponsavel()->getDescricao().'</li>
                </ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';
	    
	    
	    foreach($lista as $adm){
	        if($adm->getNivel() == Sessao::NIVEL_ADM){
	            $saudacao =  '<p>Prezado(a) ' . $adm->getNome().' ,</p>';
	            $mail->enviarEmail($adm->getEmail(), $adm->getNome(), $assunto, $saudacao.$corpo);
	        }
	    }	    
	    $_SESSION['pediu_ajuda'] = 1;
	    echo ':sucesso:UM e-mail foi enviado aos chefes:';
	    
	    
	}

	        
}
?>