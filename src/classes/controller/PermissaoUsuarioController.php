<?php
            
/**
 * Classe feita para manipulação do objeto PermissaoUsuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class PermissaoUsuarioController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new PermissaoUsuarioDAO();
		$this->view = new PermissaoUsuarioView();
	}


    public function deletar(){
	    if(!isset($_GET['deletar'])){
	        return;
	    }
        $selecionado = new PermissaoUsuario();
	    $selecionado->setId($_GET['deletar']);
        if(!isset($_POST['deletar_permissao_usuario'])){
            $this->view->confirmarDeletar($selecionado);
            return;
        }
        if($this->dao->excluir($selecionado)){
            echo '<div class="alert alert-success" role="alert">
                        Permissao Usuario excluído com sucesso!
                    </div>';
        }else{
            echo '
                    <div class="alert alert-danger" role="alert">
                        Falha ao tentar excluir   Permissao Usuario 
                    </div>

                ';
        }
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?pagina=permissao_usuario">';
    }



	public function listar() 
    {
		$lista = $this->dao->retornaLista ();
		$this->view->exibirLista($lista);
	}


	public function cadastrar() {
            
        if(!isset($_POST['enviar_permissao_usuario'])){
            $arearesponsavelDao = new AreaResponsavelDAO($this->dao->getConexao());
            $listaAreaResponsavel = $arearesponsavelDao->retornaLista();

            $this->view->mostraFormInserir($listaAreaResponsavel);
		    return;
		}
		if (! ( isset ( $_POST ['perfil'] ) && isset ( $_POST ['id_usuario_sigaa'] ) && isset ( $_POST ['usuario'] ) && isset ( $_POST ['email'] ) &&  isset($_POST ['setor']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Falha ao cadastrar. Algum campo deve estar faltando. 
                </div>

                ';
			return;
		}
            
		$permissaoUsuario = new PermissaoUsuario ();
		$permissaoUsuario->setPerfil ( $_POST ['perfil'] );
		$permissaoUsuario->setIdUsuarioSigaa ( $_POST ['id_usuario_sigaa'] );
		$permissaoUsuario->setUsuario ( $_POST ['usuario'] );
		$permissaoUsuario->setEmail ( $_POST ['email'] );
		$permissaoUsuario->getSetor()->setId ( $_POST ['setor'] );
            
		if ($this->dao->inserir ( $permissaoUsuario ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Permissao Usuario
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Permissao Usuario
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?pagina=permissao_usuario">';
	}



            
    public function editar(){
	    if(!isset($_GET['editar'])){
	        return;
	    }
        $selecionado = new PermissaoUsuario();
	    $selecionado->setId($_GET['editar']);
	    $this->dao->preenchePorId($selecionado);
	        
        if(!isset($_POST['editar_permissao_usuario'])){
            $arearesponsavelDao = new AreaResponsavelDAO($this->dao->getConexao());
            $listaAreaResponsavel = $arearesponsavelDao->retornaLista();

            $this->view->mostraFormEditar($listaAreaResponsavel, $selecionado);
            return;
        }
            
		if (! ( isset ( $_POST ['perfil'] ) && isset ( $_POST ['id_usuario_sigaa'] ) && isset ( $_POST ['usuario'] ) && isset ( $_POST ['email'] ) &&  isset($_POST ['setor']))) {
			echo "Incompleto";
			return;
		}

		$selecionado->setPerfil ( $_POST ['perfil'] );
		$selecionado->setIdUsuarioSigaa ( $_POST ['id_usuario_sigaa'] );
		$selecionado->setUsuario ( $_POST ['usuario'] );
		$selecionado->setEmail ( $_POST ['email'] );
            
		if ($this->dao->atualizar ($selecionado ))
        {
            
			echo "Sucesso";
		} else {
			echo "Fracasso";
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?pagina=permissao_usuario">';
            
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
            $controller = new PermissaoUsuarioController();
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
        $selecionado = new PermissaoUsuario();
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
        if ($url[1] != 'permissaoUsuario') {
            return;
        }

        if(isset($url[1])){
            $parametro = $url[1];
            $id = intval($parametro);
            $pesquisado = new PermissaoUsuario();
            $pesquisado->setId($id);
            $pesquisado = $this->dao->pesquisaPorId($pesquisado);
            if ($pesquisado == null) {
                echo "{}";
                return;
            }

            $pesquisado = array(
					'id' => $pesquisado->getId (), 
					'perfil' => $pesquisado->getPerfil (), 
					'idUsuarioSigaa' => $pesquisado->getIdUsuarioSigaa (), 
					'usuario' => $pesquisado->getUsuario (), 
					'email' => $pesquisado->getEmail (), 
            
            
			);
            echo json_encode($pesquisado);
            return;
        }        
        $lista = $this->dao->retornaLista();
        $listagem = array();
        foreach ( $lista as $linha ) {
			$listagem ['lista'] [] = array (
					'id' => $linha->getId (), 
					'perfil' => $linha->getPerfil (), 
					'idUsuarioSigaa' => $linha->getIdUsuarioSigaa (), 
					'usuario' => $linha->getUsuario (), 
					'email' => $linha->getEmail (), 
            
            
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
        $pesquisado = new PermissaoUsuario();
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
        $pesquisado = new PermissaoUsuario();
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
                    

        if (isset($jsonBody['perfil'])) {
            $pesquisado->setPerfil($jsonBody['perfil']);
        }
                    

        if (isset($jsonBody['id_usuario_sigaa'])) {
            $pesquisado->setIdUsuarioSigaa($jsonBody['id_usuario_sigaa']);
        }
                    

        if (isset($jsonBody['usuario'])) {
            $pesquisado->setUsuario($jsonBody['usuario']);
        }
                    

        if (isset($jsonBody['email'])) {
            $pesquisado->setEmail($jsonBody['email']);
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

        if (! ( isset ( $jsonBody ['perfil'] ) && isset ( $jsonBody ['idUsuarioSigaa'] ) && isset ( $jsonBody ['usuario'] ) && isset ( $jsonBody ['email'] ) &&  isset($_POST ['setor']))) {
			echo "Incompleto";
			return;
		}

        $adicionado = new PermissaoUsuario();
        $adicionado->setId($jsonBody['id']);

        $adicionado->setPerfil($jsonBody['perfil']);

        $adicionado->setIdUsuarioSigaa($jsonBody['id_usuario_sigaa']);

        $adicionado->setUsuario($jsonBody['usuario']);

        $adicionado->setEmail($jsonBody['email']);

        if ($this->dao->inserir($adicionado)) {
            echo "Sucesso";
        } else {
            echo "Fracasso";
        }
    }            
            
		
}
?>