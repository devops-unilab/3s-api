<?php 
namespace novissimo3s\custom\controller;

use novissimo3s\custom\view\PainelKambanView;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\model\Ocorrencia;
use novissimo3s\custom\dao\AreaResponsavelCustomDAO;
use novissimo3s\util\Sessao;


class PainelKambanController extends OcorrenciaCustomController{
    
    
    public function __construct(){
        $this->view = new PainelKambanView();
        $this->dao = new OcorrenciaCustomDAO();
    }
 
    public function formFiltro(){
        $areaDao = new AreaResponsavelCustomDAO($this->dao->getConnection());
        $lista = $areaDao->fetch();
        
        echo '
                <select name="setor" id="select-setores">
                    <option value="">Filtrar por Setor</option>';
        foreach($lista as $areaResponsavel){
            echo '<option value="'.$areaResponsavel->getId().'">'.$areaResponsavel->getNome().'</option>';
        }
        echo '
                </select>';
        

    }
    public function main(){
        
        echo '
            
<div class="card mb-4">
        <div class="card-header pb-4 mb-4 font-italic">
                    Painel Kamban';
        
        $this->formFiltro();
        
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
        
        
//         $statusDao = new StatusOcorrenciaCustomDAO($this->dao->getConnection());
        
//         foreach($pendentes as $ocorrencia){
//             $matrixStatus[$ocorrencia->getId()] = $statusDao->pesquisaPorIdOcorrencia($ocorrencia);
//         }
//         foreach($finalizados as $ocorrencia){
//             $matrixStatus[$ocorrencia->getId()] = $statusDao->pesquisaPorIdOcorrencia($ocorrencia);
//         }
        
        $lista = array_merge($pendentes, $finalizados);
        $this->view->mostrarQuadro($lista, $matrixStatus);
        
    }
    
}
?>