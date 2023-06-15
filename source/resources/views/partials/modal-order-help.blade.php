
<!-- Button trigger modal -->
<button type="button" id="botao-pedir-ajuda" class="dropdown-item text-right" data-toggle="modal" data-target="#modalPedirAjuda">
    Pedir Ajuda
  </button>

  <!-- Modal -->
  <div class="modal fade" id="modalPedirAjuda" tabindex="-1" role="dialog" aria-labelledby="labelPedirAjuda" aria-hidden="true">
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
              <input type="hidden" name="ocorrencia" value="{{$order->id}}">

              <span>Clique em solicitar ajuda para enviar um e-mail aos responsáveis pelo setor</span>

          </form>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button form="form_pedir_ajuda" type="submit" class="btn btn-primary">Solicitar Ajuda</button>
        </div>
      </div>
    </div>
  </div>
