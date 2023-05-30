<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '3s') }}</title>



    <!-- Styles -->
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
                    <a class="text-muted" href="#"><img src="{{asset("images/logo-header.png")}}"
                            alt="Logo 3s" /></a>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex align-items-end  justify-content-center">
                    <p class="blog-header-logo text-white font-weight-bold"></p>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                    <a class="text-muted" href="#"><img src="{{asset("images/logo-unilab-branco.png")}}"
                            alt="Logo Unilab" /></a>
                    <button class="btn m-4 btn-contraste" href="#altocontraste" id="altocontraste" accesskey="3"
                        onclick="window.toggleContrast()" onkeydown="window.toggleContrast()" class=" text-white ">
                        <i class="fa fa-adjust text-white"></i>
                    </button>

                </div>
            </div>
        </header>
        @include('admin.navbar')
        <main class="card container pb-2">
            <br>
            @yield('content')
        </main>
    </div>
    <footer class="blog-footer">
        <p>Desenvolvido pela <a href="https://dti.unilab.edu.br/"> Diretoria de Tecnologia da Informação DTI </a> / <a
                href="http://unilab.edu.br">Unilab</a></p>

    </footer>

    <script src="https://3s.unilab.edu.br/js/change-contraste.js?a=1"></script>
</body>

</html>
