<!doctype html>
<html lang="pt-br">

<head>

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <link rel="icon" type="image/x-icon" href="{{ env('APP_URL') }}/img/favicon.ico">
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/vendor/bootstrap-4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/css/style.css?a=123" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/css/style_kamban.css" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/css/list.css" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/css/chat.css" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/css/selectize.default.css" />
    <link href="{{ env('APP_URL') }}/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">

    <link href="{{ env('APP_URL') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ env('APP_URL') }}/css/style_form_login.css" rel="stylesheet">
    <!-- Desenvolvido por Jefferson Uchôa Ponte-->
    <meta http-equiv="Cache-control" content="no-cache">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '3s') }}</title>
    <!-- Styles -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

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
                    <a class="text-muted" href="#"><img src="{{ asset('img/logo-header.png') }}"
                            alt="Logo 3s" /></a>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex align-items-end  justify-content-center">
                    <p class="blog-header-logo text-white font-weight-bold"></p>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                    <a class="text-muted" href="#"><img src="{{ asset('img/logo-unilab-branco.png') }}"
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
        @if (auth()->check())
            @include('partials.navbar')
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        @yield('content')

                    </div>
                </div>
            </div>
        </div>

    </main>
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
</body>
<script src="{{ env('APP_URL') }}/js/barra_2.0.js"></script>
<script src="{{ env('APP_URL') }}/js/jquery-3.5.1.min.js"></script>
<script src="{{ env('APP_URL') }}/vendor/popper.min.js"></script>
<script src="{{ env('APP_URL') }}/vendor/bootstrap-4.6.0/js/bootstrap.min.js"></script>
<script src="{{ env('APP_URL') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ env('APP_URL') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ env('APP_URL') }}/js/demo/datatables-demo.js"></script>
<script src="{{ env('APP_URL') }}/js/selectize.js"></script>
<script src="{{ env('APP_URL') }}/js/login_load.js?a=12"></script>
<script src="{{ env('APP_URL') }}/js/change-contraste.js?a=1"></script>
<script src="{{ env('APP_URL') }}/js/ocorrencia_selectize.js?a=1"></script>
<script src="{{ env('APP_URL') }}/js/jquery.easyPaginate.js?a=1"></script>
<script src="{{ env('APP_URL') }}/js/ocorrencia.js?a=14513"></script>
@if (isset(request()->page) && request()->page == 'ocorrencia' && isset(request()->selecionar))
    <script src="{{ env('APP_URL') }}/js/mensagem_forum.js?a=172"></script>
@endif
<script src="{{ env('APP_URL') }}/js/status_ocorrencia.js?a=1"></script>
@yield('scripts')

</html>
