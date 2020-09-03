<?php



class PainelController{
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
    

    
    
}


?>