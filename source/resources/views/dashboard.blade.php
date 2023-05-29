<!doctype html>
<html lang="pt-br">

<head>

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta charset="utf-8">
    <title>3s | Sistema de Solicitação de Ocorrências</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="Cache-control" content="no-cache">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>




    <div id="cabecalho" class="container">



        <header>

            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12  d-flex justify-content-center">

                    <a class="text-muted" href="#"><img src="{{ asset('images/logo-header.png') }}"
                            alt="Logo 3s" /></a>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex align-items-end  justify-content-center">
                    <p class="blog-header-logo text-white font-weight-bold"></p>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                    <a class="text-muted" href="#"><img src="{{ asset('images/logo-unilab-branco.png') }}"
                            alt="Logo Unilab" /></a>
                    <button class="btn m-4 btn-contraste" href="#altocontraste" id="altocontraste" accesskey="3"
                        onclick="window.toggleContrast()" onkeydown="window.toggleContrast()" class=" text-white ">
                        <i class="fa fa-adjust text-white"></i>
                    </button>

                </div>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href=".">Início<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=ocorrencia&cadastrar=1">Abrir Chamado</a>
                    </li>

                    <!--
      <li class="nav-item">
        <a class="nav-link" href="?page=painel">Painel</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Relatórios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Configurações
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>

    -->



                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Paineis
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="?page=painel_kamban">Kanban</a>
                            <a class="dropdown-item" href="?page=painel_tabela">Tabela</a>
                            <!--
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a> -->
                        </div>
                    </li>






                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gerenciamento
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="?page=servico">Serviços</a>


                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?page=area_responsavel">Unidades</a>
                            <a class="dropdown-item" href="?page=usuario">Usuários</a>
                        </div>
                    </li>


                </ul>

                <form action="" method="get">

                    <div class="input-group">
                        <input type="hidden" name="page" value="ocorrencia">
                        <input type="text" name="selecionar" class="form-control" placeholder="Número do chamado"
                            aria-label="Número do Chamado" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="form" id="button-addon2">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="btn-group">
                    <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> Olá, Jefferson
                    </button>

                    <div class="dropdown-menu dropright">
                        <button type="button" disabled class="dropdown-item">
                            Setor: DTI
                        </button>




                        <hr>
                        <button type="button" nivel="a" disabled class="dropdown-item change-level">
                            Perfil Admin
                        </button>

                        <button type="button" nivel="t" id="change-to-tec" class="dropdown-item change-level">
                            Perfil Técnico
                        </button>
                        <button type="button" nivel="c" id="change-to-default"
                            class="dropdown-item change-level">
                            Perfil Comum
                        </button>
                        <hr>




                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                        @csrf
                    </form>
                    </div>
                </div>

            </div>
        </nav>





    </div>

    <main role="main" class="container">



        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 blog-main">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" id="panel1">
                                <div class="panel-heading">
                                    <h3 class="pb-4 mb-4 font-italic border-bottom" data-toggle="collapse"
                                        data-target="#collapseAtraso" href="#collapseAtraso">
                                        Ocorrências Em Atraso (171)

                                        <button type="button"
                                            class="float-right btn ml-3
                btn-warning btn-circle btn-lg"
                                            data-toggle="collapse" href="#collapseAtraso" role="button"
                                            aria-expanded="false" aria-controls="collapseAtraso"><i
                                                class="fa fa-expand icone-maior"></i></button>
                                    </h3>

                                </div>
                                <div id="collapseAtraso" class="panel-collapse collapse in show">
                                    <div class="panel-body">


                                        <div id=easyPaginatecollapseAtraso class="alert-group">

                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33586" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33586 </strong>Computador da servidor, situado no RU de
                                                Auroras, foi avaliado pela DTI com parecer irrecuperável.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33584" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33584 </strong>Prezados(as),

                                                Solicitamos verificação do sistema de inscrição do SISURE, atualmente o
                                                sistema não permite alteração da escolha de curso pelo candidato no
                                                período de inscrição e não permi...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33576" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33576 </strong>Atualizar Windows, pois ainda está com Windows 7
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33575" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33575 </strong>Após dano IRRECUPERÁVEL do Computador modelo
                                                Dell Optiplex 7010, tombamento 2013004507, conforme laudo em anexo,
                                                solicitamos novo equipamento para substituição.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33574" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33574 </strong>Prezados(as), solicito a instalação do git no
                                                servidor de host: 200.129.19.32 (seunem).
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33570" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33570 </strong>[Bolsista não vê todos os meses da frequência]
                                                Prezados(as), a bolsista MARIA NATANIELE QUEIROZ DE LIMA, orientanda da
                                                professora FLAVIA PAULA MAGALHÃES MONTEIRO, vinculada ao projeto
                                                PVS1668-2022...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33557" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33557 </strong>Não estou conseguindo cadastrar evento de
                                                extensão no sigaa e apareceu a mensagem orientando para abrir chamado.
                                                Como essa opção não apareceu em serviço, coloquei como se fosse
                                                formulário de pe...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33555" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33555 </strong>Impressora com problema. Não está imprimindo,
                                                papel preso!
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33551" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33551 </strong>Boa tarde, no sistema Selest, ao associar
                                                redações, foi notado que as redações ficam na horizontal. Ao clicar em
                                                &quot;girar&quot; elas apenas ficam invertidas, não girando na vertical
                                                (imagem em...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33543" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33543 </strong>Gostaria de solicitar acesso à VPN da Unilab.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33539" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33539 </strong>Prezados, solicito a execução do script a segui
                                                na base administrativo de homologação: update
                                                almoxarifado.estoque_material set saldo = 207 where id_estoque_material
                                                = 901
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33537" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33537 </strong>Computador é lento, trava constantemente, desse
                                                modo, solicitamos a avaliação do computador nº 201400130 e, caso
                                                necessário, por gentileza, realizar um upgrade.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33532" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33532 </strong>Prezados(as),

                                                Diante do chamado 33283, fomos informados pela dti que a o acesso ao
                                                módulo vestibular e ao módulo de transferência voluntária é dado pela
                                                SRCA (atualmente SECRAGI).

                                                No entant...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33531" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33531 </strong>-Verificar o funcionamento do Agente Zabbix para
                                                Linux na VM NUTANIX unicafe IP: 200.129.19.40
                                                -Verificar o apontamento para o servidor Zabbix no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33521" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33521 </strong>PROJETO AUXÍLIOS
                                                Atualizar relatório de índices redutores ou criar novo formato editável
                                                para realização da análise socioeconômica no próprio sistema.

                                                &quot;Atualmente o relatório gera u...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33519" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33519 </strong>Prezados,

                                                Segue solicitação de candidata em edital do SISURE (16/2023).

                                                &quot;Coloquei um curso errado na seleção do processo seletivo da
                                                unilab, tem como cancelar a inscrição pra me faze...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33516" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33516 </strong>[Perfil de Administrador] Para dar andamento a
                                                demandas internas, solicito inclusão do perfil de administrador no
                                                ambiente de Homologação do SEI!(https://homologacaosei.unilab.edu.br),
                                                para os segu...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33509" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33509 </strong>Em nome da Coordenação do curso de Licenciatura
                                                em Computação e Informática EaD, solicitamos a inclusão do Polo EaD de
                                                São Francisco do Conde (BA) no SISURE para que seja possível a
                                                inscriçã...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33503" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33503 </strong>Boa tarde !

                                                Em nome da Comissão Organizadora da Consulta Pública para a escolha da
                                                Direção e Vice Direção do Instituto de Humanidades e Letras do Campus
                                                dos Malês (quadriênio 2023-2027), re...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33502" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33502 </strong>O estudante AURIO DANIEL RODRIGUÊS CAMPOS -
                                                matrícula 2022208449, está com erro de layout na disciplina LEITURA E
                                                PRODUÇÃO DE TEXTO I. Segue print em anexo. Solicitamos solução.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33501" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33501 </strong>Solicito acesso de um servidor de testes do LDAP
                                                para ser usado no desenvolvimento da API de autenticação para as
                                                diversas aplicações.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33493" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33493 </strong>Prezados,

                                                Existe um sistema chamado BDTD - https://bdtd.ibict.br/vufind/ - que
                                                agrega trabalhos acadêmicos de diversas instituições, entre elas a
                                                unilab. Verifiquei que a quantidade de disserta�...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33490" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33490 </strong>[Problema ao substituir bolsista] Prezados(as),
                                                ao substituir o bolsista WALISSON SOUSA ALVES pela MONALISA RODRIGUES DE
                                                CARVALHO, orientados pela professora CAMILA CHAVES DA COSTA, no projeto
                                                PVS1686...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33486" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33486 </strong>Gostaria de solicitar a instalação do Nodejs
                                                versão 18.16.0 na máquina 200.129.19.52
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33467" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33467 </strong>Solicito que seja criado dois ambiente de
                                                produção e outro de homologação para os sistemas da SPA com PHP 8.2, SSL
                                                e Postgres.

                                                8.2 php
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33466" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33466 </strong>Solicitação de computador para a sala do pró
                                                reitor
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33463" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33463 </strong>Estou atualizando o PHP do SISGEF da versão 7.4
                                                para 8.2 e também estou configurando para utilizar https. Preciso de um
                                                ambiente de teste para hospedar o SISGEF nessas novas configurações. O
                                                ambie...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33461" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33461 </strong>Estou atualizando o PHP do SISGEF da versão 5.6
                                                para 7.4 e também estou configurando para utilizar https. Preciso de um
                                                ambiente de produção para hospedar o SISGEF nessas novas configurações.
                                                O ...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33460" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33460 </strong>Prezados,
                                                Solicitamos ajuste no modo de envio de comunicação, pelo SIGAA, com os
                                                coordenadores de ações de extensão.
                                                Pedimos que ao enviarmos um comunicado aos coordenadores de ações de
                                                exte...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33458" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33458 </strong>Prezados,
                                                Solicitamos ajuste nos status e na busca das ações, conforme documento
                                                em anexo.
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33456" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33456 </strong>Limpeza e averiguação de funcionamento da
                                                máquina.
                                                Tombo: 2016000292
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33445" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33445 </strong>[Linhas em branco nas frequências] Prezados(as),
                                                a listagem de frequências dos bolsistas apresenta umas linhas em branco.
                                                Estou abrindo esse chamado para verificar porque acontece esse
                                                comportamento...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33437" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33437 </strong>Prezados/as, bom dia!

                                                Gostaria de saber como fazer para solicitar esse tipo de serviço. É por
                                                estação de trabalho?!

                                                No aguardo.

                                                At.te,
                                                Helka Sampaio
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33434" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33434 </strong>Nós constatamos uma falha no 3S. Como
                                                demonstrado nas imagens abaixo, caso o usuário não atualize a página do
                                                chamado, ele consegue enviar mensagens mesmo com o chamado encerrado. Só
                                                após atuali...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33430" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33430 </strong>Prezados,
                                                Muitos estudantes nos relataram que não estão conseguindo emitir o
                                                certificado de bolsista/voluntário.
                                                Verificamos, no módulo de extensão, quais os impedimentos do recebimento
                                                desse d...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33415" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33415 </strong>Prezados, solicito as seguintes alterações no
                                                texto do verso de todos os diplomas:

                                                Onde se lê: &quot;Credenciada pela Lei nº 12.289, de 20 de julho de
                                                2010, publicada em 21 de julho de 2010 no...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33413" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33413 </strong>Gostaria de solicitar a correção de um membro
                                                examinador externo de banca de TCC, que esta com cadastro(nome) errado
                                                no SIGAA.
                                                CPF: 830.697.553-72 nome correto: Isabel Peixoto Lourenço
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33399" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33399 </strong>Prezados, bom dia!
                                                solicitamos a verifica da impressora
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33388" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33388 </strong>A pedido da Direção do Instituto de Humanidades,
                                                gostaria, por gentileza, de verificar a possibilidade de criar um método
                                                de parabenizar as/os discentes e docentes do IH na data de seu
                                                aniversário...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33383" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33383 </strong>Prezada Equipe, bom dia!

                                                Não estamos conseguindo cadastrar uma unidade no sistema Apoio SUSEP,
                                                segue a unidade e o erro sequente, em anexo.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33342" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33342 </strong>Solcitio que seja feita a restauração de uma
                                                tabela do sigrh. Conforme script abaixo feito pelo Paulo Neto/DSI.


                                                Tabela a ser restaurada - por equipe de banco de dados.
                                                select * from
                                                funcional...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33340" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33340 </strong>Prezados/as, boa tarde,

                                                Referente ao servidor Joab Venâncio da Silva, recebemos o seguinte
                                                e-mail:
                                                &quot;Após a minha mudança de cargo para Coordenador de Políticas
                                                Estudantis e a consequente ...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33326" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33326 </strong>Prezados, solicito emissão de relatório de
                                                registro de diplomas de graduação emitido com os mesmos dados do
                                                relatório em anexo (com resumo de quantitativo). Ele deve conter os
                                                registros de outubr...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33315" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33315 </strong>Olá
                                                Bom dia!!
                                                Estou com problema de acesso ao SIGRH. Tanto no acesso pelo computador,
                                                como no celular quando tento acessar a página exibida mostra a
                                                informação abaixo:

                                                Caro Usuário,

                                                Descu...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33312" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33312 </strong>Estamos abrindo este chamado para solicitar a
                                                correção da carga horária das disciplinas EAD no SIGAA que foram zeradas
                                                nas disciplinas de anos anteriores.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33305" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33305 </strong>A Coordenação de Ensino de Graduação e Seleção
                                                solicita o acesso para gestão do formulário presente no link
                                                https://prograd.unilab.edu.br/forms/frequencia-mensal/, de modo a
                                                agilizar os proces...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33277" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33277 </strong>A Coordenação de Ensino de Graduação e Seleção
                                                solicita os seguintes ajustes nas Ações Afirmativas para a Graduação no
                                                SIGAA:
                                                a) excluir a ação afirmativa &quot;L2 - autodeclarados PPI, ...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33276" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33276 </strong>A Coordenação de Ensino de Graduação e Seleção
                                                solicita a inclusão das seguintes Ações Afirmativas para a GRADUAÇÃO no
                                                SIGAA: &quot;CRQ Categoria 1: Pessoa de baixa renda, egressa de
                                                escola...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33275" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33275 </strong>A Coordenação de Ensino de Graduação e Seleção
                                                solicita a inclusão das seguintes formas de ingresso para a GRADUAÇÃO no
                                                SIGAA: &quot;SISURE - AÇÕES AFIRMATIVAS/REMANESCENTES&quot; e &quot;T...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33265" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33265 </strong>Solicitação de computador para o Gabinete do
                                                Professor Halisson de Souza Pinheiro (Auroras, bloco A, sala 211)
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33255" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33255 </strong>A pedido da diretoria do SIBIUNE, solicito que
                                                seja feita uma integração de usuários dos sistemas SIG para o sistema do
                                                REPOSITÓRIO INSTITUCIONAL (DSPACE). Para que qualquer usuário da
                                                comunidade...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33225" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33225 </strong>Gostaria de solicitar acesso ao servidor do
                                                ambiente teste com Host: 10.129.19.128 (ou 200.129.19.132) meu ip é
                                                10.17.0.127
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33182" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33182 </strong>bom dia. não to conseguindo acessar o sigaa,
                                                para envio de comuncado pela secom. aparece a seguinte mensagem&gt;

                                                &quot;
                                                Desculpe, o sistema se comportou de forma inesperada. Entre em contato
                                                com ...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33171" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33171 </strong>Solicito inclusão do campo
                                                [&quot;id_pessoa&quot;] na view [&quot;vw_dados_projetos&quot;].
                                                Também solicito a inclusão do campo [&quot;id_pessoa&quot;] na view
                                                [&quot;vw_dados_bolsistas_pesquisa&q...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33165" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33165 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor PROXMOX N° 147 (FirewallGeral-01)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33146" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33146 </strong>Não estou conseguindo avaliar as atividades do
                                                meu subordinado no SUSEP
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33133" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33133 </strong>Professor Claudio André não está conseguindo
                                                visualizar no SIGAA todos os seus orientandos de TCC. Segue print em
                                                anexo. Pedimos celeridade na solução do problema.
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33094" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33094 </strong>Solicitação de computador para o coordenador do
                                                mestrado RENASF.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33071" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33071 </strong>Verificação de execução de cancelamento
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33059" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33059 </strong>Conceder acesso LDAP ao ip Load balance do Vault
                                                10.130.1.110 port 8200 para configuração da autenticacao de usario
                                                admins pela UI
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33034" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33034 </strong>O sistema 3S apresenta a mensagem &quot;Falha ao
                                                inserir ocorrência, fale com o suporte&quot; sempre que o solicitante
                                                informa letras no campo PATRIMÔNIO. Além disso, o sistema trava a ponto
                                                de ser...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33016" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33016 </strong>Solicito a liberação de acesso ao site de
                                                monitoramento remoto do Campus das Auroras.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33008" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33008 </strong>Prezados, solicito a disponibilização de um
                                                servidor para que sejam instalados os serviços que serão utilizados na
                                                integração do diploma digital. São 3 serviços que funcionarão: Banco de
                                                dado...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32952" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32952 </strong>COMPARTILHAMENTO DE INFORMAÇÕES ENTRE OS
                                                COMPUTADORES
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32946" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32946 </strong>Solicitamos computador para servidor que será
                                                transferido da SECOM para o Gabinete da Reitoria.
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32944" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32944 </strong>Considerando a lotação de um novo servidor na
                                                Ouvidoria, solicitamos o envio de computador para execução das
                                                atividades.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32923" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32923 </strong>Prezado (a),

                                                Em atenção ao chamado nº 32533, aberto pelo Gabinete da Propae,
                                                reforçamos o pedido de retirada da Profa. Eliane Barbosa da Conceição,
                                                do rol de servidores lotados na unidade Sus...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32856" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32856 </strong>Recebi a seguinte mensagem referente à cadastro
                                                de ação de extensão no SIGAA:
                                                &quot;Identificamos a ação &quot;Turnê desportiva alusivo a X edição da
                                                Semana África&quot; cadastrada em nosso...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32843" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32843 </strong>Solicitação de compartilhamento de pasta
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32833" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32833 </strong>Prezados,
                                                não consigo cadastrar o plano de trabalho de estudante voluntário de
                                                extensão, pois o sigaa não apresenta todas as casas para os meses na aba
                                                do cronograma
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32824" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32824 </strong>Erro de submissão de novo feriado no sistema de
                                                APOIO SUSEP (https://apoio-pgd.unilab.edu.br/padroes/cria_feriado). Em
                                                anexo, tela de erro.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32807" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32807 </strong>O nosso WordPress, conforme imagem, não está
                                                atualizando e com isso não conseguimos editar satisfatoriamente nossas
                                                matérias que vão pro Site.
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32788" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32788 </strong>Prezados(as),

                                                Conforme já conversado com Senhor Giancarlo, gostaria de verificar sobre
                                                a possibilidade de gerarmos os Cartões Respostas das Provas de
                                                conhecimento específicos e folhas de redaç�...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32773" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32773 </strong>Impressora Brother do laboratório de
                                                Farmacotécnica tem atolado papel toda vez que é solicitada a impressão.
                                                O papel sendo removido depois volta a funcionar. Fui orientada pelo
                                                estagiário Diego a...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32769" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32769 </strong>Prezada Equipe, Bom dia!
                                                Desde ontem a noite o sistema PGD e o Apoio estão com problemas.
                                                At.te
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32745" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32745 </strong>Solicitação da entrega do computador que já foi
                                                devolvido ao patrimônio e estava no aguardo da tela para entrega a
                                                Intesol
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32734" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32734 </strong>Atualizar a assinatura dos certificados da proex
                                                emitidos pelo sigaa: pró-reitora - Geranilde Costa e Silva
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32729" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32729 </strong>Prezados, boa tarde.
                                                Tendo em vista a constante realização de pesquisa e alteração da
                                                localização de bens, o Sipac tem apresentado constantemente 'erro',
                                                sendo necessário abrir outras janelas...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32723" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32723 </strong>Verificar firewall dos Campi em relação a porta
                                                para utilizar o Whatsapp em celulares iphone. Foi apresentado o problema
                                                para os Campi Auroras e Palmares.
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32697" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32697 </strong>Sistema Selest. Esse chamado possui relação com
                                                o chamado #31964, no qual a opção &quot;Deferir histórico
                                                imediatamente&quot; pelo supervisor nas ocorrências de históricos do
                                                tipo indeferido es...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32684" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32684 </strong>Considerando o encaminhamento da reunião da
                                                Prograd, Reitoria, DTI e Prointer do dia 16.03, solicitamos a inclusão
                                                do CPF como campo obrigatório para a matrícula dos alunos nacionais e
                                                internacion...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32668" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32668 </strong>Solicitamos a reativação do cadastro no SIGAA do
                                                Professor José Cleiton Sousa dos Santos, do IEDS, e-mail:
                                                jcs@unilab.edu.br, telefone: +55 85 99752-3838, para fins de que o
                                                docente possa enviar pr...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32651" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32651 </strong>Prezado(a)s, No momento temos oito pedidos de
                                                materiais de almoxarifado que não puderam ser atendidos devido a um erro
                                                no saldo do item 3026000002856 no SIPAC, conforme print anexado ao este
                                                chamado....
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32568" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32568 </strong>Sistema SIGRH não permite homologar o mês de
                                                outubro de 2022, dos servidores IGO DA CRUZ DOS SANTOS e EMANOEL MARQUES
                                                FREITAS, aparecendo a mensagem de erro, &quot; Não é possível autorizar
                                                uma q...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32533" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32533 </strong>Prezados(as),
                                                Considerando que a servidora ELIANE BARBOSA DA CONCEIÇÃO não é mais
                                                gestora do Sepir/Propae, conforme portaria anexada;
                                                Solicitamos a sua retirada do rol de servidores lotados n...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32527" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32527 </strong>Prezados, verifiquei que o horário no sistema de
                                                ponto do SIGRH está aproximadamente 2 minutos a mais que a hora de
                                                referência e o horário dos computadores.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32512" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32512 </strong>No SIRGH, Administração de Pessoal &gt;
                                                Cadastros &gt; Vínculos de servidor&gt; Desligar Vínculo &gt; Buscar
                                                Servidor. O acesso para desligamento após a busca pelo servidor não está
                                                carregando....
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32463" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32463 </strong>Com a atualização do parque computacional dos
                                                laboratórios de informática, percebeu-se um problema com o Unicaffe. O
                                                sistema não permite a exclusão de máquinas que não estão ligadas. E não
                                                t...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32378" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32378 </strong>Criação de um campo na tela buscar bolsa
                                                auxílio, com um campo, onde pudesse ser descrito a
                                                ficha de acompanhamento de permanência ao discente.

                                                Sigaa &gt; Assistência ao Estudante&gt; Buscar...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32377" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32377 </strong>Criar uma funcionalidade para emissão de
                                                relatório de análise dos recursos no SAE ( funcionalidade em
                                                desenvolvimento) e outra funcionalidade para emissão de relatório dos
                                                discentes indeferidos c...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32376" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32376 </strong>Criar uma funcionalidade no SAE denominada
                                                Auxílio Emergencial ( atividade realizada mensalmente pela equipe
                                                social) - sistema não possibilita dois calendários vigentes/abertos no
                                                SAE.

                                                1) Deve...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32365" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32365 </strong>[Modulo de pesquisa] A data de finalização da
                                                cota do bolsista deve ser registrada quando for substituído.
                                                A informação pode ser verificada no rodapé do plano de trabalho.
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32304" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32304 </strong>Conforme processo 23282.000387/2023-85, solicito
                                                alteração no meu cadastro de modo a que seja possível atribuir permissão
                                                a todos os módulos do SIPAC, conforme designação.
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32295" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32295 </strong>SAE/SIGAA: Inserção de campo no SIGAA para
                                                indicação se a conta bancária cadastrada pertence a um BANCO DIGITAL.
                                                Deve-se incluir uma coluna na folha de pagamento de auxílios emitida no
                                                SIPAC com...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32294" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32294 </strong>Solicita-se disponibilização de tela de consulta
                                                de situação individual de discentes para a equipe de elaboração das
                                                folhas de pagamento no SAE, conforme descrito no anexo.
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32275" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32275 </strong>Liberação de acessos aos sistemas 3S e SISGEF
                                                aos estagiários institucionais (WALKER SALES VALENTIM, mat. 3301517 e
                                                FRANCISCO ERIQUI DA SILVA BARROSO, mat. 3294629) (ICEN).
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32211" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32211 </strong>Não consegui bater o ponto eletrônico hoje
                                                porque o SIGRH diz que estou de férias, sendo que minhas férias foram
                                                antecipadas para odia 17 de janeiro a té dia 21.
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32189" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32189 </strong>Criação de script para atualizar a área de
                                                conhecimento dos candidatos que estão com status deferidos, mas sem nota
                                                de histórico. Banco: Selest_Medicina. Esses scripts devem ser rodados
                                                primeiram...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32187" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32187 </strong>No meu Sigaadm estou lotada na IEAD. Mas desde
                                                do final de 2014. E isso está inibindo meus acessos na SRCA.
                                                Obs.: Coloquei essa mensagem &quot;Falha/Erro...&quot; pois não sabia
                                                qual selecionar.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32177" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32177 </strong>Não consigo adicionar justificativa de ausência
                                                no ponto eletrônico/SIGPRH do mês de julho de 2022. Dois dias ficaram
                                                abertos, sem o devido registro de ponto relativo à carga horária de
                                                trabalho...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32172" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32172 </strong>Olá, no sistema Selest, para próxima seleção do
                                                PSEI - GERAL, que ocorrerá em breve, solicito a viabilidade de
                                                parametrização de uma nova etapa na qual o candidato poderá editar
                                                SOMENTE dados ...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32154" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32154 </strong>A Divisão de Alimentação e Nutrição gostaria que
                                                o/a aluno/a quando fosse matriculado na Unilab, no momento que fizesse o
                                                cadastro no Sigaa, recebesse um e-mail automático com informações
                                                sobr...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32126" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32126 </strong>Sobre o sistema selest, Como explanado no
                                                chamado #31964, existe um fluxo de ocorrência incompleto chamado
                                                &quot;Deferir o histórico imediatamente&quot; que está gerando áreas de
                                                conhecimento vazi...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32030" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32030 </strong>Caros, conforme a Resolução Complementar
                                                CONSEPE/UNILAB nº 2, de 16 de julho de 2021, somente poderão ser
                                                computadas para integralizar a carga horária semanal docente as
                                                atividades de extensão q...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31999" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31999 </strong>Prezados,
                                                Considerando o cronograma de coleta de dados para o Censo da Educação
                                                Superior, ano de referência 2022 (Conforme Portaria MEC/INEP nº
                                                525/2022, de 29/11/2022, retificada pela Portaria ...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31998" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31998 </strong>Prezados,
                                                Considerando o cronograma de coleta de dados para o Censo da Educação
                                                Superior, ano de referência 2022 (Conforme Portaria MEC/INEP nº
                                                525/2022, de 29/11/2022, retificada pela Portaria ...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31964" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31964 </strong>Bom dia, sobre o processo seletivo de Medicina
                                                no Selest, foi notado para os países Angola e Guiné-Bissau (todos os
                                                semestres) que vários candidatos estão com inscrição Deferida, mas não
                                                possue...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31881" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31881 </strong>Erro no módulo de Extensão no acesso de
                                                Editar/Enviar Relatórios de ações de extensão. Os docentes dão inicio ao
                                                cadastramento de relatórios (parcial ou final) e após salvarem para
                                                edição p...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31865" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31865 </strong>Senhores,

                                                Ao acessar o sistema de distribuição de salas na graduação o sistema
                                                apresenta comportamento inesperado, conforme arquivo anexo.

                                                Att,
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31862" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31862 </strong>SISTEMA CATRACA
                                                Criar funcionalidade para controle do acesso de alunos internacionais
                                                recém-chegados internacionais que não possuem matrícula e que têm
                                                direito a acesso gratuito no RU.
                                                Este con...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31847" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31847 </strong>Bug em duplicação de deferimento de auxílio
                                                estudantil. No Sisitema de Assistencia Estudant, módulo, a discente está
                                                cadastrada apenas no Social, quando emitimos relatório de deferidos
                                                aparecem ...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31818" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31818 </strong>Caros(as),

                                                O calendário específico do curso de Adm. Pública EAD 2023.1 está
                                                cadastrado e vigente no SIGAA, mas a Coordenação do curso e todos os
                                                procedimentos efetuados não conseguem &quot;l...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31712" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31712 </strong>Prezados, solicitamos que o título do TCC dos
                                                discentes abaixo seja modificado no sigaa. Foi feita uma solicitação no
                                                dia 25 de julho de 2022, 3s N. 29596, porém o problema ainda não foi
                                                resolvid...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31704" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31704 </strong>O estudante HABINA LUÍS NHANQUE - matrícula
                                                2021202594 - não está conseguindo registrar sua frequência no SIGAA na
                                                parte de &quot;Pesquisa&quot; - &quot;Plano de Trabalho&quot; -
                                                &quot;Minhas Fre...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31656" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31656 </strong>Com o intuito de melhorar o acompanhamento das
                                                ocorrências registradas via 3S, bem como a elaboração de relatórios mais
                                                específicos, solicitamos que seja implementado um filtro de busca por
                                                usuá...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31654" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31654 </strong>Temos encontrado algumas dificuldades no que diz
                                                respeito a movimentação das ocorrências registradas. Por exemplo:
                                                ocorrêcias encaminhadas para outros setores que não são
                                                &quot;visualizadas&quot...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31623" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31623 </strong>Demanda de Aperfeiçoamento do SAE ( Projeto
                                                Auxílios)
                                                Solicito, por gentileza, que seja realizado o ajuste no módulo de
                                                assistência estudantil na tela do discente, o qual ele possa
                                                alterar/inclui...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31591" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31591 </strong>O site do Unicaffe está apresentando falhas de
                                                comunicação com as máquinas. Por exemplo, ao enviar o comando para
                                                desligar, os computadores desligam, porém no site continua mostrando
                                                como ativas....
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31575" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31575 </strong>Solicito que seja realizado o procedimento de
                                                encerramento de vinculo de chefias/vice sempre que houver o encerramento
                                                de uma unidade no sigrh.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31539" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31539 </strong>[Vários bolsistas listados para docente validar
                                                frequência] Prezados, a professora entrou em contato conosco a fim de
                                                entender o motivo de estarem aparecendo várias frequência para ela
                                                analisar/ho...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31519" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31519 </strong>Prezados,

                                                Solicitamos a disponibilização de um Tablet para o Gabinete da Reitoria.

                                                Obs: utilizou-se o serviço &quot;solicitar computador&quot; pois não
                                                encontramos algo similar a pedido de t...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31507" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31507 </strong>Prezado(a)s,

                                                No momento temos seis pedidos de materiais de almoxarifado que não podem
                                                ser atendidos devido a um erro no saldo do item 3026000002856, conforme
                                                print anexado ao este chamado.

                                                Soli...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31431" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31431 </strong>Não está aparecendo as opções de seleção de
                                                ocorrencias funcionais no SigRH, aba Cadastro.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30941" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30941 </strong>Prezados, boa tarde

                                                Sou Prof. Sabi, coordenador do projeto de extensão Engenharia na
                                                Sociedade. Nesse projeto desenvolvemos a plataforma web denominada
                                                UnilabTem com endereço eletrônico unilabte...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30923" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30923 </strong>Prezados,

                                                Venho por meio desse chamado solicitar com urgência a seguinte
                                                verificação de busca de relatórios no SIGAA. O coordenador do curso de
                                                Bacharelado em Humanidades solicitou um relatór...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30904" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30904 </strong>Solicita-se um computador para substituir o PC
                                                que foi entregue no Polo de Catu-Ba, pois, de acordo com o laudo em
                                                anexo, o equipamento chegou ao destino com defeito. Tombamento
                                                patrimonial: 289152.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30886" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30886 </strong>Prezados(as), hoje se inicia o processo seletivo
                                                do curso de medicina, realizado a partir de uma cópia do Selest
                                                (http://selest.unilab.edu.br), no servidor .55
                                                (http://selestmedicina.unilab.edu.br). ...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30767" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30767 </strong>No módulo de pesquisa, a substituição dos
                                                bolsistas não deve afetar as frequências enviadas pelo bolsista
                                                anterior. Atualmente, ao haver a troca dos alunos, as frequencias já
                                                enviadas são &quot...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30524" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30524 </strong>Quando acesso o sistema de ponto eletrônico
                                                aparece 2 lotações cadastradas divisão de fiscalização (DIFI) e seção de
                                                apoio e manutenção (SAM) .
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30476" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30476 </strong>Prezados(as), bom dia!!

                                                O Gabinete Propae necessita de relatório do sigaa com o número de alunos
                                                matriculados /ativos na modalidade EAD, com a descrição abaixo:

                                                Nome/CPF/Curso/Ano de Entrad...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30475" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30475 </strong>Prezados(as), bom dia!!

                                                O Gabinete Propae necessita de relatório do sigaa com o número de alunos
                                                matriculados /ativos na modalidade presencial, com a descrição abaixo:

                                                Nome/CPF/Curso/Ano de...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30266" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30266 </strong>Prezado,
                                                No dia 18/03/2022 abrimos um chamado n. 27406 solicitando auxílio para
                                                sanar alguns problemas que estávamos identificando acerca da migração de
                                                dados do SigaA para o pergamum. Nesse proc...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30219" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30219 </strong>Devido a falta de informações na solicitação de
                                                exclusão de turmas, duas turmas já concluídas foram excluídas
                                                indevidamente. Diante disso, solicitamos o estorno da exclusão das duas
                                                turmas do...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30215" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30215 </strong>1 (UM) NOTEBOOK PARA O GABINETE DA PROPAE E 1
                                                (UM) NOTEBOOK PARA O NÚCLEO DE ATENDIMENTO SOCIAL AO ESTUDANTE (NAE)
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=30159" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#30159 </strong>Solicito a exclusão da permissão de acesso ao
                                                CGSEI no SIP. Mantendo a permissão pela PROADI.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29861" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29861 </strong>Solicito um notebook para a SGIT. Motivo: temos
                                                muitas demandas de reuniões por videoconferência e não temos recursos.
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29830" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29830 </strong>Prezado (a),

                                                Estamos com um atendimento aberto no pergamum acerca de um relatório que
                                                não estamos conseguindo emitir. Solicitamos os dados de acesso remoto
                                                para que Julierme (Analista do pergamum...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29144" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29144 </strong>Prezados(as)
                                                Objetivando levantamento de dados para a elaboração do bloco do PDI -
                                                PERFIL DO CORPO DISCENTE E POLÍTICAS DE ATENDIMENTO AOS DISCENTES,
                                                solicitamos relatórios dos pontos a seguir:
                                                ...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29084" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29084 </strong>SAE/SIGAA - Inserir texto com procedimento de
                                                retificação das REPROVAÇÕES POR FALTA no e-mail automático emitido pelo
                                                SIGAA , conforme anexo.
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29082" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29082 </strong>SAE/SIGAA - Solicita-se a inclusão da
                                                funcionalidade exclusão automática de discentes com carga horária zero,
                                                bem como a emissão de relatório de discentes com carga horária zero no
                                                período let...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29081" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29081 </strong>SAE/SIGAA - Emissão de &quot;relatório previsão
                                                de término de bolsista&quot;: Alterar nome para &quot;Previsão de
                                                expiração do Tempo de Permanência&quot;. OBS: A funcionalidade não está
                                                gera...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29080" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29080 </strong>SAE/SIGAA - Solicita-se que o sistema possa
                                                enviar notificação automática de expiração do tempo de permanência com
                                                um semestre de antecedência.
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29079" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29079 </strong>SAE/SIGAA - Funcionalidade &quot;Prorrogar Tempo
                                                de Permanência&quot;: O sistema deve permitir o avanço para inserir
                                                tempo de permanência adicional para o discente que já tem tempo de
                                                permanênci...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29078" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29078 </strong>SAE/SIGAA- Funcionalidade &quot;Prorrogar Tempo
                                                de Permanência&quot; na tela: Listar estudantes por semestre de
                                                expiração com caixa marcadora ao lado, de forma a possibilitar a
                                                prorrogação em lot...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29077" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29077 </strong>SAE/SIGAA - Funcionalidade &quot;Reativar
                                                auxílio de bolsista&quot;: Inserir a opção de busca por CPF do discente.
                                                OBS: A funcionalidade não apresentou opção de avanço para conclusão da
                                                ação...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29076" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29076 </strong>SAE/SIGAA - Solicita-se inserir um campo para
                                                registro de ocorrências quando for executado procedimentos de
                                                finalização de bolsa, reativação de bolsa e prorrogação do tempo de
                                                permanência no c...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29075" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29075 </strong>SAE/SIGAA - Funcionalidade &quot;finalizar
                                                cadastro de bolsista no SIPAC&quot;: Inserir a opção de busca por CPF do
                                                discente.
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=29071" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#29071 </strong>SAE/SIGA - Solicita-se que, após incluída a
                                                funcionalidade solicitada no Chamado 28791, a inclusão do termo de
                                                compromisso no SAE deve automatizar a funcionalidade de &quot;homologar
                                                bolsista no SI...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=28792" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#28792 </strong>PRezados/as, boa tarde. Solicito que seja
                                                cadastrado no SAE funcionalidade para recebimento de recursos. Sistema
                                                deverá receber a interposição de recursos do/a candidato/a, também
                                                deverá impedir...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=28791" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#28791 </strong>PRezados/as, boa tarde. Solicitamos que seja
                                                incluído no SAE uma funcionalidade que possamos cadastrar um termo de
                                                compromisso para que o discente possa realizar a adesão nos dias
                                                estabelecidos em c...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=28790" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#28790 </strong>Prezados, solicitamos que seja ajustado a função
                                                de calendários/períodos do SAE. Quando é necessário prorrogar as
                                                inscrições, a retificação do calendário é feita alterando um auxílio
                                                cada...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=28636" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#28636 </strong>Prezado(a),

                                                Temos uma aluna que se chama: Ivina Lorena Moreira, CPF: 081.773.343-44.
                                                Essa mesma aluna os dados dele estão no pergamum, porém quando vamos
                                                buscar na tela de cadastro pelo CPF o sis...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=27533" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#27533 </strong>Cadastro de Grupo de Eleitores no SigEleição
                                                para eleição de representantes docentes no Conselho de Unidade Acadêmica
                                                do Instituto de Humanidades para o período 2022-2025. O grupo pode ser
                                                criad...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=27190" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#27190 </strong>solicitação de 15 (quinze) computadores novos
                                                para o Instituto de Educação a Distância, sendo que os computadores
                                                antigos das unidades administrativas do IEAD serão substituídos pelos
                                                novos, e ...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=27048" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#27048 </strong>Prezados/as, boa tarde.

                                                Solicito, por gentileza, que seja visto a possibilidade de
                                                aperfeiçoamento/ajuste da edição do quadro de composição familiar. A
                                                funcionalidade deve ser editável para ...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=27047" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#27047 </strong>Prezados/as, boa tarde.

                                                Solicito, por gentileza, que fosse visto a possibilidade de
                                                ajuste/criação de um campo na tela de análise do profissional na
                                                funcionalidade “buscar bolsa auxílio” pa...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=27000" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#27000 </strong>Mediante a aprovação do Projeto de Pesquisa (em
                                                anexo) no edital nº 05/2021 - FUNCAP que possui o objetivo de avaliar o
                                                impacto da pandemia na saúde do estudantes do ensino superior da UNILAB
                                                (tod...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=26981" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#26981 </strong>Prezados/as, boa tarde!
                                                Gostaríamos de verificar a possibilidade de solicitação de novo notebook
                                                para o Instituto de Humanidades. Considerando que trata-se da
                                                substituição do anterior, a saber ...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=26948" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#26948 </strong>Prezados e Prezadas, seria possível emitir um
                                                relatório contendo os emails ativos dos discentes do Ceará divididos por
                                                curso?
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=26689" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#26689 </strong>O discente : João Batista Pereira dos Santos
                                                Filho, CPF: 063.432.423-33, informou que o tablet não está ligando, nem
                                                respondendo quando coloca para carregar. IMEI: 356112082885602
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=26495" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#26495 </strong>Prezados, solicitamos a possibilidade de
                                                cerificação, pelo sigaa, para os avaliadores (Membros da Capeac e ad
                                                hoc) e Pedimos que seja verificado a possibilidade do docente externo à
                                                Unilab atuar co...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=26330" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#26330 </strong>O discente discente: Sebastião Sacalui Paulo
                                                Alves, CPF: 098.696.421-28, informou que o touch screen ficou falhando e
                                                não estava funcionando. IMEI: 358679082003293
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=26047" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#26047 </strong> A discente discente: Delce Costa Barros Cá,
                                                CPF: 614.903.983-84, informou que o aparelho está com problemas na tela.

                                                IMEI: 356112082884266/ 356112082884274
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=25974" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#25974 </strong>Prezados, solicitei à PROEX desligamento à
                                                pedido do aluno bolsista, conforme abaixo, porém a solicitação do aluno
                                                ocorreu em 05/10 e precisamos estabelecer a data no SIGAA de 30/09 para
                                                que o me...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=25479" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#25479 </strong>Para fins de atendimento a Resolução CNE/CES N°
                                                7, de 18 de dezembro de 2018, solicitamos ajuste nos certificados e
                                                declarações (Programas, projetos, eventos, prestação de serviço e
                                                cursos) e ...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=24913" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#24913 </strong>Prezados,

                                                Algumas empresas entraram em contato informando que não estão
                                                conseguindo visualizar o comprovante do IRRF 2020 no site da unilab:

                                                http://proad.unilab.edu.br/coord/cofin/comprovante...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=23303" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#23303 </strong>Verificar por que a consulta em anexo não
                                                retorna as matrículas da EAD de 2020.2.
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=23248" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#23248 </strong>Prezado Gerente da Divisão de Sistemas da
                                                Informação,

                                                O processo SEI Nº 23282.404549/2020-16 refere-se à Contratação de
                                                Solução de TIC originada pela INC189 - Licença para Banco de Dados,...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=23246" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#23246 </strong>Investigar o uso de memória dos servidores no
                                                qual estão hospedados os bancos de dados do SIG.

                                                O uso de memória RAM e Cache está alto, necessitando verificar se está
                                                dentro dos padrões do SI...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=23215" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#23215 </strong>Prezados e Prezadas, tendo em vista o último
                                                edital (08/2020) de ingresso de discentes da graduação, denominado -
                                                SISURE/REMANESCENTES/QUILOMBOLAS OU INDÍGENAS, solicitamos que a DSI
                                                implemente, ...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=23001" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#23001 </strong>Quando uma alienação é cadastrada, é registrado
                                                o valor bruto dela, gerando inconsistência no RMB Sintético. Para
                                                corrigir esse erro, é necessário subtrair o valor da depreciação
                                                acumulada d...
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" id="panel1">
                                <div class="panel-heading">
                                    <h3 class="pb-4 mb-4 font-italic border-bottom" data-toggle="collapse"
                                        data-target="#collapseAberto" href="#collapseAberto">
                                        Ocorrências Em Aberto(18)

                                        <button type="button"
                                            class="float-right btn ml-3
                btn-warning btn-circle btn-lg"
                                            data-toggle="collapse" href="#collapseAberto" role="button"
                                            aria-expanded="false" aria-controls="collapseAberto"><i
                                                class="fa fa-expand icone-maior"></i></button>
                                    </h3>

                                </div>
                                <div id="collapseAberto" class="panel-collapse collapse in show">
                                    <div class="panel-body">


                                        <div id=easyPaginatecollapseAberto class="alert-group">

                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33621" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33621 </strong>Durante o jantar, o computador voltou a
                                                apresentar o mesmo problema do chamado de n° 33607. Desta vez, solicito
                                                uma ação da DTI diferente do que vem sendo feita, pois está sendo só
                                                paliativo. Ass...
                                            </div>


                                            <div class="alert  alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33620" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33620 </strong>Solicito o técnico a analise das maquinas da
                                                direção do ILL, que estão apresentando erros quando logamos na máquina.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33618" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33618 </strong>Prezados, boa tarde. Solicitamos acesso ao
                                                módulo de assistência ao estudante do SIGAA à servidora Gloria Kalina
                                                Moreira Rosa da COEST/PROPAE. ATENÇÃO: A ABA 'BUSCAR BOLSA AUXÍLIO' NÃO
                                                DEVERÁ ...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33614" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33614 </strong>Reinstalação do programa Office no computador da
                                                Vice-reitora.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33611" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33611 </strong>Permissão de acesso ao módulo
                                                &quot;Graduação&quot; no SIGAA.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33610" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33610 </strong>Cadastrei minhas férias no sougov e elas já
                                                foram homologadas pela minha chefia. Só que elas não aparecem no sigrh.
                                                Tinha aberto uma ocorrência e falaram que a sincronização é feita pelos
                                                sist...
                                            </div>


                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33609" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33609 </strong>Solicitamos a reposição de toner para a
                                                impressora colorida 3256
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33606" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33606 </strong>Solicito a instalação de um dispositivo na
                                                Máquina de tombo n° 2014000106.
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33598" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33598 </strong>[Erro de carga horária e envio de frequência]
                                                Prezados(as), a aluna HABINA LUÍS NHANQUE, bolsista Pibic/Fapesb no
                                                Edital Proppg 02/2022, orientanda da Professora ELIZIA CRISTINA FERREIRA
                                                nos enviou...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33591" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33591 </strong>Prezados, estou substituindo atualmente o chefe
                                                da Secragi, Francisco Savio, e estou precisando que a servidora Afra
                                                Sampaio, chefe do Registro Academico, tenha acesso a concessão de
                                                permissões pelo...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33590" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33590 </strong>Para atender uma demanda do Pró-reitor de
                                                Graduação, precisamos, com certa urgência, de uma planilha com os
                                                seguintes dados:

                                                &gt; Nº de Matrícula;
                                                &gt; Nome do estudante;
                                                &gt; Curso (Qual o...
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33589" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33589 </strong>Prezados, bom dia. Solicitamos acesso ao módulo
                                                de assistência ao estudante do SIGAA ao servidor Joab Venâncio do NIDAE.
                                                ATENÇÃO: A ABA 'BUSCAR BOLSA AUXÍLIO' NÃO DEVERÁ SER LIBERADA AO
                                                SERVID...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33580" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33580 </strong>Solicitamos o laudo técnico dos equipamentos
                                                citados a baixo, para que possamos devolver ao setor patrimonial. 01
                                                computador (2013004513), 1- Monitor (DELL). 01-Teclado (DELL).
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33579" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33579 </strong>Solicitamos o laudo técnico dos equipamentos
                                                citados a baixo, para que possamos devolver ao setor patrimonial. 01
                                                computador (290146), 1- Monitor 14 polegadas (DELL). 01-Teclado (DELL).
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33552" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33552 </strong>Prezadxs colegas,
                                                Estou com um problema na configuração do SIGAA, e ficarei grato caso
                                                vocês consigam me ajudar.
                                                Este problema ocorreu em mais de um computador (da Unilab e de casa), e
                                                em mais d...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33251" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33251 </strong>Gostaria de solicitar acesso ao banco do
                                                ambiente teste com Host: 10.129.19.128 (ou 200.129.19.132) meu ip é
                                                10.17.0.127
                                            </div>


                                            <div class="alert alert-warning alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33173" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33173 </strong>Adicionar a todos os usuários da UNILAB os
                                                atirbutos sambaNTPassword: &quot;HASH NTPASSWORD mschap &quot;,
                                                objectClass: sambaSamAccount, sambaSID:&quot;ID do usuário SIG&quot; no
                                                banco LDAP CAFE (20...
                                            </div>


                                            <div class="alert alert-info alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=31355" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#31355 </strong>Preparar o Plano Anual de Contratação de
                                                Soluções TIC para 2023.
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" id="panel1">
                                <div class="panel-heading">
                                    <h3 class="pb-4 mb-4 font-italic border-bottom" data-toggle="collapse"
                                        data-target="#collapseEncerrada" href="#collapseEncerrada">
                                        Ocorrências Encerradas

                                        <button type="button"
                                            class="float-right btn ml-3
                btn-warning btn-circle btn-lg"
                                            data-toggle="collapse" href="#collapseEncerrada" role="button"
                                            aria-expanded="false" aria-controls="collapseEncerrada"><i
                                                class="fa fa-expand icone-maior"></i></button>
                                    </h3>

                                </div>
                                <div id="collapseEncerrada" class="panel-collapse collapse in ">
                                    <div class="panel-body">


                                        <div id=easyPaginatecollapseEncerrada class="alert-group">

                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33619" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33619 </strong>solicito o reset da senha do seguinte Login:
                                                monalisa.ferreira
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33617" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33617 </strong>Nome: Rebeca Pereira
                                                Setor: Núcleo de Línguas
                                                Função: Bolsista
                                                Data de Término: 14/03/2024
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33616" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33616 </strong>Máquina não aceita logar
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33613" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33613 </strong>Prezados, solicitamos criação de dois e-mails
                                                institucionais: jornalismo.drive@unilab.edu.br e o
                                                publicidade.drive@unilab.edu.br para uso estrito dos servidores dessas
                                                áreas.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33612" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33612 </strong>Login local para uso compartilhado

                                                Login: usobiblio
                                                Senha: bibliouso
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33608" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33608 </strong>Acesso ao computador pelo estagiário Carlos
                                                Daniel Lima da Silva
                                                NET\Carlos.Silva, até o dia 31/12/2023
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33607" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33607 </strong>Computador estava com a tela desconfigurando,
                                                quando desligado não ligou mais.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33605" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33605 </strong>Olá, bom dia.

                                                Eu esqueci a senha do meu acesso ao p.c da Unilab. Preciso de
                                                orientações quanto a redefinição da senha.

                                                Att,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33604" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33604 </strong>O bolsista Carlos Daniel Lima da Silva bloqueou
                                                o computador, e ao tentar acessar novamente não conseguiu.
                                                Aparece a seguinte mensagem: &quot;A conta do usuário expirou&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33603" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33603 </strong>Após formatação do computador nº 201400130,
                                                solicita-se a configuração do aparelho à impressora Brother MFC 8890DW
                                                (001917)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33602" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33602 </strong>Prezados, bom dia!
                                                Solicito uma nova senha para a estagiária Ana Letícia da Silva Alves,
                                                pois a dela encontra-se expirada. Obrigada!
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33601" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33601 </strong>computador nº 2014000118 não está funcionando,
                                                por gentileza, realizar manutenção e, caso necessário, realizar um
                                                upgrade.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33600" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33600 </strong> computador nº 201400130 não está funcionando,
                                                por gentileza, realizar manutenção e, caso necessário, realizar um
                                                upgrade.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33599" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33599 </strong>não estou conseguindo abrir novamente o sigaa.
                                                preciso enviar com urgência comunicado aos estudantes.
                                                aparece a seguinte mensagem:
                                                Desculpe, comportamento inesperado!

                                                Caro Usuário,

                                                Desculp...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33597" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33597 </strong>Conceder acesso à estagiária Isabel Sebastião
                                                Sacabeto, que teve seu vínculo de estágio prorrogado, conforme anexo do
                                                SIGEPE.
                                                SIAPE: 3294705
                                                E-mail: isabel.sacabeto@unilab.edu.br
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33596" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33596 </strong>O acesso aos computadores da estagiária
                                                &quot;Ana Gabrielly Morais Silva&quot; está com problema.
                                                Ao inserir o login e senha aparece a seguinte mensagem &quot;A conta do
                                                usuário expirou&quot; e a ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33595" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33595 </strong>Não consigo encontrar no meu computador diz que
                                                a conta expirou
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33594" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33594 </strong>Não consigo conectar a rede EDUROAM no celular.
                                                Estava funcionando bem desde ontem, mas hoje não funciona. Agradeceria
                                                se pudesse me dizer como resolver, pode ser pelo chat mesmo
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33593" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33593 </strong>Não estou conseguindo acesso à rede Wi-Fi da
                                                universidade. Precisei mudar minha senha no Sigaa e depois disso não
                                                consegui mais acessar à rede nem pelo notebook e nem pelo celular.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33592" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33592 </strong>Verificação, se necessário formatar, notebook
                                                Acer.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33588" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33588 </strong>Bom dia,

                                                Solicito a disponibilização de um toner, que é necessário para a rotina
                                                de trabalho desta coordenação, Coordenação de Políticas Estudantis
                                                -Coest/Propae.

                                                Maquina: Brother MFC-8...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33587" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33587 </strong>Conectar impressora ao pc.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33585" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33585 </strong>Acesso para HERIVELTON ALVES DE OLIVEIRA, Siape:
                                                1282480, E-mail: herivelton@unilab.edu.br
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33583" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33583 </strong>Telefone não está recebendo chamadas nem
                                                realizando, porém ele dá sinal de linha. Esse fato já tem um mês.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33582" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33582 </strong>Redefinição de senha de conta para acesso ao pc
                                                (estagiário).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33581" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33581 </strong>Prezados/as, Solicitamos a criação de e-mail
                                                institucional para a nova colaboradora Lourena Silva César,
                                                lourenasil@gmail.com (e-mail pessoal). Abrimos chamado 33446, porém a
                                                colaboradora diz ñ t...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33578" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33578 </strong>&quot;dispositivo ocupado não pode ativar
                                                suspensão de procedimento&quot;
                                                Não reinicia para executar impressão
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33577" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33577 </strong>Solicitamos acesso de computador de usuário pra
                                                poder imprimir (foi mudada a impressora e nem todos estão conseguindo
                                                imprimir)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33573" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33573 </strong>Impressora com o tonner de tinta finalizando.
                                                Impressões bem fracas. Requisitamos a troca do referido.

                                                Secretarias Do Serviço Acadêmico - IDR e Coordenções de cursos -IDR
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33572" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33572 </strong>Colaborador trocou de aparelho celular e não tem
                                                mais acesso à rede wi-fi. Nome: Silvia Helena de Vasconcelos CPF:
                                                00749401397 E-mail: silviaahelenaa45@gmail.com Data de nascimento:
                                                23/08/1984
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33571" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33571 </strong>instalação do módulo de segurança BB
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33569" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33569 </strong>Computador não consegue acessar a internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33568" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33568 </strong>Solicito configurar a impressora da CPPD
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33567" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33567 </strong>Não estou conseguindo logar no computador, após
                                                formatação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33566" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33566 </strong>Troca de tonner impressora
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33565" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33565 </strong>O bloco A do campus das Auroras está sem
                                                internet, precisaremos corrigir o mais rapido possivel para realizar um
                                                sorteio de pontos de concurso via google meet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33564" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33564 </strong>Centro Cultural encontra-se sem conexão de
                                                Internet.
                                                Hoje às 9h acontece a mesa de abertura da Semana da África
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33563" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33563 </strong>Ru de Auroras sem conectividade a rede.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33562" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33562 </strong>Bom dia, prezados, ontem o CAIS esteve sem
                                                fornecimento de energia elétrica. Ao final da tarde, a energia voltou,
                                                mas ainda precisamos que seja feita a recuperação do acesso à Internet.
                                                Obrigada.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33561" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33561 </strong>Para cadastro no SigEleição, solicitamos
                                                verificação dos dados de docentes, discentes e TAES no que se refere ao
                                                correta vinculação com SIAPE e número de matrícula.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33560" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33560 </strong>Telefones Voip: 6134 - Não está realizando
                                                ligações externas., foi tentado ligar várias vezes , o número dá um bip
                                                e para e as fica chamando e não atende. Ligações com DDD (51, 11 e 85)
                                                T...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33559" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33559 </strong>Problema para fazer login na maquina
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33558" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33558 </strong>Problema para fazer login na maquina
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33556" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33556 </strong>Boa tarde, Pedimos a verificação da rede no
                                                campus dos palmares, prédio 3. O bloco encontra-se sem internet sendo
                                                que o bloco 2 tem internet. A internet faltou nesse bloco como se alguém
                                                tenha des...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33554" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33554 </strong>Instalar Zoom
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33553" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33553 </strong> Prezada Equipe, para este novo chamado,
                                                considerando a finalização da fase inicial do PGD/UNILAB, necessitamos
                                                de informações para relatório do PGD, gostaríamos de saber se seria
                                                possível os d...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33550" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33550 </strong>Instalar software livre PDFSAM
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33549" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33549 </strong>Equipamento liga, porém após alguns minutos de
                                                uso, ele desliga e não consegue reiniciar. A tela fica azul, sem comando
                                                nenhum.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33548" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33548 </strong>Solicito gentilmente acesso aos computadores
                                                institucionais da Unilab ao servidor Marcelo Lucas Araújo, ocupante do
                                                cargo Técnico em Assuntos Educacionais, lotado na Coordenação de
                                                Pós-Graduaçã...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33547" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33547 </strong>Prezada Equipe, a servidora Regiane Lisboa,
                                                solicita redefinição de senha ao computador, pois não lembra do login.

                                                At.te
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33546" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33546 </strong>Solicitação de verificação de falha na
                                                impressora, equipamento não imprime arquivos de nenhum dos computadores
                                                do setor.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33545" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33545 </strong>Liberação de rede wi-fi para Audiência Pública:
                                                Orçamento Participativo (DPGE/ARINS) em 24/05/2023.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33544" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33544 </strong>Divisão de Patrimônio encontrasse sem acesso a
                                                internet em seus computadores.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33542" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33542 </strong>Gostaria de acessar acesso a VPN.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33541" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33541 </strong>solicito instalação de monitor para realização
                                                de multitarefas administrativas, como inserção de dados em planilhas e
                                                analise de outros dados
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33540" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33540 </strong>Prezados, solicito alteração de dados cadastrais
                                                da aluna Maria Gildellyana Maia de Moura, a aluna não lembra a senha de
                                                acesso ao Sigaa e o email cadastrado não está mais ativo. Solicito a
                                                alter...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33538" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33538 </strong>Solicito configurar a impressora da sala da CEP
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33536" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33536 </strong>Solicito verificação da conexão entre o
                                                computador (patrimônio 2014005172) e a impressora, da Intesol, pois se
                                                encontra offline.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33535" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33535 </strong>Computador do Procurador Sr. Felipe, está dando
                                                erro na senha ao acessar o usuário. Sala da Procuradoria Jurídica.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33534" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33534 </strong>Colaborador trocou de aparelho celular e não tem
                                                mais acesso à rede wi-fi. Nome: José Robson Alves da Silva CPF:
                                                20006183832 E-mail: robson452023@gmail.com Data de nascimento:
                                                14/03/1978
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33533" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33533 </strong>Restauração dos ícones Firefox, Google Chrome e
                                                outros.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33530" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33530 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SIGAA_APP1_81)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33529" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33529 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SIGRH_APP2_99)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33528" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33528 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (nfs-docker)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33527" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33527 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (NEW_Portal_Unilab15)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33526" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33526 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SEI_SIP_02)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33525" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33525 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (revistas_62)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33524" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33524 </strong>Prezados/as,
                                                A Gestão do IH vem por meio desta,
                                                considerando o processo 23282.003892/2023-81 ,
                                                considerando a Anexo I da Resolução CONAD/UNILAB nº 01/2021, de 25 de
                                                outubro de 2021 (0649719),...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33523" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33523 </strong>Prezados/as,
                                                Solicitamos a retirada dos e-mails abaixo listados do grupo
                                                professoresih.
                                                São: adailton.souza@unilab.edu.br ,annesophiegosselin@unilab.edu.br
                                                ,carlos.henrique@unilab.edu.br ,fvasconce...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33522" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33522 </strong>solcitamos apoio tecnico para computador do
                                                centro cultural que não está ligando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33520" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33520 </strong>Solicito faixa de IPs instucional (da UNILAB
                                                Ceará e Bahia) para que uma base de dados acadêmica
                                                (https://karger.com/) libere o acesso da base para a comunidade da
                                                unilab.

                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33518" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33518 </strong>Prezado, boa tarde. A pedido da coordenação do
                                                BHU, solicito, por gentileza, a inclusão do e-mail:
                                                fatimasilveira@unilab.edu.br, nas listas de g-mail do Curso de
                                                Humanidades: professoresbhu@unilab....
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33517" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33517 </strong>Adicionar à lista dti-l os e-mail dos novos
                                                servidores da DTI:
                                                emanuelamascarenhas@unilab.edu.br;
                                                miltcn@unilab.edu.br;
                                                cristianolimas@unilab.edu.br;
                                                roberio.severino@unilab.edu.br;
                                                jackson.alen...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33515" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33515 </strong>Solicito a liberação para acesso institucional
                                                aos demais computadores da Intesol para o usuário
                                                &quot;antonio.alvaro&quot; (senha: intesol2023), uma vez que possui
                                                acesso a apenas um computador da...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33514" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33514 </strong>Prezados(as), bom dia.

                                                O diretor do ICSA, prof. José Weyne, está no gabinete e não está
                                                conseguindo ligar o computador na rede, solicita usuário e senha
                                                administrativo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33513" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33513 </strong>As impressoras não estão imprimindo com os
                                                computadores da Secretaria do IHL.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33512" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33512 </strong>Bom dia! Não estou conseguindo acessar os
                                                computadores; recebo a mensagem: &quot;Nome de usuário ou senha
                                                incorretos.&quot; Eu acredito que talvez eu não tenha anotado o usuário
                                                corretamente. Algu...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33511" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33511 </strong>Não estamos conseguindo imprimir. O aparelho
                                                liga, mas parece que os computadores estão desconectados dele.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33510" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33510 </strong>Na sala 308 Bloco B, o nobreak do PC do lado da
                                                janela externa da sala não está funcionando com normalidade, somente
                                                apita com sons intermitentes
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33508" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33508 </strong>A impressora não está conectando ao meu
                                                computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33507" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33507 </strong>Segundo a documentação
                                                http://dsiwiki.unilab.edu.br/doku.php?id=desenvolvimento:ambiente:desenvolvimento:spa:servidores_dominios
                                                no ambiente de teste antigo da SPA (.52), a URL para SSL seria https:...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33506" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33506 </strong>Apresentamos Relatório (Planilha EXCEL) com
                                                dados dos discentes beneficiários do Programa Bolsa Permanência (PBP)
                                                para análise e aprofundamento das questões que envolvem a permanência
                                                dos referi...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33505" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33505 </strong>[Retirar menu docente] Prezados(as), percebemos
                                                que alguns docentes estão realizando algumas substituições de bolsistas,
                                                de forma errada, sem obedecer o que sugere o edital. Atualmente, o
                                                edital ex...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33504" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33504 </strong>Conectar equipamento computacional institucional
                                                à internet (cabeada)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33500" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33500 </strong>Prezado (a),

                                                Solicitamos que seja reinicializado do servidor onde o sistema pergamum
                                                fica localizado. Informamos que estamos se acesso ao sistema.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33499" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33499 </strong>Instalar driver USB do Arduino e do ESP8266 no
                                                computador da bancada B-02 do Laboratório de Eletrônica Digital do IEDS
                                                (Sala 003, Bloco D, Térreo).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33498" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33498 </strong>Instalar driver USB do Arduino e do ESP8266 no
                                                computador da bancada B-04 do Laboratório de Eletrônica Digital do IEDS
                                                (Sala 003, Bloco D, Térreo).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33497" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33497 </strong>Instalar driver USB do Arduino e do ESP8266 no
                                                computador da bancada B-03 do Laboratório de Eletrônica Digital do IEDS
                                                (Sala 003, Bloco D, Térreo).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33496" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33496 </strong>Instalar driver USB do Arduino e do ESP8266 no
                                                computador da bancada B-06 do Laboratório de Eletrônica Digital do IEDS
                                                (Sala 003, Bloco D, Térreo).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33495" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33495 </strong>Instalar driver USB do Arduino e do ESP8266 no
                                                computador da bancada B-05 do Laboratório de Eletrônica Digital do IEDS
                                                (Sala 003, Bloco D, Térreo).
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33494" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33494 </strong>Instalar driver USB do Arduino e ESP8266 nos
                                                computadores (6 máquinas) do Laboratório de Eletrônica Digital do IEDS
                                                (Sala 003, Bloco D, Térreo).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33492" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33492 </strong>Criar o dominio jenkins-dev.unilab.edu.br apont
                                                ao ingress 10.130.2.17
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33491" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33491 </strong>Preciso que seja adicionados dois campos na view
                                                de informações dos usuários da base SIGAA:

                                                vw_usuarios_catraca

                                                id_unidade (Com o id da Unidade)
                                                sigla_unidade(Texto com o setor do usuário...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33488" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33488 </strong>Bom dia, preciso usar a VPN, por favor informar
                                                os procedimentos necessários.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33487" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33487 </strong>sistema está constantemente travando e fechando
                                                aplicativos em uso.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33485" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33485 </strong>Prezados, solicito acesso a API
                                                http://rapconector-homologacao.unilab.edu.br pelas portas 3000 e 3001
                                                através da VPN
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33484" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33484 </strong>Computador sem internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33483" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33483 </strong>Prezados, o erro que envio em anexo está
                                                ocorrendo para alguns professores externos, a exemplo do ANTENOR
                                                TEIXEIRA DE ALMEIDA JUNIOR. Eles não conseguem acessar o SIGAA mesmo com
                                                o acesso concedido ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33482" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33482 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (3S_PRODUC-134)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33481" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33481 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (DNS_PRIM_PRODUC-130)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33480" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33480 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (AVA IEAD)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33479" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33479 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SIG_Balanceador)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33478" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33478 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (banco_portaisdb10_160)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33477" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33477 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SEI-SORL)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33476" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33476 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (novoPortais133)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33475" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33475 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (PortalDTI)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33474" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33474 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SHIBOLETH-4)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33473" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33473 </strong>Laudo técnico para transferência de equipamento.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33472" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33472 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SEI-Balanceador)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33471" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33471 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SEi_REPOSITORIO)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33470" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33470 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SEI-JOD)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33469" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33469 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (DspaceProducao)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33468" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33468 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SIPAC_APP1-87)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33465" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33465 </strong>Boa tarde, prezados, solicito verificação de
                                                falha em telefone fixo da Sala Multiprofissional do CAIS. Att,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33464" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33464 </strong>Solicito atualização da wiki da DSI:
                                                http://dsiwiki.unilab.edu.br/
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33462" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33462 </strong>Impressão está saindo manchada
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33459" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33459 </strong>Prezadas/os,
                                                Solicitamos por gentileza um teclado e um mouse para executar as
                                                atividades rotineiras na Instituição. Tendo em vista que estes
                                                equipamentos estão apresentando defeitos que dificultam...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33457" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33457 </strong>Troca de toner da impressora localizada no
                                                laboratório de Biologia Geral, vinculada ao ICEN.

                                                O tombo do equipamento é 001799 e a referência da impressora: MFC
                                                8890DW.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33455" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33455 </strong>Os computadores do atendimento nos RUs não estão
                                                conseguindo acessar o sistema do catraca. Por favor, verificar a
                                                conexão.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33454" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33454 </strong>Prezados, estamos sem rede wifi e cabeada.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33453" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33453 </strong>Rede cabeada não está funcionando
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33452" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33452 </strong>Falta de conectividade em toda biblioteca de
                                                Palmares
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33451" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33451 </strong>Prezados,
                                                Solicitamos a lista do Grupo de e-mail Professores do IH
                                                ´´professoresih@unilab.edu.br´para atualização necessária.

                                                Cordialmente,
                                                Gestão do IH
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33450" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33450 </strong>Solicito a redefinição de senha de acesso ao
                                                computador da colaboradora Rita de Cássia de Andrade Cruz.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33449" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33449 </strong>Não consigo fazer loggin em nenhuma máquina.
                                                Impossibilitada de trabalhar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33448" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33448 </strong>Prezados/as, Solicitamos, por gentileza, acesso
                                                as máquinas do IH, para a nova colaboradora Lourena Silva César,
                                                lourenasil@gmail.com. Cordialmente, Gestão do IH
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33447" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33447 </strong> Prezados/as, Solicitamos, por gentileza, a
                                                criação de login para acesso ao sigaa para as coordenações de cursos do
                                                IH e posteriormente ao sistema SEI, para a nova colaboradora
                                                Lourena Silva Cé...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33446" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33446 </strong>Prezados/as, Solicitamos a criação de e-mail
                                                institucional para a nova colaboradora Lourena Silva César,
                                                lourenasil@gmail.com (e-mail pessoal).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33444" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33444 </strong>Prezado, boa tarde. A pedido da coordenação do
                                                BHU, solicito, por gentileza, a inclusão do e-mail:
                                                isabele.cristina@unilab.edu.br, na lista de g-mail do Curso de
                                                Humanidades: professoresbhu@unilab....
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33443" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33443 </strong>solicitamos o apoio técnico para sanar o
                                                problema do computador que não reconhece a impressora.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33442" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33442 </strong>Prezados, boa tarde!
                                                Necessitamos de laudo técnico de computador com o tombo, nº 2014000231,
                                                devido a situação de incêndio no equipamento.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33441" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33441 </strong>Solicito por gentileza, relatório completo do
                                                quantitativo em números de diplomas do STRICTO SENSU e certificados do
                                                LATO SENSU ,registrados no ano de 2022 e outro separado do ano de 2023.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33440" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33440 </strong>Formatação
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33439" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33439 </strong>Solicitação de login para computador da
                                                Secretaria da Coordenação de Antropologia e Pedagogia para a
                                                colaboradora Lourena Silva Cesar, que está substituindo o colaborador
                                                Adailton Àquile a parti...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33438" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33438 </strong>Sistema SEREMUS: Solicito relatório de todos os
                                                atendimentos realizados no sistema SEREMUS até hoje, por mês,
                                                profissional, se é primeira consulta, retorno.
                                                Também gostaria da caracterização ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33435" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33435 </strong>Prezados, bom dia! Solicitamos, por gentileza,
                                                permissão de acesso ao SIG para a funcionária da empresa Protemaxi
                                                Segurança Patrimonial Armada Eireli conforme dados abaixo. Tipo de
                                                usuário: Funcio...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33433" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33433 </strong>Teste do 3s
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33432" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33432 </strong>Por gentileza , solicito a mudança da
                                                nomenclatura do setor que foi trocada recentemente para SECRETARIA DE
                                                REGISTRO E ACADÊMICO,ARQUIVO E GESTÃO DA INFORMAÇÃO / SECRAGI, nos
                                                Certificados do Lato...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33431" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33431 </strong>Prezados,
                                                Solicitamos criação de login de acesso ao Sistema SIG para o novo
                                                colaborador terceirizado da Secom: Weverton Dantas de Oliveira.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33429" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33429 </strong>A partir de demanda apresentada pelo Professor
                                                Jairo Domingos de Morais (ICS) (jairo@unilab.edu.br) solicitamos a
                                                disponibilização de espaço no domínio da Unilab para abrigar site
                                                vinculado ao Pro...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33428" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33428 </strong>Para termos o funcionamento correto dos
                                                containers do 3s precisamos que os mesmos tenham acesso à base do SIGAA.
                                                O de produção acesse a base de produção do SIGAA e o de homologação
                                                acesse uma b...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33426" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33426 </strong>bom dia, solicito inclusão do novo colaborador
                                                da Secom Weverton Dantas de Oliveira (weverton@unilab.edu.br) na lista
                                                de e-mail da secom@unilab.edu.br.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33425" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33425 </strong>Colaborador trocou de aparelho celular e não tem
                                                mais acesso à rede wi-fi.

                                                Nome: Gislene Silva de Lima
                                                CPF: 56905068349
                                                E-mail: gislenesilva.unilab@gmail.com
                                                Data de nascimento: 07/02/1972
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33424" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33424 </strong>Prezados, solicito a remoção da professora
                                                CAMILA CHAVES DA COSTA da turma CCEN0039 - INTERNATO DE ENFERMAGEM I
                                                -UNIDADE HOSPITALAR. A professora informou que não está mais na
                                                disciplina, mas quan...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33423" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33423 </strong>Mais uma vez a Centro Cultural com problemas de
                                                conexão à Internet. Tem sido constante. Solicitamos verificação
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33422" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33422 </strong>Solicitamos senha de acesso ao computador da
                                                Unilab para novo colobarador da Secom. Weverton Dantas de Oliveira
                                                (weverton@unilab.edu.br)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33421" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33421 </strong>Prezados, solicitamos nos dias de 15 a 26 de
                                                maio de 2023 uma divulgação via SIGAA, com o cartaz em anexo, da
                                                informação de que a Divisão de Alimentação e Nutrição (DAN/Propae)
                                                convida os usu...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33420" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33420 </strong>O monitor está apresentando falha de
                                                funcionamente, conforme imagem anexada.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33419" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33419 </strong>Solicitamos a configuração do data show para
                                                realizar o treinamento. É urgente!
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33418" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33418 </strong>Instalação do PDF24
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33417" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33417 </strong>cadastro no sistema sisgef.
                                                Setor Responsavel: IEDS
                                                Responsavel: Maria Cristiane Martins de Souza
                                                Solicitante: Michele da silva vieira
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33416" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33416 </strong>Redefinição da senha para acesso ao computador.
                                                Do Servidor: Edson Silva de Almeida
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33414" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33414 </strong>Prezado Cícero, boa tarde.

                                                Solicito, por gentileza, que seja extraído do módulo de assistência ao
                                                estudante, os estudantes que preencheram o cadastro único e responderam
                                                &quot;sim&quot; para...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33412" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33412 </strong>Ao realizar o cadastro no SIGAA de banca de TCC
                                                e inserir um examinador externo na banca da TCC verifiquei que não tem
                                                na Instituição de ensino onde essa pessoa trabalha o Centec - Instituto
                                                Cent...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33410" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33410 </strong>Prezado/a boa tarde.

                                                Solicitamos, por gentileza, a verificação de um computador da
                                                coordenação que apresenta uma seguinte mensagem Falha na Relação de
                                                Confiança entre estação de trabalho....
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33409" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33409 </strong>Prezados/as da DTI,



                                                Fomos informados pela Profa. Luma Nogueira (email:
                                                luma.andrade@unilab.edu.br) a respeito do não recebimento dos e-mails
                                                enviados pelo Programa de Pós-Graduação em Ensi...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33408" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33408 </strong>Boa tarde. Solicito reparo no computador
                                                localizado no Laboratório de Eletrônica Digital. O computador liga o led
                                                de ligar, faz a inicialização informando o modelo, mas não inicializa o
                                                windows, ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33407" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33407 </strong>Considerando meu recente ingresso como servidor
                                                do quadro efetivo da UNILAB, solicito criação de uma conta para acesso
                                                aos domínios institucionais físicos (computadores em rede), tendo em
                                                vista a ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33405" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33405 </strong>Cadastro de acesso aos alunos (Acesso via
                                                Unicaffe) nos 5 computadores no laboratório de Eletrônica Digital. Os
                                                computadores estão conectados a rede wi-fi, e foi testada a
                                                conectividade hoje dia 11...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33404" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33404 </strong>Configuração em rede wi-fi em um computador que
                                                não está ativando o software de driver de wi-fi no Laboratório de
                                                Eletrônica Digital do Auroras.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33403" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33403 </strong>Solicito manutenção em 2 computadores que não
                                                estão ligando no laboratório de Eletrônica Digital.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33402" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33402 </strong>Computador modelo DELL não está ligando
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33401" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33401 </strong>Caros/as, bom dia!

                                                Solicito verificação no computador utilizado pela funcionária Fernanda
                                                Borba. Funcionou perfeitamente ontem e, hoje, ela não conseguiu ligá-lo
                                                para trabalhar.

                                                No aguardo...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33400" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33400 </strong>Solicitação de toner para impressora modelo
                                                MFC8890DW
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33398" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33398 </strong>Hoje liguei o PC e está aparecendo a tela em
                                                anexo, em formato de pop-up e sobrepondo as janelas. Eu fecho, mas
                                                reaparece. Favor verificar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33397" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33397 </strong>Cadastro de domínio para servidor.
                                                Nome: Edson Silva de Almeida Siape: 1220147
                                                Setor: Biblioteca Palmares
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33396" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33396 </strong>Peço a gentileza de me orientar quanto à criação
                                                de um email para o Grupo de Pesquisa no qual sou Coordenador - Luís
                                                Carlos Ferreira.
                                                O email sugerido é vozesdaejabrasilafrica@unilab.edu.br.
                                                D...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33395" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33395 </strong>Solicitação de acesso aos computadores da
                                                Unilab, para a estagiária da Coordenação de Projetos e Acompanhamento
                                                Curricular (CPAC/PROGRAD): Dionísia Cristóvão Francisco
                                                (dionisia@unilab.edu.br)...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33394" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33394 </strong>Atualizar o curso do paciente no banco do
                                                prontuário. Nº do prontuário: 496. Conforme solicitado no chamado 33111.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33393" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33393 </strong>Estabilizador (No Break) da estação de trabalho
                                                da funcionária Eline Ramos não está funcionando corretamente.
                                                Solicitamos a troca ou reparo. Atenciosamente.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33392" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33392 </strong>Prezado, sobre o cadastramento de bancas no
                                                SIGAA na parte de inserir um membro externo pede para inserir a
                                                Universidade a qual o Docente é vinculado, porém algumas Universidades
                                                não estão cadastr...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33391" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33391 </strong>CRIAÇÃO DE E-MAIL PARA A COMISSÃO DE LICITAÇÃO
                                                NO CAMPUS DOS MALÊS
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33390" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33390 </strong>SISTEMA SEREMUS. Solicitamos alteração na data
                                                de nascimento em dois prontuários do SEREMUS.
                                                Prontuário 305 - colocar data de nascimento: 07/09/2000
                                                Prontuário 385 - colocar data de nascimento:...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33389" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33389 </strong>Cadastro de domínio para servidor.

                                                Nome: Edson Silva de Almeida
                                                Siape: 1220147
                                                Setor: Biblioteca Palmares
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33387" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33387 </strong>Solicito que o colaborador da empresa Javé de
                                                nome Francisco Gilvan Gomes Costa, CPF: 02343973300 e data de nascimento
                                                05/03/1983 possa ter acesso ao wi-fi da Unilab pelo celular.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33386" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33386 </strong>Solicita-se uma retificação no verso dos
                                                diplomas do STRICTO SENSU, retirar o nome do setor antigo (Diretoria de
                                                Registro e Controle Acadêmico) pelo setor novo (Secretaria de Registro
                                                Acadêmico, A...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33385" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33385 </strong>Solicitamos apoio técnico com o intuito de sanar
                                                o problema do computador que reconhece o login e senha do usuário.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33384" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33384 </strong>Prezado, bom dia. A pedido da direção do IH,
                                                solicito, por gentileza, a exclusão do e-mail:
                                                carlos.henrique@unilab.edu.br, das listas de g-mail do Curso de
                                                Humanidades: professoresbhu@unilab.edu.b...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33381" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33381 </strong>para que possamos devolver ao setor patrimonial.
                                                1- Computador (290152);
                                                1-Monitor
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33379" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33379 </strong>Solicito verificar o computador da sala da CPPD.
                                                O monitor não está ligando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33378" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33378 </strong>Solicitação de 06 (seis) computadores para o
                                                Laboratório de Ciências dos Materiais (Auroras, bloco D, térreo)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33377" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33377 </strong>Prezados, solicito acesso ao VPN da Unilab para
                                                utilização da núvem institucional no trabalho remoto.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33376" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33376 </strong>Prezado (a),

                                                1. Solicitamos um novo computador, uma vez que o computador atualmente
                                                utilizado foi classificado como irrecuperável, conforme laudo, em anexo.

                                                Att.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33375" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33375 </strong>Solicitação de acesso aos computadores da
                                                Unilab, para a estagiária da Coordenação de Projetos e Acompanhamento
                                                Curricular (CPAC/PROGRAD): Dionísia Cristóvão Francisco
                                                (dionisia@unilab.edu.br)...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33374" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33374 </strong>Mais uma vez a Centro Cultural com problemas de
                                                conexão à Internet. Solicitamos verificação
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33373" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33373 </strong>Prezados(as),
                                                O pró-reitor não está conseguindo homologar as frequências da equipe no
                                                Sigrh. O Sistema não carrega as informações corretamente. Necessitamos
                                                então, de suporte e orientaçõe...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33372" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33372 </strong>Bom dia! Prezados, estamos sem Internet no CAIS.
                                                Atenciosamente,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33371" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33371 </strong>Prezadxs, o computador da colaboradora Fabiane
                                                França dos Santos não está conectando à internet. Favor verificar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33370" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33370 </strong>Ao logar no computador aparece o seguinte erro
                                                &quot;falha na relação de confiança entre o computador e o
                                                usuário&quot;, solicito correção.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33369" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33369 </strong>Solicitação de toner (MFC-8890DW)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33368" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33368 </strong>No termos do Artigo 98 da Lei nº 9.504/1997 que
                                                prevê o direito do(a) servidor(a) à dispensa do serviço pelo dobro dos
                                                dias de convocação pela justiça eleitoral, fiz registro de solicitação
                                                d...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33367" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33367 </strong>Solicito novo computador, tendo em vista o
                                                defeito na placa mãe do computador que utilizava anteriormente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33366" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33366 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SEI-BD_MASTER)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33365" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33365 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (baculaDir59)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33364" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33364 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SEI-SIP-01)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33363" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33363 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (proppgPy155)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33362" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33362 </strong>Prezado (a),

                                                1. Informamos que a Coordenadora não está conseguindo acessar o
                                                computador, mesmo inserindo a senha correta. Portanto, solicitamos a
                                                verificação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33361" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33361 </strong>Bom dia. O microfone e a câmera do meu
                                                computador não estão ativos ao participar de reuniões pelo meet.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33360" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33360 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SIGAA_APP2_82)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33359" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33359 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (EDUROAM_2022)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33358" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33358 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SIGRH_APP1_98)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33357" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33357 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (wazuh)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33356" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33356 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (_R_SMTP)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33355" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33355 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SIGAA_APP3_APP4_71)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33354" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33354 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (unicafe)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33353" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33353 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (LdapAcademico)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33352" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33352 </strong>Instalar impressora no meu computador
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33351" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33351 </strong>Manutenção de impressora (MFC-8890DW) que está
                                                sendo utilizada na impressão de provas do PSEI 2023 e parou de funcionar
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33350" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33350 </strong>Solicita-se extração do status SIGAA mais atual,
                                                em curso de GRADUAÇÃO PRESENCIAL, dos estudantes beneficiários do PAES
                                                listados no anexo. No caso de estudantes que não possuam status ATIVO ou
                                                F...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33349" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33349 </strong>Prezados,
                                                Solicitamos a verificação/instalação do acesso para impressão em um
                                                computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33348" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33348 </strong>Prezados,

                                                novamente o sistema Sigaa não abre pra mim. É a quarta vez que acontece
                                                em duas semanas.

                                                Aparece a seguinte mensagem&gt; &quot; Desculpe, o sistema se comportou
                                                de forma inesperada. ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33347" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33347 </strong>Instalar programas na minha máquina
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33346" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33346 </strong>Não consigo entrar no SIGAA. Todas as vezes que
                                                tento, sou redirecionada para uma página de aviso em que consta o alerta
                                                de &quot;comportamento inesperado&quot;.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33345" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33345 </strong>O sistema SIGAA encontra-se inoperante novamente
                                                em 09/05/2023 (turno matutino).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33344" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33344 </strong>Solicitamos o laudo técnico dos equipamentos
                                                citados a baixo, para que possamos devolver ao setor patrimonial.

                                                1- Computador (003889),
                                                1-Monitor DELL;
                                                1- Teclado HP;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33343" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33343 </strong>Solicitamos o laudo técnico dos equipamentos
                                                citados a baixo, para que possamos devolver ao setor patrimonial.

                                                1- Computador (290146),
                                                1-Monitor DELL;
                                                1- Teclado;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33341" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33341 </strong>O acompanhamento pedagógico solicita uma
                                                planilha estruturada, para ser enviada dos cursos (CE e BA), com o
                                                objetivo de tratar acerca da questão da oferta de disciplinas.
                                                A ideia é enviar um únic...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33339" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33339 </strong>Solicitou a instalação de impressora em
                                                computador da sala da secretaria da reitoria
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33338" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33338 </strong>Solicitou a instalação de impressora em
                                                computador da sala da secretaria da reitoria
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33337" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33337 </strong>Formatação do PC
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33336" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33336 </strong>Telefones não completam ligações.
                                                Ramais: 6181 e 6146
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33335" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33335 </strong>Instalação de impressora na rede.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33334" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33334 </strong>Gostaria de solicitar acesso ao banco de
                                                produção do Sistema de Seleção de Estrangeiros (SELEST).
                                                Meu IP: 10.17.0.68
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33333" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33333 </strong>Solicitamos o laudo técnico dos equipamentos
                                                citados a baixo, para que possamos devolver ao setor patrimonial.

                                                03- computadores (290146), (003889) e (2013004498);
                                                03- Monitores (DELL).

                                                01-Tec...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33332" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33332 </strong>Por gentileza, inserir um número de telefone
                                                fictício para o paciente de prontuário de número 779. Pode ser algo como
                                                85 85858585. (Relacionado ao chamado 32804)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33331" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33331 </strong>Solicitação de Toner para impressora Modelo MFC
                                                8890DW
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33330" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33330 </strong>Prezados, por gentileza, realizar instalação das
                                                impressoras para impressão das provas em outro computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33329" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33329 </strong>Prezados(as), por gentileza, solicitar visita
                                                técnica para verificação de duas impressoras instaladas na Prointer para
                                                impressão de provas, pois estão travando com mais frequência.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33328" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33328 </strong>Solicitação de toner para impressora modelo
                                                MFC-8890DW
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33327" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33327 </strong>Crítica sobre cadastro de justificativa, porém,
                                                a justificativa já foi enviada, mas não consta no cadastro.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33325" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33325 </strong>Conforme verificação, mouse não funciona,
                                                solicito a troca.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33324" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33324 </strong>Instalação de CPU após formatação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33323" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33323 </strong>Computador apresenta dificuldade para ligar e
                                                quando liga a hora aparece desatualizada. Provavelmente, a bateria
                                                esteja ruim.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33322" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33322 </strong>Informo que a servidora Rachel Fernandes
                                                (Usuário: rachel.oliveira) não está conseguindo acessar o equipamento
                                                computacional desde que foi solicitado alteração de senha. Solicito
                                                verificação do...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33321" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33321 </strong>O computador não liga. O estabilizador fica
                                                piscando, luz oscila entre vermelha e azul.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33320" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33320 </strong>O monitor ao ligar fica piscando uma luz
                                                vermelha como se fosse queimar e as letras ficam grande, falada e
                                                piscando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33319" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33319 </strong>Prezados,

                                                Solicitamos ajuda na solução do seguinte problema: passar a bolsa da
                                                professora Lídia Lima da Sílva - coordenadora do Projeto- Curso
                                                introdutório em línguas bantu (eixo 2), que desi...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33318" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33318 </strong>Solicitação de Toner, impressora modelo MFC8480
                                                - 001822
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33317" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33317 </strong>Tendo em vista a necessidade de readequar o
                                                leiaute da sala da Secretaria da Reitoria, solicitamos a instalação 4
                                                computadores na referida sala, se possível no período da tarde do dia
                                                08/05/2023
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33316" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33316 </strong>Computador não aceita login do usuário
                                                Falha na relação de confiança
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33314" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33314 </strong>o acesso a maquina informa falha na relação de
                                                confiança
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33313" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33313 </strong>Olá, Sobre sistema Selest - Solicito um ambiente
                                                de testes para realização de testes no módulo de redação (criação de
                                                propostas, associar redações a candidatos, cadastrar
                                                supervisor/avaliado...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33311" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33311 </strong>Prezados(as), por gentileza, solicitar visita
                                                técnica para verificação de duas impressoras instaladas na Prointer para
                                                impressão de provas: tombo 003086 e 2027.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33310" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33310 </strong>Computador não liga e apresenta um sinal sonoro
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33309" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33309 </strong>Solicitamos apoio técnico para configurar o
                                                áudio/som do computador que a colaboradora Ana Paula dos Santos Medeiros
                                                acessa.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33308" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33308 </strong>Instalar Token CPF em notebook da Reitoria.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33307" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33307 </strong>Ao tentar entrar no módulo Ponto Eletrônico no
                                                SIGRH o sistema deu o seguinte erro: O Endereço IP de seu computador '
                                                10.16.0.112 ' não tem autorização para registrar o Ponto Eletrônico. Em
                                                cas...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33306" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33306 </strong>Conectar o equipamento de impressão ao
                                                computador da sala do AFD/SGP
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33304" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33304 </strong>Instalação do programa ChemSketch Freeware. Já
                                                foi feito o download pois usei meu cadastro de estudante.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33303" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33303 </strong>O sistema tem apresentado comportamento
                                                inesperado para submissão de novas propostas de atividades de extensão.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33302" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33302 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (CONSAN 67) e seu respectivo apontamento para
                                                o Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33301" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33301 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (BD_SIG_ADM_ARQ_LOGS)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33300" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33300 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (banco_my10_54) e seu respectivo apontamento
                                                para o Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33299" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33299 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SAMBA_UBUNTU) e seu respectivo apontamento
                                                para o Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33298" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33298 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SIPAC_APP2-88) e seu respectivo apontamento
                                                para o Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33297" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33297 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (Pergamum) e seu respectivo apontamento para o
                                                Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33296" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33296 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (SISGEF) e seu respectivo apontamento para o
                                                Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33295" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33295 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (owncloud64) e seu respectivo apontamento para
                                                o Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33294" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33294 </strong>Impressora encontra-se offline
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33293" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33293 </strong>Durante a execução do Programa de Gestão,
                                                observei que após encerrar os planos de trabalho, a produtividade é
                                                igual/maior que 100%. Mas, após a chefia imediata avaliar os planos de
                                                trabalho, o p...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33292" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33292 </strong>atualizar o windons , o antivirus etc
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33291" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33291 </strong>Ligação à internet de computador. Necessidade de
                                                cabo de rede.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33290" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33290 </strong>Solicitação de computador de mesa para a sala da
                                                Divisão de Alimentação e Nutrição (DAN) no Campus das Auroras.
                                                Laudo segue em anexo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33289" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33289 </strong>Instalação de máquina. Ligação à internet
                                                (liberação de ponto). Necessidade de cabo de rede.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33287" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33287 </strong>Senhor(a),

                                                Observei a seguinte situação nos meus Planos de Trabalho cadastrados no
                                                Sistema do Programa de Gestão:

                                                Quando há a conclusão dos planos de trabalho, a produtividade é
                                                igual/maio...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33286" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33286 </strong>Observei a seguinte situação nos meus Planos de
                                                Trabalho: Quando há a conclusão dos planos de trabalho, a produtividade
                                                é igual/maior que 100%. Porém, após a realização da avaliação pela ch...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33285" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33285 </strong>Instalação de computador na sala da Ouvidoria e
                                                configuração para utilizar a impressora.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33284" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33284 </strong>Prezado, por gentileza, efetuar substituição de
                                                Toner da impressoras localizada na Prointer, tombo: 001737
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33283" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33283 </strong>Prezados,

                                                Solicito acesso aos módulos vestibular e transferência voluntária do
                                                SIGAA, incluindo os ambientes de homologação aos servidores abaixo:

                                                Romulo Amâncio Bastos Oliveira
                                                Maria Le...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33282" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33282 </strong>Prezados (as),

                                                Solicitamos um relatório geral de discentes da graduação referente aos
                                                anos de 2011 até o momento atual com os seguintes campos: matrícula,
                                                nome do discente, sexo, curso, campu...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33281" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33281 </strong>Não consigo acessar eduroam nem pelo celular nem
                                                pelo notebook
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33280" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33280 </strong>Teclado está com algumas teclas sem funcionar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33279" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33279 </strong>Computador apresentando problemas de lentidão,
                                                travamentos e erro de sistema (tela azul). Há alguns dias o PC
                                                apresentou erro de tela azul e nessa semana o tempo entre o clique no
                                                navegador (firefox...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33278" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33278 </strong>Falha na internet cabeada no segundo andar do
                                                bloco D, auroras. O problema ocorre quase que diariamente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33274" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33274 </strong>Instalar impressora no computador que foi
                                                formatado.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33273" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33273 </strong>Máquina sem internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33272" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33272 </strong>Solicito que seja condecida permissão para que
                                                os servidores abaixo possam liberar ospedidos de ALMOXARIFADO no módulo
                                                SIPAC, pois hoje apenas 01 tem esse acesso e ele está de férias.
                                                Relação d...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33271" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33271 </strong>Solicito criação do e-mail:
                                                secragi@unilab.edu.br, (Secretaria de Registro Acadêmico, Arquivo e
                                                Gestão da Informação) e que os seguintes e-mails sejam relacionados com
                                                esses, pois o novo o setor...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33270" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33270 </strong>Prezados(as), por gentileza, realizar
                                                configuração de mais uma impressoras para impressão das provas do PSEI,
                                                pois umas das impressoras deu problema e vamos substituir por outra.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33269" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33269 </strong>Boa tarde. Não foi possível me logar na rede da
                                                Unilab para bater o ponto no final do expediente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33268" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33268 </strong>Solicitamos apoio técnico para configurar a
                                                impressora ao computador que a colaboradora Ana Paula dos Santos
                                                Medeiros acessa.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33266" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33266 </strong>Não consigo imprimir pelo meu computador.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33264" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33264 </strong>O telefone da sala da cppd não está funcionando
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33263" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33263 </strong>Solicito liberação de acesso para o host
                                                10.129.19.128 (ou 200.129.19.132), usuário 'sisgef', ao banco 'sigaa' e
                                                'sistemas_comum' do host 200.129.19.9.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33262" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33262 </strong>Prezadas/os,

                                                venho por meio deste solicitar a inclusão das TAE´s do IH Luciana Sousa
                                                Melo e Isabele Cristina Duarte Serafim no SIPAC IH.
                                                Att.
                                                Profa. Dra. Luma Nogueira de Andrade
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33261" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33261 </strong>Prezados, solicito a execução do script a seguir
                                                no banco de dados de produção: ALTER TABLE pesquisa.frequencia_mensal
                                                ADD COLUMN id_membro_projeto_discente INTEGER;
                                                CONSTRAINT membro_projeto_di...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33260" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33260 </strong>cabeamento de dois computadores novos
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33259" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33259 </strong>configurar impressora compartilhada
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33258" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33258 </strong>configurar impressora compartilhada
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33257" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33257 </strong>instalar impressora
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33256" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33256 </strong>Permitir que o usuário do Cristiano possa
                                                instalar softwares na máquina pessoal dele da SPA (atendida pelo Gelson)
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33254" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33254 </strong>Solicito que seja feita uma integração de
                                                usuários dos sistemas SIG para o sistema do REPOSITÓRIO INSTITUCIONAL
                                                (DSPACE). O objetivo de habilitarmos toda comunidade acadêmica a
                                                possibilidade de a...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33253" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33253 </strong>Solicito o cadastro do servidor Jefferson
                                                Bernardo da Silva, SIAPE 3338308 , user: jeffersonb., assistente em
                                                administração, lotado na unidade Gabinete da Reitoria, para acesso ao
                                                domínio instituci...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33252" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33252 </strong> Prezados, a pedido da direção do IDR, solicito
                                                a desativação do e-mail da professora Maria Gorete
                                                (gorete@unilab.edu.br). Considerando que a docente não faz mais parte da
                                                equipe IDR, devido ao s...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33250" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33250 </strong>Hoje retornei da minha licença a maternidade e
                                                ao ministrar aula no laboratório de Geociências da Unilab observei que
                                                as configurações de entrada estão diferentes, não consegui acessar o
                                                usuár...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33249" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33249 </strong>Prezados, solicito o restore do 'Sisgef' no host
                                                10.129.19.128 (ou 200.129.19.132).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33248" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33248 </strong>Por favor, solicito permissão de acesso à
                                                bolsista Maria Dalvinha da Silva Oliveira, para o computador do
                                                Laboratório de Botânica, o qual eu coordeno. Desde já, agradeço.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33247" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33247 </strong>Prezados,
                                                Bom dia!

                                                Informo que o computador (003882) está apresentando problemas, mostrando
                                                a tela colorida em listras e desligando em seguida. Apareceu a
                                                informação de restauração mas não d...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33246" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33246 </strong>O Sigaa não abre... erro
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33245" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33245 </strong>Prezados, hoje 03/05/23, não estou conseguindo
                                                acessar o sistema Sigaa. Quando tento acessar, aparece essa mensagem:
                                                &quot;Caro Usuário, Desculpe, o sistema se comportou de forma
                                                inesperada. Entre e...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33244" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33244 </strong>Celular não conecta na rede, nunca tinha dado
                                                problema. Segui o tutorial e ainda assim não conecta e dá falha.
                                                https://dti.unilab.edu.br/wp-content/uploads/2018/07/android_eduroam.pdf
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33243" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33243 </strong>Caros(as), preciso que as seguintes alterações
                                                sejam realizadas na certidão de conclusão de curso no portal do
                                                discente:

                                                Alterar o nome &quot;Declaração&quot; para &quot;Certidão&quot; nas ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33242" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33242 </strong>Prezados, conforme demanda mensal, solicitamos
                                                os envios das listas com dados dos estudantes atualmente matriculados
                                                nas disciplinas teórico-práticas/estágio, do período letivo 2022.2,
                                                conforme re...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33241" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33241 </strong>instalar computador novo
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33240" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33240 </strong>instalar computador novo
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33239" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33239 </strong>Não consigo acessar o computador com o login do
                                                SIG
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33238" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33238 </strong>Instalação de software Eclipse Java no
                                                computador localizado na mesa do professor. Gostaria de pedir essa
                                                instalação até as 10h do dia 03/05, pois o professor precisará do
                                                software para realizar...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33237" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33237 </strong>Prezados, bom dia. Pedimos, por gentileza, a
                                                instalação do Pacote Office, se possível, no notebook Positivo de
                                                tombamento n. 2021001233, então cedido pela CLCP para uso na
                                                Parametrização do Inve...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33236" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33236 </strong>Bom dia, o computador apresentou falha no
                                                domínio.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33235" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33235 </strong>Prezados, bom dia. Pedimos, por gentileza, a
                                                verificação da rede Wifi na Sala 215, Bloco C, em Auroras, visto que
                                                desde ontem há a mensagem de 'Internet não disponível', o que tem
                                                prejudicado o a...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33234" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33234 </strong> Preciso que execute um script de update no
                                                banco de produção do Selest para que eu possa atender ao chamado 33222.
                                                Solicito urgência, por conta de ser uma seleção em curso. Tal banco se
                                                chama &q...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33233" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33233 </strong>Preciso que execute um script de update no banco
                                                de produção do Selest para que eu possa atender ao chamado 33222.
                                                Solicito urgência, por conta de ser uma seleção em curso. Tal banco se
                                                chama &qu...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33232" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33232 </strong>Solicito verificação/revisão, e se necessário,
                                                manutenção de todos os computadores e acesso à internet dos laboratórios
                                                3 e 4 localizados no 3ºandar, Bloco D no Campus das Auroras. Aos
                                                sábad...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33231" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33231 </strong>Prezados/as,

                                                Solicitamos, por gentileza, a criação de login para acesso asmáquinas,
                                                para a nova colaboradora Camili dos Reis Gomes, cpf: 100.233.763.17,
                                                camiligomes@unilab.edu.br
                                                Cordialmen...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33230" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33230 </strong>Nome: Maria Crislany Kelly Oliveira de Souza
                                                usuário: crislany
                                                E-mail institucional: mariacrislany@unilab.edu.br

                                                solicitamos que seja retomado os acessos nas máquinas das estagiárias
                                                abaixo l...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33229" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33229 </strong>Prezado, meu usuário e senha de acesso as
                                                maquinas expirou. Gostaria de saber como proceder?
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33228" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33228 </strong>Prezado, solicito, gentilmente, a criação de
                                                usuário e senha para acesso as máquinas.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33227" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33227 </strong>Prezado, meu usuário e senha de acesso as
                                                maquinas expirou. Gostaria de saber, por gentileza, como proceder?
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33226" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33226 </strong>Computador do RU de Liberdade não liga. Máquina
                                                havia apresentado defeito anterior em 10/04/23 e foi consertada pela
                                                equipe da DTI, mas voltou a apresentar defeito hoje.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33224" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33224 </strong>Prezada equipe, estou encaminhando um e-mail da
                                                Revista Capoeira da Unilab para criação do e-mail institucional, a
                                                professora Juliana Barreto Farias (coordenadora do curso de história)
                                                que irá fic...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33223" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33223 </strong>A rede wifi está instável desde o período da
                                                manhã, mas após o almoço não consigo conectar (Recebo a mensagem de
                                                Falha de conexão). Tentei celular e notebook sem sucesso.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33222" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33222 </strong>Boa tarde, estamos com problemas no sistema
                                                Selest ao resolver os históricos da etapa de recurso da análise de
                                                históricos. Ao resolver a inscrição de número 23048010506 durante o
                                                recurso, no qua...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33221" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33221 </strong>Conectar o equipamento de impressão ao
                                                computador da sala da Secretaria/Gabinete/SGP
                                                Tombo da máquina: 2016000260
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33220" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33220 </strong>( URGENTE)

                                                Prezados, informo que a funcionalidade &quot; buscar bolsa auxílio&quot;
                                                foi alterada, fazendo com que a busca pelos discentes que se inscreveram
                                                no calendário 2023.1, não seja mais ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33219" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33219 </strong>Cadastro de e-mail de grupo de pesquisa PROSAS;

                                                Prezado como vice-líder do grupo de pesquisa PROSAS
                                                (http://dgp.cnpq.br/dgp/espelhogrupo/72109) da Unilab solicito a criação
                                                do e-mail do grupo de...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33218" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33218 </strong>O computador Dell Optiplex 7010 não liga, e
                                                apresenta luz laranja piscando no botão de Ligar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33217" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33217 </strong>Computador encontra-se sem acesso à internet
                                                cabeada.
                                                Laboratório de Fisiologia Vegetal, Bloco D, 2º andar, sala 203
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33216" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33216 </strong>Prezados, em virtude da substituição da
                                                coordenação da Secretaria de Comunicação, solicito acesso ao Sistema
                                                Susepe para poder gerenciar os planos de trabalho dos servidores da
                                                unidade.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33214" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33214 </strong>Prezados(as), bom dia.

                                                O computador do Diretor do ICSA não está ligando, o nobreak está ligado,
                                                mas o computador não acende nada.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33213" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33213 </strong>Prezados, solicito o restore do banco de dados
                                                de homologação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33212" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33212 </strong>Aplicativo &quot;GS License Manager&quot; para
                                                acesso na nuvem das chaves do aplicativo Archicad (Graphisoft) apresenta
                                                erro de conectividade.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33211" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33211 </strong>Servidora retornando de licença. Falha no ponto
                                                eletrônico, mesmo com a conexão à rede eduroam, com a seguinte mensagem:
                                                &quot;Endereço IP de seu computador (...) não tem autorização para
                                                regi...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33210" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33210 </strong>Considerando que o meu USUÁRIO/LOGIN, no
                                                ambiente SIG/UNILAB, foi criado quando do período em que fui aluno do
                                                Curso de Pós-graduação lato sensu em Gestão Pública da UNILAB, solicito
                                                que o mesm...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33209" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33209 </strong>Mais uma vez a Centro Cultural com problemas de
                                                conexão à Internet. Solicitamos verificação
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33208" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33208 </strong>Bom dia! Prezadis, estamos sem Internet no CAIS.
                                                Atenciosamente,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33207" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33207 </strong>bom dia, solicito inclusão do meu e-mail
                                                (aristidesbarbosa@unilab.edu.br) nas listas de e-mail do
                                                jornalismo.secom@unilab.edu.br; publicidade.secom@unilab.edu.br e
                                                audiovisual.secom@unilab.edu.br.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33206" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33206 </strong>Solicitamos apoio técnico para impressora, da
                                                sala da Coordenação de Arte e Cultura- que parou de imprimir, sob número
                                                de tombamento 3256.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33204" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33204 </strong>Prezados, boa tarde. ( URGENTE)

                                                Solicito, por gentileza, que seja instalado o programa adobe e outros
                                                nos cinco computadores da Sala do NAE, os arquivos que precisamos baixar
                                                do módulo de assist�...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33203" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33203 </strong>Marquei as minhas férias no Sougov, que já foram
                                                homologadas pela minha chefia, mas as informações das férias não constam
                                                no Sigaa, ou seja, não foram sincronizadas. Como resolver? Já que as
                                                f...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33202" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33202 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor PROXMOX N° 168 (Naoligar-LIC-LAB-TI)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40....
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33201" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33201 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor PROXMOX N° 132 (NTX-Samba-200.129.14)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33200" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33200 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor PROXMOX N° 128 (Local-Tuleap)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33199" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33199 </strong>Procurador não consegue loggar no computador e
                                                nem na rede wifi da unilab.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33198" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33198 </strong>Prezada equipe, se puderem verificar a
                                                possibilidade de instalação de uma linha telefônica na sala das
                                                Coordenações de Cursos do Campus dos Malês, a pedido do Instituto de
                                                Humanidades e Letras
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33197" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33197 </strong>Embora instável, observa-se funcionamento da de
                                                wifi.
                                                Contudo, o periférico (tablet), não conecta.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33196" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33196 </strong>Caros,
                                                Estou tentando cadastrar um evento e um curso no módulo homologação de
                                                extensão SIGAA e não consigo concluir a ação, pois aparece a seguinte
                                                mensagem: &quot;Um erro ocorreu durante a ex...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33195" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33195 </strong>Computador muito lento
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33194" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33194 </strong>Sinal de wifi offline.
                                                Liberdade, bloco administrativo, próximo ao auditório
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33193" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33193 </strong>Prezados(as), solicita-se, por gentileza a
                                                redefinição de senha do e-mail: nicdeaad@unilab.edu.br
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33192" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33192 </strong>Prezado, boa tarde. A pedido da coordenador do
                                                curso de Humanidades, solicito um toner para a impressora que está
                                                instalada na coordenação, no Campus dos Palmares - bloco II, sala nº
                                                111. Modelo: ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33191" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33191 </strong>Solicito a inclusão no campo &quot;INSTITUIÇÃO
                                                DE ENSINO&quot; no SIGAA para cadastro da banca em TCC para membro
                                                externo, inserir Universidad Europea Del Atlántico - Espanha
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33190" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33190 </strong>Solicito permissão de acesso como administrador
                                                do módulo SEI homologação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33189" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33189 </strong>Equipamento com a imagem em má resolução.
                                                Precisando de manutenção para ajuste da resolução e qualidade de imagem.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33188" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33188 </strong>Equipamento com lentidão. Precisando de
                                                manutenção para aceleração do sistema.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33186" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33186 </strong>Não estamos tendo internet no computadores,
                                                solicitamos a verificação do que pode estar acontecendo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33185" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33185 </strong>Problemas com o monitor.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33184" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33184 </strong>Bloco A sem internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33183" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33183 </strong>Equipamento aparece a seguinte mensagem: Não há
                                                servidores de logon disponíveis para atender a solicitação de logon.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33181" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33181 </strong>Favor enviar a senha de login no computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33180" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33180 </strong>Apresentamos Relatório (Planilha EXCEL) com
                                                dados dos discentes beneficiários do Programa Bolsa Permanência (PBP).
                                                Mensalmente, a PROPAE deve homologar o pagamento da bolsa e uma das
                                                variáveis ver...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33179" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33179 </strong>Sala sem internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33178" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33178 </strong>Solicita-se, por gentileza, a criação do e-mail
                                                institucional para o Polo Associado Campus do Malês, conforme as
                                                informações contidas no formulário em anexo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33177" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33177 </strong>Solicito permissão de acesso ao Windows (login)
                                                para a servidora abaixo descrita:
                                                Nome: Eveline Cyntia
                                                Sobrenome: Monteiro da Silva Alcantarino
                                                Vínculo: Servidora
                                                email: cyntiamonteiro@unilab.e...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33176" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33176 </strong>Solicita-se a verificação se o computador está
                                                adequado para uso, tendo em vista que está sem utilização há algum
                                                tempo. Em caso afirmativo, solicita-se a formatação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33175" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33175 </strong> Preciso que execute um script de update no
                                                banco de produção do Semuni para que eu possa atender ao chamado 33082.
                                                Tal banco se chama &quot;semuni&quot; e fica no servidor 200.129.19.10.
                                                Recomendo ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33174" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33174 </strong>Preciso que execute um script de update no banco
                                                de produção do Selest para que eu possa atender ao chamado 32811.
                                                Solicito urgência, por conta de ser uma seleção em curso.
                                                Tal banco se chama &...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33172" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33172 </strong>Verificação de conexão no computador do servidor
                                                João Fiuza que não está se conectando à rede.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33170" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33170 </strong>Solicitamos configurar a impressora para uso em
                                                computador recém instalado.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33169" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33169 </strong>Máquina sem internet.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33168" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33168 </strong>Prezados, por volta das 14h00 tanto a internet
                                                cabeada quanto a eduroam estão fora do ar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33167" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33167 </strong>O computador localizado no Laboratório de
                                                Controle Físico-Químico não está iniciando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33166" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33166 </strong>Boa tarde! Não consigo mais entrar no computador
                                                institucional com a senha que eu utilizava. O computador institucional
                                                sempre apresenta erro e mesmo com a senha correta adicionada no momento
                                                do logi...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33164" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33164 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor PROXMOX N° 125 (NTX-DokuWiki)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33163" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33163 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor PROXMOX N° 112 (NTX-PHP-IPAM-200dot72) e seu
                                                respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33162" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33162 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor PROXMOX N° 135 (NTX-Cafe-LDAP-200.129.185) e seu
                                                respectivo apontamento para o Servidor ZABBIX no endereço IP: 10.130...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33161" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33161 </strong>Prezados, a sala utilizada pela DP em Auroras
                                                (sala 215 Bloco C antiga sala do Pulsar) para a realização de atividades
                                                atinentes ao Inventário encontra-se sem acesso à rede wifi. A sala
                                                contém po...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33160" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33160 </strong>Desde ontem estou tentando registrar meu ponto
                                                eletrônico no meu computador na Unilab porém aparece a mensagem que não
                                                tenho autorização.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33159" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33159 </strong>Toner com pouca tinta
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33158" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33158 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (CKAN)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33157" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33157 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (GIT-56_Atual)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33156" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33156 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do Servidor NUTANIX (banco_pg10_56)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33155" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33155 </strong>Prezados, solicita-se espaço em nuvem interna
                                                para armazenamento institucional de dados sensíveis dos seguintes
                                                setores: Núcleo de Atendimento Social ao Estudante; Núcleo de Informação
                                                e Documen...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33154" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33154 </strong>Acesso para o Terceirizado Francisco Edneldo
                                                Pereira da Silva para acesso a internet Wi-fi no seu celular. Nome:
                                                Francisco Edneldo Pereira da Silva CPF: 840.919.083-49 Função: Motorista
                                                Data de Na...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33153" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33153 </strong>Alterar o login da aluna: vania alves gomes
                                                cpf: 011.301.085-03
                                                para: vaniaalves
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33152" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33152 </strong>Prezado, boa tarde. Não estou conseguindo
                                                recuperar a senha de acesso ao meu e-mail institucional:
                                                melicia@unilab.edu.br
                                                Pode me ajudar?
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33151" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33151 </strong>Estou há algum tempo tentando se conectar ao
                                                mathscinet pelo cafecapes. Conecto o cafecapes pela UNILAB mas não
                                                consigo acesso ao mathescinet. Há algum problema com o acesso da UNILAB?
                                                Porque coleg...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33150" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33150 </strong>Prezados, pedimos, por gentileza a verificação
                                                da Internet na Divisão de Patrimônio, visto que a mesma faltou há cerca
                                                de 15 minutos, o que interfere na finalização do inventário.

                                                No mais, ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33149" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33149 </strong>Gostaria de solicitar acesso às 2 views que
                                                estão no banco do ambiente teste:
                                                &quot;DB_HOSTNAME&quot;: 200.129.19.9
                                                &quot;DB_USERNAME&quot;: sisgef
                                                &quot;DB_NAME&quot;: sistemas_comum

                                                &quot;D...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33148" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33148 </strong>Prezado (a),

                                                1. O computador da sala do SEPIR/CDHAA desligou sozinho e não está mais
                                                ligando. Solicitamos verificação.

                                                Atenciosamente,

                                                Milena Freire
                                                Secretária Executiva
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33147" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33147 </strong>Ao tentar imprimir documentos usando o adobe
                                                acrobat ou foxit pdf reader, o computador apresenta falha ao tentar
                                                selecionar a impressora.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33145" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33145 </strong>Consersão arquivo PDF X WORD
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33144" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33144 </strong>Hoje, em acesso a prontuário no SEREMUS
                                                (https://prontuariocais.unilab.edu.br/) não foi possível iniciar o
                                                atendimento do paciente pois, ao clicar no botão verde (INICIAR
                                                ATENDIMENTO) nada ocorreu...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33143" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33143 </strong>Solicito troca de toner
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33142" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33142 </strong>A internet cabeada da minha máquina não está
                                                mais funcionando, ao instaurar a rede wi-fi funcionou de maneira lenta e
                                                caindo a conexão constantemente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33141" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33141 </strong>Computador necessita da configuração de
                                                impressoras do setor, para que seja possível enviar documentos para
                                                impressão.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33140" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33140 </strong>Computador apresenta lentidão. Trava
                                                constantemente. solicito avaliação e correção. se precisar pode
                                                formatar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33139" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33139 </strong>Computador apresenta lentidão. Levar até a TI
                                                para verificar o problema. Caso precise pode formatar e atualizar o
                                                windows.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33138" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33138 </strong>Solicito apoio para instalação do programa
                                                AutoCAD e para configurar a impressora da sala da direção para que eu
                                                consiga imprimir
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33137" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33137 </strong>Periférico (Monitor) precisando de manutenção -
                                                imagens em má resolução.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33136" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33136 </strong>Periférico (Monitor) precisando de manutenção -
                                                não apresenta imagem nenhuma.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33135" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33135 </strong>Periférico (Monitor) precisando de manutenção -
                                                não apresenta imagem nenhuma.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33134" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33134 </strong>Sou coordenadora do projeto de extensão Facul
                                                das Crias e cadastrei o período do projeto incorretamente no SIGAA. Ele
                                                deve começar 02/02/2023 e terminar 30/12/2023, mas não consigo alterar
                                                isso, a...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33132" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33132 </strong>troca do toner da impressora BROTHER MFC 8890 DW
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33131" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33131 </strong>Trocar os cabos LAN
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33130" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33130 </strong>Solicito envio dos dados de conexao do servidor
                                                LDAP de prod incluindo os devidos dn,cn groups/names de pesquisa para
                                                configuração (vide exemplo anexo) do acesso aos serviços das ferramentas
                                                Vault,...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33129" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33129 </strong>Prezados, solicito o restore do banco de dados
                                                de desenvolvimento.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33128" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33128 </strong>Verificação de falha em equipamento no break
                                                utilizado pela servidora Helka Sampaio que parou de funcionar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33127" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33127 </strong>Solicitação de formatação em CPU
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33126" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33126 </strong>Conectar impressora ao notebook.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33125" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33125 </strong>Computador no limite do armazenamento,
                                                deixando-o muito lento. O tanto de arquivos está em outros usuários do
                                                pc que não tenho acesso para excluir. São de usuários que nem tem mais
                                                acesso ao PC
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33124" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33124 </strong>Instalação do PDF ADOBE
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33123" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33123 </strong>Bom dia. A pedido da coordenação da Secretaria
                                                de Comunicação, solicitamos a retirada do servidor
                                                junior.souza@unilab.edu.br das listas de e-mail da Secom
                                                (secom@unilab.edu.br; publicidade.secom@u...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33122" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33122 </strong>Caros(as), mesmo após registrar equivalência
                                                para a aluna Mercia, conforme histórico em anexo, ainda restaram
                                                pendentes 90h para ela, mas deveria demonstrar apenas 60h. Acredito que
                                                seja algum bug ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33121" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33121 </strong>O computador de tombamento 2021001320 não está
                                                ligando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33120" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33120 </strong>Email - Novo servidor.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33119" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33119 </strong>Acesso ao computador - Novo servidor.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33118" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33118 </strong>Impressora on-line. Solicito configurar
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33117" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33117 </strong>O computador do Laboratório de Zoologia está
                                                aparecendo a seguinte mensagem: &quot;Necessário verificar a
                                                consistência de um dos discos&quot;, mesmo depois de 100% da verificação
                                                dos arquivos.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33116" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33116 </strong>Prezados solicito a execução do script a seguir
                                                no banco de produção.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33115" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33115 </strong>Impressora não imprime
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33114" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33114 </strong>Solicita-se a memória do computador que precisou
                                                ser retirada .
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33113" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33113 </strong>troca de monitor e mudança de cabo usb. troca de
                                                lugar com manuseio de fios e aparelhos eletrônicos.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33112" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33112 </strong>Testar uma melhoria do 3s
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33111" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33111 </strong>SEREMUS. Pront. 496. O cadastro possui dado de
                                                curso equivocado, segundo informação prestada pelo estudante.
                                                Atualmente, o mesmo está matriculado em Enfermagem. Solicito correção.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33110" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33110 </strong>SEREMOS. Pront. 846. Registro de erro. Após
                                                cadastrar o estudante, não consigo abrir o prontuário para registro,
                                                aparecendo insistentemente mensagem de erro. Os demais abrem
                                                normalmente. &quot;Erro...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33109" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33109 </strong>Solicito criação de email específico para uso
                                                do(a) Encarregado(a) de Dados Pessoais na UNILAB.
                                                De acordo com a Instrução Normativa SGD/ME Nº 117/2020:

                                                Art. 2º A identidade e as informaçõ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33108" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33108 </strong>Alteracao de senha de acesso ao terminal
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33107" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33107 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°127 (NTX-RedmineDSI)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33106" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33106 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°126 (NTX-DTI-Wiki)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33105" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33105 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°185 (SELESTMEDICINA55)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33104" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33104 </strong>Solicitação de instalação do Microsoft Access no
                                                computador utilizado pelo servidor Patrício Trajano
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33103" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33103 </strong>Não consigo acessar o SIGRH. Tem uma notificação
                                                informando: Usuário não autorizado a acessar o sistema. Já é o segundo
                                                chamado que cadastro, o anterior se quer foi recebida por um técnico
                                                pa...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33102" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33102 </strong>Ausência de conexão de internet nos computadores
                                                conectados a rede cabeada
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33101" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33101 </strong>Prezados, solicito a liberação de acesso dos
                                                usuários &quot;roberiobs&quot; e &quot;daniele.araujo&quot; a VPN da
                                                DSI.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33100" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33100 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°181 (Docker57-C10)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33099" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33099 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°180 (Selest)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33098" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33098 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°129 (NTX-OCS-10.129.12)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33097" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33097 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°101 (NTX-Django-10.129.13)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33096" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33096 </strong>Realização de instalação e configuração dos
                                                equipamentos de impressão para imprimir as Provas do PSEI 2023, conforme
                                                informações do e-mail em Anexo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33095" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33095 </strong>Solicitação de Toner após análise do técnico da
                                                impressora.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33093" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33093 </strong>Solicito a instalação do Pacote Office no
                                                computador
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33092" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33092 </strong>Formatação e instalação do windows 10 com
                                                instalação do JAVA para uso do token.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33091" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33091 </strong>Solicita a instalação do Pacote Office no
                                                computador
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33090" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33090 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°151 (NTX-FONE-SRL1-2021-200.129.16)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40....
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33089" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33089 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°143 (NTX-SEUNEM)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33088" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33088 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°141 (NTX-EID-200.129.184)
                                                e seu respectivo apontamento para o Servidor ZABBIX no endereço IP:
                                                10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33087" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33087 </strong>Boa tarde, não consigo acessar o computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33086" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33086 </strong>Atualização do Fedora 37 para 38.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33085" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33085 </strong>Por favor, solicito habilitação da impressora
                                                nos computadores da sala de professores do Campus Auroras. Desde já,
                                                agradeço.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33084" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33084 </strong>Não estou conseguindo informar o andamento das
                                                atividades desta semana
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33083" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33083 </strong>Laudo para devolução e Tablet samsung.
                                                201315227
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33082" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33082 </strong>Bom dia! Segue relato da Francisca Samara:
                                                &quot;Olá, eu participei da semana universitária como palestrante
                                                referente a bolsa que participei. Mas meu certificado veio com meu nome
                                                errado, queria pe...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33081" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33081 </strong>Prezada Equipe,
                                                Necessitamos de apoio na reinstalação do token, java, no computador da
                                                servidora Tais Helena(na SGP), no computador apresenta erro devido ao
                                                hash ser diferente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33080" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33080 </strong>Prezados, devido a organização de realização de
                                                provas nos países parceiros e o retorno do processo seletivo de
                                                MEDICINA, precisamos com certa urgencia da tabela com dados de todos os
                                                candidatos ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33079" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33079 </strong>Impressora solicitando papel A4 incorretamente
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33077" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33077 </strong>Prezados/as, solicito a habilitação do login de
                                                acesso aos sistemas SIG da colaboradora CICERA ELISANGELA LIMA SILVA,
                                                elisangelalima@unilab.edu.br. Desde já, agradeço a atenção.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33076" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33076 </strong>Solicito e-mail institucional para a estagiária
                                                Ana Valéria Morais de Aarújo, CPF 070.123.643-43. Setor: Serviço
                                                Administrativo do ICEN. Data de expiração: 22/03/2024.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33075" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33075 </strong>nao consigo conectar com meu celular na rede
                                                wifi eduron. fica em conectando constantemente e em seguida ocorre erro
                                                de autenticação
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33074" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33074 </strong>Computador não está acessando a internet.
                                                informa que precisa atualizar a data e hora do computador. Não sendo
                                                possível realizar minhas demandas laborais pois o computador não
                                                funciona.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33073" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33073 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°139 (CEPH-freeradius-200.129.138) e seu respectivo
                                                apontamento para o Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33072" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33072 </strong>Instalação de Agente ZABBIX em servidor LINUX
                                                virtualizado
                                                na VM do PROXMOX N°134 (CEPH-Pentaho-200.129.51) e seu respectivo
                                                apontamento para o Servidor ZABBIX no endereço IP: 10.130.40.254
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33070" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33070 </strong>O computador do coordenador do curso de
                                                Pedagogia está apresentando muita lentidão, dificultando a execução dos
                                                trabalhos da coordenação. Pedimos, gentilmente, uma visita para correção
                                                do comp...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33069" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33069 </strong>Prof. Mário Castro relata que não está
                                                conseguindo postar via Sigaa o relatório de projeto de extensão. Ver
                                                documento anexo no qual o mesmo narra o problema.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33068" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33068 </strong>Prezados, gostaria de solicitar a avaliação para
                                                a formatação do meu computador que trava às vezes ficando lento.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33067" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33067 </strong>Boa tarde, prezados, faz algum tempo que o
                                                acesso a internet do meu computador não está sendo possível(conecto e
                                                desconecto o cabo e não adianta nada), fica oscilando ou não acesse de
                                                forma algum...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33066" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33066 </strong>Solicitamos apoio técnico para monitor que está
                                                apitando ligando e desligando automaticamente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33065" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33065 </strong>Retirar acesso ao Módulo SIGAdmin do usuário
                                                Francisco William Coelho Bezerra (willcpi), conforme Portaria em anexo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33064" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33064 </strong>Bom dia, preciso de suporte para instalar
                                                computador.
                                                Não tenho estabilizador. Gostaria também que fosse disponibilizado um
                                                estabilizador para a Reitoria.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33063" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33063 </strong>Computador apresentando muita lentidão.
                                                Solicitamos gentilmente a troca de HD, conforme sugerido pelo analista.
                                                Não há necessidade de backup.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33062" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33062 </strong>Portal da prograd está fora do ar.

                                                Link: https://prograd.unilab.edu.br/
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33061" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33061 </strong>Prezado/a, boa tarde.

                                                A Coordenação do Curso Administração Pública, Presencial, venho através
                                                desse chamado pedir, por gentileza a verificação das solicitação de
                                                trancamentos dos discente...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33060" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33060 </strong>Boa tarde. A pedido do coordenador do curso de
                                                Humanidades/CE, solicito, por gentileza, que seja realizado o
                                                processamento das/os estudantes que solicitaram trancamento de
                                                disciplinas através do SIGA...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33058" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33058 </strong>Computador não está ligando, luz do gabinete
                                                acende e depois apaga e máquina não liga.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33057" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33057 </strong>a professora esqueceu da senha de acesso ao
                                                computador
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33056" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33056 </strong>Falha de relação de confiança da CPU 2014/2151
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33055" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33055 </strong>Nome: Cícera Elisângela Lima Silva; Setor:
                                                Secretaria Administrativa do ICEN; Função: Colaboradora; Data de
                                                término: 31/08/2023.

                                                Acesso ao SEI: ICEN/CLCB/CLF/CLM/CCLQ.

                                                Acesso ao SIGAA: CLCB...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33054" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33054 </strong>O computador não tem acesso à rede, mesmo
                                                estando cabeado
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33053" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33053 </strong>Solicitamos instalação do sistema OBS no
                                                notebook para transmissão de uma atividade da PROINTER para Campus Malês
                                                por ocasião da realização do SAMBA. Essa atividade ocorrerá amanhã dia
                                                08/04...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33052" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33052 </strong>Inclusão de meu e-mail institucional na lista de
                                                professores dos Malês.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33051" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33051 </strong>Telefone não recebe chamadas
                                                3332 6122
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33050" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33050 </strong>Configurar a impressora no computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33049" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33049 </strong>Sem acesso a internet na rede cabeada em todo 2º
                                                andar do bloco D de Auroras.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33048" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33048 </strong>Prezados, solicito que sejam destravados s
                                                timers a seguir: br.ufrn.sigaa.ensino.timer.TrancamentoProgramaTimer e
                                                br.ufrn.sigaa.ensino.timer.TrancamentoTimer
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33047" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33047 </strong>Computador lento e ou travando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33046" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33046 </strong>Prezados, solicito a execução do script em anexo
                                                na base de dados de homologação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33045" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33045 </strong>Prezados, solicitamos gentilmente, o reparo em
                                                um computador na secretaria da Reitoria.

                                                Ao ser ligado hoje pela manhã, apresentou a seguinte mensagem: “No boot
                                                device found. Press any key to reb...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33044" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33044 </strong>solicitação de configuração das impressoras do
                                                setor ao computador da funcionária Marta Xavier. obs, funcionária chega
                                                ao setor a partir das 16:00 horas.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33043" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33043 </strong>Gostaria de solicitar acesso ao servidor e banco
                                                do ambiente teste 200.129.19.52
                                                meu ip é 10.17.0.127
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33042" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33042 </strong>Computador do servidor João roberto Fiuza não
                                                está ligando
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33041" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33041 </strong>Nome: Cícera Elisângela Lima Silva; Setor:
                                                Secretaria Administrativa do ICEN; Função: Colaboradora; Data de
                                                término: 31/08/2023.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33040" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33040 </strong>Reativação do e-mail escrito no anexo
                                                &quot;elisangelalima@unilab.edu.br&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33039" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33039 </strong>Solicito acesso ao Sistema SIGRH como gestor.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33038" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33038 </strong>Solicito acesso.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33037" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33037 </strong>Criar domain name: dti-vault.unilab.edu.br
                                                apontando para o ingress 10.130.1.17
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33036" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33036 </strong>Solicitação do processamento do Sigaa,
                                                Atualização de solicitação de trancamento de disciplina pelo portal do
                                                aluno.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33035" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33035 </strong>Prezado,

                                                Gostaria de aproveitar o pedido 33033 para instalar, se possível, os
                                                seguintes softwares

                                                Foxit leitor PDF
                                                Pacote Office
                                                VLC media Player
                                                Mozila Firefox
                                                Winrar
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33033" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33033 </strong>Prezados,

                                                teria como fazer a atualização do windows 7 para o windows 10?
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33032" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33032 </strong>Prezados,
                                                solicito, encarecidamente, o desbloqueio da minha conta de endereço
                                                eletrônico para que eu possa, assim, obter novamente o acesso ao site de
                                                Estágio Supervisionado do Curso de Licenciatu...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33031" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33031 </strong>O professor Jon Anderson Machado Cavalcante não
                                                lembra do seu usuário e senha de acesso aos computadores. Por gentileza,
                                                enviem para o e-mail dele o usuário e uma senha provisória para o e-mail
                                                de...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33030" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33030 </strong>CPU não está funcionando. (Sala da Coordenação
                                                de áreas, dentro da sala do Núcleo de Línguas)
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33029" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33029 </strong>Computador não está ligando. CPU acende mais não
                                                conecta com o monitor, teclado e mouse. (Sala da Coordenação de áreas,
                                                dentro da sala do Núcleo de Línguas)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33028" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33028 </strong>Ao logar no computador aparece a mensagem:
                                                &quot;Falha na relação de confiança...&quot; / Computador: 003392 (Sala
                                                da Coordenação de áreas, dentro da sala do Núcleo de Línguas)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33027" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33027 </strong>Ao logar no computador aparece a mensagem:
                                                &quot;Falha na relação de confiança...&quot; / Computador: 2014005097
                                                (Recepção do Núcleo de Línguas)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33026" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33026 </strong>Prezadxs, solicito redefinição de senha para o
                                                e-mail eleicao2022.pedagogia.ihlmales@unilab.edu.br.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33025" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33025 </strong>Impressora com mensagem de &quot;offline&quot;
                                                quando acionada para impressão.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33024" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33024 </strong>Solicito a troca da bateria, pois a data voltou
                                                para 2015.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33023" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33023 </strong>Solicitamos laudo técnico de um nobreak que está
                                                sem funcionamento.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33022" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33022 </strong>Solicito perfil Gestor de Permissões no SIGAA,
                                                para que eu possa gerenciar as permissões de servidores para acesso ao
                                                SIGAA nas Coordenações e Institutos.
                                                Solicito ainda os outros perfis que util...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33021" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33021 </strong>Solicito a instalação de atualização do java e a
                                                instalação da ferramenta para desktop do software dropbox (drive já
                                                baixado e disponível na área de serviço)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33020" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33020 </strong>Nobreak apresentando problemas constantemente,
                                                apitando mesmo sem queda de energia aparente, talvez seja necessário
                                                substituição do equipamento ou pelo menos da bateria do equipamento,
                                                solicito an�...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33019" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33019 </strong>Webcam e microfone do notebook não funcionam,
                                                problema recorrente, já foi aberto chamado anteriormente de número
                                                30805, ocorreu o mesmo problema novamente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33018" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33018 </strong>O computador não aceita meu login e senha
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33017" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33017 </strong>A senha do computador da coordenação do curso de
                                                medicina está bloqueada. Por favor reautorizem-na e se possível deixem
                                                validade contínua, para que não caia por demora no uso.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33015" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33015 </strong>Instalar os Softwares PDF24 e NAPS2.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33014" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33014 </strong>Instalar os Softwares PDF24 e NAPS2.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33013" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33013 </strong>Instalar os Softwares PDF24 e NAPS2.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33012" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33012 </strong>Instalar os Softwares PDF24 e NAPS2.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33011" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33011 </strong>Instalar os Softwares PDF24 e NAPS2.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33010" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33010 </strong>Instalar os Softwares PDF24 e NAPS2.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33009" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33009 </strong>Instalar os Softwares PDF24 e NAPS2.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33007" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33007 </strong>Instalar autocad portugues gratuito e o dialuz
                                                gratuito.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33006" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33006 </strong>Prezados,

                                                Solicito Toner para impressora DDA/Sibiuni.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33005" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33005 </strong>Bom dia, prezados, solicito verificação de
                                                funcionamento do equipamento computacional de tombamento . Ao ligar a
                                                CPU estava apresentando uma sinalização sonora incomum e não ligava.
                                                Att,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33004" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33004 </strong>Não há programa da microsoft.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33003" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33003 </strong>Tela de computador não liga.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33002" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33002 </strong>Falha ao tentar acessar computador na sala da
                                                SRCA
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33001" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33001 </strong>Solicito a alteração da senha desse e-mail
                                                institucional.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=33000" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#33000 </strong>Com a saída do diretor do ICS, em breve teremos
                                                eleições.
                                                Como pretendo realizar lançamento de candidatura, gostaria de solicitar
                                                dados abertos para conseguir elaborar o plano de gestão.
                                                Desta...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32999" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32999 </strong>Bloco A de Auroras sem internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32998" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32998 </strong>Computadores sem acesso à internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32997" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32997 </strong>O computador da sala da CIS (Casinha) não está
                                                ligando
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32996" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32996 </strong>Prezados,
                                                Gostaria de saber se foi colocada alguma restrição ao acesso do site
                                                https://www.overleaf.com/ ou https://pt.overleaf.com/. Tenho acesso a
                                                esse site normalmente mas hoje não estou conseg...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32995" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32995 </strong>Solicitação de laudo para devolução de notebook
                                                após empréstimo à servidor
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32994" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32994 </strong>Problema com a hora correta do computador, pode
                                                ser a bateria da placa mãe, hora apresentada atualmente 28/03/2023.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32993" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32993 </strong>Falta de internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32992" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32992 </strong>Prezado/a boa tarde.

                                                Gostaria de solicitar a troca de cartucho para impressora da Coordenação
                                                Administração Pública, Presencial. Tombamento da impressora 001876.
                                                Atenciosamente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32991" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32991 </strong>Boa tarde, a pedido da CSAEI/PROINTER, gostaria
                                                de verificar a possibilidade de alterar o peso dos Históricos no
                                                Selestmedicina, no campo informado no arquivo em anexo.

                                                Imagem1 (PSEI MEDICINA)
                                                ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32990" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32990 </strong>Relação de confiança.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32989" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32989 </strong>Prezados, gostaria de solicitar duas alterações
                                                no SIGAA: O meu login alterar de smaraujo02 para silvana e BRBD para
                                                STRD. Atenciosamente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32988" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32988 </strong>Solicitamos 02 (dois) mouses para a PROINTER, em
                                                substituição aos mouses que encontram-se com problemas. Os mouses serão
                                                destinados às terceirizadas Antonia Ivanyele e Vilmara Uchoa.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32987" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32987 </strong>Estalação de maquina
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32986" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32986 </strong>Boa tarde! Temos um PC que liga mas que ao
                                                &quot;esquentar&quot; fica apitando. Iremos enviar o equipamento ainda
                                                hoje.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32985" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32985 </strong>Instalação do Programa Gerador da DIRF e do
                                                Programa Receitanet.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32984" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32984 </strong>Estimadas! tudo bom? Por gentileza, solicito 3
                                                emails institucionais para gestão de projetos em andamento: Grupo de
                                                Pesquisa CNPq (consolidado); projeto de pesquisa financiado pela FUNCAP
                                                edital BPI ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32983" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32983 </strong>Por gentileza, solicito um PC em substituição ao
                                                que eu usava, visto que o mesmo deu efeito e o laudo da DTI consta como
                                                um bem IRRECUPERÁVEL (laudo anexo).
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32982" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32982 </strong>Boa tarde, o computador de tombamento N°
                                                2016000296 está aceitando acesso de apenas um usuário.
                                                Precisamos que outros profissionais também possam acessar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32981" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32981 </strong>Prezado, existem dois servidores recém chegados
                                                à DTI que estão com um &quot;problema&quot; referente a notificação de
                                                chamados 3S encaminhados para eles. Os usuários estão recebendo as
                                                notific...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32980" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32980 </strong>Prezada equipe, fui removido para a Secretaria
                                                de Instituto de Humanidades e Letras dos Malês, Campus dos Malês, diante
                                                disso solicitaria que fosse alterada a lotação do servidor. Portaria em
                                                anex...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32979" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32979 </strong>Instalar impressora Brother. Ponto de rede foi
                                                verificado.

                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32978" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32978 </strong>Solicito a instalação dos softwares:
                                                Google earth pro;
                                                Qgis Versão 3.28.5 LTR
                                                Autocad Civil 3D versão estudante
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32977" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32977 </strong>Solicitamos emissão de relatório atualizado, a
                                                partir do SIGAA, contendo a relação de estudantes, e seus respectivos
                                                cursos, que estejam com status ativo mas sem matrícula em componentes
                                                curricul...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32976" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32976 </strong>Olá! Gostaria de solicitar, caso seja possível,
                                                criar um email com espaço de armazenamento institucional para um projeto
                                                de extensão que trabalha com fotografia. Código do projeto: PJ075-2023.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32975" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32975 </strong>Solicita-se extração do status SIGAA mais atual,
                                                em curso de GRADUAÇÃO PRESENCIAL, dos estudantes beneficiários do PAES
                                                listados no anexo. No caso de estudantes que não possuam status ATIVO ou
                                                F...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32974" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32974 </strong>Solicito Toner para a impressora da Secretaria
                                                dos cursos/ICS. Brother MFC-8890, tombo nº 002047.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32973" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32973 </strong>Solicito Toner para a impressora do Mestrado
                                                Acadêmico em Enfermagem/ICS. Brother MFC-8890, tombo nº 001738.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32972" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32972 </strong>instalar cartuchos na impressora
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32971" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32971 </strong>Criação de Site para Hospedagem da documentação
                                                digitalizada dentro do &quot;Projeto Quilombos no Brasil Escravista Uma
                                                História Documental&quot;, aprovado na Chamada Pública 40/2022 do CNPQ.

                                                ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32970" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32970 </strong>Não estou conseguindo acessar o sistema Sigaa.
                                                Quando tento acessar, aparece essa mensagem:
                                                &quot;Caro Usuário,

                                                Desculpe, o sistema se comportou de forma inesperada. Entre em contato
                                                com a nossa...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32969" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32969 </strong>Instalar a impressora Multifuncional (scanner,
                                                impressora) da sala da Secretaria de Instituto de Humanidades dos Malês
                                                - IHL Malês
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32968" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32968 </strong>Criação de Site para Hospedagem da documentação
                                                digitalizada dentro do &quot;Projeto Quilombos no Brasil Escravista Uma
                                                História Documental&quot;, aprovado na Chamada Pública 40/2022 do CNPQ.

                                                ...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32967" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32967 </strong>O computador apresenta a mensagem &quot;não há
                                                conexões disponíveis&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32966" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32966 </strong>Procurador não conseguiu fazer loggin no
                                                computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32965" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32965 </strong>Instalação de AutoCAD, tendo em vista a
                                                necessidade de consulta, verificação, adaptação e/ou alteração de
                                                projetos.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32964" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32964 </strong>computador não reconhece a internet cabeada, só
                                                wifi
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32963" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32963 </strong>Configurar o IP (fixo) da Emanuela na SPA para
                                                permitir acesso aos bancos de dados -
                                                https://docs.google.com/spreadsheets/d/1rppOUPdBMR5RhOZ3xN-yZ7ea00s4bopYHV5s-EYqQ-U
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32962" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32962 </strong>Instalação de ponto de rede sem conexão à
                                                internet. Constatei após trocar o cabeamento de ponto para aferir se
                                                seria a conexão rj45 da máquina ou o cabeamento em si, mas pude perceber
                                                que se tr...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32961" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32961 </strong>Bloco A de Auroras sem internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32960" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32960 </strong>aparece essa mensagem:
                                                Caro Usuário,

                                                Desculpe, o sistema se comportou de forma inesperada. Entre em contato
                                                com a nossa equipe de suporte no link &quot;Abrir Chamado&quot;.

                                                Siga uma das opçõ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32959" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32959 </strong>Não conseguimos usar o computador, nenhum login
                                                da secretaria é aceite. Problema em confiabilidade.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32958" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32958 </strong>Solicitação de novo Toner para as impressoras:
                                                001913 - Sala da Coordenação do ILL - Sala 113
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32957" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32957 </strong>Solicitação de novo Toner para as impressoras:
                                                001873 - Sala do Núcleo de Línguas - Sala 109
                                                001913 - Sala da Coordenação do ILL - Sala 113
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32955" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32955 </strong>Solicito a troca de toner da impressora da sala
                                                STI/PROPLAN.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32954" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32954 </strong>Solicito criação de e-mail institucional para o
                                                projeto de Extensão TV Malês por mim coordenado, cadastrado na PROEX Ee
                                                com status ativo. O nome da assinatura é: TV Malês. Se possível,
                                                gostaria...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32953" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32953 </strong>Olá, boa tarde!

                                                Sou servidora nova lotada na DSI/DTI e irei precisar de acesso à VPN.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32951" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32951 </strong>Instalação de Autocad
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32950" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32950 </strong>Mais uma vez a Centro Cultural com problemas de
                                                conexão à Internet.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32949" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32949 </strong>Estamos sem Eduram no CAIS
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32948" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32948 </strong>Computador que faz o registro de acesso do RU de
                                                Liberdade não está ligando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32947" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32947 </strong>Pró-reitor sem acesso à computadores
                                                institucionais. Senha não está sendo aceita
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32945" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32945 </strong>Computador da sala da Pró-reitora sem internet.
                                                Tombamento 2021001321
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32943" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32943 </strong>Prezada equipe,
                                                De acordo com ato de remoção do servidor, da Direção do Campus para a
                                                Secretaria do Instituto de Humanidades e Letras dos Malês - IHL Malês,
                                                solicito que seja removido este Comp...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32942" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32942 </strong>Computador com demora para ligar e inicializar.
                                                Equipamento sinaliza pelo led do botão On/Off ao tentar ligar. Ao
                                                inicializar, equipamento exibe data e horário desconfigurados. Se
                                                possível, agendar...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32941" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32941 </strong>Computador com demora para ligar e inicializar.
                                                Equipamento sinaliza pelo led do botão On/Off ao tentar ligar. Ao
                                                inicializar, equipamento exibe data e horário desconfigurados. Se
                                                possível, agendar...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32940" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32940 </strong>A impressora não esta conectada ao equipamento.
                                                Lourembergue Saraiva
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32939" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32939 </strong>Peço, por gentileza, a verificação do computador
                                                de tombamento n. 2014005086, visto que o mesmo tem apresentado grande
                                                lentidão, o que tem dificultado no término do Inventário, cujo prazo se
                                                enc...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32938" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32938 </strong>Permissões de adm para sistema unicaffe,
                                                laboratório da biblioteca Palmares
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32937" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32937 </strong>Esqueci a senha para ligar no computador
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32936" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32936 </strong>Computador está sem acesso a internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32935" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32935 </strong>Preciso corrigir plano de trabalho de bolsista
                                                de extensão, seguindo orientação da PROEX, mas o ícone de alterar plano
                                                de trabalho não está habilitado no Sigaa. (Módulo Docente&gt;Planos de
                                                Tra...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32934" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32934 </strong>Prezados, solicito a execução do script em anexo
                                                no banco de homologação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32933" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32933 </strong>Criação de usuário e senha para acesso aos
                                                computadores institucionais para o servidor: Igor Emmanuel Melo da
                                                Silva, SIAPE: 3335024
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32932" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32932 </strong>Criação de email institucional para o servidor
                                                Igor Emmanuel Melo da Silva.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32931" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32931 </strong>Atualizar sistema operacional - computador lento
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32930" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32930 </strong>Falta de cabo de internet e verificação de drive
                                                de vídeo
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32929" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32929 </strong>Monitor tremendo e falhando na imagem
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32928" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32928 </strong>Monitor com defeito - Apresentando tela branca
                                                sem imagem, também atualizar o sistema operacional para windows 10/11
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32927" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32927 </strong>Monitor não está emitindo nenhuma imagem e
                                                também falta cabo de internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32926" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32926 </strong>Configuração da Impressora Local para o
                                                computador
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32925" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32925 </strong>Atualizar o sistema operacional para windows 10
                                                ou 11
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32924" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32924 </strong>realizar substituição de bolsista em projeto de
                                                extensão no modulo de extensão no sigaa
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32922" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32922 </strong>Solicitamos a troca da bateria do computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32921" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32921 </strong>Solicitamos a troca da bateria do computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32920" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32920 </strong>Solicitamos a troca da bateria do computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32919" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32919 </strong>Prezado (a),

                                                Temos o cadastro de dois alunos em que o sistema pergamum não está
                                                reconhecendo o novo curso/matricula em que os alunos estão vinculados no
                                                SigaA. Segue nome dos discentes: Aluno 1-...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32918" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32918 </strong>Boa tarde!
                                                Em relação ao sistema SUSEP, estou com a seguinte dúvida:

                                                Em alguns planos, o tempo planejado está coincidindo com o tempo
                                                despendido, no entanto a produtividade não consta como ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32916" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32916 </strong>Criar e-mail institucional para a nova
                                                servidora.
                                                Nome: Emanuela da Rocha Mascarenhas.
                                                Siape: 334809
                                                Obs: sugestão de e-mail: emanuelamascarenhas
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32915" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32915 </strong>Instalar scanner HP 7500
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32914" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32914 </strong>Prezados, Ontem entrou uma nova colaboradora e
                                                solicito, se possível, o cadastramento da mesma para acesso a rede.
                                                Nome: Sílvia Helena de Vasconcelos &gt; CPF: 007.494.013-97 &gt;
                                                DAT.NASC: 23/08...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32913" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32913 </strong>Renovação de licença do AutoCAD em computador da
                                                sala da ENGENEJR.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32912" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32912 </strong>Renovação de licença do AutoCAD em computador da
                                                sala da ENGENEJR.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32911" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32911 </strong>Configuração de IP Fixo na máquina da nova
                                                servidora SPA, Emanuela Marcarenha.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32910" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32910 </strong>Bom dia, prezado, devido a necessidade de
                                                algumas informações adicionais para o diploma digital, foi necessário a
                                                criação de uma coluna para adicionar o código do IBGE na tabela
                                                comum.municipio,...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32909" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32909 </strong>Boa tarde ! Gostaria de solicita comparecimento
                                                de um Técnico. Obs: configuração de impressora no computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32908" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32908 </strong>Nome: Walker Sales Valentim Setor: Secretaria
                                                Administrativa do ICEN Função: Estagiário Data de término: 25/07/2024
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32907" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32907 </strong>Aparentemente o Unicaffe está bloqueando o envio
                                                de comandos pelo site, quando as máquinas estão em stand by. Já havia
                                                detectado esse problema com elas em manutenção, porém observei que está
                                                c...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32906" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32906 </strong>Solicito cadastro do Usuário: Nicolas20 para
                                                acesso ao SISGEF, 3S e computadores Intesol
                                                Nome: António José Nicolau Álvaro
                                                Cargo: Estagiário de apoio administrativo Intesol
                                                Tempo de contrato: ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32905" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32905 </strong>Boa tarde!
                                                O PC não liga, fica apenas fazendo um barulho de ventilação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32904" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32904 </strong>Solicito email institucional para Christianne
                                                Silva Vasconcellos (estágio pós-doutorado CNPq/FUNCAP 2023/ 2025), sob
                                                supervisão da Prof. Natalia Cabanillas, Mat siape 2402085 (MIH-
                                                Instituto de Hum...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32903" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32903 </strong>Apresentamos Relatório (Planilha EXCEL) com
                                                dados dos discentes beneficiários do Programa Bolsa Permanência (PBP).
                                                Mensalmente, a Propae deve homologar o pagamento da bolsa e uma das
                                                variáveis ver...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32902" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32902 </strong>Falha na impressão ( com brevidade)
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32901" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32901 </strong>Prezados, solicito a execução do script em anexo
                                                no banco de homologação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32900" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32900 </strong>Configurar a máquina da Emanuela na SPA para
                                                permitir instalação de programas
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32899" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32899 </strong>Disponibilização de rede wifi para reunião com
                                                FACEP.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32898" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32898 </strong>O aluno &quot;Sumaé Embaló&quot; login SIG:
                                                &quot;sumae&quot;, informa que participou da VIII Semuni, no entanto,
                                                não consegue gerar seu certificado de participação no sistema gerenciar.
                                                Por favo...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32897" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32897 </strong>Primeiro acesso para o servidor CAIO VICTOR
                                                OLIVEIRA DA SILVA ao computador
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32896" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32896 </strong>A partir de demanda apresentada pela professora
                                                Profa. Kaline Girão Jamison (kalinegirao@unilab.edu.br) solicitamos a
                                                disponibilização de espaço no domínio da Unilab para abrigar site
                                                vinculado a...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32895" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32895 </strong>Estabilizador da impressora com barulho.
                                                Bloco C, sala técnica laboratório de Física.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32894" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32894 </strong>Rede cabeada não funciona.
                                                Laboratório de Física - sala 317. Bloco C.
                                                Procurar o técnico na sala Técnica.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32893" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32893 </strong>Rede cabeada não funciona.
                                                Laboratório de Física - sala 315. Bloco C.
                                                Procurar o técnico na sala Técnica.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32892" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32892 </strong>Rede cabeada não funciona.
                                                Laboratório de Física - sala 315. Bloco C.
                                                Procurar o técnico na sala Técnica.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32891" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32891 </strong>Rede cabeada não funciona.
                                                Laboratório de Física - sala 313. Bloco C.
                                                Procurar o técnico na sala Técnica.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32890" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32890 </strong>Rede cabeada não funciona.
                                                Laboratório de Física - sala 311.
                                                Procurar o técnico na sala Técnica.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32889" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32889 </strong>Prezados/as, solicitamos acesso as máquinas
                                                institucionais para a nova seridora do IH, Luciana Sousa Melo.
                                                CPF: 002.132.193-01, e-mail pessoal: lusousam@gmail.com. Informamos
                                                ainda que a servidora a...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32888" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32888 </strong>Solicitamos a verificação do computador que não
                                                está ligando. Pode ser bateria.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32887" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32887 </strong>Boa tarde, Cícero


                                                Iniciamos a execução do Cronograma do processo seletivo do PAES, por
                                                esse motivo solicitamos uma planilha com informações relativas aos/às
                                                discentes que aderiram ao cadast...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32886" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32886 </strong>Prezados,

                                                O discente INTERNACIONAL ZECA MALAN CÁ, relatou novamente que não
                                                consegue anexar os documentos relacionados a sua realidade ( Passaporte,
                                                Protocolo e Declarações), documentações c...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32885" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32885 </strong>Prezados (as), boa tarde.

                                                As linhas telefônicas das salas da direção e das secretarias do IDR não
                                                estão completando a ligação, estão como se estivessem ocupadas. Os
                                                ramais são 6176, 6223...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32884" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32884 </strong>Nome: Jailson Carlos Nanque
                                                Setor: Núcleo de Línguas
                                                Função: Bolsista
                                                Data de Término: 20/12/2023
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32883" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32883 </strong>No dia 28 de março, trabalhei as 8 horas
                                                diárias. Bati os pontos de entrada e saída, porém o sistema só
                                                contabilizou 7 horas de trabalho.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32882" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32882 </strong>Fiz a solicitação do email institucional por
                                                esse link https://dti.unilab.edu.br/forms/emailServidores/
                                                Acredito algo deu errado no preenchimento do formulário, pois ainda não
                                                recebi a mensagem (...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32881" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32881 </strong>Cadastrar o seguinte Usuário para acesso ao
                                                UNICAFÉ:
                                                Nome: António José Nicolau Álvaro
                                                Função: Estagiário
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32880" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32880 </strong>Dar acesso ao 3s ao estagiário Intesol.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32879" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32879 </strong>Solicito integração de conta para uso nos
                                                computadores pelos estagiários e bolsistas: Usuário = Intesol
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32878" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32878 </strong>O computador do tombo nº 2014000112, não
                                                inicializa.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32877" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32877 </strong>wi-fi
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32876" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32876 </strong>Configurar o PC para impressão.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32875" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32875 </strong>O sistema Sig , na seção de férias (incluir
                                                férias), fui tentar cadastrar parcelamento de férias em três vezes, e só
                                                aparece a opção de tirar três parcelas de 10 dias. O sistema não tá
                                                per...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32874" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32874 </strong>configurar impressora multifuncional no
                                                computador da secretaria do curso de enfermagem. O computador não possui
                                                Anydesk instalado
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32873" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32873 </strong>Notebook (2013005017) com problema de
                                                reinicialização e sistema operacional desatualizado.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32872" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32872 </strong>Prezados, conforme demanda mensal, solicitamos
                                                os envios das listas com dados dos estudantes atualmente matriculados
                                                nas disciplinas teórico-práticas/estágio, do período letivo 2022.2,
                                                conforme re...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32871" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32871 </strong>notebook (2014002096) com problema de
                                                reinicialização do sistema operacional e programas desatualizados.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32870" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32870 </strong>Notebook ( 2015000057) problema de
                                                reinicialização de sistema operacional e programas básicos
                                                desatualizados.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32869" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32869 </strong>saída de áudio de computador não esta instalada.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32868" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32868 </strong>notebook (2014002097) com problema de
                                                reinicialização e software desatualizado causando lentidão no sistema
                                                operacional.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32867" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32867 </strong>PC não está mais funcionando desde quarta-feira.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32866" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32866 </strong>Precisamos novo aceso para estudante de PIBIC
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32865" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32865 </strong>Notebook com problema de reinicialização no
                                                boot, além disso sistema operacional muito lento e falha na conexão de
                                                rede.
                                                Número de tombamento: 2014002103
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32864" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32864 </strong>Prezados, solicito liberação de acesso remoto no
                                                SIGRH para registro de justificativas do ponto.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32863" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32863 </strong>Não consigo acessar o sistema SIGRH. Tem uma
                                                notificação informando: Usuário não autorizado a acessar o sistema.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32862" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32862 </strong>Solicitamos o laudo técnico do computador (UFC
                                                289152) que se encontra apresentando problemas na parte de hardware e
                                                software.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32861" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32861 </strong>Solicitamos o laudo técnico do computador (UFC
                                                290161) que se encontra apresentando problemas na parte de hardware.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32860" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32860 </strong>solicitação para mudança de senha da usuária
                                                Francisca Andreia Silva Lima, informo também que o computador de
                                                tombamento (2016000295) não estar aceitando nenhum usuário só aparece
                                                fora do dom...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32859" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32859 </strong>Prezados, solicitamos a visita de um técnico na
                                                Reitoria, para verificar o motivo que o computador da Servidora Josely
                                                não ligou hoje pela manhã.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32857" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32857 </strong> Solicitação de criação de e-mail institucional
                                                do servidor Caio Victor Oliveira da Silva - Siape: 1203975 - Lotado na
                                                Divisão De Contabilidade/ Coordenação Financeira. Sugestão para
                                                criação...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32855" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32855 </strong>Computadores da biblioteca de Auroras sem acesso
                                                a internet.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32854" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32854 </strong>Os computadores da Biblioteca de Auroras estão
                                                sem conexão a internet, por isso solicitamos o atendimento a este
                                                chamado.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32853" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32853 </strong>Estamos sem acesso a internet no bloco B,
                                                Auroras.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32852" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32852 </strong>Centro Cultural mais uma vez sem conexão de
                                                Internet (wifi e cabeada)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32851" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32851 </strong>Redefinir login e senha para acessar os
                                                computadores da sala dos professores em Palmares I
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32850" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32850 </strong>Prezadxs, bom dia!

                                                Solicitamos a retirada dos computadores, impressora e demais
                                                equipamentos da sala da Secretaria do IHL-Malês, pois haverá reforma
                                                entre os dias 03 a 05 de abril.

                                                Atenciosame...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32849" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32849 </strong>O SIGA A - não dá acesso. Mensagem:
                                                &quot;comportamento inesperado&quot;.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32848" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32848 </strong>Prezados, peço, por gentileza, a instalação do
                                                programa Word na máquina de Tombamento: 2014005086. Tal pedido se deve à
                                                necessidade de emissão de vários documentos visando a finalização do
                                                In...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32847" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32847 </strong>Prezados, peço, por gentileza, a instalação da
                                                impressora Godex (impressora esta que emite os tombamentos) na máquina
                                                de Tombamento: 2016000283. Tal pedido se deve à necessidade de emissão
                                                de v�...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32846" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32846 </strong>Prezados, peço, por gentileza, a instalação do
                                                programa Foxit Reader na máquina de Tombamento: 2016000283, a fim de que
                                                se possa prosseguir com a emissão de alguns documentos atinentes ao
                                                Invent�...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32845" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32845 </strong>Solicito a criação de um email institucional
                                                para programa de pesquisa e extensão coordenado por mim, devidamente
                                                aprovado e cadastrado junto à PROEX. PG001-2022 AnDanças – programa de
                                                pesquisa...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32844" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32844 </strong>Prezado/a,

                                                solicito, por gentileza, a verificação do projeto do laboratório de
                                                informática do campus das Auroras porque está sem funcionar a projeção
                                                de tela do computador do professor com o...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32842" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32842 </strong> Solicito por gentileza, relatório completo do
                                                quantitativo de diplomas em Outubro, Novembro e dezembro de 2022
                                                modalidades da Graduação .
                                                E Solicito também , o relatório completo do quantitativ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32841" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32841 </strong>Prezado,

                                                Solicitamos reinicialização do servidor, pois estamos desde 11:30 sem o
                                                sistema pergamum estar funcionando.

                                                Atenciosamente,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32840" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32840 </strong>Falha no sistema Pergamum, não estamos
                                                conseguindo acessar.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32839" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32839 </strong>Solicita-se o laudo técnico da funcionalidade de
                                                dois computadores que se encontram no Polo de Catu- Ba apresentando
                                                falha de hardware. Desse modo, a secretaria do IEAD solicitará um
                                                veículo oficia...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32838" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32838 </strong>Prezados,
                                                Estou tentando votar no SIGeleição, mas esqueci minha senha, ou ela não
                                                está funcionando nesse domínio. Solicito realizar alteração de senha.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32837" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32837 </strong>Computador com problemas de acesso a internet,
                                                hora encontra-se completamente sem sinal, hora com internet muito lenta.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32836" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32836 </strong>Solicita-se a instalação do software da lousa
                                                Interativa do Estúdio de Gravação do IEAD, pois o equipe é importante
                                                para interação e dinâmica pedagógica dos docentes.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32835" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32835 </strong>Boa tarde. Gostaria de solicitar a instalação do
                                                software code blocks nos computadores no Laboratório de Informática 02,
                                                no Palmares. Link de download do software:
                                                https://www.fosshub.com/Code-Blo...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32834" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32834 </strong>Centro Cultural sem conexão de Internet (wifi e
                                                cabeada)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32832" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32832 </strong>Solicito relatório dos estudantes vinculados ao
                                                PAES (lista atualizada em anexo) que possuem carga horária zero (não
                                                estão matriculados em nenhuma disciplina) no semestre 2022.2.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32831" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32831 </strong>Nome: Safira Fontenele Gomes
                                                Setor: Núcleo de Línguas
                                                Função: Bolsista
                                                Data de término: 20/12/2023
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32830" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32830 </strong>Nome: Weslley de Sousa Cezar
                                                Setor: Núcleo de Línguas
                                                Função: Bolsista
                                                Data de término: 20/12/2023
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32829" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32829 </strong>Nome: Antonio Wilame Ferreira da Silva Junior
                                                Setor: Núcleo de Línguas
                                                Função: Bolsista
                                                Data de término: 20/12/2023
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32828" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32828 </strong>Nome: Matheus da Costa Santos
                                                Setor: Núcleo de Línguas
                                                Função: Bolsista
                                                Data de término: 20/12/2023
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32827" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32827 </strong>Criação de Site para Hospedagem da documentação
                                                digitalizada dentro do &quot;Projeto Quilombos no Brasil Escravista Uma
                                                História Documental&quot;, aprovado na Chamada Pública 40/2022 do CNPQ.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32826" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32826 </strong>Criação de acesso aos computadores para os
                                                bolsistas do Núcleo de Línguas.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32825" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32825 </strong>Gostaria de saber se é possível instalar o
                                                Pacote Office no computador que estou usando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32823" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32823 </strong> Instalar o programa Word no computador do
                                                gabinete da Prointer, Modelo Positivo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32822" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32822 </strong>Prezados, solicito a instalação do pacote office
                                                em computador da sala 321, bloco B, em Auroras. Desde já, agradeço a
                                                atenção.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32821" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32821 </strong>Solicito permissão para instalar um programa de
                                                gravação de tela.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32820" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32820 </strong>OBS
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32819" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32819 </strong>Prezados, solicitamos, por gentileza, a criação
                                                de e-mail institucional &lt;dionisia@unilab.edu.br&gt; para a estagiária
                                                DIONÍSIA CRISTÓVÃO FRANCISCO, lotada na CPAC/Coordenação de Projetos e
                                                ...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32818" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32818 </strong>Criação de site homologação/teste para LGPD com
                                                template padrão. Exemplo: utilizado pelo PDTIC. O acesso será a
                                                princípio para a DTI. Sugestão de url: lgpd.unilab.edu.br.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32817" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32817 </strong>Solicito acesso para a estagiária; BATENY
                                                MONTEIRO SANCA
                                                login sigaa: batenysanca
                                                Processo: 23282.003934/2023-84
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32816" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32816 </strong>Instalar o editor de vídeo Kdenlive.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32815" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32815 </strong>solicitar a criação de um Link de transmissão
                                                para o evento &quot;Festival anual das árvores&quot;, que acontecerá no
                                                auditório do campus Liberdade, no dia 31/03/2023 às 9h.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32814" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32814 </strong>O computador (nª tombo: 2014005232) sofreu uma
                                                atualização e mudou a data para 2015, por isso não entra mais na
                                                internet. Gostaria que a data seja atualizada. Se for necessário, estou
                                                por aqui e ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32813" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32813 </strong>Instalar/Configurar a máquina do Milton na SPA
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32812" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32812 </strong>Prezado/a, bom dia.

                                                O Instituto de Ciências Sociais Aplicadas (ICSA), está com 3
                                                computadores, que não estamos conseguindo acessar, fica aparecendo a
                                                seguinte frase: Falha na relação de confia...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32811" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32811 </strong>Boa tarde, sobre o sistema Selest, foi notado um
                                                erro de fluxo que aconteceu no PSEI 2021 (chamado #27902) e está se
                                                repetindo agora no PSEI 2023 (No de medicina tudo ocorreu normal).
                                                Recapitulando: ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32810" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32810 </strong>Instalar o anydesk no notebook positivo
                                                (2021001249)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32809" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32809 </strong>Criação de conta de email para o servidor André
                                                Luís Lima de Oliveira - SIAPE 1419690
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32808" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32808 </strong>Computador com acesso domínio falha.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32806" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32806 </strong>Formatação de computador. Computador necessita
                                                de atualização.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32805" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32805 </strong>Solicitação de teclado para substituição, pois o
                                                que está sendo utilizado apresenta defeito.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32804" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32804 </strong>SEREMUS. Prontuário número 779 está dando erro
                                                ao tentar entrar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32803" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32803 </strong>Sem acesso ao sistema PGD.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32802" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32802 </strong>Login não está acessando o PC.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32801" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32801 </strong>Manutenção preventiva, conforme solicitação do
                                                Eduardo. Máquina terminal de consulta ao acervo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32800" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32800 </strong>Manutenção preventiva, conforme solicitação do
                                                Eduardo. Máquina do &quot;Unicafe&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32799" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32799 </strong>Manutenção preventiva, conforme solicitação do
                                                Eduardo. Máquina do &quot;Unicafe&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32798" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32798 </strong>Prezados,

                                                Estou com dificuldades de homologar o ponto eletrônico das servidoras
                                                subordinadas a mim no setor (DDA). Não estou conseguindo selecionar a
                                                servidora para, individualmente, homologar o...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32797" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32797 </strong>Alteração na visualização da seção &quot;Outros
                                                Destaques&quot; no Portal da Unilab. Existem duas linhas na divisão da
                                                apresentação das matérias ali disponibilizadas.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32796" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32796 </strong>Computador não inicia o sistema, não liga. O
                                                problema começou com o sistema lento e travando, agora o computador não
                                                liga.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32795" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32795 </strong>Foi detectado outro problema no unicaffe. Após
                                                entrar em stand by as máquinas não aceitam o comando para desligar.
                                                Detectei esse problema com elas em modo de MANUTENÇÃO, não cheguei a
                                                verificar ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32794" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32794 </strong>Após a última atualização do Unicaffe, ao logar
                                                nas máquinas o windows não está subindo o explore.exe.
                                                Mesmo colocando em manutenção ou entrando com a senha de emergência, ele
                                                não executa,...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32793" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32793 </strong>verificar impressão de documentos
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32792" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32792 </strong>Solicitação de acesso para a estagiária da
                                                Divisão de Alimentação e Nutrição, Maria Herivanda Nogueira Barbosa, com
                                                contrato de estágio válido até 22/03/2024.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32791" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32791 </strong>Prezados(as),

                                                Solicitamos relatório SISURE dos candidatos deferidos, no edital 07/2023
                                                contendo nome polo, e-mail e convocação (se o candidato não tiver
                                                convocação associada, deixar em branc...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32790" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32790 </strong>Prezados, desde a ultima terça feira não estou
                                                conseguindo acessar o sistema SUSEP do PGD UNILAB. Quando na tentativa
                                                de acesso hoje, apareceu a mensagem de que a página não foi encontrada.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32789" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32789 </strong>Caros,
                                                Desde o dia 28/03, que eu não consigo entrar no sistema SUSEP (PGD),
                                                para encerrar um plano de trabalho e colocar outro em execução. A página
                                                do sistema, em questão, não carrega, já ten...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32787" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32787 </strong>O computador não liga, aparece a mensagem alerta
                                                system battery voltage is low
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32786" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32786 </strong>computador (UFC 290121) encontra-se desconectado
                                                da internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32785" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32785 </strong>Solicitamos a reposição do toner da impressora
                                                MFC - 8890DW (001917)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32784" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32784 </strong>configurar impressora
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32783" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32783 </strong>Prezados,
                                                A pedido da Profa. Elizia Cristina Ferreira coordenadora do Projeto
                                                Capoeira, venho por meio deste solicitar a criação de e-mail para o
                                                referido projeto. Esse projeto tanto quanto outros...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32782" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32782 </strong>Prezado/a,

                                                solicito, por favor, a instalação do programa Xmind
                                                (https://xmind.app/download/) para leitura dos mapas mentais utilizados
                                                em aula. O programa tem uma versão gratuita para esta final...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32781" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32781 </strong>Sistema SIGRH não cadastra justificativa de
                                                frequência. Aparece para o chefe homologar, mas após de homologado não
                                                justifica no ponto da servidora.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32780" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32780 </strong>Bom dia, sobre o Selest de apenas de Medicina
                                                gostaria de verificar a possiblidade de incluir a prova especifica de
                                                Biologia além das provas já existentes. Informo que esse pedido é
                                                urgente devido ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32779" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32779 </strong>Nome: Ana Valéria Morais de Araújo
                                                Setor: Secretaria Administrativa do ICEN
                                                Função: Estagiária
                                                Data de término: 22/03/2024
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32778" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32778 </strong>Boa tarde, prezados, solicito novo cartucho de
                                                tinta para a impressora do CAIS, tombamento 001889.
                                                Atenciosamente,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32777" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32777 </strong>Prezados (as), boa tarde ! O colaborador
                                                FRANCISCO VANDERLIS DE LIMA não está conseguindo conectar na rede wi-fi.
                                                Peço, se possível, a redefinição da senha. CPF: 740.829.493-72, e-mail:
                                                vanderl...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32776" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32776 </strong>No site de homologação sigaa, na opção de
                                                solicitar auxílio aparece a mensagem de comportamento inesperado.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32775" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32775 </strong>Acesso aos computadores da Universidade para os
                                                estagiários Francisco Eriqui da Silva Barroso e Ana Valéria Morais de
                                                Araújo
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32774" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32774 </strong>Chat não funciona
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32772" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32772 </strong>Favor habilitar permissão de Gestor de
                                                Comunicação para o servidor Vinicius Alves Moraes, Coordenador da SECOM,
                                                SIAPE 3285414.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32771" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32771 </strong>Prezados, solicito a execução do script a seguir
                                                no banco de dados de produção: update ensino.coordenacao_curso set
                                                data_inicio_mandato = '2023-03-06', data_fim_mandato = '2024-03-06'
                                                where id_ser...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32770" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32770 </strong>Prezados, solicito, a verificação de possível
                                                problema com o nobreak/estabilizador da sala do laboratório de
                                                astronomia, em Auroras, bloco C. Falar com o professor Michel Lopes
                                                Granjeiro. Desde j�...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32768" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32768 </strong>Computador sem internet
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32767" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32767 </strong>Informo que não consigo anexar documento no
                                                SIGRH nem cadastrar os dias de teletrabalho parcial, sistema acusa
                                                comportamento inesperado. o sistema também está identificando que estou
                                                de férias na ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32766" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32766 </strong>Manutenção preventiva, conforme solicitação do
                                                Eduardo. Máquina do &quot;Unicafe&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32765" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32765 </strong>
                                                Prezada Equipe, para este novo chamado, poderiam acrescentar mais outras
                                                colunas necessitamos de informações para relatório do PGD, gostaríamos
                                                de saber se seria possível os dados em tabela(csv...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32764" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32764 </strong>Prezados, Solicito criação de e-mail
                                                institucional para nova colaboradora da Biblioteca. Nome: Marta Janine
                                                do Espirito Santo Xavier. CPF: 078.453.125-09. No aguardo. At.te, Helka
                                                Sampaio
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32762" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32762 </strong>URGENTE

                                                Temos relato de dois estudantes que não estão conseguindo solicitar o
                                                auxílio instalação, tanto no município de Acarape e Redenção.

                                                Redenção: Estudante Daniel Gregório de Sous...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32761" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32761 </strong>Computador já foi formatado, mas está novamente
                                                apresentando muita lentidão
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32760" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32760 </strong>Não consigo solicitar homologação do diploma de
                                                discente do programa Profmat no sigaa. O sistema acuso comportamento
                                                inesperado
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32759" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32759 </strong>Impressora Brother MFC 8890DW - Printer
                                                Série: TIJ696614
                                                Tombamento: 001866.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32758" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32758 </strong>Solicita-se o laudo de dois computadores do Polo
                                                de Catu-BA, uma vez que o primeiro encontra-se com
                                                travamento/congelamento no carregamento do sistema operacional, bem como
                                                apresentando tela azul e re...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32756" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32756 </strong>Mudança de computador, impressora e telefone de
                                                sala.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32755" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32755 </strong>projetocasaviva@unilab.edu.br para
                                                engenharianasociedade@unilab.edu.br. O pedido é motivado pelo fato que o
                                                Projeto casa viva ( registrado no PJ175-2021) coordenado por mim teve
                                                nome alterado por Pro...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32753" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32753 </strong>Computador está sem internet.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32752" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32752 </strong>A servidora Técnica de Laboratório Tatyane
                                                Bandeira Barros tem recebido e-mails sempre que algum servidor faz
                                                alguma alteração no PGD. Ela solicita que os e-mails parem de ser
                                                enviados a ela.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32751" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32751 </strong>Nobreak não se encontra funcionando. Além disso,
                                                está emitindo um som muito alto mesmo estando na energia.
                                                Por favor, verificar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32750" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32750 </strong>Prezados (as),

                                                Estamos realizando Inventario/2022 e no SIPAC quando solicitamos os
                                                relatórios (inventário) de bens das unidades/setores o mesmo emiti uma
                                                relação em PDF, a fim de facilitar o m...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32749" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32749 </strong>O e-mail da institucional da CPA:
                                                cpa@unilab.edu.br
                                                está com várias mensagens na cx de entrada referentes ao site da CPA.
                                                Solicito verificar o que aconteceu.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32748" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32748 </strong>Configurar o aplicativo trinta no leptop da
                                                Intesol para gestão administrativo e financeira da Loja Solidária
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32747" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32747 </strong>Solicitação de manutenção preventiva de todos os
                                                computadores Intesol
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32746" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32746 </strong>Solicitação de computador em substituição ao
                                                devolvido ao patrimônio Nº 003901 conforme laudo realizado por este
                                                setor
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32744" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32744 </strong>Solicitação de computador e seus periféricos em
                                                troca pelo de nº 003909 devolvido ao patrimônio conforme laudo
                                                apresentado por este setor
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32743" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32743 </strong>Solicitação de computador e seus periféricos
                                                como troca do equipamento devolvido ao Patrimônio Nº 003910 conforme
                                                laudo apresentado por este setor
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32742" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32742 </strong>Olá bom dia...já tenho cadastro para acesso no
                                                computador aqui da minha sala..no entanto desde a volta presencial nao
                                                consigo acessa-lo pq nao lembro mais login e senha.

                                                Estarei a tarde toda hoje...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32741" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32741 </strong>O Auto Cad, está solicitando o número da
                                                licenças
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32740" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32740 </strong>Manutenção preventiva, conforme solicitação do
                                                Eduardo. Máquina do &quot;Unicafe&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32739" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32739 </strong>Estamos sem acesso à rede cabeada no Ru Auroras
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32738" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32738 </strong>Os softwares instalados precisam ser
                                                atualizados.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32737" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32737 </strong>Solicito um mouse para o computador que dispomos
                                                no laboratório de ecologia. O que tem no laboratório está com a
                                                sensibilidade alterada, com o cursor se movimentando de forma aleatória.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32736" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32736 </strong>Monitor quando ligado fica com a luz vermelha
                                                acesa direto e o normal era uma luz azul. A imagem na tela também está
                                                com defeito.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32735" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32735 </strong>Prezados, solicito que seja verificado a
                                                possibilidade de disponibilização de 2 monitores extras para a equipe de
                                                desenvolvimento.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32733" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32733 </strong>Dia 30 de março de 2023, ocorrerá a 9ª
                                                conferência de saúde do município de Redenção e conforme ofício anexo,
                                                eles pediram acesso à rede wi-fi.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32732" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32732 </strong>Foi identificado, no módulo de extensão Sigaa,
                                                que na aba “Gerenciar Ações” está faltando o item Plano de Trabalho e
                                                seus subitens, assim como o item “Relatórios” e seus subitens. Segue ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32731" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32731 </strong>A coordenadora do curso de Antropologia solicita
                                                a atualização da senha do seu acesso ao seu computador.
                                                A nova senha temporária pode ser enviada para o e-mail dela:
                                                &gt; denisecruz@unilab.edu.b...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32730" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32730 </strong>Desde a tarde de ontem não consigo incluir
                                                despachos em processos sigilosos (que pedem senha). Mesmo inserindo a
                                                senha, não é possível editar o documento.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32728" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32728 </strong>Cadastro para novo servidor
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32727" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32727 </strong>Solicito a execução dos scripts em anexo no
                                                banco de dados de produção da Sisure. Banco: sisure Host: 200.129.19.10
                                                Usuário: sisure
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32726" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32726 </strong>O gabinete do UniCafé está com um baralho forte.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32725" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32725 </strong>Prezada equipe,
                                                Boa tarde!

                                                Solicito o cadastramento de conta, para acesso aos computadores, por
                                                parte da servidora ISABELE CRISTINA DUARTE SERAFIM, CPF 027.233.453-78,
                                                recém empossada como TAE, l...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32724" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32724 </strong>Criar conta de acesso para: MILTON HONÓRIO
                                                CAVALCANTE NETO sendo Técnico de TI, ROBÉRIO BEZERRA SEVERINO, DANIELE
                                                SOUZA DE ARAÚJO, EMANUELA DA ROCHA MASCARENHAS e ALEX SANDRO PEREIRA
                                                RAMOS, sendo ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32722" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32722 </strong>Instalação do Windows 10.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32721" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32721 </strong>Bloco A sem internet cabeada e Wi-Fi
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32720" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32720 </strong>Tem um ponto de rede da sala que esta sem
                                                conexão. Os outros estão normal.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32719" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32719 </strong>Centro Cultural no Auroras está sem Internet.
                                                Não há conexão cabeada nem wifi.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32718" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32718 </strong>Prezados,

                                                Solicito instalação do obs studio na máquina para viabilizar o registro
                                                e gravação de reuniões.

                                                Atenciosamente,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32717" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32717 </strong>Instalar a impressora no computador 2014000180
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32716" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32716 </strong>A estagiária Mireia ao entrar no computador
                                                (2014000180) aparece a seguinte mensagem: Não há servidores de Logon
                                                disponíveis para atender a solicitação de Logon.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32715" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32715 </strong>Troca de bateria do relógio do computador
                                                &quot;Atendimento&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32714" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32714 </strong>Troca de bateria do relógio do computador.
                                                &quot;Atendimento&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32713" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32713 </strong>Troca de bateria do relógio do computador.
                                                &quot;Terminal de consulta&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32712" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32712 </strong>Troca de bateria do relógio do computador.
                                                &quot;Unicafe&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32711" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32711 </strong>Troca de bateria do relógio do computador.
                                                &quot;Unicafe&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32710" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32710 </strong>Troca de bateria do relógio do computador.
                                                &quot;Unicafe&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32709" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32709 </strong>Não conecta
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32708" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32708 </strong>Sem acesso a internet através da rede cabeada
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32707" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32707 </strong>Cadastrar domínio name
                                                dti-registro-notary.unilab.edu.br com ref para Ingress 10.130.1.17

                                                _note:

                                                O server Harbor Notary é um dos principais componentes do registro
                                                Harbor e é responsável ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32706" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32706 </strong>Boa tarde. Gostaria de informar que sempre que
                                                vou me logar no windows aparece o erro &quot;Falha na relação de
                                                confiança entre estação de trabalho e o domínio primário. Sempre tenho
                                                que tirar ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32705" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32705 </strong>Ao tentar efetuar login nos computadores:
                                                2014005127 e 2014000120, situados na sala NucLi/ILL - Palmares III é
                                                exibido a mensagem de falha em relação a confiança. Ocorre para o login
                                                manoel.santos
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32704" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32704 </strong>computador localizado no gabinete da Prograd
                                                muito lento, dificultando o uso.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32702" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32702 </strong>Prezados, solicito o acesso ao computador para o
                                                estagiário Francisco Eriqui da Silva Barroso; SIAPE 3294629; login
                                                eriqui; email eriqui@unilab.edu.br. O referido estagiário teve sua senha
                                                expirada....
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32701" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32701 </strong>Telefone não funciona
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32700" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32700 </strong>Solicitamos avaliação de 2 (dois) telefones VoIP
                                                que estão sem funcionar na unidade. A saber os ramais 6224 e o 6165.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32699" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32699 </strong>Instalar o programa Word no computador do
                                                gabinete da Prointer,
                                                Modelo Positivo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32698" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32698 </strong>Impressora modelo MFC-8890DW, ao imprimir o
                                                papel fica preso, amassando e paralisando a impressão.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32696" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32696 </strong>A pedido da coordenação da biblioteca de
                                                auroras, solicito a criação de uma lista de e-mail para comunicação com
                                                um grupo específico de pessoas que atuam na biblioteca de auroras:
                                                equipe-bib-au...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32695" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32695 </strong>Prezados, gostaria de solicitar a mudança de
                                                sala do meu computador da sala 20 para a sala da Divisão de
                                                Administração, e que o computador do novo servidor, Claudio Marcelo,
                                                seja instalado no loca...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32694" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32694 </strong>Prezados, solicito a execução do script em anexo
                                                nas 3 bases de dados.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32693" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32693 </strong>Instalação de font no windows.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32692" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32692 </strong>cadastrar dominio k8s.unilab.edu.br ingress
                                                10.130.1.17
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32691" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32691 </strong>Prezado, solicito por gentileza uma manutenção
                                                na impressora multifuncional da FEP (tombamento Copy Systems 001827).
                                                Multifuncional Brother MFC-8480DN. A mesma não esta imprimindo com
                                                qualidade (fa...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32690" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32690 </strong>Solicito um mouse novo, pois o que utilizo está
                                                defeituoso
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32689" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32689 </strong>O coordenador de Extensão, professor Ricardo
                                                Ossagô, solicita por meio deste 3S apoio quanto a instalação de programa
                                                par usar a impressora do setor.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32687" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32687 </strong>Prezados,

                                                Solicito relação de docentes ativos e os institutos em que se encontram
                                                lotados atualmente.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32686" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32686 </strong>Prezados, bom dia ! Solicito, por gentileza, a
                                                verificação do computador da prefeitura de palmares. O sistema de áudio
                                                externo não está funcionando.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32685" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32685 </strong>Bom dia. Ao chegar no gabinete pela manhã,
                                                acessei o computador normalmente para trabalhar. Quando dei a 1a pausa,
                                                acessei normalmente o computador com minha senha, pois ele fica na tela
                                                de descanso ...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32683" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32683 </strong>Elaboração de laudo técnico para computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32682" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32682 </strong>Internet não funciona no notebook do RU de
                                                Palmares, não tem como fazer o sistema Catraca funcionar.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32681" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32681 </strong>Computador do RU de Palmares não liga!
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32680" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32680 </strong>Não está abrindo página da Unilab, sigaa e sei.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32679" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32679 </strong>O Software Laragon encontra-se pedindo a senha
                                                do administrador para atualização.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32678" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32678 </strong>Não conecta
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32677" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32677 </strong>Colegas, peço auxilio pois não estou conseguindo
                                                imprimir o documento. a impressora parece estar sem offline
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32676" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32676 </strong>Instalar a pasta destino de scanner da
                                                impressora para a máquina (pasta sra)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32675" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32675 </strong>Gostaria de pedir para inserir no bloco (grupo)
                                                de e-mail Professores Letras Malês
                                                &lt;professoresletrasba@unilab.edu.br&gt;
                                                &quot;professores letras malês&quot;

                                                Inserir o endereço da nova pro...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32674" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32674 </strong>Um indivíduo alega ter realizado inscrição para
                                                o processo seletivo do Mestrado Interdisciplinar em Humanidades dentro
                                                do prazo estabelecido em edital. Na tentativa de provar o envio da
                                                documentaç...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32672" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32672 </strong>Bom dia! Pedimos a gentileza de disponibilizar
                                                uma rede wi-fi para uma palestra que haverá no ICSA com o tema: Sistema
                                                CFA/CRA e o mercado de trabalho do Administrador Público. Será dia
                                                03/04/23, d...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32671" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32671 </strong>Não consigo enviar para impressora.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32670" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32670 </strong>Áudio do computador muito baixo, o que prejudica
                                                as reuniões online.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32669" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32669 </strong>Prezados,

                                                Solicito criação de e-mail institucional para nova colaboradora da
                                                Biblioteca. Nome: Marta Janine do Espirito Santo Xavier. CPF:
                                                078.453.125-09.

                                                No aguardo.

                                                At.te,
                                                Helka Sampaio...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32667" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32667 </strong>Impressora esta com um barulho muito forte e
                                                aparece a imagem de papel preso e não esta
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32666" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32666 </strong>Boa tarde. Gostaria de solicitar a instalação do
                                                software Eclipse Java nos computadores do laboratório de informática do
                                                Auroras. Link de download do software: Eclipse (Ferramenta de
                                                Desenvolvimen...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32665" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32665 </strong>Prezado,

                                                Solicitamos que seja verificado o motivo pelo qual não veio migrado os
                                                dados dos respectivos usuários listados logo abaixo do sistema SigaA
                                                (acadêmico) para o Pergamum:

                                                1. Marcelino...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32664" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32664 </strong>Solicito que seja liberação de acesso a
                                                protocolo FTP para o colaborador Isaac da empresa Cerbrum para
                                                viabilização de treinamento para o momento.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32663" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32663 </strong>Prezados, necessito de uma senha para para
                                                acesso aos computadores institucionais, uma vez que a minha anterior não
                                                estar dando certo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32662" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32662 </strong>Boa tarde. Gostaria de solicitar a instalação do
                                                software code blocks nos computadores do laboratório de informática do
                                                Auroras. Link de download do software:
                                                https://www.fosshub.com/Code-Blocks.h...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32661" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32661 </strong>Prezadxs, o computador da colaboradora Fabiane
                                                dos Santos não está conectando à internet. Solicito verificar e
                                                corrigir, se possível.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32660" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32660 </strong>Boa tarde. Gostaria de solicitar a instalação do
                                                software code blocks nos computadores do laboratório de Palmares. Link
                                                de download do software:
                                                https://www.fosshub.com/Code-Blocks.html?dwl=codeblo...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32659" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32659 </strong>Boa tarde. Gostaria de solicitar a instalação do
                                                software code blocks nos computadores do laboratório de Palmares. Link
                                                de download do software:
                                                https://www.fosshub.com/Code-Blocks.html?dwl=codeblo...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32658" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32658 </strong>Precisamos montar uma nova estação de trabalho,
                                                para isso solicitamos a disponibilidade de um computador (gabinete,
                                                monitor, mouse e teclado).
                                                O nosso setor não dispõe de máquinas para uma nova...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32657" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32657 </strong>Prezados, boa tarde.
                                                Informo que o acesso ao sistema SIPAC encontra-se indisponível desde
                                                hoje pela manhã.

                                                Segue em anexo print do erro apresentado na tela do SIPAC.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32656" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32656 </strong>Erro ao tentar entrar no Sigrh
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32655" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32655 </strong>Solicito a instalação, se possível, de algum
                                                software de edição de pdf, para juntar arquivos de um processo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32654" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32654 </strong>Não consigo acessar o SIGRH.
                                                Favor observar a msg no print em anexo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32653" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32653 </strong>O SigRh não permite acesso. Mostra a seguinte
                                                mensagem:

                                                org.jboss.tm.JBossTransactionRolledbackException: null; nested exception
                                                is: javax.transaction.HeuristicMixedException; - nested throwable: ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32652" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32652 </strong>Não consigo acessar o Sigaa, recebo a seguinte
                                                informação
                                                &quot;O sistema comportou-se de forma inesperada e por isso não foi
                                                possível realizar com sucesso a operação selecionada.&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32650" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32650 </strong>O Sigaa não está disponível, tanto dentro da
                                                rede da Unilab, quanto em outras redes.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32649" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32649 </strong>Falha no acesso do SIGAA pelos jornalista da
                                                SECOM (BA e CE)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32648" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32648 </strong>Não estou conseguindo abrir o Sigaa. Aparece a
                                                seguinte informação:
                                                Caro Usuário,

                                                &quot;Desculpe, o sistema se comportou de forma inesperada. Entre em
                                                contato com a nossa equipe de suporte no ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32647" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32647 </strong>Prezados,
                                                Na condição de coordenadora de estágio pedagogia-CE, venho solicitar um
                                                endereço de e-mail institucional para a coordenação de estágio do curso
                                                de licenciatura em pedagogia do Ceará...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32646" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32646 </strong>Recuperação de arquivos do drive;
                                                Verificar a perda de arquivos no drive;
                                                Arquivos de drive de e-mail institucional precisam ser recuperados.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32645" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32645 </strong>Não estou conseguindo solicitar reserva de
                                                espaço, onde tem responsável aparece uma tarja preta.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32644" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32644 </strong>Prezados, solicito verificação dos rádios que
                                                proveem internet sem fio próximo ao local, assim como os pontos de
                                                internet da sala 215, Palmares, bloco 2. A sala será utilizada nos dias
                                                23 e 24 pa...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32643" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32643 </strong>Prezado/a,
                                                Solicito, por gentileza, instalar os softwares livres descritos a
                                                seguir, no laboratório de informática no campus das Auroras.
                                                Softwares:
                                                1. Octave - https://octave.org/download
                                                2. Sc...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32642" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32642 </strong>Cluster K8S C3 Inoperante
                                                (https://10.130.0.46:6443) API e Nodes in 10.130.2.0/24 não acessiveis
                                                necessitanto das maquinas ativas na virtualização para deployments de
                                                serviços devops no cluster k8...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32641" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32641 </strong>Não consigo inserir os pesos, com valores
                                                'quebrados' no sisure, por exemplo &quot;1,2&quot; ou &quot;2,4&quot;.
                                                Por favor, verificar com urgência essa questão e tentar corrigir.
                                                (https://sisure....
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32640" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32640 </strong>Boa tarde, estamos no processo de gerar pacotes
                                                de históricos da análise de históricos, ao selecionar o processo
                                                seletivo vigente e clicar em gerar pacotes, a mensagem de sucesso foi
                                                exibida instan...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32639" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32639 </strong>Boa tarde, os sites relacionados ao
                                                selest/processo de seleção de medicina estão fora do ar, favor verificar

                                                http://selestmedicina.unilab.edu.br/
                                                http://gerencia.selestmedicina.unilab.edu.br/lo...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32638" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32638 </strong>Preciso urgentemente que vejam essa mensagem
                                                conforme tela em anexo, no sisure
                                                (https://sisure.unilab.edu.br/loginSisureGestao.php) , no edital
                                                02/2023, não consigo cadastrar a oferta de um curso, pr...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32637" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32637 </strong>Bom dia, solicito a reversão do tipo de perfil
                                                do Selest DIEGO OLIVEIRA LIMA ou RENATA PRIMO DE SOUSA PAZ para ADMIN,
                                                pois os perfis foram convertido para Analisador de histórico, perdendo o
                                                acesso ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32636" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32636 </strong>Verificar o ponto de rede da sala da ATP/SGP
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32635" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32635 </strong>Monitor. Uma formiga andando na tela.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32634" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32634 </strong>Solicitamos a verificação nos telefones da
                                                Divisão de Patrimônio, no momento todos estão inoperantes.

                                                Ramais: 6224, 6106 e 6165.

                                                Certos de vossa atenção, agradecemos antecipadamente.

                                                A...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32633" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32633 </strong>Solicito a instalação do VPN para acesso ao
                                                Anydesk pois, como informado no chamado anterior que foi fechado, é
                                                necessário para configurar o PC para assinar o diploma digital.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32631" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32631 </strong>Solicito, laudo de um notebook para ser feito a
                                                devolução.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32630" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32630 </strong>Instalar programa para declaração de IRPF
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32629" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32629 </strong>Solicito, laudo de um notebook para ser feito a
                                                devolução.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32628" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32628 </strong>Geração de relatório com dados de estudantes de
                                                GRADUAÇÃO PRESENCIAL para monitoramento do Tempo de Permanência no
                                                Programa de Assistência Estudantil - PAES, contendo os seguintes itens:
                                                - CPF ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32627" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32627 </strong>Solicito instalação de áudio na minha estação de
                                                trabalho.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32626" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32626 </strong>não está imprimindo
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32625" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32625 </strong>1 Computador com defeito
                                                Necessidade de laudo técnico para devolução ao patrimônio.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32624" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32624 </strong>Bom dia, prezados, a CPU do consultório 2, ao
                                                ser ligada apresentou comportamento incomum e está constantemente
                                                &quot;processando&quot; mas não conclui o boot. Da outra vez que isso
                                                ocorreu em um d...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32623" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32623 </strong>INSTALAÇÃO DE UM PONTO DE REDE PARA O TELEFONE.
                                                OBSERVAÇÃO: SERVIÇO JÁ REALIZADO APENAS FORMALIZANDO.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32622" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32622 </strong>Estamos tendo problemas ao tentar conexão entre
                                                a máqina do catraca em malês e a base de dados do sigaa.


                                                Tentativa de conexão está sendo feita através dos seguintes IPS:

                                                200.129.19.80,...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32621" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32621 </strong>Estou tentando enviar comunicado aos estudantes
                                                via Sigaa, mas os alunos alegam que não receberam e também sempre vem
                                                mensagem de retorno e, desta vez, não recebemos mensagem de retorno, com
                                                o cont...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32620" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32620 </strong>instalar impressora multifuncional
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32619" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32619 </strong>Quando foi efetivado a alteração da senha o
                                                computador não reconhece a senha.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32618" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32618 </strong>Verificação de nobreak.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32617" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32617 </strong>Verificação de nobreak.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32616" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32616 </strong>Falha na rede eduroam e na rede cabeada
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32615" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32615 </strong>Instalar o software e o plugin no word no
                                                Mendeley( programa de referencias bibliograficas, gratuito)
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32614" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32614 </strong>Não permite registrar retorno do almoço. Consta
                                                como servidor de licença
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32613" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32613 </strong>Telefone indisponível
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32612" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32612 </strong>Solicitamos a atualização de lotação do usuário
                                                no SIPAC do colaborador terceirizado José Edilberto de Castro Silva,
                                                tendo em vista que atualmente o mesmo encontra-se na SEÇÃO DE
                                                ALMOXARIFADO ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32611" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32611 </strong>Solicito cadastro para acesso aos computadores
                                                do NucLi pelo Bolsista Francisco Manoel Martins dos Santos.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32610" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32610 </strong>Demanda Censo 2022. Relatórios/Consultas.
                                                Solicitamos elaboração de consulta/relatório, em formato planilha, que
                                                identifique no SIGAA, os casos de estudantes ingressantes e veteranos
                                                que estejam a...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32609" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32609 </strong>Bom dia, solicito troca da senha institucional.
                                                jaderlano.jardim
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32608" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32608 </strong>Referenciar o nome dti-pgadmin.unilab.edu.br
                                                para o ingress 200.129.19.5
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32607" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32607 </strong>Prezados, há alguns meses venho recebendo no
                                                email particular, mensagens de confirmação do sistema SISGEF, como se
                                                houvesse sido enviada para JOCELIA MARIA DE OLIVEIRA MELO.
                                                Email - wagner.fsales@...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32606" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32606 </strong>Atualização de drive para scanner.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32605" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32605 </strong>Disponibilização de rede sem fio para o evento:
                                                I Semana Acadêmica Internacional de GEGUICEN - 2023
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32604" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32604 </strong>Boa tarde!

                                                Prezadxs,

                                                Não estou conseguindo acessar a rede de Wi-Fi pelo celular e nem pelo
                                                computador. Eu já havia configurado para realizar a conexão automática e
                                                até a semana passada esta...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32603" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32603 </strong>Solicitamos a instalação de telefone VoiP.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32602" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32602 </strong>Monitor com mal contato.
                                                Bloco Anexo (casinha)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32601" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32601 </strong>Prezados, boa a tarde! solicitamos toner para
                                                impressora brother 8890dw nº 002028 localizada na sala da prefeitura de
                                                auroras.
                                                grato!
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32600" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32600 </strong>Solicito a retirada dos perfis (e-mails
                                                conectados ao computador via OneDrive), e também seja desabilitada o
                                                software Microsoft OneDrive na inicialização do Windows em todos os
                                                computadores do Labo...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32599" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32599 </strong>Informo que estou precisando registrar o
                                                Certificado da aluna Benacelia Rabelo da Silva Mat: 2014202727, do Curso
                                                de Pós-Graduação em Gestão em Saúde que já se encontra com status
                                                Concluído e ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32598" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32598 </strong>Bom dia.
                                                Gostaria de solicitar a retirada de senha de acesso do perfil LabGeo aos
                                                computadores do laboratório de geociências, que foram colocadas sem
                                                autorização de técnico ou docente. Os comput...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32597" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32597 </strong>Boa tarde.
                                                Gostaria que fosse feita a inspeção das conexões da internet cabeada em
                                                todos os computadores do laboratório de Geociências, pois esses
                                                equipamentos necessitam estar conectados a rede...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32596" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32596 </strong>Solicita-se a criação do e-mail da Coordenação
                                                do curso de Especialização em Gestão de Recursos Hídricos, Ambientais e
                                                Energéticos, conforme o formulário em anexo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32595" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32595 </strong>O office está pedindo para ser ativado.
                                                Gostaria de solicitar também a atualização do AutoCad.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32594" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32594 </strong>Um computador do unicafé está pedindo a
                                                atualização de data e hora. E pede para que comuniquemos ao
                                                administrador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32593" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32593 </strong>computador sem acesso à rede wi-fi da Unilab
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32592" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32592 </strong>Prezados (as), bom dia ! O colaborador Francisco
                                                Fábio da Silva
                                                não está conseguindo conectar na rede EDUROAM . Desconectou-se e não
                                                esta conectando mais. Tentamos novamente conectar, mas ele ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32591" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32591 </strong>Prezados/as, gostaria de saber como proceder
                                                para o cadastro dos alunos do curso de mestrado PPGEF, bem como os
                                                docentes desse curso, no SigEleição para votação na eleição de
                                                coordenador e vice-...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32590" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32590 </strong>Sistema catraca não está registrando cartões no
                                                período noturno no campus Auroras
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32589" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32589 </strong>solicitação de cadastramento de usuário
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32588" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32588 </strong>Solicitação de verificação de computador que não
                                                está ligando
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32587" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32587 </strong>Não estamos conseguindo logar no site da prograd
                                                por meio do link login do administrador.

                                                Peço que verifiquem o link
                                                https://prograd.unilab.edu.br/wp-login.php?redirect_to=https%3A%2F%2Fprograd.u...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32586" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32586 </strong>Configurar a impressora.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32585" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32585 </strong>[Urgente] Não estou conseguindo entrar no
                                                WordPress para editar o site da Prointer
                                                (prointer.unilab.edu.br/wp-admin). O site ficou desconfigurado, não mais
                                                exibindo barra horizontal da home e os men...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32584" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32584 </strong>Solicitação de cadastro para a
                                                servidora/terceirizada Camili dos Reis Gomes para acesso as maquinas da
                                                instituição.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32583" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32583 </strong>Evento de estudantes guineenses de ciências
                                                exatas e da natureza com professores da Unilab e estrangeiros a ocorrer
                                                nos dias 15, 16 e 17 de março.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32582" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32582 </strong>Solicito, por gentileza, a configuração de
                                                computador para impressora na sala da Prograd.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32581" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32581 </strong>SOLICITO REDE WIFI SEPARADA PARA UM EVENTO NOS
                                                DIAS 15,16 E 17 DE MARÇO
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32580" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32580 </strong>Prezados,

                                                Desde sexta-feira (10/03/2023) tento anexar uma declaração de consulta
                                                médica realizada no dia 07/03, no período da tarde, atividade esta,
                                                inclusive, que foi cadastrada no meu plano d...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32579" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32579 </strong>Necessito alteração no apontamento do domínio
                                                3shomologacao.unilba.edu.br para o ingress 200.129.19.3
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32578" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32578 </strong>Instalação de Software de Banco de Dados (
                                                MySql, PostreSql ou similar )
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32577" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32577 </strong>Prezados (as), bom dia! Gostaria de informar que
                                                a impressora Brother MFC - 8480DN, localizada na coordenação do mestrado
                                                em antropologia está apresentando falhas ao realizarmos as impressões
                                                por ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32576" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32576 </strong>Instalar token comprasnet (pregoeira)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32575" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32575 </strong>O Grupo de estudos da Linha de Pesquisa Gênero e
                                                Raça: fundamentos onto-históricos na sociedade de classes, vinculado ao
                                                Grupo Interdisciplinar Marxista/Unilab realiza seus estudos quinzenais,
                                                e pr...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32574" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32574 </strong>Solicito a liberação da base de dados de
                                                homologação do sigaa (200.129.19.9) , para acesso à view do 3s.

                                                Para os ips: 10.49.0.17 e 10.46.0.11
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32573" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32573 </strong>Impressora não está imprimindo quando envio
                                                documentos para impressora, ou seja não está fazendo conexão entre os
                                                períféricos.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32572" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32572 </strong>Solicito a instalação do Windows 10 no notebook
                                                da SRCA para que seja possível instalar o app Bird Id, necessário para
                                                assinar os diplomas digitais.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32571" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32571 </strong>Atualização de Unidade de Lotação do Usuário no
                                                SIPAC.

                                                Boa tarde,
                                                Tendo em vista a minha lotação em nova unidade, solicito a atualização
                                                da mesma no SIPAC.

                                                Me encontro atualmente na Di...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32570" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32570 </strong>Solicito um mouse para usar na máquina de tombo
                                                nº 2014000106, pois o atual apresenta falhas.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32567" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32567 </strong>Solicita-se extração do status SIGAA mais atual,
                                                em curso de GRADUAÇÃO PRESENCIAL, dos estudantes beneficiários do PAES
                                                listados no anexo. No caso de estudantes que não possuam status ATIVO ou
                                                F...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32566" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32566 </strong>Bom dia!

                                                Prezados,

                                                Conforme solicitado segue em anexo o formulário preenchido com as
                                                informações necessárias para criação de e-mail institucional para o
                                                grupo de extensão que eu coordeno.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32565" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32565 </strong> Não consigo acessar o meu sigaa pelo notebook,
                                                apenas pelo celular, está informando &quot;comportamento
                                                inesperado&quot;
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32564" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32564 </strong>Sistema está abrindo em perfil temporário
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32563" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32563 </strong>o Login ao SIGAA não está funcionando
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32562" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32562 </strong>Prezados, solicito o restore do banco de dados
                                                de homologação.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32561" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32561 </strong>Em breve, haverá eleição para direção e
                                                vice-direção do Instituto de Humanidades e Letras da UNILAB (Campus dos
                                                Malês). Assim sendo, como uma das representantes docentes na comissão
                                                escrutina...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32560" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32560 </strong>instalação de notebook na televisão.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32559" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32559 </strong>Configurar o equipamento de impressão ao
                                                computador da sala do Gabinete/SGP - Impressora DCP-L8400CDN
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32558" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32558 </strong>Configurar o equipamento de impressão ao
                                                computador da sala do Gabinete/SGP - Impressora Brother MFC 8890DW
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32557" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32557 </strong>O telefone da DAS está indisponível para efetuar
                                                e receber chamadas
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32556" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32556 </strong>Prezados, Solicitamos a inclusão da estagiária
                                                da Secretaria de Comunicação na lista de e-mail da Secom
                                                (secom@unilab.edu.br) com seu e-mail institucional. Solicitamos também
                                                que seja retirado o ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32555" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32555 </strong>Prezados,
                                                Solicito cordialmente a verificação de computador na sala da COEGS, no
                                                qual aparece a mensagem de erro &quot;nenhum dispositivo de saída de
                                                áudio habilitada&quot;. Ao tentar habilitar...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32554" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32554 </strong>Prezados,
                                                Solicito cordialmente a instalação do Programa OBS Studio, na sala da
                                                Prograd.

                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32553" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32553 </strong>Prezados/as, solicito envio de dados referentes
                                                à matrículas para atualização do Unilab em Números. Desde já, agradeço a
                                                atenção.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32552" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32552 </strong>Solicito criação de email institucional para a
                                                estagiária Anija Neila
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32551" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32551 </strong>Digitalizar pelo drive ou pendrive.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32550" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32550 </strong>Computador necessita de atualização de sistemas.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32549" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32549 </strong>A versão online do scketchup não está
                                                reconhecendo a minha conta da unilab para acesso ao aplicativo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32548" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32548 </strong>Bom dia ,
                                                Informo que não estou consigo encontrar uma discente no sistema SIGAA ,
                                                ele é estrangeira de São Tomé e Principe da Pós-Graduação Lato-Sensu /
                                                curso Segurança Alimentar e Nutricio...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32547" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32547 </strong>O computador foi ligado e não obedecia aos
                                                comandos para digitação e seleção de itens. Foi reiniciado através da
                                                CPU, mas não reinicia.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32546" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32546 </strong>Reativação temporária de conta de ex-servidora,
                                                docente Layla Daniele Pedreira de Carvalho, com e-mail institucional
                                                desativado (laylacarvalho@unilab.edu.br). Esta foi desligada do vinculo
                                                efetivo ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32545" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32545 </strong>cadastrar na homologacao base_comum acesso full
                                                leitura a todas as tabelas (public,comum,rh) para usuario de nome:
                                                &quot;devops&quot;. ref. ip 10.48.0.11
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32544" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32544 </strong>Solicito a troca de 1 mouse, pois o mesmo está
                                                com defeito.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32543" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32543 </strong>Boa tarde!

                                                Prezados,

                                                Necessito mudar o meu e-mail cadastrado no SIGAA, no entanto não
                                                conseigo fazer a alteração diretamente pela plataforma. O e-mail que foi
                                                cadastrado foi o meu pessoal (ma...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32542" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32542 </strong>Boa tarde!

                                                Prezados,

                                                Sou coordenadora de um projeto de extensão vínculado ao &quot;Grupo de
                                                Extensão em Segurança dos Alimentos - GESA&quot; e necessito de um
                                                e-mail institucional que possa ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32541" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32541 </strong>Gostaria de saber se há a possibilidade de
                                                liberar o cadastro retroativo de plano de trabalho em caso de
                                                esquecimento servidor, já que o sistema acusa a mensagem &quot;A data de
                                                início do plano de ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32540" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32540 </strong>Sem acesso a internet em palmares 3
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32539" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32539 </strong>Problemas de conexão da impressora com o
                                                computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32538" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32538 </strong>Ao logar no computador aparece o seguinte erro
                                                &quot;falha na relação de confiança entre o computador e o
                                                usuário&quot;, solicito correção.
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32537" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32537 </strong>Solicito o acesso à base de dados de homologação
                                                do SIG para utilização no servidor de homologação do sistema 3s.

                                                IP do servidor que irá acessar 10.148.0.11
                                                Base de dados que necessita ac...
                                            </div>


                                            <div class="alert alert-secondary alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32536" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32536 </strong>Problemas de conexão da impressora com o
                                                computador.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32534" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32534 </strong>O curso de Licenciatura em Computação já está
                                                devidamente cadastrado no SIGAA como um curso EAD, porém ainda não está
                                                na integração nem migrou nada para o AVA. Solicitamos a verificação da
                                                ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32532" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32532 </strong>Computador foi amortecido e quando ligado
                                                novamente não funcionou mais.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32531" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32531 </strong>O acesso ao domínio institucional para os
                                                estudantes da Empresa Jr. (ENGENEJr.). &quot;Login:
                                                guilherme.andrade&quot; está expirado. No caso, solicita-se a renovação
                                                do acesso.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32530" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32530 </strong>Falha do registro no dia 18/01/2023, na hora de
                                                bater provável que mesmo sem querer deixou marcado a saída do almoço
                                                como não. Deste modo, foi batido o ponto para o intervalo de almoço,
                                                porém n�...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32529" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32529 </strong>Prezados, solicito a instalação de dois pontos
                                                de redes para os computadores que foram remanejados para a nova sala das
                                                secretarias de coordenação de cursos do ICEN (salas 333/334), bloco B,
                                                em Au...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32528" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32528 </strong>Bom dia, estar sem Internet na academia
                                                universitária.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32526" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32526 </strong>Atualização de drive para scanner.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32525" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32525 </strong>Atualização de drive para scanner.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32524" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32524 </strong>Atualização de drive para scanner.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32523" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32523 </strong>Prezados(as),
                                                Um outro servidor abriu um chamado para manutenção preventiva, mas agora
                                                está de férias. Como faço para acompanhar esse chamado? O número é
                                                32484. Desde já agradeço.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32522" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32522 </strong>CPU não liga, apenas piscando uma luz no botão
                                                ligar
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32521" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32521 </strong>Aparente os telefones da Unilab não estão
                                                recebendo ligação. Sempre que ligo informa que o número está ocupado.
                                                Obs.: tentei em mais de um número e o comportamento é o mesmo.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32520" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32520 </strong>Pacote Anaconda - VSCode - Power Bi
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32519" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32519 </strong>Bom dia! Prezados, solicito manutenção de linha
                                                telefônica, pois o telefone do CAIS (3332-6218) não está recebendo
                                                ligações, apenas efetuando. Atenciosamente,
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32518" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32518 </strong>SOLICITAMOS A INCLUSÃO DE INFORMATIVO NA PÁGINA
                                                INICIAL DO SIGAA APÓS OS DISCENTES FAZEREM LOGIN PARA DIVULGAÇÃO DAS
                                                INSCRIÇÕES DO PAES

                                                INCLUIR O SEGUINTE TEXTO


                                                Fique Atento!!
                                                A Pró R...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32517" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32517 </strong>A Coordenação de Ensino de Graduação e Seleção
                                                solicita a inclusão das seguintes formas de ingresso para a GRADUAÇÃO no
                                                SIGAA:
                                                PORTADOR DE DIPLOMA - VAGA NOVA REOFERTADA
                                                REOPÇÃO - VAGA NO...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32516" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32516 </strong>Prezada Equipe do Setor de DTI,

                                                Bom dia!

                                                Na condição de Diretor em Exercício do Instituto de Humanidades desta
                                                universidade, portanto, superior hierárquico imediato da servidora
                                                Hildinete de...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32515" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32515 </strong>Solicitamos permissão de acesso (login e senha)
                                                a nova estagiária da Secom para as maquinas da Unilab
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32514" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32514 </strong>Instalar computador do chamado 31361
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32513" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32513 </strong>Esqueci a senha para acesso ao computador
                                                institucional.
                                                O usuário é stella.maia, mas a senha não lembro mais.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32511" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32511 </strong>Criação do nome de domínio:
                                                dti-pgadmin.unilab.edu.br com referencia para o load balance 10.130.1.2.
                                                Bloqueado para www externa
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32510" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32510 </strong>Minha chefia não consegue homologar minha
                                                frequência nos dias 07 e 08/02/2023, sendo que nesse dia foram feitas
                                                inclusões dos registros de tele-trabalho parcial e foram aceitos pela
                                                chefia; porém ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32509" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32509 </strong>Prezada Equipe e Responsáveis,

                                                Boa tarde!

                                                Abro este chamado, na condição de Diretor em Exercício do Instituto de
                                                Humanidades, para solicitar a liberação do acesso do servidor ADAILTON
                                                ÁQU...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32508" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32508 </strong>Drive de scanners apresentando problemas.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32507" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32507 </strong>O Sig/Susep está com bug. Ao tentar incluir as
                                                atividades da semana no PIT, só consegui incluir 1, pois as atividades
                                                em cascata só aparecem parcialmente. Mais da metade das atividades não
                                                estão ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32506" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32506 </strong>Registrei minha justificativa de falta por conta
                                                de tele-trabalho parcial, mas não aparece no espelho de ponto. A chefia
                                                também não consegue homologar minha frequência, pois aparece que já
                                                existe...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32505" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32505 </strong>Não é possível alterar senha de usuário no
                                                SIGAA.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32503" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32503 </strong>Verificar falha de confiança no computador do
                                                laboratório de Botânica, sl 202 bl D
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32502" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32502 </strong>Prezados, boa tarde. Tendo em vista a realização
                                                de atividades atinentes ao inventário 2022 na sala da Divisão de
                                                Patrimônio, em Palmares, não foi possível acessar o computador de
                                                tombamento: 2...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32501" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32501 </strong>Prezados, boa tarde.
                                                Tendo em vista a realização de atividades atinentes ao inventário 2022
                                                na sala da Divisão de Patrimônio, em Palmares, não foi possível acessar
                                                o computador de tombamento: ...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32500" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32500 </strong>Solicito acesso à &quot;Coordenação de
                                                Pós-Graduação&quot; à docente Anne Fayma Lopes Chaves, coordenadora de
                                                Pós-Graduação da PROPPG no portal Sig Admin (código 10.02.09.03)
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32499" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32499 </strong>Prezadxs, bom dia!

                                                O telefone da Secretaria do IHL-Malês não está funcionando. Solicito
                                                verificar, por favor.

                                                Atenciosamente,

                                                Alexandre Rosa
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32498" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32498 </strong>Prezados,
                                                Solicitamos a inclusão da estagiária da Secretaria de Comunicação
                                                (anijaneilasousa@gmail.com) na lista de e-mail da Secom
                                                (secom@unilab.edu.br) para a mesma receber as demandas da unida...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32497" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32497 </strong>habilitação de 2 pontos de rede.
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32496" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32496 </strong>Cadastrar meu login para poder realizar
                                                impressão na impressora
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32495" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32495 </strong>Recuperação de domínio
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32494" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32494 </strong>No dia 03 de março não consegui bater o ponto na
                                                minha entrada pois o Campus das Auroras estava sem acesso a internet.
                                                Tentei pelo meu celular e também pela minha estação de trabalho. Só fui
                                                reg...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32493" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32493 </strong>Solicitamos atualização no Drive do Scanner
                                                Brother ADS 3000N
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32492" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32492 </strong>Acesso de administrador para consultas e
                                                manutenções ao sistema de apoio PGD
                                                (https://apoio-pgd.unilab.edu.br/login) para os usuários Jheck Marvan de
                                                Albuquerque Costa e Francisco Maurício Lima Fa...
                                            </div>


                                            <div class="alert alert-success alert-dismissable">
                                                <a href="?page=ocorrencia&selecionar=32491" class="close"><i
                                                        class="fa fa-search icone-maior"></i></a>

                                                <strong>#32491 </strong>Bom dia. Informo que hoje tentei registrar meu
                                                ponto e o sistema SIGRH informa que estou em período de férias. Ocorre
                                                que tenho férias programadas apenas para dia 19/06/2023.
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <aside class="col-md-4 blog-sidebar">
                        <div class="p-4 mb-3 bg-light rounded">
                            <h4 class="font-italic">Filtros</h4>
                            <form id="form-filtro-basico">

                                <input type="hidden" value="1" id="meu-setor" name="meu-setor">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="filtro-meu-setor">
                                    <label class="custom-control-label" for="filtro-meu-setor">Demandas (DTI)
                                    </label>
                                </div>


                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input"
                                        id="filtro-minhas-demandas">
                                    <label class="custom-control-label" for="filtro-minhas-demandas">Meus
                                        Atendimentos</label>
                                </div>



                                <div class="custom-control custom-switch mb-3">
                                    <input type="checkbox" class="custom-control-input"
                                        id="filtro-minhas-solicitacoes">
                                    <label class="custom-control-label" for="filtro-minhas-solicitacoes">Minhas
                                        Solicitações</label>
                                </div>


                                <div class="form-group">
                                    <label for="select-tecnico">Técnico Responsável</label>
                                    <select id="select-tecnico">
                                        <option value="">Selecione um atendente</option>
                                        <option value="3349">ALEXSANDRO SILVA SANTOS </option>
                                        <option value="5409">MAUANA SILVA DA PURIFICAÇÃO SOUZA </option>
                                        <option value="3365">LUAN JACINTO CARVALHO </option>
                                        <option value="2255">WAGNER FERREIRA SALES </option>
                                        <option value="3377">JACKSON UCHOA PONTE </option>
                                        <option value="3368">FRANCISCO GIOVANILDO TEIXEIRA DE SOUZA </option>
                                        <option value="3425">DAVID FLAVIO DE LIMA MENEZES </option>
                                        <option value="3389">CICERO ROBSON BARROS FEITOSA </option>
                                        <option value="3364">LUAN SIDNEY NASCIMENTO DOS SANTOS </option>
                                        <option value="3370">PHYLLIPE DO CARMO FELIX </option>
                                        <option value="3404">NORMANIA LUCIA PEIXOTO PEREIRA </option>
                                        <option value="3369">RICARDO PEREIRA ARAGAO </option>
                                        <option value="3373">TIAGO LUCIO PEREIRA MELO </option>
                                        <option value="6109">GERDIANI DA SILVA MOURA </option>
                                        <option value="28">CARLOS EDUARDO BARBOSA </option>
                                        <option value="3391">REGINALDO SILVA DOS ANJOS </option>
                                        <option value="181">ANTONIO RAFAEL OLIVEIRA MACIEL </option>
                                        <option value="3374">TIAGO MESQUITA DE OLIVEIRA </option>
                                        <option value="3579">EMANOEL MARQUES FREITAS </option>
                                        <option value="3371">MARIA CAMILA ALCANTARA DA SILVA </option>
                                        <option value="3522">ERIVANDO DE SENA RAMOS </option>
                                        <option value="3651">ALAN LUCAS DE OLIVEIRA LIMA </option>
                                        <option value="2246">DIEGO SOUSA DE CASTRO </option>
                                        <option value="17779">ROBERIO BEZERRA SEVERINO </option>
                                        <option value="17752">EMANUELA DA ROCHA MASCARENHAS </option>
                                        <option value="446">MILTON HONORIO CAVALCANTE NETO </option>
                                        <option value="17806">DANIELE SOUZA DE ARAUJO </option>
                                        <option value="17847">FRANCISCO JACKSON FREITAS ALENCAR </option>
                                        <option value="17732">ALEX SANDRO PEREIRA RAMOS </option>
                                        <option value="191">ANTONIO GELSON DA SILVA LIMA </option>
                                        <option value="3403">FRANCISCO KLEBER RODRIGUES DE CASTRO </option>
                                        <option value="4101">IGOR SOUSA OSTERNO </option>
                                        <option value="3130">GIANCARLO CARDOSO VECCHIA </option>
                                        <option value="65">DÉBORA FARIAS FROTA </option>
                                        <option value="3409">FRANCISCO PAULO HENRIQUE DE ANDRADE </option>
                                        <option value="3322">IGO DA CRUZ DOS SANTOS </option>
                                        <option value="3424">JOSE EDUARDO SILVA LIMA </option>
                                        <option value="3366">JOSE ABEL MENDONÇA PAIXAO </option>
                                        <option value="1702">JOSÉ LUCIANO DA SILVA FILHO </option>
                                        <option value="3328">LAILSON DOS SANTOS </option>
                                        <option value="3396">LENILSON DE SOUSA MARIANO </option>
                                        <option value="3426">PAULA TATYENE SILVA DANTAS </option>
                                        <option value="11034">BISMARCK DOS SANTOS ALMEIDA </option>
                                        <option value="29">THIAGO DE ALBUQUERQUE GOMES </option>
                                        <option value="3559">ALAN CLEBER MORAIS GOMES </option>
                                        <option value="3400">MICHEL PEREIRA MACHADO </option>
                                        <option value="3375">JEFFERSON UCHOA PONTE </option>
                                        <option value="3558">RAIMUNDO PAULO NETO </option>
                                    </select>
                                </div>
                            </form>
                            <hr />
                            <form id="form-filtro-avancado">
                                <div class="form-group">
                                    <label for="filtro-data-1">Setor Requisitante</label>
                                    <select id="select-setores-filtro">
                                        <option value="">Selecione o Setor</option>
                                        <option value="244">DAN </option>
                                        <option value="1">teste </option>
                                        <option value="215">NASE </option>
                                        <option value="9">PROGRAD </option>
                                        <option value="112">DCM </option>
                                        <option value="128">SEAP </option>
                                        <option value="418">SRCA </option>
                                        <option value="361">IHLM </option>
                                        <option value="103">DTI </option>
                                        <option value="59">DISIR </option>
                                        <option value="393">DIPG </option>
                                        <option value="109">PROEX </option>
                                        <option value="202">SSEL </option>
                                        <option value="348">SAVI </option>
                                        <option value="115">DISIBIUNI </option>
                                        <option value="98">SPA </option>
                                        <option value="384">CSAEI </option>
                                        <option value="383">SPSI </option>
                                        <option value="29">IEDS </option>
                                        <option value="262">SERAC </option>
                                        <option value="95">DSINFO </option>
                                        <option value="111">PROPPG </option>
                                        <option value="280">DFE </option>
                                        <option value="321">SAU </option>
                                        <option value="368">SEACIH </option>
                                        <option value="362">ATP </option>
                                        <option value="108">PROPAE </option>
                                        <option value="350">SGP </option>
                                        <option value="409">NPRDA </option>
                                        <option value="360">ILL </option>
                                        <option value="141">SEADM-ICEN </option>
                                        <option value="133">SEADM-ICS </option>
                                        <option value="8">PROADI </option>
                                        <option value="24">CEXT </option>
                                        <option value="4">GR </option>
                                        <option value="281">Ouvidoria </option>
                                        <option value="417">CDHAA </option>
                                        <option value="402">SCAP </option>
                                        <option value="7">SCI </option>
                                        <option value="26">ICS </option>
                                        <option value="28">IDR </option>
                                        <option value="220">DACM </option>
                                        <option value="448">DACNI </option>
                                        <option value="157">CPE </option>
                                        <option value="437">CORAC </option>
                                        <option value="278">SECD </option>
                                        <option value="25">ICSA </option>
                                        <option value="258">SEBI </option>
                                        <option value="443">CPICC </option>
                                        <option value="425">CPEQ </option>
                                        <option value="276">DIFI </option>
                                        <option value="248">SEPROTEC </option>
                                        <option value="156">SECPRO </option>
                                        <option value="419">SGIT </option>
                                        <option value="359">IH </option>
                                        <option value="57">DEFIN </option>
                                        <option value="286">SCA </option>

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="filtro-data-1">Setor Responsável</label>
                                    <select id="select-setores-filtro2">
                                        <option value="">Selecione o Solicitante</option>
                                        <option value="1">DTI</option>
                                        <option value="6">STI-MALÊS</option>
                                        <option value="8">DEAAD</option>
                                        <option value="7">PROGRAD</option>
                                        <option value="12">DPG</option>
                                        <option value="11">SAU/LABPATI</option>
                                        <option value="14">SESIC/DISIR</option>
                                        <option value="3">DISIR</option>
                                        <option value="2">SAU</option>
                                        <option value="4">DSI/SPSI</option>
                                        <option value="15">SPRT1</option>
                                        <option value="9">DSI/SABD</option>
                                        <option value="10">DSI/SPA</option>
                                        <option value="13">DSI</option>

                                    </select>
                                </div>

                                <hr>
                                <label for="filtro-data-1">Data de Abertura</label>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="filtro-data-1">Data Inicial</label>
                                        <input type="date" class="form-control" id="filtro-data-1"
                                            name="filtro-data-1" value="">

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="filtro-data-2">Data Final</label>
                                        <input type="date" class="form-control" id="filtro-data-2"
                                            name="filtro-data-2" value="">

                                    </div>
                                </div>

                            </form>
                            <form id="form-filtro-campus">
                                <hr>
                                <label for="filtro-data-1">Campus</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="filtro-campus-liberdade">
                                    <label class="form-check-label" for="filtro-campus-liberdade">
                                        Liberdade
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="filtro-campus-palmares">
                                    <label class="form-check-label" for="filtro-campus-palmares">
                                        Palmares
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="filtro-campus-auroras">
                                    <label class="form-check-label" for="filtro-campus-auroras">
                                        Auroras
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="filtro-campus-males">
                                    <label class=""font-weight-normal" for="filtro-campus-males">
                                        Malês
                                    </label>
                                </div>


                            </form>



                        </div>






                        <div class="p-4 mb-3 bg-light rounded">
                            <h4 class="font-italic">Sobre o Novíssimo 3s</h4>
                            <p class="mb-0">
                                Esta é uma aplicação completamente nova desenvolvida pela DTI do zero.
                                Tudo foi refeito, desde o design até a estrutura de banco de dados.
                                Os chamados antigos foram preservados em uma nova estrutura de banco de dados.

                            </p>
                        </div>
                    </aside><!-- /.blog-sidebar -->
                </div>


            </div>
        </div>








    </main><!-- /.container -->

    <footer class="blog-footer">
        <p>Desenvolvido pela <a href="https://dti.unilab.edu.br/"> Diretoria de Tecnologia da Informação DTI </a> / <a
                href="http://unilab.edu.br">Unilab</a></p>

    </footer>



    <!-- Modal -->
    <div class="modal fade" id="modalResposta" tabindex="-1" role="dialog"
        aria-labelledby="labelModalResposta" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModalResposta">Resposta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="textoModalResposta"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="botao-modal-resposta" class="btn btn-primary"
                        data-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div>
    </div>

    {{--

<script src="js/ocorrencia_selectize.js?a=1"></script>

<script src="js/status_ocorrencia.js?a=1"></script>
<script src="js/jquery.easyPaginate.js?a=1"></script>
<script src="js/ocorrencia.js?a=14"></script> --}}



</body>

</html>
