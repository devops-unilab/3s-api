<?php
            
/**
 * Customize o controller do objeto Ocorrencia aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class OcorrenciaCustomController  extends OcorrenciaController {
    

	public function __construct(){
		$this->dao = new OcorrenciaCustomDAO();
		$this->view = new OcorrenciaCustomView();
	}
	public function selecionar(){
	    
	    if(!isset($_GET['selecionar'])){
	        return;
	    }

	    
	    $selecionado = new Ocorrencia();
	    $selecionado->setId($_GET['selecionar']);
	    $this->dao->preenchePorId($selecionado);
	    
	    echo '
            <div class="row">
                <div class="col-md-8 blog-main">
                    <h3 class="pb-4 mb-4 font-italic border-bottom">
                        #'.$selecionado->getId().' - Chamado Selecionado
                    </h3>

';
	    
	    $this->view->mostrarSelecionado($selecionado);
	    
	    echo '
	    
	    
                </div>
                <aside class="col-md-4 blog-sidebar">
                  <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Histórico</h4>
                    <p class="mb-0">Lista de Status </p>
                  </div>
	        
                  <div class="p-4">
                    <h4 class="font-italic">Archives</h4>
                    <ol class="list-unstyled mb-0">
                      <li><a href="#">March 2014</a></li>
                      <li><a href="#">February 2014</a></li>
                      <li><a href="#">January 2014</a></li>
                      <li><a href="#">December 2013</a></li>
                      <li><a href="#">November 2013</a></li>
                      <li><a href="#">October 2013</a></li>
                      <li><a href="#">September 2013</a></li>
                      <li><a href="#">August 2013</a></li>
                      <li><a href="#">July 2013</a></li>
                      <li><a href="#">June 2013</a></li>
                      <li><a href="#">May 2013</a></li>
                      <li><a href="#">April 2013</a></li>
                    </ol>
                  </div>
	        
                  <div class="p-4">
                    <h4 class="font-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                      <li><a href="#">GitHub</a></li>
                      <li><a href="#">Twitter</a></li>
                      <li><a href="#">Facebook</a></li>
                    </ol>
                  </div>
                </aside><!-- /.blog-sidebar -->
	        
	        
	        
            </div>';
	    echo '<hr>';
	    


	    
	    
	}
	public function main(){

	    echo '
	        
<div class="card mb-4">
        <div class="card-body">';
	    
	    if(isset($_GET['selecionar'])){
	        $this->selecionar();
	    }else if(isset($_GET['cadastrar'])){
	        $this->cadastrar();
	    }
	    else{
	        $this->listar();
	    }
	    
	    
	    
	    echo '
	        
            
	</div>
</div>
	        
	        
	        
	        
';
	    
	}
	public function listar(){
	    echo '
            <div class="row">
                <div class="col-md-8 blog-main">';
	    echo '
            <div class="row">
                    <div class="col-md-10">
                        <h3 class="pb-4 mb-4 font-italic border-bottom">
                            Lista de Ocorrências
                        </h3>
	        
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-warning btn-circle btn-lg"  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-filter icone-maior"></i></button>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                                Local reservado para o formulário de edição de filtros.
                              </div><br><br>
                            </div>
                        </div>
	        
                    </div>';
	    
	    $lista = $this->dao->retornaListaAbertos();
	    echo '<div class="panel panel-warning">';
	    $this->view->exibirLista($lista);
	    echo '</div>';
	    
	    
	    
	    echo '
	        
	        
	        

                </div>
                <aside class="col-md-4 blog-sidebar">
                  <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Sobre o novíssimo 3s</h4>
                    <p class="mb-0">Esta é uma aplicação completamente nova desenvolvida pela DTI. Tudo foi refeito, desde o design até a estrutura de banco de dados.
                                    Os chamados antigos foram preservados em uma nova estrutura,
                                    a responsividade foi adicionada e muitas falhas de segurança foram sanadas. </p>
                  </div>
	        
	        
                <div class="p-4">
                    <h4 class="font-italic">Arquivos</h4>
                    <ol class="list-unstyled mb-0">
                      <li><a href="#">March 2014</a></li>
                      <li><a href="#">February 2014</a></li>
                      <li><a href="#">January 2014</a></li>
                      <li><a href="#">December 2013</a></li>
                      <li><a href="#">November 2013</a></li>
                      <li><a href="#">October 2013</a></li>
                      <li><a href="#">September 2013</a></li>
                      <li><a href="#">August 2013</a></li>
                      <li><a href="#">July 2013</a></li>
                      <li><a href="#">June 2013</a></li>
                      <li><a href="#">May 2013</a></li>
                      <li><a href="#">April 2013</a></li>
                    </ol>
                  </div>
                </aside><!-- /.blog-sidebar -->
	        
	        
	        
            </div>';
	    
	    
	    
	}
	
	public function cadastrar() {
	    echo '
            <div class="row">
                <div class="col-md-12 blog-main">
                    <h3 class="pb-4 mb-4 font-italic border-bottom">
                        Cadastrar Ocorrência
                    </h3>
	        
';
	    $servicoDao = new ServicoDAO($this->dao->getConexao());
	    $listaServico = $servicoDao->retornaLista();
	    
	    $this->view->mostraFormInserir2($listaServico);

	    
	    echo '
	        
	        
                </div>
            </div>';
	    
	    
	    
	    if(!isset($_POST['enviar_ocorrencia'])){
	       return;
	    }
        if (! ( isset ( $_POST ['id_local'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['campus'] ) && isset ( $_POST ['patrimonio'] ) && isset ( $_POST ['ramal'] ) && isset ( $_POST ['local'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['solucao'] ) && isset ( $_POST ['prioridade'] ) && isset ( $_POST ['avaliacao'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['anexo'] ) && isset ( $_POST ['local_sala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']) &&  isset($_POST ['usuario_cliente']) &&  isset($_POST ['usuario_atendente']) &&  isset($_POST ['usuario_indicado']))) {
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
	    $ocorrencia->setAnexo ( $_POST ['anexo'] );
	    $ocorrencia->setLocalSala ( $_POST ['local_sala'] );
	    $ocorrencia->getAreaResponsavel()->setId ( $_POST ['area_responsavel'] );
	    $ocorrencia->getServico()->setId ( $_POST ['servico'] );
	    $ocorrencia->getUsuarioCliente()->setId ( $_POST ['usuario_cliente'] );
	    $ocorrencia->getUsuarioAtendente()->setId ( $_POST ['usuario_atendente'] );
	    $ocorrencia->getUsuarioIndicado()->setId ( $_POST ['usuario_indicado'] );
	    
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
	
	
	public function telaInicialPainel(){
	    $result = $this->dao->getConexao()->query("SELECT nome, descricao FROM area_responsavel");
	    foreach($result as $linha){
	        $setoresNomeCompleto[$linha['nome']] = $linha['nome'].' - '.$linha['descricao'];
	    }

	        
	        	    echo '
	        
<div class="card mb-4">
        <div class="card-body">

	        
	        
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Acompanhamento do 3s</h1>
        <p class="lead text-muted">Preencha um dos formulários</p>
';
	    
	    echo '
	        
      </div>
    </section>

        <div class="row">';
	    echo '<div class="col-sm-8 col-md-8 col-xl-8">';
	    echo '
	        
	        
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Quantidade de Chamados Por Campi</h5>
    <form action="" id="form-tabela">
	        
    <input type="hidden" name="pagina" value="tabela">
    <input type="hidden" name="setores" id="hidden-tabela" >
    <select id="select-tabela">
	        
';
	    
	    echo '<option value="">Selecione um ou mais setores...</option>';
	    foreach($setoresNomeCompleto as $chave => $valor){
	        echo '<option value="'.$chave.'">'.$valor.'</option>';
	    }
	    echo '
    </select>
	        
    <input class="btn btn-primary" type="submit">
    </form>
	        
  </div>
</div>
	        
';
	    
	    echo '</div>';
	    echo '<div class="col-sm-4 col-md-4 col-xl-4">';
	    echo '
	        
	        
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Quadro Kanban</h5>
    <form action="">
	        
    <input type="hidden" name="pagina" value="quadro">
    <select name="setor" id="select-setores">';
	    
	    echo '<option value="">Selecione um setor...</option>';
	    foreach($setoresNomeCompleto as $chave => $valor){
	        echo '<option value="'.$chave.'">'.$valor.'</option>';
	    }
	    echo '
    </select>
    <input type="date" class="form-control" name="data1" value="">
    <input type="date" class="form-control" name="data2" value=""><br>
    <input class="btn btn-primary" type="submit">
    </form>
	        
  </div>
</div>
	        
';
	    echo '</div>';
	    echo '
	        
	        
        </div>
	        
      </div>
    </div>
	        

';
	    
	    
	}
	
	
	public function painelTabela() 
	{
	    $filtro = "";
	    if(isset($_GET['setores'])){
	        $arrStrSetores = explode(",", $_GET['setores']);
	        $filtroSetor = " area_responsavel.nome like ";
	        $i = 1;
	        $n = count($arrStrSetores);
	        foreach($arrStrSetores as $setor){
	            $filtroSetor .= "'$setor'";
	            if($i != $n){
	                $filtroSetor .= " OR area_responsavel.nome like ";
	            }
	            $i++;
	        }
	        $filtro = " WHERE ".$filtroSetor;
	    }
	    
	    $result = $this->dao->getConexao()->query("SELECT id, nome FROM area_responsavel $filtro");
	    $setores = array();
	    foreach($result as $linha){
	        $setor = new Setor();
	        $setor->setNome($linha['nome']);
	        $setor->setId($linha['id']);
	        $setores[] = $setor;
	    }
	    
	    $result = $this->dao->getConexao()->query("SELECT campus from ocorrencia GROUP BY campus");
	    $matriz = array();
	    foreach($result as $linha){
	        foreach($setores as $setor){
	            $matriz[$linha['campus']][$setor->getNome()] = 0;
	        }
	    }
	    
	    $filtroSetor = " AND (".$filtroSetor.")";
	    $sql = "SELECT
            ocorrencia.campus as campus,
            area_responsavel.nome as setor
            FROM
            ocorrencia
            INNER JOIN status ON status.sigla = ocorrencia.status
            INNER JOIN area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
            WHERE (status.id = 2 OR status.id = 7) $filtroSetor
        ";
	    
	    $result = $this->dao->getConexao()->query($sql);
	    
	    
	    
	    foreach($result as $linha){
	        if(isset($matriz[$linha['campus']][$linha['setor']])){
	            $matriz[$linha['campus']][$linha['setor']]++;
	        }else{
	            $matriz[$linha['campus']][$linha['setor']] = 1;
	        }
	    }
	    
	    
	    
	    
	    
	    echo '<br><br>
	        
          <table class="table display-3 text-center table-bordered">
              <thead class="thead-dark">
                <tr>';
	    echo '<th scope="col">Setor</th>';
	    foreach($matriz as $chave => $valor){
	        echo '<th scope="col">'.ucfirst($chave).'</th>';
	    }
	    echo '
                </tr>
              </thead>
              <tbody>';
	    foreach($setores as $setor){
	        echo '
                <tr>
                  <th scope="row">'.$setor->getNome().'</th>';
	        foreach($matriz as $chave => $valor){
	            echo '
                  <td>'.$valor[$setor->getNome()].'</td>';
	        }
	        
	        echo '
                </tr>';
	    }
	    
	    echo '
              </tbody>
            </table>';
	    
	    
	    
	}
	
	
	public function painelQuadroKanban($setor = null, $data1 = null, $data2 = null) {
	    if(isset($_GET['setor'])){
	        $setor = $_GET['setor'];
	    }
	    if(isset($_GET['data1']) && isset($_GET['data2'])){
	        $data1 = $_GET['data1'];
	        $data2 = $_GET['data2'];
	    }
	    $lista = $this->dao->retornaLista ($setor, $data1, $data2);
	    $listaFechados = $this->dao->retornaFechados($setor, $data1, $data2);
	    $this->view->mostrarQuadro($lista, $listaFechados);
	    
	}
}
?>