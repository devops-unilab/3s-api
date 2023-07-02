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
            case 'painel_kamban':
                $controller = new PainelKambanController();
                $controller->quadroKamban();
                break;
            case 'painel_tabela':
                $controller = new PainelTabelaController();
                $controller->tabelaChamados();
                break;
            case 'login':
                $controller = new UsuarioController();
                $controller->ajaxLogin();
                break;
            case 'mudar_nivel':
                $controller = new UsuarioController();
                $controller->mudarNivel();
                break;
            default:
                echo ':falha';
                break;
        }
    }
}
