

            <div class="dropdown-divider"></div>

			<button type="button" acao="aguardar_usuario"  class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
				Aguardar Usuário
		  	</button>
		  	<button type="button" acao="aguardar_ativos"  class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
		  		Aguardar Ativos de TI
			</button>

</div>
</div>
<button class="btn btn-light btn-lg p-2" type="button" disabled>
    Status:  {{$currentStatus->nome}}
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
                    <b> Descricao: </b>{{ $order->descricao }}<br>

                    @if ($order->anexo != '')
                        <b>Anexo: </b><a target="_blank" href="{{asset('storage/uploads/'.$order->anexo)}}"> Clique aqui</a> <br>
                    @endif

                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <b>Patrimônio: </b>{{ $order->patrimonio }}<br>
                    @if ($canEditTag)
                        <button id="botao-editar-patrimonio" type="button" acao="editar_patrimonio"
                            class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                            Editar Patrimônio
                        </button>
                    @endif

                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <b>Solucao: </b>{{ $order->solucao }}<br>
                    @if ($canEditSolution)
                        <button id="botao-editar-solucao" type="button" acao="editar_solucao"
                            class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                            Editar Solução
                        </button>
                    @endif



                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card mb-4">
                <div class="card-body">
                    <b>Classificação do Chamado: </b>{{ $order->service_name }}<br>
                    @if ($canEditService)
                        <button type="button" id="botao-editar-servico" acao="editar_servico"
                            class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                            Editar Serviço
                        </button>
                    @endif
                    <hr>
                    @if (!$isLevelClient)
                        @if ($order->tempo_sla > 1)
                            <b>SLA: </b>{{ $order->tempo_sla }} Horas úteis<br>
                        @endif
                        @if ($order->tempo_sla === 1)
                            <b>SLA: </b> 1 Hora útil<br>
                        @endif
                        @if ($order->tempo_sla === 0)
                            SLA não definido. <br>
                        @endif

                    @endif
                    <b>Data de Abertura: </b>{{ date('d/m/Y', strtotime($order->data_abertura)) }}
                    {{ date('H', strtotime($order->data_abertura)) }}h{{ date('i', strtotime($order->data_abertura)) }}min<br>

                    <span class="{{ $isLate ? 'text-danger' : '' }}">
                        <b>Solução Estimada: </b>
                        {{ date('d/m/Y', strtotime($dataSolucao)) }}
                        {{ date('H', strtotime($dataSolucao)) }}h{{ date('i', strtotime($dataSolucao)) }}min
                    </span><br>

                    @if ($canRequestHelp)
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
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form_pedir_ajuda" class="user" method="post">
                                            <input type="hidden" name="pedir_ajuda" value="1">
                                            <input type="hidden" name="ocorrencia" value="{{ $order->id }}">

                                            <span>Clique em solicitar ajuda para enviar um e-mail aos responsáveis pelo
                                                setor</span>

                                        </form>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Fechar</button>
                                        <button form="form_pedir_ajuda" type="submit" class="btn btn-primary">Solicitar
                                            Ajuda</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <b>Setor Responsável: </b>{{ $providerDivision }}<br>
                    <b>Técnico Responsável: </b>{{ $providerName }}<br>
                    @if ($canEditDivision)
                        <button id="botao-editar-area" type="button" acao="editar_area"
                            class="dropdown-item text-right" data-toggle="modal" data-target="#modalStatus">
                            Editar Setor Responsável
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<aside class="col-md-4 blog-sidebar">
    <h4 class="font-italic">Histórico</h4>
    <div class="container">
        @foreach ($orderStatusLog as $status)
            <div class="notice {{ $status->color }}">
                <strong>{{ $status->nome }}</strong><br>
                @if ($status->sigla == 'g')
                    <br>
                    @for ($i = 0; $i < intval($order->avaliacao); $i++)
                        <img class="m-2 estrela-1" nota="1" src="img/star1.png" alt="1">
                    @endfor
                @endif
                <br>{{ $status->mensagem }}<br>
                <strong>{{ $status->nome_usuario }}<br>{{ date('d/m/Y - H:i', strtotime($status->data_mudanca)) }}</strong>
            </div>
        @endforeach
    </div>
</aside>
