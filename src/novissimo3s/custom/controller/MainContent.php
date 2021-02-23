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
        switch ($sessao->getNivelAcesso()){
            case Sessao::NIVEL_TECNICO:
                $this->contentTec();
                break;
            case Sessao::NIVEL_ADM:
                $this->contentAdmin();
                break;
            case Sessao::NIVEL_COMUM:
                $this->contentComum();
                break;
            default:
                $usuarioController = new UsuarioCustomController();
                $usuarioController->telaLogin();
                break;
        }
        
    }

    public function contentComum(){
        if(isset($_GET['page'])){
            switch ($_GET['page'])
            {
                case 'ocorrencia':
                    $controller = new OcorrenciaCustomController();
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

    
    public function contentAdmin(){
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
                case 'servico':
                    $controller = new ServicoCustomController();
                    $controller->main();
                    break;
                case 'painel_kamban':
                    $controller = new PainelKambanController();
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
    
    
    public function contentTec(){
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
                case 'painel_kamban':
                    $controller = new PainelKambanController();
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