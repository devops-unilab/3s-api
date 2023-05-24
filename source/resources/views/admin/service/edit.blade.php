<div class="card o-hidden border-0 shadow-lg mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Servico</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post" id="edit_form_servico">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" value="{{ $selected->nome }}" name="nome"
                        id="nome" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="descricao">Descricao</label>
                    <input type="text" class="form-control" value="{{ $selected->descricao }}" name="descricao"
                        id="descricao" placeholder="Descricao">
                </div>
                <div class="form-group">
                    <label for="tempo_sla">Tempo SLA(Em horas)</label>
                    <input type="number" class="form-control" value="{{ $selected->tempo_sla }}" name="tempo_sla"
                        id="tempo_sla" placeholder="Tempo Sla">
                </div>


                <div class="form-group">
                    <label for="visao">Visão</label>
                    <select class="form-control" name="visao" id="visao">
                        <option value="">Selecione uma visão</option>
                        <option {{ $selected->visao === '0' ? 'selected' : '' }} value="0">Inativo</option>
                        <option {{ $selected->visao === '1' ? 'selected' : '' }} value="1">Comum</option>
                        <option {{ $selected->visao === '2' ? 'selected' : '' }} value="2">Técnico</option>
                        <option {{ $selected->visao === '3' ? 'selected' : '' }} value="3">Administrador</option>
                    </select>
                </div>




                <div class="form-group">
                    <label for="area_responsavel">Area Responsavel</label>
                    <select class="form-control" id="area_responsavel" name="area_responsavel">
                        <option value="">Selecione o Area Responsavel</option>';

                        @foreach ($departments as $element)
                            <option value="{{ $element->id }}}" {{ $element->id === $selected->id_area_responsavel ? "selected" : ""}}>
                                {{ $element->nome }}
                            </option>
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
