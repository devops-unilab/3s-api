<?php 

class Principal{
    
    
    public function main()
    {
        
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
            $usuarioController = new UsuarioCustomController();
            $usuarioController->telaLogin();
            return;
        }
                
        if(isset($_GET['pagina'])){
            switch ($_GET['pagina']){
                case 'painel':
                    if(!($sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO)){
                        return;
                    }
                    $controller = new OcorrenciaCustomController();
                    $controller->telaInicialPainel();
                    break;
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


    
    
}



?>