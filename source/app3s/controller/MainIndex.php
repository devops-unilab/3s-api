<?php

namespace app3s\controller;

class MainIndex
{

  public function main()
  {
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
    $primeiroNome = request()->user()->name;
    $arr = explode(" ", request()->user()->name);
    if (isset($arr[0])) {
      $primeiroNome = $arr[0];
    }
    $primeiroNome = ucfirst(strtolower($primeiroNome));
    echo view('partials.navbar');
    $controller = new OcorrenciaController();
    $controller->main();
    echo view('partials.footer');
  }
}
