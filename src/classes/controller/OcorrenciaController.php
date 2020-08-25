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

            $this->view->mostraFormInserir($listaAreaResponsavel, $listaServico);
		    return;
		}
		if (! ( isset ( $_POST ['id_local'] ) && isset ( $_POST ['id_funcionario'] ) && isset ( $_POST ['desc_problema'] ) && isset ( $_POST ['campus'] ) && isset ( $_POST ['etiq_equipamento'] ) && isset ( $_POST ['contato'] ) && isset ( $_POST ['ramal'] ) && isset ( $_POST ['local'] ) && isset ( $_POST ['funcionario'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['obs'] ) && isset ( $_POST ['prioridade'] ) && isset ( $_POST ['avaliacao'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['fecha_confirmado'] ) && isset ( $_POST ['reaberto'] ) && isset ( $_POST ['dt_abertura'] ) && isset ( $_POST ['dt_atendimento'] ) && isset ( $_POST ['dt_fechamento'] ) && isset ( $_POST ['dt_fecha_confirmado'] ) && isset ( $_POST ['dt_cancelamento'] ) && isset ( $_POST ['id_atendente'] ) && isset ( $_POST ['id_tecnico_indicado'] ) && isset ( $_POST ['dt_liberacao'] ) && isset ( $_POST ['anexo'] ) && isset ( $_POST ['dt_espera'] ) && isset ( $_POST ['dt_aguardando_usuario'] ) && isset ( $_POST ['local_sala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Falha ao cadastrar. Algum campo deve estar faltando. 
                </div>

                ';
			return;
		}
            
		$ocorrencia = new Ocorrencia ();
		$ocorrencia->setIdLocal ( $_POST ['id_local'] );
		$ocorrencia->setIdFuncionario ( $_POST ['id_funcionario'] );
		$ocorrencia->setDescProblema ( $_POST ['desc_problema'] );
		$ocorrencia->setCampus ( $_POST ['campus'] );
		$ocorrencia->setEtiqEquipamento ( $_POST ['etiq_equipamento'] );
		$ocorrencia->setContato ( $_POST ['contato'] );
		$ocorrencia->setRamal ( $_POST ['ramal'] );
		$ocorrencia->setLocal ( $_POST ['local'] );
		$ocorrencia->setFuncionario ( $_POST ['funcionario'] );
		$ocorrencia->setStatus ( $_POST ['status'] );
		$ocorrencia->setObs ( $_POST ['obs'] );
		$ocorrencia->setPrioridade ( $_POST ['prioridade'] );
		$ocorrencia->setAvaliacao ( $_POST ['avaliacao'] );
		$ocorrencia->setEmail ( $_POST ['email'] );
		$ocorrencia->setFechaConfirmado ( $_POST ['fecha_confirmado'] );
		$ocorrencia->setReaberto ( $_POST ['reaberto'] );
		$ocorrencia->setDtAbertura ( $_POST ['dt_abertura'] );
		$ocorrencia->setDtAtendimento ( $_POST ['dt_atendimento'] );
		$ocorrencia->setDtFechamento ( $_POST ['dt_fechamento'] );
		$ocorrencia->setDtFechaConfirmado ( $_POST ['dt_fecha_confirmado'] );
		$ocorrencia->setDtCancelamento ( $_POST ['dt_cancelamento'] );
		$ocorrencia->setIdAtendente ( $_POST ['id_atendente'] );
		$ocorrencia->setIdTecnicoIndicado ( $_POST ['id_tecnico_indicado'] );
		$ocorrencia->setDtLiberacao ( $_POST ['dt_liberacao'] );
		$ocorrencia->setAnexo ( $_POST ['anexo'] );
		$ocorrencia->setDtEspera ( $_POST ['dt_espera'] );
		$ocorrencia->setDtAguardandoUsuario ( $_POST ['dt_aguardando_usuario'] );
		$ocorrencia->setLocalSala ( $_POST ['local_sala'] );
		$ocorrencia->getAreaResponsavel()->setId ( $_POST ['area_responsavel'] );
		$ocorrencia->getServico()->setId ( $_POST ['servico'] );
            
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

            $this->view->mostraFormEditar($listaAreaResponsavel, $listaServico, $selecionado);
            return;
        }
            
		if (! ( isset ( $_POST ['id_local'] ) && isset ( $_POST ['id_funcionario'] ) && isset ( $_POST ['desc_problema'] ) && isset ( $_POST ['campus'] ) && isset ( $_POST ['etiq_equipamento'] ) && isset ( $_POST ['contato'] ) && isset ( $_POST ['ramal'] ) && isset ( $_POST ['local'] ) && isset ( $_POST ['funcionario'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['obs'] ) && isset ( $_POST ['prioridade'] ) && isset ( $_POST ['avaliacao'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['fecha_confirmado'] ) && isset ( $_POST ['reaberto'] ) && isset ( $_POST ['dt_abertura'] ) && isset ( $_POST ['dt_atendimento'] ) && isset ( $_POST ['dt_fechamento'] ) && isset ( $_POST ['dt_fecha_confirmado'] ) && isset ( $_POST ['dt_cancelamento'] ) && isset ( $_POST ['id_atendente'] ) && isset ( $_POST ['id_tecnico_indicado'] ) && isset ( $_POST ['dt_liberacao'] ) && isset ( $_POST ['anexo'] ) && isset ( $_POST ['dt_espera'] ) && isset ( $_POST ['dt_aguardando_usuario'] ) && isset ( $_POST ['local_sala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']))) {
			echo "Incompleto";
			return;
		}

		$selecionado->setIdLocal ( $_POST ['id_local'] );
		$selecionado->setIdFuncionario ( $_POST ['id_funcionario'] );
		$selecionado->setDescProblema ( $_POST ['desc_problema'] );
		$selecionado->setCampus ( $_POST ['campus'] );
		$selecionado->setEtiqEquipamento ( $_POST ['etiq_equipamento'] );
		$selecionado->setContato ( $_POST ['contato'] );
		$selecionado->setRamal ( $_POST ['ramal'] );
		$selecionado->setLocal ( $_POST ['local'] );
		$selecionado->setFuncionario ( $_POST ['funcionario'] );
		$selecionado->setStatus ( $_POST ['status'] );
		$selecionado->setObs ( $_POST ['obs'] );
		$selecionado->setPrioridade ( $_POST ['prioridade'] );
		$selecionado->setAvaliacao ( $_POST ['avaliacao'] );
		$selecionado->setEmail ( $_POST ['email'] );
		$selecionado->setFechaConfirmado ( $_POST ['fecha_confirmado'] );
		$selecionado->setReaberto ( $_POST ['reaberto'] );
		$selecionado->setDtAbertura ( $_POST ['dt_abertura'] );
		$selecionado->setDtAtendimento ( $_POST ['dt_atendimento'] );
		$selecionado->setDtFechamento ( $_POST ['dt_fechamento'] );
		$selecionado->setDtFechaConfirmado ( $_POST ['dt_fecha_confirmado'] );
		$selecionado->setDtCancelamento ( $_POST ['dt_cancelamento'] );
		$selecionado->setIdAtendente ( $_POST ['id_atendente'] );
		$selecionado->setIdTecnicoIndicado ( $_POST ['id_tecnico_indicado'] );
		$selecionado->setDtLiberacao ( $_POST ['dt_liberacao'] );
		$selecionado->setAnexo ( $_POST ['anexo'] );
		$selecionado->setDtEspera ( $_POST ['dt_espera'] );
		$selecionado->setDtAguardandoUsuario ( $_POST ['dt_aguardando_usuario'] );
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
					'idFuncionario' => $pesquisado->getIdFuncionario (), 
					'descProblema' => $pesquisado->getDescProblema (), 
					'campus' => $pesquisado->getCampus (), 
					'etiqEquipamento' => $pesquisado->getEtiqEquipamento (), 
					'contato' => $pesquisado->getContato (), 
					'ramal' => $pesquisado->getRamal (), 
					'local' => $pesquisado->getLocal (), 
					'funcionario' => $pesquisado->getFuncionario (), 
					'status' => $pesquisado->getStatus (), 
					'obs' => $pesquisado->getObs (), 
					'prioridade' => $pesquisado->getPrioridade (), 
					'avaliacao' => $pesquisado->getAvaliacao (), 
					'email' => $pesquisado->getEmail (), 
					'fechaConfirmado' => $pesquisado->getFechaConfirmado (), 
					'reaberto' => $pesquisado->getReaberto (), 
					'dtAbertura' => $pesquisado->getDtAbertura (), 
					'dtAtendimento' => $pesquisado->getDtAtendimento (), 
					'dtFechamento' => $pesquisado->getDtFechamento (), 
					'dtFechaConfirmado' => $pesquisado->getDtFechaConfirmado (), 
					'dtCancelamento' => $pesquisado->getDtCancelamento (), 
					'idAtendente' => $pesquisado->getIdAtendente (), 
					'idTecnicoIndicado' => $pesquisado->getIdTecnicoIndicado (), 
					'dtLiberacao' => $pesquisado->getDtLiberacao (), 
					'anexo' => $pesquisado->getAnexo (), 
					'dtEspera' => $pesquisado->getDtEspera (), 
					'dtAguardandoUsuario' => $pesquisado->getDtAguardandoUsuario (), 
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
					'idFuncionario' => $linha->getIdFuncionario (), 
					'descProblema' => $linha->getDescProblema (), 
					'campus' => $linha->getCampus (), 
					'etiqEquipamento' => $linha->getEtiqEquipamento (), 
					'contato' => $linha->getContato (), 
					'ramal' => $linha->getRamal (), 
					'local' => $linha->getLocal (), 
					'funcionario' => $linha->getFuncionario (), 
					'status' => $linha->getStatus (), 
					'obs' => $linha->getObs (), 
					'prioridade' => $linha->getPrioridade (), 
					'avaliacao' => $linha->getAvaliacao (), 
					'email' => $linha->getEmail (), 
					'fechaConfirmado' => $linha->getFechaConfirmado (), 
					'reaberto' => $linha->getReaberto (), 
					'dtAbertura' => $linha->getDtAbertura (), 
					'dtAtendimento' => $linha->getDtAtendimento (), 
					'dtFechamento' => $linha->getDtFechamento (), 
					'dtFechaConfirmado' => $linha->getDtFechaConfirmado (), 
					'dtCancelamento' => $linha->getDtCancelamento (), 
					'idAtendente' => $linha->getIdAtendente (), 
					'idTecnicoIndicado' => $linha->getIdTecnicoIndicado (), 
					'dtLiberacao' => $linha->getDtLiberacao (), 
					'anexo' => $linha->getAnexo (), 
					'dtEspera' => $linha->getDtEspera (), 
					'dtAguardandoUsuario' => $linha->getDtAguardandoUsuario (), 
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
                    

        if (isset($jsonBody['id_funcionario'])) {
            $pesquisado->setIdFuncionario($jsonBody['id_funcionario']);
        }
                    

        if (isset($jsonBody['desc_problema'])) {
            $pesquisado->setDescProblema($jsonBody['desc_problema']);
        }
                    

        if (isset($jsonBody['campus'])) {
            $pesquisado->setCampus($jsonBody['campus']);
        }
                    

        if (isset($jsonBody['etiq_equipamento'])) {
            $pesquisado->setEtiqEquipamento($jsonBody['etiq_equipamento']);
        }
                    

        if (isset($jsonBody['contato'])) {
            $pesquisado->setContato($jsonBody['contato']);
        }
                    

        if (isset($jsonBody['ramal'])) {
            $pesquisado->setRamal($jsonBody['ramal']);
        }
                    

        if (isset($jsonBody['local'])) {
            $pesquisado->setLocal($jsonBody['local']);
        }
                    

        if (isset($jsonBody['funcionario'])) {
            $pesquisado->setFuncionario($jsonBody['funcionario']);
        }
                    

        if (isset($jsonBody['status'])) {
            $pesquisado->setStatus($jsonBody['status']);
        }
                    

        if (isset($jsonBody['obs'])) {
            $pesquisado->setObs($jsonBody['obs']);
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
                    

        if (isset($jsonBody['fecha_confirmado'])) {
            $pesquisado->setFechaConfirmado($jsonBody['fecha_confirmado']);
        }
                    

        if (isset($jsonBody['reaberto'])) {
            $pesquisado->setReaberto($jsonBody['reaberto']);
        }
                    

        if (isset($jsonBody['dt_abertura'])) {
            $pesquisado->setDtAbertura($jsonBody['dt_abertura']);
        }
                    

        if (isset($jsonBody['dt_atendimento'])) {
            $pesquisado->setDtAtendimento($jsonBody['dt_atendimento']);
        }
                    

        if (isset($jsonBody['dt_fechamento'])) {
            $pesquisado->setDtFechamento($jsonBody['dt_fechamento']);
        }
                    

        if (isset($jsonBody['dt_fecha_confirmado'])) {
            $pesquisado->setDtFechaConfirmado($jsonBody['dt_fecha_confirmado']);
        }
                    

        if (isset($jsonBody['dt_cancelamento'])) {
            $pesquisado->setDtCancelamento($jsonBody['dt_cancelamento']);
        }
                    

        if (isset($jsonBody['id_atendente'])) {
            $pesquisado->setIdAtendente($jsonBody['id_atendente']);
        }
                    

        if (isset($jsonBody['id_tecnico_indicado'])) {
            $pesquisado->setIdTecnicoIndicado($jsonBody['id_tecnico_indicado']);
        }
                    

        if (isset($jsonBody['dt_liberacao'])) {
            $pesquisado->setDtLiberacao($jsonBody['dt_liberacao']);
        }
                    

        if (isset($jsonBody['anexo'])) {
            $pesquisado->setAnexo($jsonBody['anexo']);
        }
                    

        if (isset($jsonBody['dt_espera'])) {
            $pesquisado->setDtEspera($jsonBody['dt_espera']);
        }
                    

        if (isset($jsonBody['dt_aguardando_usuario'])) {
            $pesquisado->setDtAguardandoUsuario($jsonBody['dt_aguardando_usuario']);
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

        if (! ( isset ( $jsonBody ['idLocal'] ) && isset ( $jsonBody ['idFuncionario'] ) && isset ( $jsonBody ['descProblema'] ) && isset ( $jsonBody ['campus'] ) && isset ( $jsonBody ['etiqEquipamento'] ) && isset ( $jsonBody ['contato'] ) && isset ( $jsonBody ['ramal'] ) && isset ( $jsonBody ['local'] ) && isset ( $jsonBody ['funcionario'] ) && isset ( $jsonBody ['status'] ) && isset ( $jsonBody ['obs'] ) && isset ( $jsonBody ['prioridade'] ) && isset ( $jsonBody ['avaliacao'] ) && isset ( $jsonBody ['email'] ) && isset ( $jsonBody ['fechaConfirmado'] ) && isset ( $jsonBody ['reaberto'] ) && isset ( $jsonBody ['dtAbertura'] ) && isset ( $jsonBody ['dtAtendimento'] ) && isset ( $jsonBody ['dtFechamento'] ) && isset ( $jsonBody ['dtFechaConfirmado'] ) && isset ( $jsonBody ['dtCancelamento'] ) && isset ( $jsonBody ['idAtendente'] ) && isset ( $jsonBody ['idTecnicoIndicado'] ) && isset ( $jsonBody ['dtLiberacao'] ) && isset ( $jsonBody ['anexo'] ) && isset ( $jsonBody ['dtEspera'] ) && isset ( $jsonBody ['dtAguardandoUsuario'] ) && isset ( $jsonBody ['localSala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']))) {
			echo "Incompleto";
			return;
		}

        $adicionado = new Ocorrencia();
        $adicionado->setId($jsonBody['id']);

        $adicionado->setIdLocal($jsonBody['id_local']);

        $adicionado->setIdFuncionario($jsonBody['id_funcionario']);

        $adicionado->setDescProblema($jsonBody['desc_problema']);

        $adicionado->setCampus($jsonBody['campus']);

        $adicionado->setEtiqEquipamento($jsonBody['etiq_equipamento']);

        $adicionado->setContato($jsonBody['contato']);

        $adicionado->setRamal($jsonBody['ramal']);

        $adicionado->setLocal($jsonBody['local']);

        $adicionado->setFuncionario($jsonBody['funcionario']);

        $adicionado->setStatus($jsonBody['status']);

        $adicionado->setObs($jsonBody['obs']);

        $adicionado->setPrioridade($jsonBody['prioridade']);

        $adicionado->setAvaliacao($jsonBody['avaliacao']);

        $adicionado->setEmail($jsonBody['email']);

        $adicionado->setFechaConfirmado($jsonBody['fecha_confirmado']);

        $adicionado->setReaberto($jsonBody['reaberto']);

        $adicionado->setDtAbertura($jsonBody['dt_abertura']);

        $adicionado->setDtAtendimento($jsonBody['dt_atendimento']);

        $adicionado->setDtFechamento($jsonBody['dt_fechamento']);

        $adicionado->setDtFechaConfirmado($jsonBody['dt_fecha_confirmado']);

        $adicionado->setDtCancelamento($jsonBody['dt_cancelamento']);

        $adicionado->setIdAtendente($jsonBody['id_atendente']);

        $adicionado->setIdTecnicoIndicado($jsonBody['id_tecnico_indicado']);

        $adicionado->setDtLiberacao($jsonBody['dt_liberacao']);

        $adicionado->setAnexo($jsonBody['anexo']);

        $adicionado->setDtEspera($jsonBody['dt_espera']);

        $adicionado->setDtAguardandoUsuario($jsonBody['dt_aguardando_usuario']);

        $adicionado->setLocalSala($jsonBody['local_sala']);

        if ($this->dao->inserir($adicionado)) {
            echo "Sucesso";
        } else {
            echo "Fracasso";
        }
    }            
            
		
}
?>