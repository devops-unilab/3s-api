@php
    $userFirstName = auth()->user()->name;
    $arr = explode(' ', auth()->user()->name);
    if (isset($arr[0])) {
        $userFirstName = $arr[0];
    }
    $userFirstName = ucfirst(strtolower($userFirstName));
@endphp
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

            @if (request()->session()->get('role') === 'administrator' || request()->session()->get('role') === 'provider')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Paineis
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('kamban')}}">Kanban</a>
                        <a class="dropdown-item" href="{{route('table')}}">Tabela</a>
                    </div>
                </li>
            @endif
            @if (request()->session()->get('role') === 'administrator')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Gerenciamento
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href={{ route('services.index') }}>Serviços</a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href={{ route('divisions.index') }}>Unidades</a>
                        <a class="dropdown-item" href={{ route('users.index') }}>Usuários</a>
                    </div>
                </li>
            @endif

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
            <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fa fa-user"></i> Olá, {{ $userFirstName }}
            </button>
            <div class="dropdown-menu dropright">
                <button type="button" disabled class="dropdown-item">
                    Setor: {{ auth()->user()->division_sig }}
                </button>
                <hr>
                @if (auth()->user()->role === 'administrator')
                    <form method="POST" action="/change-level">
                        @csrf
                        <input type="hidden" name="role" value="administrator" />
                        <button type="submit" class="dropdown-item change-level"
                            {{ request()->session()->get('role') === 'administrator' ? 'disabled' : '' }}>
                            Perfil Admin
                        </button>
                    </form>
                @endif
                @if (auth()->user()->role === 'provider' || auth()->user()->role === 'administrator')
                    <form method="POST" action="/change-level">
                        @csrf
                        <input type="hidden" name="role" value="provider" />
                        <button type="submit" class="dropdown-item change-level"
                            {{ request()->session()->get('role') === 'provider' ? 'disabled' : '' }}>
                            Perfil Técnico
                        </button>
                    </form>
                @endif
                <form method="POST" action="/change-level">
                    @csrf
                    <input type="hidden" name="role" value="customer" />
                    <button type="submit" class="dropdown-item change-level"
                        {{ request()->session()->get('role') === 'customer' ? 'disabled' : '' }}>
                        Perfil Comum
                    </button>
                </form>
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
