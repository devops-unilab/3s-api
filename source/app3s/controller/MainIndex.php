<?php

namespace app3s\controller;

use app3s\util\Sessao;

class MainIndex
{

  public function main()
  {
    $sessao = new Sessao();
    $user = request()->user();

    if($sessao->getNivelAcesso() === null) {
      $sessao = new Sessao();
      $sessao->criaSessao($user->id, $user->role, $user->login, $user->name, $user->email);
      $sessao->setIDUnidade($user->division_sig_id);
      $sessao->setUnidade($user->division_sig);
      redirect('/');
    }
    // dd($sessao->getNivelAcesso());

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

    $primeiroNome = $user->name;
    $arr = explode(" ", $user->name);
    if (isset($arr[0])) {
      $primeiroNome = $arr[0];
    }
    $primeiroNome = ucfirst(strtolower($primeiroNome));
    // dd($sessao->getNivelAcesso());
    // dd(request());
    echo view('partials.navbar', [
      'role' => $sessao->getNivelAcesso(),
      'originalRole' => $user->role,
      'userFirstName' => $primeiroNome,
      'divisionSig' => $sessao->getUnidade()]);

    $sessao = new Sessao();
    if ($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO) {
      echo view('partials.form-login');
      return;
    }

    switch ($user->role) {
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
