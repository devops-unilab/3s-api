@extends('layouts.app')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        {{ __('Order') }} {{ $order->id }}
    </h3>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12 blog-main">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="alert  bg-light d-flex justify-content-between align-items-center" role="alert">
                                    <div class="btn-group">
                                        <button class="btn btn-light btn-lg dropdown-toggle p-2" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ __('Order') }} {{ $order->id }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" acao="cancelar" class="dropdown-item  botao-status"
                                                data-toggle="modal" data-target="#modalStatus">
                                                Cancelar
                                            </button>
                                            <button type="button" acao="atender" class="dropdown-item  botao-status"
                                                data-toggle="modal" data-target="#modalStatus">
                                                Atender
                                            </button>

                                            <button type="button" acao="fechar" class="dropdown-item  botao-status"
                                                data-toggle="modal" data-target="#modalStatus">
                                                Fechar
                                            </button>
                                            <button type="button" id="avaliar-btn" acao="avaliar" class="dropdown-item"
                                                data-toggle="modal" data-target="#modalStatus">
                                                Confirmar
                                            </button>

                                            <button id="botao-reabrir" type="button" acao="reabrir" class="dropdown-item"
                                                data-toggle="modal" data-target="#modalStatus">
                                                Reabrir
                                            </button>

                                            <button type="button" acao="reservar" id="botao-reservar" class="dropdown-item"
                                                data-toggle="modal" data-target="#modalStatus">
                                                Reservar
                                            </button>

                                            <button type="button" acao="liberar_atendimento"
                                                class="dropdown-item  botao-status" data-toggle="modal"
                                                data-target="#modalStatus">
                                                Liberar Ocorrência
                                            </button>

                                            <div class="dropdown-divider"></div>

                                            <button type="button" acao="aguardar_usuario"
                                                class="dropdown-item  botao-status" data-toggle="modal"
                                                data-target="#modalStatus">
                                                Aguardar Usuário
                                            </button>
                                            <button type="button" acao="aguardar_ativos"
                                                class="dropdown-item  botao-status" data-toggle="modal"
                                                data-target="#modalStatus">
                                                Aguardar Ativos de TI
                                            </button>
                                        </div>
                                    </div>
                                    <button class="btn btn-light btn-lg p-2" type="button" disabled>
                                        Status: {{ __($order->status) }}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row  border-bottom mb-3"></div>
                </div>


                <div class="col-md-8">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                            <div class="card mb-4">
                                <div class="card-body">
                                    <b> Descricao: </b>{{ $order->description }}<br>

                                    @if (trim($order->attachment) != '')
                                        <b>Anexo: </b><a target="_blank"
                                            href="{{ asset('storage/uploads/' . $order->attachment) }}">Clique aqui</a><br>
                                    @endif
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <b>Patrimônio: </b>{{ $order->tag }}<br>

                                    <button id="botao-editar-patrimonio" type="button" acao="editar_patrimonio"
                                        class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                                        Editar Patrimônio
                                    </button>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <b>Solucao: </b>{{ $order->solucao }}<br>

                                    <button id="botao-editar-solucao" type="button" acao="editar_solucao"
                                        class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                                        Editar Solução
                                    </button>



                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <b>Serviço: </b>{{ $order->service->name }} - {{ $order->service->description }}<br>

                                    <button type="button" id="botao-editar-servico" acao="editar_servico"
                                        class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                                        Editar Serviço
                                    </button>

                                    <hr>

                                    {{-- @if ($order->tempo_sla > 1)
                                            <b>SLA: </b>{{ $order->tempo_sla }} Horas úteis<br>
                                        @endif
                                        @if ($order->tempo_sla === 1)
                                            <b>SLA: </b> 1 Hora útil<br>
                                        @endif
                                        @if ($order->tempo_sla === 0)
                                            SLA não definido. <br>
                                        @endif --}}

                                    <b>Data de Abertura: </b>{{ date('d/m/Y', strtotime($order->data_abertura)) }}
                                    {{ date('H', strtotime($order->data_abertura)) }}h{{ date('i', strtotime($order->data_abertura)) }}min<br>

                                    <span class="{{ 'text-danger' }}">
                                        <b>Solução Estimada: </b>
                                        {{ date('d/m/Y', strtotime($solutionDate)) }}
                                        {{ date('H', strtotime($solutionDate)) }}h{{ date('i', strtotime($solutionDate)) }}min
                                    </span><br>


                                    <button type="button" id="botao-pedir-ajuda" class="dropdown-item text-right"
                                        data-toggle="modal" data-target="#modalPedirAjuda">
                                        Pedir Ajuda
                                    </button>
                                    <div class="modal fade" id="modalPedirAjuda" tabindex="-1" role="dialog"
                                        aria-labelledby="labelPedirAjuda" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="labelPedirAjuda">Pedir Ajuda</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="form_pedir_ajuda" class="user" method="post">
                                                        <input type="hidden" name="pedir_ajuda" value="1">
                                                        <input type="hidden" name="ocorrencia"
                                                            value="{{ $order->id }}">

                                                        <span>Clique em solicitar ajuda para enviar um e-mail aos
                                                            responsáveis
                                                            pelo
                                                            setor</span>

                                                    </form>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Fechar</button>
                                                    <button form="form_pedir_ajuda" type="submit"
                                                        class="btn btn-primary">Solicitar
                                                        Ajuda</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <b>Requisitante: </b>{{ $order->client_name }}<br />
                                    <b>Setor do Requisitante:</b>{{ $order->local }}<br>
                                    <b>Campus: </b>{{ $order->campus }} <br>
                                    <b>Email: </b>{{ $order->email }}<br>
                                    <b>Local/Sala: </b>{{ $order->local_sala }}<br>
                                    <b>Ramal: </b>{{ $order->ramal }}<br>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-body">
                                    <b>Setor Responsável: </b>{{ $order->provider->division->name ?? '' }}<br>
                                    <b>Técnico Responsável: </b>{{ $order->provider->name ?? '' }}<br>

                                    <button id="botao-editar-area" type="button" acao="editar_area"
                                        class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                                        Editar Setor Responsável
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-md-4 blog-sidebar">
                    <h4 class="font-italic">Histórico</h4>
                    <div class="container">
                        @foreach ($order->statusLogs as $status)
                            @php
                                $strCartao = ' alert-warning ';
                                if ($status->status === 'opened') {
                                    $strCartao = '  notice-warning';
                                } elseif ($status->status === 'in progress') {
                                    $strCartao = '  notice-info ';
                                } elseif ($status->status == 'closed') {
                                    $strCartao = 'notice-success ';
                                } elseif ($status->status === 'committed') {
                                    $strCartao = 'notice-success ';
                                } elseif ($status->status == 'canceled') {
                                    $strCartao = ' notice-warning ';
                                } elseif ($status->status == 'reserved') {
                                    $strCartao = '  notice-warning ';
                                } elseif ($status->status === 'pending customer response') {
                                    $strCartao = '  notice-warning ';
                                } elseif ($status->status == 'pending it resource') {
                                    $strCartao = ' notice-warning';
                                }
                            @endphp
                            <div class="notice {{ $strCartao }}">
                                <strong>{{ __($status->status) }} </strong><br>
                                @if ($status->status == 'commited')
                                    <br>
                                    @for ($i = 0; $i < intval($order->avaliacao); $i++)
                                        <img class="m-2 estrela-1" nota="1" src="{{ asset('img/star1.png') }}"
                                            alt="1">
                                    @endfor
                                @endif

                                <br>{{ $status->message }}<br>
                                <strong>{{ $status->nome_usuario }}<br>{{ date('d/m/Y - H:i', strtotime($status->updated_at)) }}</strong>
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteChat" tabindex="-1" aria-labelledby="modalDeleteChatLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteChatLabel">Apagar Mensagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja apagar esta mensagem?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="" method="post">
                        <input type="hidden" id="chatDelete" name="chatDelete" value="" />
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="chatbox chatbox22">
                <div class="chatbox__title">
                    <h5 class="text-white">#<span id="id-ocorrencia">{{ $order->id }}</span></h5>
                    <button class="chatbox__title__tray"><span></span></button>
                </div>
                <div id="corpo-chat" class="chatbox__body">


                    @foreach ($order->messages as $mensagemForum)
                        <div class="chatbox__body__message chatbox__body__message--left">

                            <div class="chatbox_timing">
                                <ul>
                                    <li><a href="#"><i class="fa fa-calendar"></i>
                                            {{ date('d/m/Y', strtotime($mensagemForum->created_at)) }}</a></li>
                                    <li><a href="#"><i class="fa fa-clock-o"></i>
                                            {{ date('H:i', strtotime($mensagemForum->created_at)) }}</a></a></li>
                                    @if ($canDelete = $mensagemForum->user_id == $userId && $mensagemForum->order_status === 'e')
                                        <li><button data-toggle="modal" onclick="changeField(' . $mensagemForum->id . ')"
                                                data-target="#modalDeleteChat"><i class="fa fa-trash-o"></i> Apagar
                                                </a></button></li>
                                    @endif

                                </ul>
                            </div>
                            <!-- <img src="https://www.gstatic.com/webp/gallery/2.jpg"
                   alt="Picture">-->
                            <div class="clearfix"></div>
                            <div class="ul_section_full">
                                <ul class="ul_msg">
                                    <li><strong>{{ substr(ucwords(mb_strtolower($mensagemForum->user_name, 'UTF-8')), 0, 14) . (strlen($mensagemForum->user_name) > 14 ? '...' : '') }}</strong>
                                    </li>
                                    @if ($mensagemForum->message_type == 2)
                                        <li>Anexo: <a href="uploads/{{ $mensagemForum->message_content }}">Clique aqui</a>
                                        </li>
                                    @else
                                        <li>{{ strip_tags($mensagemForum->message_content) }}</li>
                                    @endif

                                </ul>
                                <div class="clearfix"></div>

                            </div>

                        </div>
                        @if ($loop->last)
                            <span id="ultimo-id-post" class="escondido">{{ $mensagemForum->id }}</span>
                        @endif
                    @endforeach
                </div>
                <div class="panel-footer">

                    <form id="insert_form_mensagem_forum" class="user" method="post">
                        <input type="hidden" name="enviar_mensagem_forum" value="1">
                        <input type="hidden" name="ocorrencia" value="{{ $order->id }}">
                        <input type="hidden" id="campo_tipo" name="tipo" value="1">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="muda-tipo" id="muda-tipo">
                            <label class="custom-control-label" for="muda-tipo">Enviar Arquivo</label>
                        </div>
                        <div class="custom-file mb-3 escondido" id="campo-anexo">
                            <input type="file" class="custom-file-input" name="anexo" id="anexo"
                                accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*, application/zip,application/rar, .ovpn, .xlsx">
                            <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um
                                Arquivo</label>
                        </div>
                        <div class="input-group">
                            <input name="mensagem" id="campo-texto" type="text"
                                class="form-control input-sm chat_set_height" placeholder="Digite sua mensagem aqui..."
                                tabindex="0" dir="ltr" spellcheck="false" autocomplete="off" autocorrect="off"
                                autocapitalize="off" contenteditable="true" />
                            <span class="input-group-btn"> <button class="btn bt_bg btn-sm"
                                    id="botao-enviar-mensagem">Enviar</button></span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function changeField(id) {
            document.getElementById('chatDelete').value = id;
        }
    </script>




    <!-- Modal -->
    <div class="modal fade modal_form_status" id="modalStatus" tabindex="-1" aria-labelledby="labelModalCancelar"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModalCancelar">Alterar Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="container-editar-servico" class="form-group escondido">

                            <label for="select-servico">Selecione um Serviço</label>
                            <select name="id_servico" id="select-servico">
                                <option value="" selected>Selecione um Serviço</option>
                                @foreach ($services as $servico)
                                    <option value="{{ $servico->id }}">{{ $servico->nome }} - {{ $servico->descricao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="container-editar-solucao" class="form-group escondido">
                            <label for="solucao">Solução</label>
                            <textarea class="form-control" id="solucao" name="solucao" rows="2">{{ strip_tags($order->solucao) }}</textarea>
                        </div>
                        <div id="container-editar-patrimonio" class="form-group escondido">
                            <label for="solucao">Patrimônio</label>
                            <input class="form-control" id="patrimonio" type="number" name="patrimonio"
                                value="" />
                        </div>
                        <div id="container-mensagem-status" class="form-group escondido">
                            <label for="mensagem-status">Mensagem</label>
                            <textarea class="form-control" id="mensagem-status" name="mensagem-status" rows="2"></textarea>
                        </div>

                        <div id="container-reservar" class="form-group escondido">

                            <label for="select-tecnico">Selecione um Técnico</label>
                            <select name="tecnico" id="select-tecnico">
                                <option value="" selected>Selecione um Técnico</option>
                                @foreach ($providers as $tecnico)
                                    <option value="{{ $tecnico->id }}">{{ $tecnico->nome }}</option>
                                @endforeach

                            </select>
                        </div>



                        <div id="container-editar-area" class="form-group escondido">

                            <label for="select-area">Selecione um Setor</label>
                            <select name="area_responsavel" id="select-area">
                                <option value="" selected>Selecione um Setor</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }} - {{ $division->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="container-avaliacao" class="form-group escondido">
                            Faça sua avaliação:<br>
                            <img class="m-2 star estrela-1" nota="1" src="{{ asset('img/star0.png') }}"
                                alt="1">
                            <img class="m-2 star estrela-2" nota="2" src="{{ asset('img/star0.png') }}"
                                alt="1">
                            <img class="m-2 star estrela-3" nota="3" src="{{ asset('img/star0.png') }}"
                                alt="1">
                            <img class="m-2 star estrela-4" nota="4" src="{{ asset('img/star0.png') }}"
                                alt="1">
                            <img class="m-2 star estrela-5" nota="5" src="{{ asset('img/star0.png') }}"
                                alt="1">

                            <input type="hidden" value="0" name="avaliacao" id="campo-avaliacao">

                        </div>
                        <div class="form-group">
                            <input type="hidden" id="campo_acao" name="status_acao" value="">
                            <input type="hidden" name="id_ocorrencia" value="{{ $order->id }}">
                            <label for="senha">Confirme Com Sua Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control"
                                autocomplete="on">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                    <button id="botao-status" form="form_status_alterar" type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
