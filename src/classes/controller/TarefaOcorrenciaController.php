<?php
            
/**
 * Classe feita para manipulação do objeto TarefaOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class TarefaOcorrenciaController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new TarefaOcorrenciaDAO();
		$this->view = new TarefaOcorrenciaView();
	}


    public function deletar(){
	    if(!isset($_GET['deletar'])){
	        return;
	    }
        $selecionado = new TarefaOcorrencia();
	    $selecionado->setId($_GET['deletar']);
        if(!isset($_POST['deletar_tarefa_ocorrencia'])){
            $this->view->confirmarDeletar($selecionado);
            return;
        }
        if($this->dao->excluir($selecionado)){
            echo '<div class="alert alert-success" role="alert">
                        Tarefa Ocorrencia excluído com sucesso!
                    </div>';
        }else{
            echo '
                    <div class="alert alert-danger" role="alert">
                        Falha ao tentar excluir   Tarefa Ocorrencia 
                    </div>

                ';
        }
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?pagina=tarefa_ocorrencia">';
    }



	public function listar() 
    {
		$lista = $this->dao->retornaLista ();
		$this->view->exibirLista($lista);
	}


	public function cadastrar() {
            
        if(!isset($_POST['enviar_tarefa_ocorrencia'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConexao());
            $listaOcorrencia = $ocorrenciaDao->retornaLista();

            $usuarioDao = new UsuarioDAO($this->dao->getConexao());
            $listaUsuario = $usuarioDao->retornaLista();

            $this->view->mostraFormInserir($listaOcorrencia, $listaUsuario);
		    return;
		}
		if (! ( isset ( $_POST ['tarefa'] ) && isset ( $_POST ['data_inclusao'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Falha ao cadastrar. Algum campo deve estar faltando. 
                </div>

                ';
			return;
		}
            
		$tarefaOcorrencia = new TarefaOcorrencia ();
		$tarefaOcorrencia->setTarefa ( $_POST ['tarefa'] );
		$tarefaOcorrencia->setDataInclusao ( $_POST ['data_inclusao'] );
		$tarefaOcorrencia->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$tarefaOcorrencia->getUsuario()->setId ( $_POST ['usuario'] );
            
		if ($this->dao->inserir ( $tarefaOcorrencia ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Tarefa Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Tarefa Ocorrencia
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?pagina=tarefa_ocorrencia">';
	}



            
    public function editar(){
	    if(!isset($_GET['editar'])){
	        return;
	    }
        $selecionado = new TarefaOcorrencia();
	    $selecionado->setId($_GET['editar']);
	    $this->dao->preenchePorId($selecionado);
	        
        if(!isset($_POST['editar_tarefa_ocorrencia'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConexao());
            $listaOcorrencia = $ocorrenciaDao->retornaLista();

            $usuarioDao = new UsuarioDAO($this->dao->getConexao());
            $listaUsuario = $usuarioDao->retornaLista();

            $this->view->mostraFormEditar($listaOcorrencia, $listaUsuario, $selecionado);
            return;
        }
            
		if (! ( isset ( $_POST ['tarefa'] ) && isset ( $_POST ['data_inclusao'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo "Incompleto";
			return;
		}

		$selecionado->setTarefa ( $_POST ['tarefa'] );
		$selecionado->setDataInclusao ( $_POST ['data_inclusao'] );
            
		if ($this->dao->atualizar ($selecionado ))
        {
            
			echo "Sucesso";
		} else {
			echo "Fracasso";
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?pagina=tarefa_ocorrencia">';
            
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
            $controller = new TarefaOcorrenciaController();
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
        $selecionado = new TarefaOcorrencia();
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
        if ($url[1] != 'tarefaOcorrencia') {
            return;
        }

        if(isset($url[1])){
            $parametro = $url[1];
            $id = intval($parametro);
            $pesquisado = new TarefaOcorrencia();
            $pesquisado->setId($id);
            $pesquisado = $this->dao->pesquisaPorId($pesquisado);
            if ($pesquisado == null) {
                echo "{}";
                return;
            }

            $pesquisado = array(
					'id' => $pesquisado->getId (), 
					'tarefa' => $pesquisado->getTarefa (), 
					'dataInclusao' => $pesquisado->getDataInclusao (), 
            
            
			);
            echo json_encode($pesquisado);
            return;
        }        
        $lista = $this->dao->retornaLista();
        $listagem = array();
        foreach ( $lista as $linha ) {
			$listagem ['lista'] [] = array (
					'id' => $linha->getId (), 
					'tarefa' => $linha->getTarefa (), 
					'dataInclusao' => $linha->getDataInclusao (), 
            
            
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
        $pesquisado = new TarefaOcorrencia();
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
        $pesquisado = new TarefaOcorrencia();
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
                    

        if (isset($jsonBody['tarefa'])) {
            $pesquisado->setTarefa($jsonBody['tarefa']);
        }
                    

        if (isset($jsonBody['data_inclusao'])) {
            $pesquisado->setDataInclusao($jsonBody['data_inclusao']);
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

        if (! ( isset ( $jsonBody ['tarefa'] ) && isset ( $jsonBody ['dataInclusao'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo "Incompleto";
			return;
		}

        $adicionado = new TarefaOcorrencia();
        $adicionado->setId($jsonBody['id']);

        $adicionado->setTarefa($jsonBody['tarefa']);

        $adicionado->setDataInclusao($jsonBody['data_inclusao']);

        if ($this->dao->inserir($adicionado)) {
            echo "Sucesso";
        } else {
            echo "Fracasso";
        }
    }            
            
		
}
?>