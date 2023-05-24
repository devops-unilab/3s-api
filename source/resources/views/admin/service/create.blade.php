<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddServico">
    Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddServico" tabindex="-1" role="dialog" aria-labelledby="labelAddServico"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelAddServico">Adicionar Servico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insert_form_servico" class="user" method="post">
                    <input type="hidden" name="enviar_servico" value="1">



                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descricao</label>
                        <input type="text" class="form-control" name="descricao" id="descricao"
                            placeholder="Descricao">
                    </div>

                    <div class="form-group">
                        <label for="tempo_sla">Tempo Sla</label>
                        <input type="number" class="form-control" name="tempo_sla" id="tempo_sla"
                            placeholder="Tempo Sla">
                    </div>


                    <div class="form-group">
                        <label for="visao">Visão</label>
                        <select class="form-control" id="tipo_atividade" name="visao" id="visao">
                            <option value="">Selecione uma visão</option>
                            <option value="0">Inativo</option>
                            <option value="1">Comum</option>
                            <option value="2">Técnico</option>
                            <option value="3">Administrador</option>
                        </select>
                    </div>

                    <div class="form-group">

                        <div class="form-group">
                            <label for="area_responsavel">Area Responsavel</label>
                            <select class="form-control" id="area_responsavel" name="area_responsavel">
                                <option value="">Selecione o Area Responsavel</option> ';

                                @foreach ($departments as $element)
                                    <option value="{{ $element->id }}"> {{ $element->nome }}</option>
                                @endforeach


                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button form="insert_form_servico" type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
