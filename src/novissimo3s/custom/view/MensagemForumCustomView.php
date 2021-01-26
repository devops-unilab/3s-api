<?php
            
/**
 * Classe de visao para MensagemForum
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\custom\view;
use novissimo3s\view\MensagemForumView;
use novissimo3s\custom\controller\MensagemForumCustomController;


class MensagemForumCustomView extends MensagemForumView {

    public function showInsertForm2() {
        echo '
          <form id="insert_form_mensagem_forum" class="user" method="post">
            <input type="hidden" name="enviar_mensagem_forum" value="1">
            
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" name="muda-tipo" id="muda-tipo">
                          <label class="custom-control-label" for="muda-tipo">Enviar Arquivo</label>
                        </div>
                           
                        <input type="hidden" name="tipo" value="'.MensagemForumCustomController::TIPO_TEXTO.'">

                        <div class="form-floating" id="campo-texto">
                          <textarea class="form-control" placeholder="Deixar uma mensagem"  name="mensagem" id="mensagem" ></textarea>
                          <label for="mensagem">Mensagem</label>
                        </div>   



                        <div class="custom-file mb-3 escondido" id="campo-anexo">
                          <input type="file" class="custom-file-input" name="anexo" id="anexo">
                          <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
                        </div>

                        <div class="form-floating" id="campo-texto">
                            <button form="insert_form_mensagem_forum" type="submit" class="btn btn-primary">Cadastrar</button>
                        </div> 

	              </form>
                    
            
            
            
';
    }
    


}