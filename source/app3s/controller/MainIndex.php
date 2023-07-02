<?php

namespace app3s\controller;

use app3s\util\Sessao;

class MainIndex
{

  public function main()
  {
    $sessao = new Sessao();
    $user = request()->user();


    if (isset($_GET['ajax'])) {
      $mainAjax = new MainAjax();
      $mainAjax->main();
      exit(0);
    }
    if (isset($_REQUEST['api'])) {
      $controller = new MensagemForumApiRestController();
      $controller->main();
      exit(0);
    }

    echo view('partials.header');

    $primeiroNome = $sessao->getNome();
    $arr = explode(" ", $sessao->getNome());
    if (isset($arr[0])) {
      $primeiroNome = $arr[0];
    }
    $primeiroNome = ucfirst(strtolower($primeiroNome));

    if ($sessao->getNivelAcesso() == Sessao::NIVEL_COMUM) {
      echo view('client.partials.navbar', ['originalLevel' => $sessao->getNivelOriginal(), 'userFirstName' => $primeiroNome, 'divisionSig' => $sessao->getUnidade()]);
    }
    if ($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
      echo view('provider.partials.navbar', ['originalLevel' => $sessao->getNivelOriginal(), 'userFirstName' => $primeiroNome, 'divisionSig' => $sessao->getUnidade()]);
    }
    if ($sessao->getNivelAcesso() == Sessao::NIVEL_ADM) {
      echo view('admin.partials.navbar', ['userFirstName' => $primeiroNome, 'divisionSig' => $sessao->getUnidade()]);
    }

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

    }
    echo view('partials.footer');
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
