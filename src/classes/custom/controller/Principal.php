<?php 

class Principal{
    
    
    public function main()
    {
        
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
            $this->telaLogin();
            return;
        }
                
        if(isset($_GET['pagina'])){
            switch ($_GET['pagina']){
                case 'painel':
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
    public function fazerLogin(){
        if (!isset($_POST['logar'])) {
            return;
        }
        
        $usuario = new Usuario();
        $usuario->setLogin($_POST['usuario']);
        $usuario->setSenha(md5($_POST['senha']));
        $usuarioDao = new UsuarioCustomDAO(null, DB_AUTENTICACAO);
        if ($usuarioDao->autenticar($usuario)) {
            echo '
<div class="alert alert-success" role="alert">
  Login realizado com Sucesso
</div>      
';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=index.php">';
        } else {
            echo '
<div class="alert alert-danger" role="alert">
  Você errou a senha! Tente novamente!
</div>
                
';
        }
    }
    public function telaLogin(){
        
        echo '
            
<div class="card mb-4">
    <div class="card-body">';
        $this->fazerLogin();
        $usuarioView = new UsuarioCustomView();
        $usuarioView->formLogin();
        echo '<br><br><br><br><br><br><br><br><br>
    </div>
</div>';
    }
    
    
}



?>