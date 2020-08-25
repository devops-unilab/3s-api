<?php
            
/**
 * Classe feita para manipulação do objeto Chamado
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */
class ChamadoController {
	private $post;
	private $view;
    private $dao;
    
    public static function main(){
        if(isset($_GET['pagina'])){
            switch ($_GET['pagina']){
                case 'quadro':
                    $controller = new ChamadoController();
                    echo '<div id="quadro-kanban">';
                    $controller->quadroKanban();
                    echo '</div>';
                    break;
                case 'tabela':
                    $controller = new ChamadoController();
                    echo '<div id="tabela-chamados">';
                    $controller->tabelaChamados();
                    echo '</div>';
                    break;
                default:
                    $controller = new ChamadoController();
                    $controller->telaInicial();
                    break;
            }
        }else{
            $controller = new ChamadoController();
            $controller->telaInicial();
        }
    }
	public function __construct(){
		$this->dao = new ChamadoDAO();
		$this->view = new ChamadoView();
		foreach($_POST as $chave => $valor){
			$this->post[$chave] = $valor;
		}
	}
	public function telaInicial(){
	    $result = $this->dao->getConexao()->query("SELECT nome, descricao FROM area_responsavel");
	    foreach($result as $linha){
	        $setoresNomeCompleto[$linha['nome']] = $linha['nome'].' - '.$linha['descricao'];
	    }
	    
	    
	    $arrNome = explode(" ",$_SESSION['nome_user']);
	    $fullName = "";
	    if(count($arrNome) > 1){
	        $fullName = ucfirst(strtolower($arrNome[0])).' '.ucfirst(strtolower($arrNome[1]));
	    }
	    echo '
	        
	        
	        
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Acompanhamento do 3s</h1>
        <p class="lead text-muted">Olá, '.$fullName.'!</p>
';
	    
	    echo '
	        
      </div>
    </section>
	        
    <div class="album text-muted">
      <div class="container">
	        
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
	        
    <footer class="text-muted">
      <div class="container">
	        
        <p>Página de acompanhamento do 3s</p>
	        
      </div>
    </footer>
';
	    
	    
	}

	public function tabelaChamados() {
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
	public function quadroKanban($setor = null, $data1 = null, $data2 = null) {
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

	public function listarJSON()
    {
		$chamadoDao = new ChamadoDAO ();
		$lista = $chamadoDao->retornaLista ();
		$listagem = array ();
		foreach ( $lista as $linha ) {
			$listagem ['lista'] [] = array (
					'id' => $linha->getId (), 
					'descricao' => $linha->getDescricao (), 
					'abertura' => $linha->getAbertura (), 
					'atendimento' => $linha->getAtendimento (), 
					'fechamento' => $linha->getFechamento (), 
					'campus' => $linha->getCampus (), 
					'idstatus' => $linha->getIdstatus (), 
					'status' => $linha->getStatus (), 
					'atendente' => $linha->getAtendente (), 
					'idsetor' => $linha->getIdsetor (), 
					'setor' => $linha->getSetor ()
            
            
			);
		}
		echo json_encode ( $listagem );
	}
            
            
		
}
?>