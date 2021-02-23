<?php 
namespace novissimo3s\custom\controller;

use novissimo3s\custom\view\PainelKambanView;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\model\Ocorrencia;
use novissimo3s\custom\dao\AreaResponsavelCustomDAO;
use novissimo3s\custom\dao\UsuarioCustomDAO;
use novissimo3s\model\Usuario;
use novissimo3s\util\Sessao;


class PainelKambanController extends OcorrenciaCustomController{
    
    
    public function __construct(){
        $this->view = new PainelKambanView();
        $this->dao = new OcorrenciaCustomDAO();
    }
 
    public function main(){
        
        echo '
            
<div class="card mb-4">';
        echo '
            
                <div class="card-header pb-4 mb-4 font-italic">
                    Painel Kamban';
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
        echo '
                <button id="btn-expandir-tela" type="button" class="float-right btn ml-3 btn-warning btn-circle btn-lg collapsed"><i class="fa fa-expand icone-maior"></i></button>
            </div>';
        echo '
        <div class="card-body">';
        echo '


';

        
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