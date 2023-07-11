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

                <form action="{{ route('orders.update', $order) }}" id="form_status_alterar" method="POST">
                    @csrf
                    @method('PUT')
                    <div id="container-editar-servico" class="form-group escondido">

                        <label for="select-servico">Selecione um Serviço</label>
                        <select name="service" id="select-servico">
                            <option value="" selected>Selecione um Serviço</option>
                            @foreach ($services as $servico)
                                <option value="{{ $servico->id }}">{{ $servico->nome }} - {{ $servico->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="container-editar-solucao" class="form-group escondido">
                        <label for="solucao">Solução</label>
                        <textarea class="form-control" id="solucao" name="solution" rows="2">{{ strip_tags($order->solucao) }}</textarea>
                    </div>
                    <div id="container-editar-patrimonio" class="form-group escondido">
                        <label for="tag">Patrimônio</label>
                        <input class="form-control" id="tag" type="number" name="tag" value="" />
                    </div>
                    <div id="container-reservar" class="form-group escondido">

                        <label for="select-tecnico">Selecione um Técnico</label>
                        <select name="provider" id="select-tecnico">
                            <option value="" selected>Selecione um Técnico</option>
                            @foreach ($providers as $tecnico)
                                <option value="{{ $tecnico->id }}">{{ $tecnico->nome }}</option>
                            @endforeach

                        </select>
                    </div>



                    <div id="container-editar-area" class="form-group escondido">

                        <label for="select-area">Selecione um Setor</label>
                        <select name="division" id="select-area">
                            <option value="" selected>Selecione um Setor</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }} -
                                    {{ $division->description }}
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

                        <input type="hidden" value="0" name="rating" id="campo-avaliacao">

                    </div>
                    <div class="form-group">
                        <input type="hidden" id="campo_acao" name="action" value="">
                        <label for="password">Confirme Com Sua Senha</label>
                        <input type="password" id="password" name="password" class="form-control" required
                            autocomplete="on">
                    </div>
                    <span class="escondido">Clique em solicitar ajuda para enviar um e-mail aos
                        responsáveis
                        pelo
                        setor</span>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <button id="botao-status" form="form_status_alterar" type="submit"
                    class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>
