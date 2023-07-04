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

    $primeiroNome = $user->name;
    $arr = explode(" ", $user->name);
    if (isset($arr[0])) {
      $primeiroNome = $arr[0];
    }
    $primeiroNome = ucfirst(strtolower($primeiroNome));
    echo view('partials.navbar');

    $sessao = new Sessao();
    if ($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO) {
      echo view('partials.form-login');
      return;
    }
    $controller = new OcorrenciaController();
    $controller->main();
    echo view('partials.footer');
  }
}
