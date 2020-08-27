<?php
            
/**
 * Classe feita para manipulação do objeto Ocorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class OcorrenciaController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new OcorrenciaDAO();
		$this->view = new OcorrenciaView();
	}


    public function deletar(){
	    if(!isset($_GET['deletar'])){
	        return;
	    }
        $selecionado = new Ocorrencia();
	    $selecionado->setId($_GET['deletar']);
        if(!isset($_POST['deletar_ocorrencia'])){
            $this->view->confirmarDeletar($selecionado);
            return;
        }
        if($this->dao->excluir($selecionado)){
            echo '<div class="alert alert-success" role="alert">
                        Ocorrencia excluído com sucesso!
                    </div>';
        }else{
            echo '
                    <div class="alert alert-danger" role="alert">
                        Falha ao tentar excluir   Ocorrencia 
                    </div>

                ';
        }
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?pagina=ocorrencia">';
    }



	public function listar() 
    {
		$lista = $this->dao->retornaLista ();
		$this->view->exibirLista($lista);
	}


	public function cadastrar() {
            
        if(!isset($_POST['enviar_ocorrencia'])){
            $arearesponsavelDao = new AreaResponsavelDAO($this->dao->getConexao());
            $listaAreaResponsavel = $arearesponsavelDao->retornaLista();

            $servicoDao = new ServicoDAO($this->dao->getConexao());
            $listaServico = $servicoDao->retornaLista();

            $usuarioDao = new UsuarioDAO($this->dao->getConexao());
            $listaUsuario = $usuarioDao->retornaLista();

            $this->view->mostraFormInserir($listaAreaResponsavel, $listaServico, $listaUsuario);
		    return;
		}
		if (! ( isset ( $_POST ['id_local'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['campus'] ) && isset ( $_POST ['patrimonio'] ) && isset ( $_POST ['ramal'] ) && isset ( $_POST ['local'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['solucao'] ) && isset ( $_POST ['prioridade'] ) && isset ( $_POST ['avaliacao'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['id_usuario_atendente'] ) && isset ( $_POST ['id_usuario_indicado'] ) && isset ( $_POST ['anexo'] ) && isset ( $_POST ['local_sala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']) &&  isset($_POST ['usuario_cliente']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Falha ao cadastrar. Algum campo deve estar faltando. 
                </div>

                ';
			return;
		}
            
		$ocorrencia = new Ocorrencia ();
		$ocorrencia->setIdLocal ( $_POST ['id_local'] );
		$ocorrencia->setDescricao ( $_POST ['descricao'] );
		$ocorrencia->setCampus ( $_POST ['campus'] );
		$ocorrencia->setPatrimonio ( $_POST ['patrimonio'] );
		$ocorrencia->setRamal ( $_POST ['ramal'] );
		$ocorrencia->setLocal ( $_POST ['local'] );
		$ocorrencia->setStatus ( $_POST ['status'] );
		$ocorrencia->setSolucao ( $_POST ['solucao'] );
		$ocorrencia->setPrioridade ( $_POST ['prioridade'] );
		$ocorrencia->setAvaliacao ( $_POST ['avaliacao'] );
		$ocorrencia->setEmail ( $_POST ['email'] );
		$ocorrencia->setIdUsuarioAtendente ( $_POST ['id_usuario_atendente'] );
		$ocorrencia->setIdUsuarioIndicado ( $_POST ['id_usuario_indicado'] );
		$ocorrencia->setAnexo ( $_POST ['anexo'] );
		$ocorrencia->setLocalSala ( $_POST ['local_sala'] );
		$ocorrencia->getAreaResponsavel()->setId ( $_POST ['area_responsavel'] );
		$ocorrencia->getServico()->setId ( $_POST ['servico'] );
		$ocorrencia->getUsuarioCliente()->setId ( $_POST ['usuario_cliente'] );
            
		if ($this->dao->inserir ( $ocorrencia ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Ocorrencia
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?pagina=ocorrencia">';
	}



            
    public function editar(){
	    if(!isset($_GET['editar'])){
	        return;
	    }
        $selecionado = new Ocorrencia();
	    $selecionado->setId($_GET['editar']);
	    $this->dao->preenchePorId($selecionado);
	        
        if(!isset($_POST['editar_ocorrencia'])){
            $arearesponsavelDao = new AreaResponsavelDAO($this->dao->getConexao());
            $listaAreaResponsavel = $arearesponsavelDao->retornaLista();

            $servicoDao = new ServicoDAO($this->dao->getConexao());
            $listaServico = $servicoDao->retornaLista();

            $usuarioDao = new UsuarioDAO($this->dao->getConexao());
            $listaUsuario = $usuarioDao->retornaLista();

            $this->view->mostraFormEditar($listaAreaResponsavel, $listaServico, $listaUsuario, $selecionado);
            return;
        }
            
		if (! ( isset ( $_POST ['id_local'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['campus'] ) && isset ( $_POST ['patrimonio'] ) && isset ( $_POST ['ramal'] ) && isset ( $_POST ['local'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['solucao'] ) && isset ( $_POST ['prioridade'] ) && isset ( $_POST ['avaliacao'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['id_usuario_atendente'] ) && isset ( $_POST ['id_usuario_indicado'] ) && isset ( $_POST ['anexo'] ) && isset ( $_POST ['local_sala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']) &&  isset($_POST ['usuario_cliente']))) {
			echo "Incompleto";
			return;
		}

		$selecionado->setIdLocal ( $_POST ['id_local'] );
		$selecionado->setDescricao ( $_POST ['descricao'] );
		$selecionado->setCampus ( $_POST ['campus'] );
		$selecionado->setPatrimonio ( $_POST ['patrimonio'] );
		$selecionado->setRamal ( $_POST ['ramal'] );
		$selecionado->setLocal ( $_POST ['local'] );
		$selecionado->setStatus ( $_POST ['status'] );
		$selecionado->setSolucao ( $_POST ['solucao'] );
		$selecionado->setPrioridade ( $_POST ['prioridade'] );
		$selecionado->setAvaliacao ( $_POST ['avaliacao'] );
		$selecionado->setEmail ( $_POST ['email'] );
		$selecionado->setIdUsuarioAtendente ( $_POST ['id_usuario_atendente'] );
		$selecionado->setIdUsuarioIndicado ( $_POST ['id_usuario_indicado'] );
		$selecionado->setAnexo ( $_POST ['anexo'] );
		$selecionado->setLocalSala ( $_POST ['local_sala'] );
            
		if ($this->dao->atualizar ($selecionado ))
        {
            
			echo "Sucesso";
		} else {
			echo "Fracasso";
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?pagina=ocorrencia">';
            
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
            $controller = new OcorrenciaController();
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
        $selecionado = new Ocorrencia();
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
        if ($url[1] != 'ocorrencia') {
            return;
        }

        if(isset($url[1])){
            $parametro = $url[1];
            $id = intval($parametro);
            $pesquisado = new Ocorrencia();
            $pesquisado->setId($id);
            $pesquisado = $this->dao->pesquisaPorId($pesquisado);
            if ($pesquisado == null) {
                echo "{}";
                return;
            }

            $pesquisado = array(
					'id' => $pesquisado->getId (), 
					'idLocal' => $pesquisado->getIdLocal (), 
					'descricao' => $pesquisado->getDescricao (), 
					'campus' => $pesquisado->getCampus (), 
					'patrimonio' => $pesquisado->getPatrimonio (), 
					'ramal' => $pesquisado->getRamal (), 
					'local' => $pesquisado->getLocal (), 
					'status' => $pesquisado->getStatus (), 
					'solucao' => $pesquisado->getSolucao (), 
					'prioridade' => $pesquisado->getPrioridade (), 
					'avaliacao' => $pesquisado->getAvaliacao (), 
					'email' => $pesquisado->getEmail (), 
					'idUsuarioAtendente' => $pesquisado->getIdUsuarioAtendente (), 
					'idUsuarioIndicado' => $pesquisado->getIdUsuarioIndicado (), 
					'anexo' => $pesquisado->getAnexo (), 
					'localSala' => $pesquisado->getLocalSala (), 
            
            
			);
            echo json_encode($pesquisado);
            return;
        }        
        $lista = $this->dao->retornaLista();
        $listagem = array();
        foreach ( $lista as $linha ) {
			$listagem ['lista'] [] = array (
					'id' => $linha->getId (), 
					'idLocal' => $linha->getIdLocal (), 
					'descricao' => $linha->getDescricao (), 
					'campus' => $linha->getCampus (), 
					'patrimonio' => $linha->getPatrimonio (), 
					'ramal' => $linha->getRamal (), 
					'local' => $linha->getLocal (), 
					'status' => $linha->getStatus (), 
					'solucao' => $linha->getSolucao (), 
					'prioridade' => $linha->getPrioridade (), 
					'avaliacao' => $linha->getAvaliacao (), 
					'email' => $linha->getEmail (), 
					'idUsuarioAtendente' => $linha->getIdUsuarioAtendente (), 
					'idUsuarioIndicado' => $linha->getIdUsuarioIndicado (), 
					'anexo' => $linha->getAnexo (), 
					'localSala' => $linha->getLocalSala (), 
            
            
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
        $pesquisado = new Ocorrencia();
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
        $pesquisado = new Ocorrencia();
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
                    

        if (isset($jsonBody['id_local'])) {
            $pesquisado->setIdLocal($jsonBody['id_local']);
        }
                    

        if (isset($jsonBody['descricao'])) {
            $pesquisado->setDescricao($jsonBody['descricao']);
        }
                    

        if (isset($jsonBody['campus'])) {
            $pesquisado->setCampus($jsonBody['campus']);
        }
                    

        if (isset($jsonBody['patrimonio'])) {
            $pesquisado->setPatrimonio($jsonBody['patrimonio']);
        }
                    

        if (isset($jsonBody['ramal'])) {
            $pesquisado->setRamal($jsonBody['ramal']);
        }
                    

        if (isset($jsonBody['local'])) {
            $pesquisado->setLocal($jsonBody['local']);
        }
                    

        if (isset($jsonBody['status'])) {
            $pesquisado->setStatus($jsonBody['status']);
        }
                    

        if (isset($jsonBody['solucao'])) {
            $pesquisado->setSolucao($jsonBody['solucao']);
        }
                    

        if (isset($jsonBody['prioridade'])) {
            $pesquisado->setPrioridade($jsonBody['prioridade']);
        }
                    

        if (isset($jsonBody['avaliacao'])) {
            $pesquisado->setAvaliacao($jsonBody['avaliacao']);
        }
                    

        if (isset($jsonBody['email'])) {
            $pesquisado->setEmail($jsonBody['email']);
        }
                    

        if (isset($jsonBody['id_usuario_atendente'])) {
            $pesquisado->setIdUsuarioAtendente($jsonBody['id_usuario_atendente']);
        }
                    

        if (isset($jsonBody['id_usuario_indicado'])) {
            $pesquisado->setIdUsuarioIndicado($jsonBody['id_usuario_indicado']);
        }
                    

        if (isset($jsonBody['anexo'])) {
            $pesquisado->setAnexo($jsonBody['anexo']);
        }
                    

        if (isset($jsonBody['local_sala'])) {
            $pesquisado->setLocalSala($jsonBody['local_sala']);
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

        if (! ( isset ( $jsonBody ['idLocal'] ) && isset ( $jsonBody ['descricao'] ) && isset ( $jsonBody ['campus'] ) && isset ( $jsonBody ['patrimonio'] ) && isset ( $jsonBody ['ramal'] ) && isset ( $jsonBody ['local'] ) && isset ( $jsonBody ['status'] ) && isset ( $jsonBody ['solucao'] ) && isset ( $jsonBody ['prioridade'] ) && isset ( $jsonBody ['avaliacao'] ) && isset ( $jsonBody ['email'] ) && isset ( $jsonBody ['idUsuarioAtendente'] ) && isset ( $jsonBody ['idUsuarioIndicado'] ) && isset ( $jsonBody ['anexo'] ) && isset ( $jsonBody ['localSala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']) &&  isset($_POST ['usuario_cliente']))) {
			echo "Incompleto";
			return;
		}

        $adicionado = new Ocorrencia();
        $adicionado->setId($jsonBody['id']);

        $adicionado->setIdLocal($jsonBody['id_local']);

        $adicionado->setDescricao($jsonBody['descricao']);

        $adicionado->setCampus($jsonBody['campus']);

        $adicionado->setPatrimonio($jsonBody['patrimonio']);

        $adicionado->setRamal($jsonBody['ramal']);

        $adicionado->setLocal($jsonBody['local']);

        $adicionado->setStatus($jsonBody['status']);

        $adicionado->setSolucao($jsonBody['solucao']);

        $adicionado->setPrioridade($jsonBody['prioridade']);

        $adicionado->setAvaliacao($jsonBody['avaliacao']);

        $adicionado->setEmail($jsonBody['email']);

        $adicionado->setIdUsuarioAtendente($jsonBody['id_usuario_atendente']);

        $adicionado->setIdUsuarioIndicado($jsonBody['id_usuario_indicado']);

        $adicionado->setAnexo($jsonBody['anexo']);

        $adicionado->setLocalSala($jsonBody['local_sala']);

        if ($this->dao->inserir($adicionado)) {
            echo "Sucesso";
        } else {
            echo "Fracasso";
        }
    }            
            
		
}
?>