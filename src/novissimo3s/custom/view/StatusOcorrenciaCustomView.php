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

    public function modalFormStatus(Ocorrencia $ocorrencia, $listaTecnicos = array(), $listaServicos = array()){
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
            <div id="container-editar-servico" class="form-group escondido">
                
                <label for="select-servico">Selecione um Serviço</label>
                <select name="id_servico" id="select-servico">
                    <option value="" selected>Selecione um Serviço</option>';
        foreach($listaServicos as $servico){
            echo '
                        <option value="'.$servico->getId().'">'.$servico->getNome();
            if($servico->getDescricao() != ""){
                echo ' - ('.$servico->getDescricao().') ';
                
                
            }
            echo '</option>';
        }
        
        echo '
                </select>
            </div>
            <div id="container-editar-solucao" class="form-group escondido"> 
                <label for="solucao">Solução</label>
                <textarea class="form-control" id="solucao" name="solucao" rows="2">'.strip_tags($ocorrencia->getSolucao()).'</textarea>
            </div>

            <div id="container-reservar" class="form-group escondido">
                
                <label for="select-tecnico">Selecione um Técnico</label>
                <select name="tecnico" id="select-tecnico">
                    <option value="" selected>Selecione um Técnico</option>';
        foreach($listaTecnicos as $tecnico){
            echo '
                    <option value="'.$tecnico->getId().'">'.$tecnico->getNome().'</option>';
        }
        
        echo '
                </select>
            </div>
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
        <button id="botao-status" form="form_status_alterar" type="submit"  class="btn btn-primary">
            <span id="spinner-status" class="escondido spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Confirmar
        </button>
      </div>
    </div>
  </div>
</div>
                
                
                ';
        
    }
    public function botaoCancelar($posso = false){
        $strDisable = "";
        if(!$posso){
            $strDisable = 'disabled';
        }
        echo '

    <!-- Button trigger modal --> 
    <button type="button" acao="cancelar" '.$strDisable.' class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
      Cancelar 
    </button>
                
';
        
    }
    
    
    
    public function botaoAtender($posso = false){
        $strDisable = "";
        if(!$posso){
            $strDisable = 'disabled';
        }
        echo '
    <!-- Button trigger modal -->
    <button type="button"  '.$strDisable.'  acao="atender" class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
      Atender 
    </button>
                
';
        
    }
    
    public function botaoAvaliar($posso = false){
        $strDisable = "";
        if(!$posso){
            $strDisable = 'disabled';
        }
        echo '
    <!-- Button trigger modal -->
    <button type="button" '.$strDisable.'  id="avaliar-btn" acao="avaliar"  class="dropdown-item"  data-toggle="modal" data-target="#modalStatus">
      Avaliar 
    </button>
            
';
        
    }
    
    public function botaoReabrir($posso = false){
        $strDisable = "";
        if(!$posso){
            $strDisable = 'disabled';
        }
        echo '
    <!-- Button trigger modal -->
    <button type="button" '.$strDisable.'  acao="reabrir"  class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
      Reabrir 
    </button>
        
';
        
    }
    
    public function botaoReservar(){
        echo '
    <!-- Button trigger modal -->
    <button type="button" acao="reservar" id="botao-reservar" class="dropdown-item"  data-toggle="modal" data-target="#modalStatus">
      Reservar 
    </button>
            
';
        
        
    }
    
    public function botaoFechar($posso = false){
        $strDisable = "";
        if(!$posso){
            $strDisable = 'disabled';
        }
        echo '
    <!-- Button trigger modal -->
    <button type="button" '.$strDisable.'  acao="fechar"  class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
      Fechar 
    </button>
            
';
        
    }
    
    public function botaoLiberar(){
        echo '
    <!-- Button trigger modal -->
    <button type="button" acao="liberar_atendimento"  class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
      Liberar Ocorrência
    </button>
            
';
        
    }
    
    public function botaoEditarServico(){
        echo '
    <!-- Button trigger modal -->
    <button type="button" id="botao-editar-servico" acao="editar_servico"  class="dropdown-item text-right"  data-toggle="modal" data-target="#modalStatus">
      Editar Serviço
    </button>
            
';
        
    }
    
    
    public function botaoEditarSolucao(){
        echo '
    <!-- Button trigger modal -->
    <button id="botao-editar-solucao" type="button" acao="editar_solucao"  class="dropdown-item text-right"   data-toggle="modal" data-target="#modalStatus">
      Editar Solução
    </button>
            
';
        
    }
    
    
    public function botaoAguardarUsuario(){
        echo '
    <!-- Button trigger modal -->
    <button type="button" acao="aguardar_usuario"  class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
      Aguardar Usuário
    </button>
            
';
        
    }
    
    
    public function botaoAguardarAtivos(){
        echo '
    <!-- Button trigger modal -->
    <button type="button" acao="aguardar_ativos"  class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
      Aguardar Ativos de TI
    </button>
            
';
        
    }
    
}