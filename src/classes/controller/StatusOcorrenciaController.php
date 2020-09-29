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
        if($this->dao->excluir($selecionado))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Status Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Status Ocorrencia
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
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConexao());
            $listaOcorrencia = $ocorrenciaDao->retornaLista();

            $statusDao = new StatusDAO($this->dao->getConexao());
            $listaStatus = $statusDao->retornaLista();

            $usuarioDao = new UsuarioDAO($this->dao->getConexao());
            $listaUsuario = $usuarioDao->retornaLista();

            $this->view->mostraFormInserir($listaOcorrencia, $listaStatus, $listaUsuario);
		    return;
		}
		if (! ( isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_mudanca'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['status']) &&  isset($_POST ['usuario']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Falha ao cadastrar. Algum campo deve estar faltando. 
                </div>

                ';
			return;
		}
            
		$statusOcorrencia = new StatusOcorrencia ();
		$statusOcorrencia->setMensagem ( $_POST ['mensagem'] );
		$statusOcorrencia->setDataMudanca ( $_POST ['data_mudanca'] );
		$statusOcorrencia->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$statusOcorrencia->getStatus()->setId ( $_POST ['status'] );
		$statusOcorrencia->getUsuario()->setId ( $_POST ['usuario'] );
            
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



            
	public function cadastrarAjax() {
            
        if(!isset($_POST['enviar_status_ocorrencia'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_mudanca'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['status']) &&  isset($_POST ['usuario']))) {
			echo ':incompleto';
			return;
		}
            
		$statusOcorrencia = new StatusOcorrencia ();
		$statusOcorrencia->setMensagem ( $_POST ['mensagem'] );
		$statusOcorrencia->setDataMudanca ( $_POST ['data_mudanca'] );
		$statusOcorrencia->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$statusOcorrencia->getStatus()->setId ( $_POST ['status'] );
		$statusOcorrencia->getUsuario()->setId ( $_POST ['usuario'] );
            
		if ($this->dao->inserir ( $statusOcorrencia ))
        {
			$id = $this->dao->getConexao()->lastInsertId();
            echo ':sucesso:'.$id;
            
		} else {
			 echo ':falha';
		}
	}
            
            

            
    public function editar(){
	    if(!isset($_GET['editar'])){
	        return;
	    }
        $selecionado = new StatusOcorrencia();
	    $selecionado->setId($_GET['editar']);
	    $this->dao->preenchePorId($selecionado);
	        
        if(!isset($_POST['editar_status_ocorrencia'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConexao());
            $listaOcorrencia = $ocorrenciaDao->retornaLista();

            $statusDao = new StatusDAO($this->dao->getConexao());
            $listaStatus = $statusDao->retornaLista();

            $usuarioDao = new UsuarioDAO($this->dao->getConexao());
            $listaUsuario = $usuarioDao->retornaLista();

            $this->view->mostraFormEditar($listaOcorrencia, $listaStatus, $listaUsuario, $selecionado);
            return;
        }
            
		if (! ( isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_mudanca'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['status']) &&  isset($_POST ['usuario']))) {
			echo "Incompleto";
			return;
		}

		$selecionado->setMensagem ( $_POST ['mensagem'] );
		$selecionado->setDataMudanca ( $_POST ['data_mudanca'] );
            
		if ($this->dao->atualizar ($selecionado ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso 
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha 
</div>

';
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
    public function mainAjax(){

        $this->cadastrarAjax();
        
            
    }
    public function mainREST($arquivoIni)
    {
        $config = parse_ini_file ( $arquivoIni );
        $usuario = $config ['user'];
        $senha = $config ['password'];
        
        if(!isset($_SERVER['PHP_AUTH_USER'])){
            header("WWW-Authenticate: Basic realm=\"Private Area\" ");
            header("HTTP/1.0 401 Unauthorized");
            echo '{"erro":[{"status":"error","message":"Authentication failed"}]}';
            return;
        }
        if($_SERVER['PHP_AUTH_USER'] == $usuario && ($_SERVER['PHP_AUTH_PW'] == $senha)){
            header('Content-type: application/json');
            
            $this->restGET();
            //$controller->restPOST();
            //$controller->restPUT();
            $this->resDELETE();
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

        if(isset($url[2])){
            $parametro = $url[2];
            $id = intval($parametro);
            $pesquisado = new StatusOcorrencia();
            $pesquisado->setId($id);
            $pesquisado = $this->dao->preenchePorId($pesquisado);
            if ($pesquisado == null) {
                echo "{}";
                return;
            }

            $pesquisado = array(
					'id' => $pesquisado->getId (), 
					'mensagem' => $pesquisado->getMensagem (), 
					'dataMudanca' => $pesquisado->getDataMudanca (), 
            
            
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
					'dataMudanca' => $linha->getDataMudanca (), 
            
            
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
                    

        if (isset($jsonBody['data_mudanca'])) {
            $pesquisado->setDataMudanca($jsonBody['data_mudanca']);
        }
                    

        if ($this->dao->atualizar($pesquisado)) 
                {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso 
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha 
</div>

';
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

        if (! ( isset ( $jsonBody ['mensagem'] ) && isset ( $jsonBody ['dataMudanca'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['status']) &&  isset($_POST ['usuario']))) {
			echo "Incompleto";
			return;
		}

        $adicionado = new StatusOcorrencia();
        $adicionado->setId($jsonBody['id']);

        $adicionado->setMensagem($jsonBody['mensagem']);

        $adicionado->setDataMudanca($jsonBody['data_mudanca']);

        if ($this->dao->inserir($adicionado)) 
                {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso 
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha 
</div>

';
		}
    }            
            
		
}
?>