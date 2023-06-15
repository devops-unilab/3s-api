<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddAreaResponsavel">
    Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddAreaResponsavel" tabindex="-1" role="dialog" aria-labelledby="labelAddAreaResponsavel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelAddAreaResponsavel">Adicionar Area Responsavel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insert_form_area_responsavel" class="user" method="post">
                    <input type="hidden" name="enviar_area_responsavel" value="1">



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
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button form="insert_form_area_responsavel" type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </div>
</div>
