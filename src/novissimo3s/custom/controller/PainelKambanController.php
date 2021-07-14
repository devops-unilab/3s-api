<?php 
namespace novissimo3s\custom\controller;

use novissimo3s\custom\view\PainelKambanView;
use novissimo3s\model\Ocorrencia;
use novissimo3s\custom\dao\AreaResponsavelCustomDAO;
use novissimo3s\util\Sessao;
use novissimo3s\custom\dao\PainelKambanDAO;


class PainelKambanController extends OcorrenciaCustomController{
    
    
    public function __construct(){
        $this->view = new PainelKambanView();
        $this->dao = new PainelKambanDAO();
    }
 

    public function main(){
        $areaDao = new AreaResponsavelCustomDAO($this->dao->getConnection());
        $listaAreas = $areaDao->fetch();
        
        
        echo '
            
<div class="card mb-4">
        <div class="card-header pb-4 mb-4 font-italic">
                    Painel Kamban';
        
        $this->view->formFiltro($listaAreas);
        
        echo '
                <button id="btn-expandir-tela" type="button" class="float-right btn ml-3 btn-warning btn-circle btn-lg collapsed"><i class="fa fa-expand icone-maior"></i></button>
            </div>
            <div class="card-body" id="quadro-kamban">';
        $this->quadroKamban();
        echo '
	</div>
</div>
            
            
            
            
';
        
    }

    public function quadroKamban(){
        $sessao = new Sessao();
        if(
            $sessao->getNivelAcesso() != Sessao::NIVEL_TECNICO
            &&
            $sessao->getNivelAcesso() != Sessao::NIVEL_ADM
            ){
            echo "Acesso Negado";
            return;
        }
        $filtro = "";
        if(isset($_GET['setores'])){
            $arrStrSetores = explode(",", $_GET['setores']);
            $filtro = 'AND( area_responsavel.id = '.implode(" OR area_responsavel.id = ", $arrStrSetores).' )';
        }
        
       
        
        
        $ocorrencia = new Ocorrencia();
        $matrixStatus = array();
        $pendentes = $this->dao->pesquisaKamban($ocorrencia, $this->arrayStatusPendente(), $matrixStatus, $filtro);
        $finalizados = $this->dao->pesquisaKamban($ocorrencia, $this->arrayStatusFinalizado(), $matrixStatus, $filtro);
        
        
        
        $lista = array_merge($pendentes['ocorrencias'], $finalizados['ocorrencias']);
        $atendentes = array();
        foreach($pendentes['responsaveis'] as $chave => $valor){
            $atendentes[$chave] = $valor;
        }
        foreach($finalizados['responsaveis'] as $chave => $valor){
            $atendentes[$chave] = $valor;
        }

        $this->view->mostrarQuadro($lista, $atendentes);
        
    }
    
    
    public function showList($lista, $atendentes){

        echo '
            
            
            
            
          <div class="card">
                <div class="card-header">
                  Lista Ocorrencia
                </div>
                <div class="card-body">
            
            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				
				<tbody>';
        
        foreach($lista as $element){
            echo '<tr>';
            echo '<td>'.$element->getId().'</td>';
            echo '<td>'.$element->getIdLocal().'</td>';
            echo '<td>'.$element->getDescricao().'</td>';
            echo '<td>'.$element->getCampus().'</td>';
            echo '<td>'.$element->getAreaResponsavel().'</td>';
            echo '<td>'.$element->getServico().'</td>';
            
            
            $atendente = "Teste";

            echo '<td>'.$atendente.'</td>';
//             echo '<td>'.$element->getUsuarioCliente().'</td>';
            echo '<td>
                        <a href="?page=ocorrencia&select='.$element->getId().'" class="btn btn-info text-white">Select</a>
                        <a href="?page=ocorrencia&edit='.$element->getId().'" class="btn btn-success text-white">Edit</a>
                        <a href="?page=ocorrencia&delete='.$element->getId().'" class="btn btn-danger text-white">Delete</a>
                      </td>';
            echo '</tr>';
        }
        
        echo '
				</tbody>
			</table>
		</div>
            
            
            
            
  </div>
</div>
            
';
    }
}
?>