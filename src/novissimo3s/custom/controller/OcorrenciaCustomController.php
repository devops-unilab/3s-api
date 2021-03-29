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
use novissimo3s\custom\view\StatusCustomView;

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
	    echo '
            <div class="row">
                <div class="col-md-12 blog-main">
                <div class="row  border-bottom mb-3">
                    <div class="col-md-6 blog-main">
                        <h3 class="pb-4 mb-1 font-italic">
                            Chamado Nº'.$this->selecionado->getId().'
                        </h3>';
	    
	    $statusController = new StatusOcorrenciaCustomController();
	    $statusController->painelStatus($this->selecionado);
	    

	    
	    
	    echo '


                    </div>
                    <div class="col-md-6 blog-main">

                    <span class="text-right">';
	    
	    $horaEstimada = $this->calcularHoraSolucao($dataAbertura, $this->selecionado->getServico()->getTempoSla());
	    
	    if($this->selecionado->getServico()->getTempoSla() >= 1){
	        $this->view->painelTopoSLA($this->selecionado, $listaStatus, $dataAbertura, $horaEstimada);
	    }else{
	        echo ' Sla Não definido ';
	    }
            
                    
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
	public function painel($lista, $strTitulo, $id){
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
        <div id="'.$id.'" class="panel-collapse collapse in">
            <div class="panel-body">';
	    $this->view->exibirLista($lista);
	    echo '
	        
            </div>
        </div>
    </div>';
	}
	
	public function exibirListagem($lista1, $lista2, $listaAtrasados = array()){
	    echo '
            <div class="row">
                <div class="col-md-8 blog-main">';
	    echo '

                    <div class="panel-group" id="accordion">';
	    if(count($listaAtrasados) > 0){
	        $this->painel($listaAtrasados, "Ocorrências Em Atraso", 'collapseAtraso');
	        
	    }
	    $this->painel($lista1, "Ocorrências Em Aberto", 'collapseAberto');
	    $this->painel($lista2, "Ocorrências Encerradas", 'collapseEncerrada');
	    
        echo '    
                    </div>';//Fecha panel-group
        echo '</div>';//fecha col-md-8
	    
	    echo '
                <aside class="col-md-4 blog-sidebar">
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
	public function arrayStatusPendente(){
	    $arrStatus = array();
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_ABERTO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_AGUARDANDO_ATIVO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_AGUARDANDO_USUARIO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_ATENDIMENTO;
	    $arrStatus[] = StatusOcorrenciaCustomController::STATUS_REABERTO;
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
	public function listar(){
	    
	    
	    $ocorrencia = new Ocorrencia();
	    $this->sessao = new Sessao();
	    
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM)
	    {
	       $ocorrencia->getUsuarioCliente()->setId($this->sessao->getIdUsuario());
	       $lista = $this->dao->pesquisaPorCliente($ocorrencia, $this->arrayStatusPendente());
	       $lista2 = $this->dao->pesquisaPorCliente($ocorrencia, $this->arrayStatusFinalizado());
	       $this->exibirListagem($lista, $lista2);
	       
	    }else if($this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
	        
	        
	        $ocorrencia->getUsuarioCliente()->setId($this->sessao->getIdUsuario());
	        $ocorrencia->setIdUsuarioAtendente($this->sessao->getIdUsuario());
	        $ocorrencia->setIdUsuarioIndicado($this->sessao->getIdUsuario());
	        
	        $usuario = new Usuario();
	        $usuario->setId($this->sessao->getIdUsuario());
	        $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	        $usuarioDao->fillById($usuario);
	        $ocorrencia->getAreaResponsavel()->setId($usuario->getIdSetor());

	        $lista = $this->dao->pesquisaParaTec($ocorrencia, $this->arrayStatusPendente());
	        $lista2 = $this->dao->pesquisaParaTec($ocorrencia, $this->arrayStatusFinalizado());
	        
	        $this->exibirListagem($lista, $lista2);
	        
	    }else if($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM)
	    {
	        
	        $listaPendentes = $this->dao->pesquisaAdmin($ocorrencia, $this->arrayStatusPendente());
	        $lista2 = $this->dao->pesquisaAdmin($ocorrencia, $this->arrayStatusFinalizado());
	        $listaAtrasados = array();
	        $listaNaoAtrasados = array();
	        foreach($listaPendentes as $ocorrencia){
	            if($this->atrasado($ocorrencia))
	            {
	                $listaAtrasados[] = $ocorrencia;
	            }else{
	                $listaNaoAtrasados[] = $ocorrencia;
	            }
	        }
	        $this->exibirListagem($listaNaoAtrasados, $lista2, $listaAtrasados);
	        
	    }
	    
	    
	    
	    
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
	    $this->sessao = new Sessao();
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
	        $servico->setVisao(2);
	        $lista2 = $servicoDao->fetchByVisao($servico);
	        $listaServico = array_merge($listaServico, $lista2);
	    }
	    
	    
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
	            
	            $extensoes_permitidas = array('jpg', 'gif', 'png', 'pdf', 'jpeg');
	            if(!(in_array($extensao, $extensoes_permitidas))){
	                echo $extensao;
	                echo ':falha:Extensão não permitida';
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