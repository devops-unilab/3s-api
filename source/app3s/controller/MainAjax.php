<?php

namespace app3s\controller;

class MainAjax
{

    public function main()
    {
        switch ($_GET['ajax']) {
            case 'mensagem_forum':
                $controller = new OcorrenciaController();
                $controller->ajaxAddMessage();
                break;
            case 'pedir_ajuda':
                $controller = new OcorrenciaController();
                $controller->ajaxPedirAjuda();
                break;
            default:
                echo ':falha';
                break;
        }
    }
}
