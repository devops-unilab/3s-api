<div class="card o-hidden border-0 shadow-lg mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Editar Área Responsavel</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post" id="edit_form_area_responsavel">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" value="{{ $division->nome }}" name="nome"
                        id="nome" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="descricao">Descricao</label>
                    <input type="text" class="form-control" value="{{ $division->descricao }}" name="descricao"
                        id="descricao" placeholder="Descricao">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="{{ $division->email }}" name="email"
                        id="email" placeholder="Email">
                </div>
                <input type="hidden" value="1" name="edit_area_responsavel">
            </form>

        </div>
        <div class="modal-footer">
            <button form="edit_form_area_responsavel" type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </div>
</div>
