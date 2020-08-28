<?php 

class Principal{
    
    
    public static function main()
    {
        if(isset($_GET['pagina'])){
            switch ($_GET['pagina']){
               
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