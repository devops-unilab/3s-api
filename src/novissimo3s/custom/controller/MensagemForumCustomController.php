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
        
        
        $destinatario = $ocorrencia->getEmail();
        $nome = $ocorrencia->getUsuarioCliente()->getNome();
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
    
    public function chat(Ocorrencia $ocorrencia){
        echo '


<div class="container">
	<div class="row">
	    <div class="chatbox chatbox22 chatbox--tray">
    <div class="chatbox__title">
        <h5><a href="javascript:void()">Ocorrênncia #'.$ocorrencia->getId().'</a></h5>
        <!--<button class="chatbox__title__tray">
            <span></span>
        </button>-->
        <button class="chatbox__title__close">
            <span>
                <svg viewBox="0 0 12 12" width="12px" height="12px">
                    <line stroke="#FFFFFF" x1="11.75" y1="0.25" x2="0.25" y2="11.75"></line>
                    <line stroke="#FFFFFF" x1="11.75" y1="11.75" x2="0.25" y2="0.25"></line>
                </svg>
            </span>
        </button>
    </div>
    <div class="chatbox__body">
        <div class="chatbox__body__message chatbox__body__message--left">
		
		<div class="chatbox_timing">
		<ul>
		<li><a href="#"><i class="fa fa-calendar"></i> 22/11/2018</a></li>
			<li><a href="#"><i class="fa fa-clock-o"></i> 7:00 PM</a></a></li>
		</ul>
		</div>
            <img src="https://www.gstatic.com/webp/gallery/2.jpg" alt="Picture">
			<div class="clearfix"></div>
			<div class="ul_section_full">
			<ul class="ul_msg">
			<li><strong>Person Name</strong></li>
			<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
			</ul>
			<div class="clearfix"></div>
			<ul class="ul_msg2">
			<li><a href="#"><i class="fa fa-pencil"></i> </a></li>
			<li><a href="#"><i class="fa fa-trash chat-trash"></i></a></li>
			</ul>
			</div>
			 
        </div>
        <div class="chatbox__body__message chatbox__body__message--right">
		
		<div class="chatbox_timing">
		<ul>
		<li><a href="#"><i class="fa fa-calendar"></i> 22/11/2018</a></li>
			<li><a href="#"><i class="fa fa-clock-o"></i> 7:00 PM</a></a></li>
		</ul>
		</div>
	
            <img src="https://www.gstatic.com/webp/gallery/2.jpg" alt="Picture">
			<div class="clearfix"></div>
			<div class="ul_section_full">
			<ul class="ul_msg">
			<li><strong>Person Name</strong></li>
			<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
			</ul>
			<div class="clearfix"></div>
			<ul class="ul_msg2">
			<li><a href="#"><i class="fa fa-pencil"></i> </a></li>
			<li><a href="#"><i class="fa fa-trash chat-trash"></i></a></li>
			</ul>
			</div>
			 
        </div>
        <div class="chatbox__body__message chatbox__body__message--left">
		
		<div class="chatbox_timing">
		<ul>
		<li><a href="#"><i class="fa fa-calendar"></i> 22/11/2018</a></li>
			<li><a href="#"><i class="fa fa-clock-o"></i> 7:00 PM</a></a></li>
		</ul>
		</div>
	
            <img src="https://www.gstatic.com/webp/gallery/2.jpg" alt="Picture">
			<div class="clearfix"></div>
			<div class="ul_section_full">
			<ul class="ul_msg">
			<li><strong>Person Name</strong></li>
			<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
			</ul>
			<div class="clearfix"></div>
			<ul class="ul_msg2">
			<li><a href="#"><i class="fa fa-pencil"></i> </a></li>
			<li><a href="#"><i class="fa fa-trash chat-trash"></i></a></li>
			</ul>
			</div>
			 
        </div>
        <div class="chatbox__body__message chatbox__body__message--right">
		
		<div class="chatbox_timing">
		<ul>
		<li><a href="#"><i class="fa fa-calendar"></i> 22/11/2018</a></li>
			<li><a href="#"><i class="fa fa-clock-o"></i> 7:00 PM</a></a></li>
		</ul>
		</div>
	
            <img src="https://www.gstatic.com/webp/gallery/2.jpg" alt="Picture">
			<div class="clearfix"></div>
			<div class="ul_section_full">
			<ul class="ul_msg">
			<li><strong>Person Name</strong></li>
			<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
			</ul>
			<div class="clearfix"></div>
			<ul class="ul_msg2">
			<li><a href="#"><i class="fa fa-pencil"></i> </a></li>
			<li><a href="#"><i class="fa fa-trash chat-trash"></i></a></li>
			</ul>
			</div>
			 
        </div>
        <div class="chatbox__body__message chatbox__body__message--left">
		
		<div class="chatbox_timing">
		<ul>
		<li><a href="#"><i class="fa fa-calendar"></i> 22/11/2018</a></li>
			<li><a href="#"><i class="fa fa-clock-o"></i> 7:00 PM</a></a></li>
		</ul>
		</div>
	
            <img src="https://www.gstatic.com/webp/gallery/2.jpg" alt="Picture">
			<div class="clearfix"></div>
			<div class="ul_section_full">
			<ul class="ul_msg">
			<li><strong>Person Name</strong></li>
			<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
			</ul>
			<div class="clearfix"></div>
			<ul class="ul_msg2">
			<li><a href="#"><i class="fa fa-pencil"></i> </a></li>
			<li><a href="#"><i class="fa fa-trash chat-trash"></i></a></li>
			</ul>
			</div>
			 
        </div>
    </div>
    <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm chat_set_height" placeholder="Type your message here..." tabindex="0" dir="ltr" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off" contenteditable="true" />
						
                        <span class="input-group-btn">
                            <button class="btn bt_bg btn-sm" id="btn-chat">
                                Send</button>
                        </span>
                    </div>
                </div>
</div>
	    
	</div>
	</div>

';
    }
    
    public function mainOcorrencia(Ocorrencia $ocorrencia){
        $this->chat($ocorrencia);
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