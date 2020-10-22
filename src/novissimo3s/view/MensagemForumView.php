<?php
            
/**
 * Classe de visao para MensagemForum
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\view;
use novissimo3s\model\MensagemForum;



class MensagemForumView {
    public function showInsertForm($listaOcorrencia, $listaUsuario) {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddMensagemForum">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddMensagemForum" tabindex="-1" role="dialog" aria-labelledby="labelAddMensagemForum" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddMensagemForum">Adicionar Mensagem Forum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


          <form id="insert_form_mensagem_forum" class="user" method="post">
            <input type="hidden" name="enviar_mensagem_forum" value="1">                



                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <input type="number" class="form-control"  name="tipo" id="tipo" placeholder="Tipo">
                                        </div>

                                        <div class="form-group">
                                            <label for="mensagem">Mensagem</label>
                                            <input type="text" class="form-control"  name="mensagem" id="mensagem" placeholder="Mensagem">
                                        </div>

                                        <div class="form-group">
                                            <label for="data_envio">Data Envio</label>
                                            <input type="datetime-local" class="form-control"  name="data_envio" id="data_envio" placeholder="Data Envio">
                                        </div>
                                        <div class="form-group">
                                          <label for="ocorrencia">Ocorrencia</label>
                						  <select class="form-control" id="ocorrencia" name="ocorrencia">
                                            <option value="">Selecione o Ocorrencia</option>';
                                                
        foreach( $listaOcorrencia as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="usuario">Usuario</label>
                						  <select class="form-control" id="usuario" name="usuario">
                                            <option value="">Selecione o Usuario</option>';
                                                
        foreach( $listaUsuario as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="insert_form_mensagem_forum" type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>
            
            
			
';
	}



                                            
                                            
    public function showList($lista){
           echo '
                                            
                                            
                                            

          <div class="card mb-4">
                <div class="card-header">
                  Lista Mensagem Forum
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Tipo</th>
						<th>Mensagem</th>
						<th>Data Envio</th>
						<th>Ocorrencia</th>
						<th>Usuario</th>
                        <th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Tipo</th>
                        <th>Mensagem</th>
                        <th>Data Envio</th>
						<th>Ocorrencia</th>
						<th>Usuario</th>
                        <th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $element){
                echo '<tr>';
                echo '<td>'.$element->getId().'</td>';
                echo '<td>'.$element->getTipo().'</td>';
                echo '<td>'.$element->getMensagem().'</td>';
                echo '<td>'.$element->getDataEnvio().'</td>';
                echo '<td>'.$element->getOcorrencia().'</td>';
                echo '<td>'.$element->getUsuario().'</td>';
                echo '<td>
                        <a href="?page=mensagem_forum&select='.$element->getId().'" class="btn btn-info text-white">Select</a>
                        <a href="?page=mensagem_forum&edit='.$element->getId().'" class="btn btn-success text-white">Edit</a>
                        <a href="?page=mensagem_forum&delete='.$element->getId().'" class="btn btn-danger text-white">Delete</a>
                      </td>';
                echo '</tr>';
            }
            
        echo '
				</tbody>
			</table>
		</div>
            
            
            
            
  </div>
</div>
            
';
    }
            

            
	public function showEditForm($listaOcorrencia, $listaUsuario, MensagemForum $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Edit Mensagem Forum</h1>
									</div>
						              <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getTipo().'"  name="tipo" id="tipo" placeholder="Tipo">
                						</div>
                                        <div class="form-group">
                                            <label for="mensagem">Mensagem</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getMensagem().'"  name="mensagem" id="mensagem" placeholder="Mensagem">
                						</div>
                                        <div class="form-group">
                                            <label for="data_envio">Data Envio</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDataEnvio().'"  name="data_envio" id="data_envio" placeholder="Data Envio">
                						</div>
                                        <div class="form-group">
                                          <label for="ocorrencia">Ocorrencia</label>
                						  <select class="form-control" id="ocorrencia" name="ocorrencia">
                                            <option value="">Selecione o Ocorrencia</option>';
                                                
        foreach( $listaOcorrencia as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="usuario">Usuario</label>
                						  <select class="form-control" id="usuario" name="usuario">
                                            <option value="">Selecione o Usuario</option>';
                                                
        foreach( $listaUsuario as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="edit_mensagem_forum">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}




            
        public function showSelected(MensagemForum $mensagemforum){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Mensagem Forum selecionado
            </div>
            <div class="card-body">
                Id: '.$mensagemforum->getId().'<br>
                Tipo: '.$mensagemforum->getTipo().'<br>
                Mensagem: '.$mensagemforum->getMensagem().'<br>
                Data Envio: '.$mensagemforum->getDataEnvio().'<br>
                Ocorrencia: '.$mensagemforum->getOcorrencia().'<br>
                Usuario: '.$mensagemforum->getUsuario().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


                                            
    public function confirmDelete(MensagemForum $mensagemForum) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
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