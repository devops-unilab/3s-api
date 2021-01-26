<?php 

namespace novissimo3s\custom\controller;
use novissimo3s\util\Sessao;


class MainContent{
    
    
    public function main()
    {
        
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO)
        {
            $usuarioController = new UsuarioCustomController();
            $usuarioController->telaLogin();
            return;
        }
        
        $this->contentComum();
    }

    public function contentComum(){
        if(isset($_GET['page'])){
            switch ($_GET['page'])
            {
                case 'ocorrencia':
                    $controller = new OcorrenciaCustomController();
                    $controller->main();
                    break;
                case 'importador':
                    $controller = new Importador();
                    $controller->main();
                    break;
                default:
                    echo '<p>Página solicitada não encontrada.</p>';
                    break;
            }
        }else{
            $controller = new OcorrenciaCustomController();
            $controller->main();
            
        }
    }

    
    
}



?>