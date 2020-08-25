<?php
            
/**
 * Classe feita para manipulação do objeto StatusOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class StatusOcorrenciaController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new StatusOcorrenciaDAO();
		$this->view = new StatusOcorrenciaView();
	}


    public function deletar(){
	    if(!isset($_GET['deletar'])){
	        return;
	    }
        $selecionado = new StatusOcorrencia();
	    $selecionado->setId($_GET['deletar']);
        if(!isset($_POST['deletar_status_ocorrencia'])){
            $this->view->confirmarDeletar($selecionado);
            return;
        }
        if($this->dao->excluir($selecionado)){
            echo '<div class="alert alert-success" role="alert">
                        Status Ocorrencia excluído com sucesso!
                    </div>';
        }else{
            echo '
                    <div class="alert alert-danger" role="alert">
                        Falha ao tentar excluir   Status Ocorrencia 
                    </div>

                ';
        }
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?pagina=status_ocorrencia">';
    }



	public function listar() 
    {
		$lista = $this->dao->retornaLista ();
		$this->view->exibirLista($lista);
	}


	public function cadastrar() {
            
        if(!isset($_POST['enviar_status_ocorrencia'])){
            $statusDao = new StatusDAO($this->dao->getConexao());
            $listaStatus = $statusDao->retornaLista();

            $this->view->mostraFormInserir($listaStatus);
		    return;
		}
		if (! ( isset ( $_POST ['mensagem'] ) && isset ( $_POST ['id_user'] ) && isset ( $_POST ['dt_mudanca'] ) &&  isset($_POST ['status']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Falha ao cadastrar. Algum campo deve estar faltando. 
                </div>

                ';
			return;
		}
            
		$statusOcorrencia = new StatusOcorrencia ();
		$statusOcorrencia->setMensagem ( $_POST ['mensagem'] );
		$statusOcorrencia->setIdUser ( $_POST ['id_user'] );
		$statusOcorrencia->setDtMudanca ( $_POST ['dt_mudanca'] );
		$statusOcorrencia->getStatus()->setId ( $_POST ['status'] );
            
		if ($this->dao->inserir ( $statusOcorrencia ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Status Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Status Ocorrencia
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?pagina=status_ocorrencia">';
	}



            
    public function editar(){
	    if(!isset($_GET['editar'])){
	        return;
	    }
        $selecionado = new StatusOcorrencia();
	    $selecionado->setId($_GET['editar']);
	    $this->dao->preenchePorId($selecionado);
	        
        if(!isset($_POST['editar_status_ocorrencia'])){
            $statusDao = new StatusDAO($this->dao->getConexao());
            $listaStatus = $statusDao->retornaLista();

            $this->view->mostraFormEditar($listaStatus, $selecionado);
            return;
        }
            
		if (! ( isset ( $_POST ['mensagem'] ) && isset ( $_POST ['id_user'] ) && isset ( $_POST ['dt_mudanca'] ) &&  isset($_POST ['status']))) {
			echo "Incompleto";
			return;
		}

		$selecionado->setMensagem ( $_POST ['mensagem'] );
		$selecionado->setIdUser ( $_POST ['id_user'] );
		$selecionado->setDtMudanca ( $_POST ['dt_mudanca'] );
            
		if ($this->dao->atualizar ($selecionado ))
        {
            
			echo "Sucesso";
		} else {
			echo "Fracasso";
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?pagina=status_ocorrencia">';
            
    }
        
    
    public function main(){
        
        if (isset($_GET['selecionar'])){
            echo '<div class="row justify-content-center">';
                $this->selecionar();
            echo '</div>';
            return;
        }
        echo '
		<div class="row justify-content-center">';
        echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';
        
        if(isset($_GET['editar'])){
            $this->editar();
        }else if(isset($_GET['deletar'])){
            $this->deletar();
	    }else{
            $this->cadastrar();
        }
        $this->listar();
        
        echo '</div>';
        echo '</div>';
            
    }
    public static function mainREST()
    {
        if(!isset($_SERVER['PHP_AUTH_USER'])){
            header("WWW-Authenticate: Basic realm=\"Private Area\" ");
            header("HTTP/1.0 401 Unauthorized");
            echo '{"erro":[{"status":"error","message":"Authentication failed"}]}';
            return;
        }
        if($_SERVER['PHP_AUTH_USER'] == 'usuario' && ($_SERVER['PHP_AUTH_PW'] == 'senha@12')){
            header('Content-type: application/json');
            $controller = new StatusOcorrenciaController();
            $controller->restGET();
            //$controller->restPOST();
            //$controller->restPUT();
            $controller->resDELETE();
        }else{
            header("WWW-Authenticate: Basic realm=\"Private Area\" ");
            header("HTTP/1.0 401 Unauthorized");
            echo '{"erro":[{"status":"error","message":"Authentication failed"}]}';
        }

    }

    public function selecionar(){
	    if(!isset($_GET['selecionar'])){
	        return;
	    }
        $selecionado = new StatusOcorrencia();
	    $selecionado->setId($_GET['selecionar']);
	        
        $this->dao->preenchePorId($selecionado);

        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->mostrarSelecionado($selecionado);
        echo '</div>';
            

            
    }
	public function restGET()
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
        if ($url[1] != 'statusOcorrencia') {
            return;
        }

        if(isset($url[1])){
            $parametro = $url[1];
            $id = intval($parametro);
            $pesquisado = new StatusOcorrencia();
            $pesquisado->setId($id);
            $pesquisado = $this->dao->pesquisaPorId($pesquisado);
            if ($pesquisado == null) {
                echo "{}";
                return;
            }

            $pesquisado = array(
					'id' => $pesquisado->getId (), 
					'mensagem' => $pesquisado->getMensagem (), 
					'idUser' => $pesquisado->getIdUser (), 
					'dtMudanca' => $pesquisado->getDtMudanca (), 
            
            
			);
            echo json_encode($pesquisado);
            return;
        }        
        $lista = $this->dao->retornaLista();
        $listagem = array();
        foreach ( $lista as $linha ) {
			$listagem ['lista'] [] = array (
					'id' => $linha->getId (), 
					'mensagem' => $linha->getMensagem (), 
					'idUser' => $linha->getIdUser (), 
					'dtMudanca' => $linha->getDtMudanca (), 
            
            
			);
		}
		echo json_encode ( $listagem );
    
		
		
		
		
	}

    public function resDELETE()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
            return;
        }
        $path = explode('/', $_GET['api']);
        $parametro = "";
        if (count($path) < 2) {
            return;
        }
        $parametro = $path[1];
        if ($parametro == "") {
            return;
        }
    
        $id = intval($parametro);
        $pesquisado = new StatusOcorrencia();
        $pesquisado->setId($id);
        $pesquisado = $this->dao->pesquisaPorId($pesquisado);
        if ($pesquisado == null) {
            echo "{}";
            return;
        }

        if($this->dao->excluir($pesquisado))
        {
            echo "{}";
            return;
        }
        
        echo "Erro.";
        
    }
    public function restPUT()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
            return;
        }

        if (! array_key_exists('api', $_GET)) {
            return;
        }
        $path = explode('/', $_GET['api']);
        if (count($path) == 0 || $path[0] == "") {
            echo 'Error. Path missing.';
            return;
        }
        
        $param1 = "";
        if (count($path) > 1) {
            $parametro = $path[1];
        }

        if ($path[0] != 'info') {
            return;
        }

        if ($param1 == "") {
            echo 'error';
            return;
        }

        $id = intval($parametro);
        $pesquisado = new StatusOcorrencia();
        $pesquisado->setId($id);
        $pesquisado = $this->dao->pesquisaPorId($pesquisado);

        if ($pesquisado == null) {
            return;
        }

        $body = file_get_contents('php://input');
        $jsonBody = json_decode($body, true);
        
        
        if (isset($jsonBody['id'])) {
            $pesquisado->setId($jsonBody['id']);
        }
                    

        if (isset($jsonBody['mensagem'])) {
            $pesquisado->setMensagem($jsonBody['mensagem']);
        }
                    

        if (isset($jsonBody['id_user'])) {
            $pesquisado->setIdUser($jsonBody['id_user']);
        }
                    

        if (isset($jsonBody['dt_mudanca'])) {
            $pesquisado->setDtMudanca($jsonBody['dt_mudanca']);
        }
                    

        if ($this->dao->atualizar($pesquisado)) {
            echo "Sucesso";
        } else {
            echo "Erro";
        }
    }

    public function restPOST()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }
        if (! array_key_exists('path', $_GET)) {
            echo 'Error. Path missing.';
            return;
        }

        $path = explode('/', $_GET['path']);

        if (count($path) == 0 || $path[0] == "") {
            echo 'Error. Path missing.';
            return;
        }

        $body = file_get_contents('php://input');
        $jsonBody = json_decode($body, true);

        if (! ( isset ( $jsonBody ['mensagem'] ) && isset ( $jsonBody ['idUser'] ) && isset ( $jsonBody ['dtMudanca'] ) &&  isset($_POST ['status']))) {
			echo "Incompleto";
			return;
		}

        $adicionado = new StatusOcorrencia();
        $adicionado->setId($jsonBody['id']);

        $adicionado->setMensagem($jsonBody['mensagem']);

        $adicionado->setIdUser($jsonBody['id_user']);

        $adicionado->setDtMudanca($jsonBody['dt_mudanca']);

        if ($this->dao->inserir($adicionado)) {
            echo "Sucesso";
        } else {
            echo "Fracasso";
        }
    }            
            
		
}
?>