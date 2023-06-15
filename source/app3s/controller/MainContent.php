<?php

namespace app3s\controller;

use app3s\util\Sessao;


class MainContent
{


    public function main()
    {

        $sessao = new Sessao();
        if ($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO) {
            echo view('partials.form-login');
            return;
        }

        switch ($sessao->getNivelAcesso()) {
            case Sessao::NIVEL_TECNICO:
                $this->contentTec();
                break;
            case Sessao::NIVEL_ADM:
                $this->contentAdmin();
                break;
            case Sessao::NIVEL_COMUM:
                $this->contentComum();
                break;
            case Sessao::NIVEL_DISABLED:
                echo view('partials.diabled');
                break;
            default:
                echo view('partials.form-login');
                break;
        }
    }

    public function contentComum()
    {
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'ocorrencia':
                    $controller = new OcorrenciaController();
                    $controller->main();
                    break;
                default:
                    echo '<p>Página solicitada não encontrada.</p>';
                    break;
            }
        } else {
            $controller = new OcorrenciaController();
            $controller->main();
        }
    }


    public function contentAdmin()
    {
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'ocorrencia':
                    $controller = new OcorrenciaController();
                    $controller->main();
                    break;
                case 'servico':
                    $controller = new ServicoController();
                    $controller->main();
                    break;
                case 'area_responsavel':
                    $controller = new AreaResponsavelController();
                    $controller->main();
                    break;
                case 'usuario':
                    $controller = new UsuarioController();
                    $controller->main();
                    break;
                case 'painel_kamban':
                    $controller = new PainelKambanController();
                    $controller->main();
                    break;
                case 'painel_tabela':
                    $controller = new PainelTabelaController();
                    $controller->main();
                    break;
                default:
                    echo '<p>Página solicitada não encontrada.</p>';
                    break;
            }
        } else {
            $controller = new OcorrenciaController();
            $controller->main();
        }
    }


    public function contentTec()
    {
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'ocorrencia':
                    $controller = new OcorrenciaController();
                    $controller->main();
                    break;
                case 'painel_kamban':
                    $controller = new PainelKambanController();
                    $controller->main();
                    break;
                case 'painel_tabela':
                    $controller = new PainelTabelaController();
                    $controller->main();
                    break;
                default:
                    echo '<p>Página solicitada não encontrada.</p>';
                    break;
            }
        } else {
            $controller = new OcorrenciaController();
            $controller->main();
        }
    }
}
