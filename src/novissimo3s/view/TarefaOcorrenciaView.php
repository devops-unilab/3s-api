<?php
            
/**
 * Classe de visao para TarefaOcorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\view;
use novissimo3s\model\TarefaOcorrencia;



class TarefaOcorrenciaView {
    public function showInsertForm($listaOcorrencia, $listaUsuario) {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddTarefaOcorrencia">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddTarefaOcorrencia" tabindex="-1" role="dialog" aria-labelledby="labelAddTarefaOcorrencia" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddTarefaOcorrencia">Adicionar Tarefa Ocorrencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


          <form id="insert_form_tarefa_ocorrencia" class="user" method="post">
            <input type="hidden" name="enviar_tarefa_ocorrencia" value="1">                



                                        <div class="form-group">
                                            <label for="tarefa">Tarefa</label>
                                            <input type="number" class="form-control"  name="tarefa" id="tarefa" placeholder="Tarefa">
                                        </div>

                                        <div class="form-group">
                                            <label for="data_inclusao">Data Inclusao</label>
                                            <input type="datetime-local" class="form-control"  name="data_inclusao" id="data_inclusao" placeholder="Data Inclusao">
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
        <button form="insert_form_tarefa_ocorrencia" type="submit" class="btn btn-primary">Cadastrar</button>
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
                  Lista Tarefa Ocorrencia
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Tarefa</th>
						<th>Data Inclusao</th>
						<th>Ocorrencia</th>
						<th>Usuario</th>
                        <th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Tarefa</th>
                        <th>Data Inclusao</th>
						<th>Ocorrencia</th>
						<th>Usuario</th>
                        <th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $element){
                echo '<tr>';
                echo '<td>'.$element->getId().'</td>';
                echo '<td>'.$element->getTarefa().'</td>';
                echo '<td>'.$element->getDataInclusao().'</td>';
                echo '<td>'.$element->getOcorrencia().'</td>';
                echo '<td>'.$element->getUsuario().'</td>';
                echo '<td>
                        <a href="?page=tarefa_ocorrencia&select='.$element->getId().'" class="btn btn-info text-white">Select</a>
                        <a href="?page=tarefa_ocorrencia&edit='.$element->getId().'" class="btn btn-success text-white">Edit</a>
                        <a href="?page=tarefa_ocorrencia&delete='.$element->getId().'" class="btn btn-danger text-white">Delete</a>
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
            

            
	public function showEditForm($listaOcorrencia, $listaUsuario, TarefaOcorrencia $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Edit Tarefa Ocorrencia</h1>
									</div>
						              <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="tarefa">Tarefa</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getTarefa().'"  name="tarefa" id="tarefa" placeholder="Tarefa">
                						</div>
                                        <div class="form-group">
                                            <label for="data_inclusao">Data Inclusao</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDataInclusao().'"  name="data_inclusao" id="data_inclusao" placeholder="Data Inclusao">
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
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="edit_tarefa_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}




            
        public function showSelected(TarefaOcorrencia $tarefaocorrencia){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Tarefa Ocorrencia selecionado
            </div>
            <div class="card-body">
                Id: '.$tarefaocorrencia->getId().'<br>
                Tarefa: '.$tarefaocorrencia->getTarefa().'<br>
                Data Inclusao: '.$tarefaocorrencia->getDataInclusao().'<br>
                Ocorrencia: '.$tarefaocorrencia->getOcorrencia().'<br>
                Usuario: '.$tarefaocorrencia->getUsuario().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


                                            
    public function confirmDelete(TarefaOcorrencia $tarefaOcorrencia) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Delete Tarefa Ocorrencia</h1>
									</div>
						              <form class="user" method="post">                    Are you sure you want to delete this object?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Delete" name="delete_tarefa_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}