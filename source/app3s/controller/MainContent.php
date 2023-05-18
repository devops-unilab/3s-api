<?php

namespace app3s\controller;

use app3s\util\Sessao;
use app3s\dao\DAO;


class MainContent
{


    public function main()
    {

        $sessao = new Sessao();
        if ($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO) {
            $usuarioController = new UsuarioController();
            $usuarioController->telaLogin();
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
                echo '<div class="card mb-4">
                        <div class="container">
                            <div class="row m-5">
                                <h1>Seu acesso está desabilitado. É necessário solicitar seu acesso à DTI. </h1>
                            </div>
                        </div>
                    </div>';
                break;
            default:

                $usuarioController = new UsuarioController();
                $usuarioController->telaLogin();
                break;
        }
    }

    public function contentComum()
    {
        if (!isset($_GET['page'])) {
            $controller = new OcorrenciaController();
            $controller->main();
            return;
        }
        if ($_GET['page'] === 'ocorrencia') {
            $controller = new OcorrenciaController();
            $controller->main();
        } else {
            $this->notFound();
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
                    $this->notFound();
                    break;
            }
        } else {
            $controller = new OcorrenciaController();
            $controller->main();
        }
    }

    public function notFound() {
        $this->notFound();
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
                    $this->notFound();
                    break;
            }
        } else {
            $controller = new OcorrenciaController();
            $controller->main();
        }
    }
}
