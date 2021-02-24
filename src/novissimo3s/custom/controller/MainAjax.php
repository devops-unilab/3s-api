<?php 

namespace novissimo3s\custom\controller;


class MainAjax{
    
    public function main(){
        switch ($_GET['ajax']){
            case 'ocorrencia':
                $controller = new OcorrenciaCustomController();
                $controller->mainAjax();
                break;
            case 'mensagem_forum':
                $controller = new MensagemForumCustomController();
                $controller->mainAjax();
                break;
            case 'status_ocorrencia':
                $controller = new StatusOcorrenciaCustomController();
                $controller->mainAjax();
                break;
            case 'pedir_ajuda':
                $controller = new OcorrenciaCustomController();
                $controller->ajaxPedirAjuda();
                break;
            case 'painel_kamban':
                $controller = new PainelKambanController();
                $controller->quadroKamban();
                break;
            default:
                echo ':falha';
                break;
        }
        
    }
}

?>