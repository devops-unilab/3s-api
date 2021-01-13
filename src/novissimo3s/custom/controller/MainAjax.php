<?php 

namespace novissimo3s\custom\controller;


class MainAjax{
    
    public function main(){
        switch ($_GET['ajax']){
            case 'ocorrencia':
                $controller = new OcorrenciaCustomController();
                $controller->mainAjax();
                break;
            default:
                echo ':falha';
                break;
        }
    }
}

?>