@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 blog-main">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        @include('orders.panel-status')
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
                            @can('editTag', $order)
                                <button id="botao-editar-patrimonio" type="button" acao="editTag"
                                    class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                                    Editar Patrimônio
                                </button>
                            @endcan
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <b>Solucao: </b>{{ $order->solution }}<br>
                            @can('editSolution', $order)
                                <button id="botao-editar-solucao" type="button" acao="editSolution"
                                    class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                                    Editar Solução
                                </button>
                            @endcan



                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <b>Serviço: </b>{{ $order->service->name }} - {{ $order->service->description }}<br>
                            @can('editService', $order)
                                <button type="button" id="botao-editar-servico" acao="{{ $order->status }}"
                                    class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                                    Editar Serviço
                                </button>
                            @endcan
                            @if ($order->service->sla > 0)
                                <hr>

                                @if (request()->session()->get('role') === 'administrator' ||
                                        request()->session()->get('role') === 'provider')
                                    @if ($order->service->sla > 1)
                                        <b>SLA: </b>{{ $order->service->sla }} Horas úteis<br>
                                    @elseif($order->service->sla === 1)
                                        <b>SLA: </b> 1 Hora útil<br>
                                    @endif
                                @endif

                                <b>Data de Abertura: </b>{{ date('d/m/Y', strtotime($order->data_abertura)) }}
                                {{ date('H', strtotime($order->data_abertura)) }}h{{ date('i', strtotime($order->data_abertura)) }}min<br>

                                <span class="{{ 'text-danger' }}">
                                    <b>Solução Estimada: </b>
                                    {{ date('d/m/Y', strtotime($solutionDate)) }}
                                    {{ date('H', strtotime($solutionDate)) }}h{{ date('i', strtotime($solutionDate)) }}min
                                </span><br>
                                @can('requestHelp', $order)
                                    <button type="button" id="botao-pedir-ajuda" class="dropdown-item text-right"
                                        data-toggle="modal" data-target="#modalPedirAjuda">
                                        Pedir Ajuda
                                    </button>
                                @endcan
                            @endif


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
                            @can('editDivision', $order)
                                <button id="botao-editar-area" type="button" acao="editar_area"
                                    class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                                    Editar Setor Responsável
                                </button>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('orders.panel-status-logs')
    </div>
    @include('orders.modal-status')
    {{-- @include('orders.chat-box') --}}
@endsection
