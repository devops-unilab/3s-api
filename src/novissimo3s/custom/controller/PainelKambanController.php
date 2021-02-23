<?php 
namespace novissimo3s\custom\controller;

use novissimo3s\custom\view\PainelKambanView;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\model\Ocorrencia;


class PainelKambanController extends OcorrenciaCustomController{
    
    
    public function __construct(){
        $this->view = new PainelKambanView();
        $this->dao = new OcorrenciaCustomDAO();
    }
 
    public function main(){
        
        echo '
            
<div class="card mb-4">
        <div class="card-body">';
        
        echo '<h3 class="pb-4 mb-4 font-italic border-bottom collapsed" data-toggle="collapse" data-target="#collapseAtraso" href="#collapseAtraso" aria-expanded="false">
                Painel Kamban
	        
            <button type="button" class="float-right btn ml-3 btn-warning btn-circle btn-lg collapsed" data-toggle="collapse" href="#collapseAtraso" role="button" aria-expanded="false" aria-controls="collapseAtraso"><i class="fa fa-expand icone-maior"></i></button>
            </h3>';
        
        $ocorrencia = new Ocorrencia();
        $pendentes = $this->dao->pesquisaAdmin($ocorrencia, $this->arrayStatusPendente());
        $finalizados = $this->dao->pesquisaAdmin($ocorrencia, $this->arrayStatusFinalizado());
        
        
        $this->view->mostrarQuadro($pendentes, $finalizados);
        
        echo '
            
            
	</div>
</div>
            
            
            
            
';
        
    }
    
}
?>