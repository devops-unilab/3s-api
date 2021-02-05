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

    public function modalFormStatus(Ocorrencia $ocorrencia){
        echo '<!-- Modal -->
<div class="modal fade modal_form_status" id="modalStatus" tabindex="-1" aria-labelledby="labelModalCancelar" aria-hidden="true">
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
          <div id="container-avaliacao" class="form-group escondido">
            Faça sua avaliação:<br> 



            ';
            for($i = 1; $i < 6; $i++){
                echo '<img class="m-2 star estrela-'.$i.'" nota="'.$i.'"  src="img/star0.png" alt="1">';
            }
            
            echo '
            <input type="hidden" value="5" name="avaliacao" id="campo-avaliacao">
            
          </div>
          <div class="form-group">
            <input type="hidden" id="campo_acao" name="status_acao" value="">
            <input type="hidden" name="id_ocorrencia" value="'.$ocorrencia->getId().'">
            <label for="senha">Confirme Com Sua Senha</label>
            <input type="password" id="senha" name="senha" class="form-control" autocomplete="on">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        <button form="form_status_alterar" type="submit"  class="btn btn-primary">Confirmar</button>
      </div>
    </div>
  </div>
</div>
                
                
                ';
        
    }
    public function botaoCancelar(){
        echo '

    <hr>
    <!-- Button trigger modal -->
    <button type="button" acao="cancelar" class="btn btn-primary botao-status" data-toggle="modal" data-target="#modalStatus">
      Cancelar Ocorrência
    </button>
                
';
        
    }
    
    
    
    public function botaoAtender(){
        echo '
    <hr>
    <!-- Button trigger modal -->
    <button type="button" acao="atender"  class="btn btn-primary botao-status" data-toggle="modal" data-target="#modalStatus">
      Atender Ocorrência
    </button>
                
';
        
    }
    
    public function botaoAvaliar(){
        echo '
    <hr>
    <!-- Button trigger modal -->
    <button type="button" id="botao-avaliar" acao="avaliar"  class="btn btn-primary" data-toggle="modal" data-target="#modalStatus">
      Avaliar Ocorrência
    </button>
            
';
        
    }
    public function botaoReservar(){
        echo '
    <hr>
    <!-- Button trigger modal -->
    <button type="button" acao="reservar"  class="btn btn-primary botao-status" data-toggle="modal" data-target="#modalStatus">
      Reservar Ocorrência
    </button>
            
';
        
    }
    public function botaoFechar(){
        echo '
    <hr>
    <!-- Button trigger modal -->
    <button type="button" acao="fechar"  class="btn btn-primary botao-status" data-toggle="modal" data-target="#modalStatus">
      Fechar Ocorrência
    </button>
            
';
        
    }
}