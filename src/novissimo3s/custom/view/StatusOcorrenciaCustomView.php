<?php
            
/**
 * Classe de visao para StatusOcorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\custom\view;
use novissimo3s\view\StatusOcorrenciaView;
use novissimo3s\model\Ocorrencia;


class StatusOcorrenciaCustomView extends StatusOcorrenciaView {

    ////////Digite seu código customizado aqui.

    
    public function formCancelar(Ocorrencia $ocorrencia){
        echo '
<!-- Modal -->
<div class="modal fade modal_form_status" id="modalCancelar" tabindex="-1" aria-labelledby="labelModalCancelar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelModalCancelar">Cancelar Ocorrência</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form_status_cancelar" class="form_status">
          <div class="form-group">
            <input type="hidden" name="status_acao" value="cancelar">
            <input type="hidden" name="id_ocorrencia" value="'.$ocorrencia->getId().'">
            <label for="senha">Confirme Com Sua Senha</label>
            <input type="password" id="senha" name="senha" class="form-control" autocomplete="on">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        <button form="form_status_cancelar" type="submit"  class="btn btn-primary">Confirmar</button>
      </div>
    </div>
  </div>
</div>
                
                
                
<hr>
    <!-- Button trigger modal -->
    <button type="button" acao="cancelar" class="btn btn-primary" data-toggle="modal" data-target="#modalCancelar">
      Cancelar Ocorrência
    </button>
                
';
        
    }
    
    
    
    public function formAtender(Ocorrencia $ocorrencia){
        echo '
<!-- Modal -->
<div class="modal fade modal_form_status" id="modalAtender" tabindex="-1" aria-labelledby="labelModalCancelar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelModalCancelar">Atender Ocorrência</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form_status_atender" class="form_status">
          <div class="form-group">
            <input type="hidden" name="status_acao" value="atender">
            <input type="hidden" name="id_ocorrencia" value="'.$ocorrencia->getId().'">
            <label for="senha1">Confirme Com Sua Senha</label>
            <input type="password" id="senha1" name="senha" class="form-control" autocomplete="on">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        <button form="form_status_atender" type="submit"  class="btn btn-primary">Confirmar</button>
      </div>
    </div>
  </div>
</div>
                
                
                
<hr>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAtender">
      Atender Ocorrência
    </button>
                
';
        
    }

}