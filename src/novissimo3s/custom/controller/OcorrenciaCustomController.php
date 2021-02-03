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

class OcorrenciaCustomController  extends OcorrenciaController {
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

	public function __construct(){
		$this->dao = new OcorrenciaCustomDAO();
		$this->view = new OcorrenciaCustomView();
	}



	public function editarSolucao(){
	    //
	}
	
	public function alterarServico(){
	    //
	}
	
	private $selecionado; 
	private $sessao;
	
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
	    
	    echo '
            <div class="row">
                <div class="col-md-8 blog-main">
                    <h3 class="pb-4 mb-4 font-italic border-bottom">
                        #'.$this->selecionado->getId().' - '.$this->selecionado->getServico()->getNome().'
                    </h3>
                            
';
	    
	    $statusDao = new StatusOcorrenciaCustomDAO($this->dao->getConnection());
	    $listaStatus = $statusDao->pesquisaPorIdOcorrencia($this->selecionado);
	    $dataAbertura = null;
	    foreach($listaStatus as $statusOcorrencia){
	        if($statusOcorrencia->getStatus()->getSigla() == 'a'){
	            $dataAbertura = $statusOcorrencia->getDataMudanca();
	            break;
	        }
	    }
	    if($dataAbertura == null){
	        echo  "Chamado não possui histórico de status<br>";
	        return;
	    }
	    
	    
	    $horaEstimada = $this->calcularHoraSolucao($dataAbertura, $this->selecionado->getServico()->getTempoSla());
	    $this->view->mostrarSelecionado2($this->selecionado, $listaStatus, $dataAbertura, $horaEstimada);
	    

	    
	    echo '
	        
	        
                </div>';

	    echo '
                <aside class="col-md-4 blog-sidebar">';
	    $statusController = new StatusCustomController();
	    
	    $statusController->painelStatus($this->selecionado);
	    echo '

	        
	        
                    <h4 class="font-italic">Histórico</h4>
                    <div class="container">';
	    
	    foreach($listaStatus as $status){
	        $strCartao = ' alert-warning ';
	        if($status->getStatus()->getSigla() == 'a'){
	            $strCartao = '  notice-warning';
	        }else if($status->getStatus()->getSigla() == 'e'){
	            $strCartao = '  notice-info ';
	        }
	        else if($status->getStatus()->getSigla() == 'f'){
	            $strCartao = 'notice-success ';
	        }
	        else if($status->getStatus()->getSigla() == 'g'){
	            $strCartao = 'notice-success ';
	        }
	        else if($status->getStatus()->getSigla() == 'h'){
	            $strCartao = ' notice-warning ';
	        }
	        else if($status->getStatus()->getSigla() == 'r'){
	            $strCartao = '  notice-warning ';
	        }
	        else if($status->getStatus()->getSigla() == 'b'){
	            $strCartao = '  notice-warning ';
	        }
	        else if($status->getStatus()->getSigla() == 'c'){
	            $strCartao = '   notice-warning ';
	        }
	        else if($status->getStatus()->getSigla() == 'd'){
	            $strCartao = '  notice-warning ';
	        }
	        else if($status->getStatus()->getSigla() == 'i'){
	            $strCartao = ' notice-warning';
	        }
	        
	        
	        echo '
	            
	            
                    <div class="notice '.$strCartao.'">
            	       <strong>'.$status->getStatus()->getNome().'</strong><br>
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
	
	public function listar(){
	    echo '
            <div class="row">
                <div class="col-md-8 blog-main">';
	    echo '
            <div class="row">
                    <div class="col-md-10">
                        <h3 class="pb-4 mb-4 font-italic border-bottom">
                            Lista de Ocorrências
                        </h3>
	        
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-warning btn-circle btn-lg"  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-filter icone-maior"></i></button>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                                Local reservado para o formulário de edição de filtros.
                              </div><br><br>
                            </div>
                        </div>
	        
                    </div>';
	    $ocorrencia = new Ocorrencia();
	    $sessao = new Sessao();
	    $ocorrencia->getUsuarioCliente()->setId($sessao->getIdUsuario());
	    
	    $lista = $this->dao->pesquisaPorCliente($ocorrencia);
	    
	    
	    
	    $this->view->exibirLista($lista);
	    
	    
	    
	    
	    echo '
	        
	        
	        
	        
                </div>
                <aside class="col-md-4 blog-sidebar">
                  <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Sobre o novíssimo 3s</h4>
                    <p class="mb-0">Esta é uma aplicação completamente nova desenvolvida pela DTI. Tudo foi refeito, desde o design até a estrutura de banco de dados.
                                    Os chamados antigos foram preservados em uma nova estrutura,
                                    a responsividade foi adicionada e muitas falhas de segurança foram sanadas. </p>
                  </div>
	        
	        
	        
                </aside><!-- /.blog-sidebar -->
	        
	        
	        
            </div>';
	    
	    
	    
	}
	
	public function telaCadastro() {
	    
	    echo '
            <div class="row">
                <div class="col-md-12 blog-main">
                    <h3 class="pb-4 mb-4 font-italic border-bottom">
                        Cadastrar Ocorrência
                    </h3>
	        
';
	    $servicoDao = new ServicoCustomDAO($this->dao->getConnection());
	    $servico = new Servico();
	    $servico->setVisao(1);
	    $listaServico = $servicoDao->fetchByVisao($servico);
	    //Javascript envia esses dados pelo $.ajax
	    $this->view->mostraFormInserir2($listaServico);
	    
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
	        
	        $ocorrencia->setIdLocal ( 1 );
	        $ocorrencia->setLocal ( 'teste' );
	        $ocorrencia->setStatus ( 'a');
	        $ocorrencia->getAreaResponsavel()->setId ( 1 );
	        
	        $ocorrencia->setDescricao ( $_POST ['descricao'] );
	        $ocorrencia->setCampus ( $_POST ['campus'] );
	        $ocorrencia->setPatrimonio ( $_POST ['patrimonio'] );
	        $ocorrencia->setRamal ( $_POST ['ramal'] );
	        $ocorrencia->setEmail ( $_POST ['email'] );
	        
	        if(!file_exists('uploads/ocorrencia/anexo/')) {
	            mkdir('uploads/ocorrencia/anexo/', 0777, true);
	        }
	        
	        if($_FILES['anexo']['tmp_name'] != null){
	            if(!move_uploaded_file($_FILES['anexo']['tmp_name'], 'uploads/ocorrencia/anexo/'. $_FILES['anexo']['name']))
    	        {
    	            echo ':falha';
    	            return;
    	        }
    	        $ocorrencia->setAnexo ( "uploads/ocorrencia/anexo/".$_FILES ['anexo']['name'] );
	        }
	        
	        $ocorrencia->setLocalSala ( $_POST ['local_sala'] );
	        
	        $ocorrencia->getServico()->setId ( $_POST ['servico'] );
	        
	        
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
	            $statusOcorrencia->getOcorrencia()->setId($id);
	            if($statusOcorrenciaDAO->insert($statusOcorrencia))
	            {
	                echo ':sucesso:'.$id;
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
	
	        
}
?>