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
            $mensagemForum->setTipo ( MensagemForumCustomController::TIPO_TEXTO );
            $mensagemForum->setMensagem ( $_POST ['mensagem'] );
            $mensagemForum->setDataEnvio (date("Y-m-d G:i:s") );
            
            $mensagemForum->getUsuario()->setId ( $sessao->getIdUsuario() );
            $ocorrencia = new Ocorrencia();
            $ocorrencia->setId($_POST['ocorrencia']);
            
            
            if ($this->dao->insert ( $mensagemForum, $ocorrencia ))
            {
                $id = $this->dao->getConnection()->lastInsertId();
                echo ':sucesso:'.$id;
                
            } else {
                echo ':falha';
            }
    }
    
    
    
    
    public function mainOcorrencia(Ocorrencia $ocorrencia){
        echo '	        
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="font-italic">Mensagens</h4>
                <div class="container">
                	<div class="row">';

        $this->add();
	    $listaForum = $ocorrencia->getMensagens();
	    foreach($listaForum as $mensagemForum){

	        echo '


                    <div class="notice notice-info">
                        '.$mensagemForum->getMensagem().'<br>
                        <strong>'.$mensagemForum->getUsuario()->getNome().'| '.date("d/m/Y H:i",strtotime($mensagemForum->getDataEnvio())).'</strong><br>
            	    </div>

';

	    }
        
        
        echo '
                    	</div>
                    </div>
                  </div>';
	
        
    }

	public function __construct(){
		$this->dao = new MensagemForumCustomDAO();
		$this->view = new MensagemForumCustomView();
	}


	        
}
?>