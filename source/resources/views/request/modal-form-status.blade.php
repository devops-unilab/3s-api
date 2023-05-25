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
                <form method="post" id="form_status_alterar" class="form_status">
                    <div id="container-editar-servico" class="form-group escondido">

                        <label for="select-servico">Selecione um Serviço</label>
                        <select name="id_servico" id="select-servico">
                            <option value="" selected>Selecione um Serviço</option>';
                            @foreach ($services as $servico)
                                <option value="{{ $servico->id}}">
                                    {{ $servico->nome }}
                                    {{ $servico->descricao === '' ? '' : ' - ' . $servico->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="container-editar-solucao" class="form-group escondido">
                        <label for="solucao">Solução</label>
                        <textarea class="form-control" id="solucao" name="solucao" rows="2">
                            {{ strip_tags($request->solucao) }}</textarea>
                    </div>
                    <div id="container-editar-patrimonio" class="form-group escondido">
                        <label for="solucao">Patrimônio</label>
                        <input class="form-control" id="patrimonio" name="patrimonio" value="" />
                    </div>
                    <div id="container-mensagem-status" class="form-group escondido">
                        <label for="mensagem-status">Mensagem</label>
                        <textarea class="form-control" id="mensagem-status" name="mensagem-status" rows="2"></textarea>
                    </div>

                    <div id="container-reservar" class="form-group escondido">

                        <label for="select-tecnico">Selecione um Técnico</label>
                        <select name="tecnico" id="select-tecnico">
                            <option value="" selected>Selecione um Técnico</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div id="container-editar-area" class="form-group escondido">

                        <label for="select-area">Selecione um Setor</label>
                        <select name="area_responsavel" id="select-area">
                            <option value="" selected>Selecione um Setor</option> ';
                            @foreach ($departments as $department)
                                <option value="' . $area->id . '">
                                    {{ $department->nome }} - {{ $department->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="container-avaliacao" class="form-group escondido">
                        Faça sua avaliação:<br>

                        @php
                            for ($i = 1; $i < 6; $i++) {
                                echo '<img class="m-2 star estrela-' . $i . '" nota="' . $i . '"  src="img/star0.png" alt="1">';
                            }
                        @endphp
                        <input type="hidden" value="0" name="avaliacao" id="campo-avaliacao">

                    </div>
                    <div class="form-group">
                        <input type="hidden" id="campo_acao" name="status_acao" value="">
                        <input type="hidden" name="id_ocorrencia" value="{{$request->id}}">
                        <label for="senha">Confirme Com Sua Senha</label>
                        <input type="password" id="senha" name="senha" class="form-control" autocomplete="on">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <button id="botao-status"F form="form_status_alterar" type="submit" class="btn btn-primary">
                    <span id="spinner-status" class="escondido spinner-border spinner-border-sm" role="status"
                        aria-hidden="true"></span>
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
