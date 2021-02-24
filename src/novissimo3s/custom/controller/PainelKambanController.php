<?php 
namespace novissimo3s\custom\controller;

use novissimo3s\custom\view\PainelKambanView;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\model\Ocorrencia;
use novissimo3s\custom\dao\AreaResponsavelCustomDAO;
use novissimo3s\custom\dao\UsuarioCustomDAO;
use novissimo3s\model\Usuario;
use novissimo3s\util\Sessao;
use novissimo3s\custom\dao\StatusOcorrenciaCustomDAO;


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
        
        $usuario = new Usuario();
        $usuario->setNivel(Sessao::NIVEL_TECNICO);
        $usuarioDao = new UsuarioCustomDAO($this->dao->getConnection());
        $listaTec = $usuarioDao->fetchByNivel($usuario);
        $usuario->setNivel(Sessao::NIVEL_ADM);
        $listaAdm = $usuarioDao->fetchByNivel($usuario);
        $listaTec = array_merge($listaTec, $listaAdm);
        
        
        echo '
                    <select id="select-tabela">
                            <option value="">Filtrar por Técnico</option>';
        
        foreach($listaTec as $usuario){
            echo '                <option value="'.$usuario->getId().'">'.$usuario->getNome().'</option>';
        }
        
        echo '
                    </select>';
    }
    public function main(){
        
        echo '
            
<div class="card mb-4">
        <div class="card-header pb-4 mb-4 font-italic">
                    Painel Kamban';
        
//         $this->formFiltro();
        
        echo '
                <button id="btn-expandir-tela" type="button" class="float-right btn ml-3 btn-warning btn-circle btn-lg collapsed"><i class="fa fa-expand icone-maior"></i></button>
            </div>
            <div class="card-body" id="quadro-kanban">';
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
        $ocorrencia = new Ocorrencia();
        $pendentes = $this->dao->pesquisaAdmin($ocorrencia, $this->arrayStatusPendente());
        $finalizados = $this->dao->pesquisaAdmin($ocorrencia, $this->arrayStatusFinalizado());
        
        
        $statusDao = new StatusOcorrenciaCustomDAO($this->dao->getConnection());
        $matrixStatus = array();
        foreach($pendentes as $ocorrencia){
            $matrixStatus[$ocorrencia->getId()] = $statusDao->pesquisaPorIdOcorrencia($ocorrencia);
        }
        foreach($finalizados as $ocorrencia){
            $matrixStatus[$ocorrencia->getId()] = $statusDao->pesquisaPorIdOcorrencia($ocorrencia);
        }
        
        
        $this->view->mostrarQuadro($pendentes, $finalizados, $matrixStatus);
        
    }
    
}
?>