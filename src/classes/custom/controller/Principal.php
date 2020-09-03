<?php 

class Principal{
    
    
    public static function main()
    {
        
        echo '
            
<div class="card mb-4">
    <div class="card-body">
';

        
        $usuarioView = new UsuarioCustomView();
        $usuarioView->formLogin();
        echo '<br><br><br><br>
    </div>
</div>';
        
        
//         if(isset($_GET['pagina'])){
//             switch ($_GET['pagina']){
//                 case 'painel':
//                     $controller = new OcorrenciaCustomController();
//                     $controller->telaInicialPainel();
//                     break;
//                 case 'ocorrencia':
//                     $controller = new OcorrenciaCustomController();
//                     $controller->main();
//                     break;
//                 default:
//                     echo '<p>Página solicitada não encontrada.</p>';
//                     break;
//             }
//         }else{
//             $controller = new OcorrenciaCustomController();
//             $controller->main();
            
//         }
        
        
    }
    
    
}



?>