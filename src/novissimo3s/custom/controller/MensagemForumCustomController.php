<?php
            
/**
 * Customize o controller do objeto MensagemForum aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\MensagemForumController;
use novissimo3s\custom\dao\MensagemForumCustomDAO;
use novissimo3s\custom\view\MensagemForumCustomView;
use novissimo3s\model\Ocorrencia;
use novissimo3s\model\MensagemForum;
use novissimo3s\util\Sessao;
use novissimo3s\util\Mail;
use novissimo3s\dao\OcorrenciaDAO;
use novissimo3s\model\Usuario;
use novissimo3s\dao\UsuarioDAO;

class MensagemForumCustomController  extends MensagemForumController {
    const TIPO_ARQUIVO = 2;
    const TIPO_TEXTO = 1;
    public function add() {
        if(!isset($_GET['selecionar'])){
            return;
        }
        $ocorrencia = new Ocorrencia();
        $ocorrencia->setId($_GET['selecionar']);
        
        if(!isset($_POST['enviar_mensagem_forum'])){
            $this->view->showInsertForm2($ocorrencia);
            return;
        }
        
    }
    
    
    
    public function addAjax() {
        
        $sessao = new Sessao();
        if(!isset($_POST['enviar_mensagem_forum'])){
            return;
        }
        if (! ( isset ( $_POST ['tipo'] )
            && isset ( $_POST ['mensagem'] )
            && isset ( $_POST ['ocorrencia'] ) )) {
                echo ':incompleto';
                return;
            }
            
            $mensagemForum = new MensagemForum ();
            $mensagemForum->setTipo ($_POST ['tipo']);
            
            if($_POST['tipo'] == MensagemForumCustomController::TIPO_TEXTO){
                $mensagemForum->setMensagem ( $_POST ['mensagem'] );
            }else{
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
                        echo ':falha';
                        return;
                    }
                    $mensagemForum->setMensagem ( $novoNome );
                }
                
            }
            
            
            $mensagemForum->setDataEnvio (date("Y-m-d G:i:s") );
            
            $mensagemForum->getUsuario()->setId ( $sessao->getIdUsuario() );
            $ocorrencia = new Ocorrencia();
            $ocorrencia->setId($_POST['ocorrencia']);
            
            
            if ($this->dao->insert ( $mensagemForum, $ocorrencia ))
            {
                echo ':sucesso:'.$ocorrencia->getId();
                $this->enviaEmail($mensagemForum, $ocorrencia);
                
            } else {
                echo ':falha';
            }
    }
    public function enviaEmail(MensagemForum $mensagemForum, Ocorrencia $ocorrencia){
        $mail = new Mail();
        
        $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
        $ocorrenciaDao->fillById($ocorrencia);
        
        $assunto = "[3S] - Chamado Nº ".$ocorrencia->getId();
        
        
        
        $saldacao =  '<p>Prezado(a) ' . $ocorrencia->getUsuarioCliente()->getNome().' ,</p>';
        $corpo = '<p>Avisamos que houve uma mudança no status da solicitação Nº'.$ocorrencia->getId().'</p>';
        
        $corpo .= '<ul>

                        <li>Corpo: '.$mensagemForum->getMensagem().'</li>
                        <li>Serviço Solicitado: '. $ocorrencia->getServico()->getNome().'</li>
                        <li>Descrição do Problema: '.$ocorrencia->getDescricao().'</li>
                        <li>Setor Responsável: '. $ocorrencia->getServico()->getAreaResponsavel()->getNome().' -
                        '.$ocorrencia->getServico()->getAreaResponsavel()->getDescricao().'</li>
                        <li>Cliente: '.$ocorrencia->getUsuarioCliente()->getNome().'</li>
                </ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';
        
        
        $destinatario = $this->statusOcorrencia->getOcorrencia()->getEmail();
        $nome = $this->statusOcorrencia->getOcorrencia()->getUsuarioCliente()->getNome();
        $mail->enviarEmail($destinatario, $nome, $assunto, $saldacao.$corpo);
        
        
        $usuarioDao = new UsuarioDAO($this->dao->getConnection());
        if($ocorrencia->getIdUsuarioAtendente() != null){
            
            $atendente = new Usuario();
            $atendente->setId($ocorrencia->getIdUsuarioAtendente());
            $usuarioDao->fillById($atendente);
            $destinatario = $atendente->getEmail();
            $nome = $atendente->getNome();
            
            $saldacao =  '<p>Prezado(a) ' . $nome.' ,</p>';
            $mail->enviarEmail($destinatario, $nome, $assunto, $saldacao.$corpo);
            
        }
        else if($ocorrencia->getIdUsuarioIndicado() != null)
        {
            
            $indicado = new Usuario();
            $indicado->setId($ocorrencia->getIdUsuarioIndicado());
            $usuarioDao->fillById($indicado);
            $destinatario = $indicado->getEmail();
            $nome = $indicado->getNome();
            
            $saldacao =  '<p>Prezado(a) ' . $nome.' ,</p>';
            $mail->enviarEmail($destinatario, $nome, $assunto, $saldacao.$corpo);
        }
        
    }
    
    
    public function mainOcorrencia(Ocorrencia $ocorrencia){
        echo '	        
            <div class="container">
                <h4 class="font-italic">Mensagens</h4>
                <div class="container">
                	';

        
	    $listaForum = $ocorrencia->getMensagens();
	    foreach($listaForum as $mensagemForum){

	        echo '

<div class="row">
                    <div class="notice notice-info">';
	        if($mensagemForum->getTipo() == self::TIPO_ARQUIVO){
	            echo 'Anexo: <a href="uploads/'.$mensagemForum->getMensagem().'">Clique aqui</a><br>';
	        }else{
	            echo '
                        '.strip_tags($mensagemForum->getMensagem()).'<br>';
	        }
	        
	        echo '
                        <strong>'.$mensagemForum->getUsuario()->getNome().'| '.date("d/m/Y H:i",strtotime($mensagemForum->getDataEnvio())).'</strong><br>
            	    </div>
</div>
';

	    }
        
        
        echo '
                    	
                    </div>
                  </div>';
        if($ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO){
            return;
        }
        if($ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO){
            return;
        }
        if($ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_CANCELADO){
            return;
        }
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == SESSAO::NIVEL_COMUM){
            if($sessao->getIdUsuario() != $ocorrencia->getUsuarioCliente()->getId()){
                return;
            }
        }
        if($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
            if($ocorrencia->getIdUsuarioAtendente() != $sessao->getIdUsuario())
            {
                if($sessao->getIdUsuario() != $ocorrencia->getUsuarioCliente()->getId()){
                    return;
                }
            }
        }
        echo '<div class="p-4 mb-3 bg-light rounded">';
        $this->add();
        echo '</div>';
    }

    
	public function __construct(){
		$this->dao = new MensagemForumCustomDAO();
		$this->view = new MensagemForumCustomView();
	}


	        
}
?>