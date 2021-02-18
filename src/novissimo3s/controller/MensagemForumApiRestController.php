<?php
            
/**
 * Classe feita para manipulação do objeto MensagemForumApiRestController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;
use novissimo3s\dao\MensagemForumDAO;
use novissimo3s\model\MensagemForum;
use novissimo3s\util\Sessao;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\model\Ocorrencia;

class MensagemForumApiRestController {


    protected $dao;

	public function __construct(){
		$this->dao = new MensagemForumDAO();

	}


            
    public function main()
    {
        
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
//             header("WWW-Authenticate: Basic realm=\"Private Area\" ");
//             header("HTTP/1.0 401 Unauthorized");
            return;
        }
        
        header('Content-type: application/json');
        $this->get();
    }
    
    public function parteInteressada(Ocorrencia $selecionado){
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO ){
            return true;
        }else if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM){
            return true;
        }else if($selecionado->getUsuarioCliente()->getId() == $this->sessao->getIdUsuario()){
            return true;
        }else{
            return false;
        }
    }

    public function get()
    {

        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            return;
        }
        
        if(!isset($_REQUEST['api'])){
            return;
        }
        
        $url = explode("/", $_REQUEST['api']);
        if (count($url) == 0 || $url[0] == "") {
            return;
        }
        if(!isset($url[1])){
            return;
        }
        if ($url[1] != 'mensagem_forum') {
            return;
        }
        if(!isset($url[2])){
            return;
        }
        if(isset($url[2]) == ""){
            return;
        }
        
        $id = intval($url[2]);
        
        $ocorrencia = new Ocorrencia();
        $ocorrencia->setId($id);
        $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
        $ocorrenciaDao->fillById($ocorrencia);
        
        if(!$this->parteInteressada($ocorrencia)){
            echo "{Acesso Negado}";
            return;
        }
        
        
        if(isset($url[3]) && $url[3] != ''){
            $idM = intval($url[3]);
            $ocorrenciaDao->fetchMensagensPag($ocorrencia, $idM);
        }else{
            $ocorrenciaDao->fetchMensagens($ocorrencia);
        }
        
        $list = $ocorrencia->getMensagens();
        
        if (count($list) == 0) {
            echo "{}";
            return;
        }

        
        $listagem = array();
        foreach ( $list as $linha ) {
			$listagem [] = array (
					'id' => $linha->getId (), 
					'tipo' => $linha->getTipo (), 
					'mensagem' => $linha->getMensagem (), 
					'data_envio' => $linha->getDataEnvio (), 
                    'nome_usuario' => $linha->getUsuario()->getNome()
            
            
			);
		}
		echo json_encode ( $listagem );
		
	}

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
            return;
        }
        
        if(!isset($_REQUEST['api'])){
            return;
        }
        $url = explode("/", $_REQUEST['api']);
        if (count($url) == 0 || $url[0] == "") {
            return;
        }
        if ($url[0] != 'mensagem_forum') {
            echo 'error';
            return;
        }

        if(!isset($url[1])){
            echo 'error';
            return;
        }
        if($url[1] == ''){
            echo 'error';
            return;
        }
        
        $id = $url[1];



        $selected = new MensagemForum();
        $selected->setMensagemForum($id);
        $selected = $this->dao->fillById($selected);
        if ($selected == null) {
            return;
        }
        if($this->dao->delete($selected))
        {
            echo "{}";
            return;
        }
        
        echo "Erro.";
        
    }




    public function put()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
            return;
        }

        if(!isset($_REQUEST['api'])){
            return;
        }
        $url = explode("/", $_REQUEST['api']);
        if (count($url) == 0 || $url[0] == "") {
            return;
        }
        if (!isset($url[1])) {
            return;
        }

        if ($url[1] != 'mensagem_forum') {
            echo 'error';
            return;
        }

        if(!isset($url[2])){
            echo 'error';
            return;
        }

        if($url[2] == ''){
            echo 'error';
            return;
        }
        
        $id = $url[2];



        $selected = new MensagemForum();
        $selected->setId($id);
        $selected = $this->dao->fillById($selected);

        if ($selected == null) {
            return;
        }

        $body = file_get_contents('php://input');
        $jsonBody = json_decode($body, true);
        
        
        if (isset($jsonBody['tipo'])) {
            $selected->setTipo($jsonBody['tipo']);
        }
                    

        if (isset($jsonBody['mensagem'])) {
            $selected->setMensagem($jsonBody['mensagem']);
        }
                    

        if (isset($jsonBody['data_envio'])) {
            $selected->setDataEnvio($jsonBody['data_envio']);
        }
                    

        if ($this->dao->update($selected)) 
                {
			echo 'Sucesso';
		} else {
			echo 'Falha';
		}
    }




    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }
        
        if(!isset($_REQUEST['api'])){
            return;
        }
        $url = explode("/", $_REQUEST['api']);
        if (count($url) == 0 || $url[0] == "") {
            return;
        }

        if(!isset($url[1])){
            return;
        }
        if ($url[1] != 'mensagem_forum') {
            return;
        }

        $body = file_get_contents('php://input');
        $jsonBody = json_decode($body, true);

        if (! ( isset ( $jsonBody ['tipo'] ) && isset ( $jsonBody ['mensagem'] ) && isset ( $jsonBody ['dataEnvio'] ) &&  isset($_POST ['usuario']))) {
			echo "Incompleto";
			return;
		}

        $adicionado = new MensagemForum();
        if(isset($jsonBody['tipo'])){
            $adicionado->setTipo($jsonBody['tipo']);
        }
        

        if(isset($jsonBody['mensagem'])){
            $adicionado->setMensagem($jsonBody['mensagem']);
        }
        

        if(isset($jsonBody['data_envio'])){
            $adicionado->setDataEnvio($jsonBody['data_envio']);
        }
        

        if ($this->dao->insert($adicionado)) 
                {
			echo ' Sucesso';
		} else {
			echo 'Falha ';
		}
    }       


}
?>