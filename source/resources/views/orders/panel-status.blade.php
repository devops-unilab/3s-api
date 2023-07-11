<div class="alert  bg-light d-flex justify-content-between align-items-center" role="alert">
    <div class="btn-group">
        <button class="btn btn-light btn-lg dropdown-toggle p-2" type="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            {{ __('Order') }} {{ $order->id }}
        </button>
        <div class="dropdown-menu">

            <button type="button" acao="cancel" class="dropdown-item  botao-status" data-toggle="modal"
                @cannot('cancel', $order)
                    disabled
                @endcan
                data-target="#modalStatus">
                Cancelar
            </button>

            <button type="button" id="avaliar-btn" acao="commit" class="dropdown-item" data-toggle="modal"
                data-target="#modalStatus"
                @cannot('commit', $order)
                    disabled
                @endcan
                >
                Confirmar
            </button>

            <button id="botao-reabrir" type="button" acao="open" class="dropdown-item" data-toggle="modal"
                data-target="#modalStatus"
                @cannot('open', $order)
                    disabled
                @endcan
                >
                Reabrir
            </button>
            @if (request()->session()->get('role') === 'provider' ||
                    request()->session()->get('role') === 'administrator')


                <button type="button" acao="inProgress" class="dropdown-item  botao-status" data-toggle="modal"
                    data-target="#modalStatus"
                    @cannot('inProgress', $order)
                        disabled
                    @endcan
                    >
                    Atender
                </button>

                <button type="button" acao="close" class="dropdown-item  botao-status" data-toggle="modal"
                    data-target="#modalStatus"
                    @cannot('close', $order)
                        disabled
                    @endcan
                    >
                    Fechar
                </button>
                @if (request()->session()->get('role') === 'administrator')
                    <button type="button" acao="reserve" id="botao-reservar" class="dropdown-item" data-toggle="modal"
                        data-target="#modalStatus"
                        @cannot('reserve', $order)
                            disabled
                        @endcan
                        >
                        Reservar
                    </button>

                    <button type="button" acao="opened" class="dropdown-item  botao-status" data-toggle="modal"
                        data-target="#modalStatus"
                        @cannot('open', $order)
                            disabled
                        @endcan
                        >
                        Liberar Ocorrência
                    </button>
                @endif


                <div class="dropdown-divider"></div>
                <button type="button" acao="pendingCustomer" class="dropdown-item  botao-status"
                    data-toggle="modal" data-target="#modalStatus"
                    @cannot('pendingCustomer', $order)
                            disabled
                    @endcan
                    >
                    Aguardar Usuário
                </button>
                <button type="button" acao="pendingResource" class="dropdown-item  botao-status"
                    data-toggle="modal" data-target="#modalStatus"
                    @cannot('pendingResource', $order)
                        disabled
                    @endcan
                    >
                    Aguardar Ativos de TI
                </button>
            @endif
                </div>
        </div>
        <button class="btn btn-light btn-lg p-2" type="button" disabled>
            Status: {{ __($order->status) }}
        </button>
    </div>
