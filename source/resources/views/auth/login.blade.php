<!doctype html>
<html lang="pt-br">

<head>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <meta charset="utf-8">
    <title>3s | Sistema de Solicitação de Ocorrências</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://3s.unilab.edu.br/css/style.css?a=123" />
    <link rel="stylesheet" type="text/css" href="https://3s.unilab.edu.br/css/style_kamban.css" />
    <link rel="stylesheet" type="text/css" href="https://3s.unilab.edu.br/css/list.css" />
    <link rel="stylesheet" type="text/css" href="https://3s.unilab.edu.br/css/chat.css" />
    <link rel="stylesheet" type="text/css" href="https://3s.unilab.edu.br/css/selectize.default.css" />

    <link href="https://3s.unilab.edu.br/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://3s.unilab.edu.br/css/style_form_login.css" rel="stylesheet">
    <!-- Desenvolvido por Jefferson Uchôa Ponte-->
    <meta http-equiv="Cache-control" content="no-cache">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!--     Barra do Governo -->
    <div id="barra-brasil" style="background: #7F7F7F; height: 20px; padding: 0 0 0 10px; display: block;">
        <ul id="menu-barra-temp" style="list-style: none;">
            <li
                style="display: inline; float: left; padding-right: 10px; margin-right: 10px; border-right: 1px solid #EDEDED">
                <a href="http://brasil.gov.br"
                    style="font-family: sans, sans-serif; text-decoration: none; color: white;">Portal
                    do Governo Brasileiro</a>
            </li>
        </ul>
    </div>
    <!--     Fim da Barra do Governo -->



    <div id="cabecalho" class="container">



        <header>

            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12  d-flex justify-content-center">
                    <a class="text-muted" href="#"><img src="https://3s.unilab.edu.br/img/logo-header.png"
                            alt="Logo 3s" /></a>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex align-items-end  justify-content-center">
                    <p class="blog-header-logo text-white font-weight-bold"></p>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                    <a class="text-muted" href="#"><img src="https://3s.unilab.edu.br/img/logo-unilab-branco.png"
                            alt="Logo Unilab" /></a>
                    <button class="btn m-4 btn-contraste" href="#altocontraste" id="altocontraste" accesskey="3"
                        onclick="window.toggleContrast()" onkeydown="window.toggleContrast()" class=" text-white ">
                        <i class="fa fa-adjust text-white"></i>
                    </button>

                </div>
            </div>
        </header>


    </div>

    <main role="main" class="container">


        <div class="container">
            <div class="row">
                <div class="card mb-4">
                    <div class="card-body">

                        <br><br>

                        <div class="container forget-password">
                            <div class="row justify-content-center">
                                <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12">
                                    <div class="panel-body p-3 m-3">
                                        <div class="text-center">


                                            <div class="panel">
                                                <h3>Entrar no sistema 3s</h3>

                                            </div>

                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input autofocus type="text" size="350" name="login"
                                                        class="form-control" value="{{ old('login') }}"
                                                        placeholder="Usuario do SIG" autofocus="autofocus">
                                                </div>

                                                <div class="form-group">
                                                    <input type="password" class="form-control" type="password"
                                                        name="password" required autocomplete="current-password"
                                                        placeholder="Senha do SIG">
                                                </div>
                                                <!-- Email Address -->

                                                <!-- Remember Me -->
                                                <div class="block mt-4">
                                                    <label for="remember_me" class="inline-flex items-center">
                                                        <input id="remember_me" type="checkbox"
                                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                            name="remember">
                                                        <span
                                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                                    </label>
                                                </div>



                                                <div class="forgot">
                                                    <a
                                                        href="https://sigadmin.unilab.edu.br/admin/public/recuperar_senha.jsf">Esqueceu
                                                        a senha?</a>
                                                </div><br>
                                                <button type="submit" id="botao-login"
                                                    class="btn-primary btn-lg btn-block">
                                                    Entrar
                                                </button>

                                                <input type="hidden" class="btn btn-info btn-md" name="logar"
                                                    value="Entrar">
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br><br><br><br><br><br><br>



                    </div>
                </div>

            </div>
        </div>




    </main><!-- /.container -->

    <footer class="blog-footer">
        <p>Desenvolvido pela <a href="https://dti.unilab.edu.br/"> Diretoria de Tecnologia da Informação DTI </a> / <a
                href="http://unilab.edu.br">Unilab</a></p>

    </footer>



    <!-- Modal -->
    <div class="modal fade" id="modalResposta" tabindex="-1" role="dialog" aria-labelledby="labelModalResposta"
        aria-hidden="true">
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
    <script src="https://3s.unilab.edu.br/js/barra_2.0.js"></script>
    <script src="https://3s.unilab.edu.br/js/change-contraste.js?a=1"></script>

</body>

</html>


{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />





</x-guest-layout> --}}
