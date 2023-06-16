<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Editar Usuário: {{ $user->nome }}</h6>
    </div>
    <div class="card-body">
        <form class="user" method="post" id="edit_form_usuario">

            <div class="form-group">
                <label for="select-nivel">Nivel</label>

                <select id="select-nivel" required name="nivel">
                    <option value="">Nível de Acesso</option>
                    <option value="c" {{ $user->nivel == 'c' ? 'selected' : '' }}>Comum</option>
                    <option value="t" {{ $user->nivel == 't' ? 'selected' : '' }}>Técnico</option>
                    <option value="a" {{ $user->nivel == 'a' ? 'selected' : '' }}>Administrador</option>
                    <option value="d" {{ $user->nivel == 'd' ? 'selected' : '' }}>Desativado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="select-unidade">Unidade </label>
                <select name="id_setor" id="select-unidade">
                    <option value="">Selecione a Unidade</option>
                    @foreach ($divisions as $area)
                        <option value="{{ $area->id }}"
                            {{ $user->id_setor === $area->id ? 'selected' : '' }}>{{ $area->nome }}
                        </option>
                    @endforeach

                </select>
            </div>


            <input type="hidden" value="1" name="edit_usuario">
        </form>

    </div>
    <div class="modal-footer">
        <button form="edit_form_usuario" type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</div>
