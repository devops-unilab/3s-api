<div class="card o-hidden border-0 shadow-lg mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Servico</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post" id="edit_form_servico">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" value="{{$selected->nome}}" name="nome"
                        id="nome" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="descricao">Descricao</label>
                    <input type="text" class="form-control" value="{{$selected->descricao}}"
                        name="descricao" id="descricao" placeholder="Descricao">
                </div>
                <div class="form-group">
                    <label for="tempo_sla">Tempo SLA(Em horas)</label>
                    <input type="number" class="form-control" value="{{$selected->tempo_sla}}"
                        name="tempo_sla" id="tempo_sla" placeholder="Tempo Sla">
                </div>


                <div class="form-group">
                    <label for="visao">Visão</label>
                    <select class="form-control" name="visao" id="visao" required>
                        <option value="">Selecione uma visão</option>
                        <option value="3">Administrador</option>
                        <option value="0">Inativo</option>
                        <option value="1">Cliente</option>
                        <option value="2">Atendente</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo_atividade">Tipo Atividade</label>
                    <select class="form-control" id="tipo_atividade" name="tipo_atividade">
                        <option value="">Selecione o Tipo Atividade</option>
                        @foreach ($listaTipoAtividade as $element)
                            <option value="{{ $element->id }}">{{ $element->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="area_responsavel">Area Responsavel</label>
                    <select class="form-control" id="area_responsavel" name="area_responsavel">
                        <option value="">Selecione o Area Responsavel</option>
                        @foreach ($listaAreaResponsavel as $element)
                            <option value="{{ $element->id }}">{{ $element->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="grupo_servico">Grupo Servico</label>
                    <select class="form-control" id="grupo_servico" name="grupo_servico">
                        <option value="">Selecione o Grupo Servico</option>
                        @foreach ($listaGrupoServico as $element)
                            <option value="{{ $element->id }}">{{ $element->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="1" name="edit_servico">
            </form>

        </div>
        <div class="modal-footer">
            <button form="edit_form_servico" type="submit" class="btn btn-primary">Alterar</button>
        </div>
    </div>
</div>
