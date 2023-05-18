<?php

/**
 * Classe de visao para MensagemForum
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace app3s\view;

use app3s\controller\MensagemForumController;
use app3s\model\MensagemForum;
use app3s\model\Ocorrencia;

class MensagemForumView
{


  public function showInsertForm2(Ocorrencia $ocorrencia)
  {

    echo '

                <form id="insert_form_mensagem_forum" class="user" method="post">
                    <input type="hidden" name="enviar_mensagem_forum" value="1">
                    <input type="hidden" name="ocorrencia" value="' . $ocorrencia->getId() . '">
                    <input type="hidden" id="campo_tipo" name="tipo" value="' . MensagemForumController::TIPO_TEXTO . '">

                    <div class="custom-control custom-switch">                        
                      <input type="checkbox" class="custom-control-input" name="muda-tipo" id="muda-tipo">
                      <label class="custom-control-label" for="muda-tipo">Enviar Arquivo</label>
                    </div>
                    <div class="custom-file mb-3 escondido" id="campo-anexo">
                          <input type="file" class="custom-file-input" name="anexo" id="anexo" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*, application/zip,application/rar, .ovpn, .xlsx">
                          <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
                    </div>
          <div class="input-group">
            <input name="mensagem" id="campo-texto" type="text" class="form-control input-sm chat_set_height" placeholder="Digite sua mensagem aqui..." tabindex="0" dir="ltr" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off" contenteditable="true" />    
                        <span class="input-group-btn"> <button class="btn bt_bg btn-sm" id="botao-enviar-mensagem">Enviar</button></span>
          </div>
                </form>

';
  }

  public function confirmDelete(MensagemForum $mensagemForum)
  {
    echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Delete Mensagem Forum</h1>
									</div>
						              <form class="user" method="post">                    Are you sure you want to delete this object?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Delete" name="delete_mensagem_forum">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
  }
}
