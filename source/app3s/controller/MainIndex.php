<?php

namespace app3s\controller;

use app3s\util\Sessao;

class MainIndex
{

  public function main()
  {
    $sessao = new Sessao();
    if (isset($_GET['ajax'])) {
      $mainAjax = new MainAjax();
      $mainAjax->main();
      exit(0);
    }
    if (isset($_REQUEST['api'])) {
      $mainApi = new MainApi();
      $mainApi->main();
      exit(0);
    }
    if (isset($_GET["sair"])) {
      $sessao->mataSessao();
      echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=.">';
    }

    $this->pagina();
  }

  public function pagina()
  {

    echo view('partials.header');
    echo '    <main role="main" class="container">';
    $sessao = new Sessao();
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
    $principal = new MainContent();
    $principal->main();
    echo view('partials.footer');
  }
}
