<?php 
namespace novissimo3s\custom\controller;

use novissimo3s\custom\view\PainelKambanView;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\model\Ocorrencia;
use novissimo3s\util\Sessao;

class PainelKambanController extends OcorrenciaCustomController{
    
    
    public function __construct(){
        $this->view = new PainelKambanView();
        $this->dao = new OcorrenciaCustomDAO();
    }
 
    public function main(){
        
        echo '
            
<div class="card mb-4">
        <div class="card-body">';
        
        echo "<h3>Painel Kamban</h3>";
        
        $ocorrencia = new Ocorrencia();
//         $sessao = new Sessao();
        
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