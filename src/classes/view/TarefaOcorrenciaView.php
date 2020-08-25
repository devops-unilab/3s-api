<?php
            
/**
 * Classe de visao para TarefaOcorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class TarefaOcorrenciaView {
    public function mostraFormInserir() {
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
        


          <form id="form_enviar_tarefa_ocorrencia" class="user" method="post">
            <input type="hidden" name="enviar_tarefa_ocorrencia" value="1">                



                                        <div class="form-group">
                                            <label for="id_ocorrencia">Id Ocorrencia</label>
                                            <input type="number" class="form-control"  name="id_ocorrencia" id="id_ocorrencia" placeholder="Id Ocorrencia">
                                        </div>

                                        <div class="form-group">
                                            <label for="tarefa">Tarefa</label>
                                            <input type="number" class="form-control"  name="tarefa" id="tarefa" placeholder="Tarefa">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_user">Id User</label>
                                            <input type="number" class="form-control"  name="id_user" id="id_user" placeholder="Id User">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_inclusao">Dt Inclusao</label>
                                            <input type="datetime-local" class="form-control"  name="dt_inclusao" id="dt_inclusao" placeholder="Dt Inclusao">
                                        </div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_enviar_tarefa_ocorrencia" type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>
            
            
			
';
	}



                                            
                                            
    public function exibirLista($lista){
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
						<th>Id Ocorrencia</th>
						<th>Tarefa</th>
						<th>Id User</th>
                        <th>Ações</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Id Ocorrencia</th>
                        <th>Tarefa</th>
                        <th>Id User</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $elemento){
                echo '<tr>';
                echo '<td>'.$elemento->getId().'</td>';
                echo '<td>'.$elemento->getIdOcorrencia().'</td>';
                echo '<td>'.$elemento->getTarefa().'</td>';
                echo '<td>'.$elemento->getIdUser().'</td>';
                echo '<td>
                        <a href="?pagina=tarefa_ocorrencia&selecionar='.$elemento->getId().'" class="btn btn-info text-white">Selecionar</a>
                        <a href="?pagina=tarefa_ocorrencia&editar='.$elemento->getId().'" class="btn btn-success text-white">Editar</a>
                        <a href="?pagina=tarefa_ocorrencia&deletar='.$elemento->getId().'" class="btn btn-danger text-white">Deletar</a>
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
            


            
        public function mostrarSelecionado(TarefaOcorrencia $tarefaocorrencia){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Tarefa Ocorrencia selecionado
            </div>
            <div class="card-body">
                Id: '.$tarefaocorrencia->getId().'<br>
                Id Ocorrencia: '.$tarefaocorrencia->getIdOcorrencia().'<br>
                Tarefa: '.$tarefaocorrencia->getTarefa().'<br>
                Id User: '.$tarefaocorrencia->getIdUser().'<br>
                Dt Inclusao: '.$tarefaocorrencia->getDtInclusao().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


            
	public function mostraFormEditar(TarefaOcorrencia $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Editar Tarefa Ocorrencia</h1>
									</div>
						              <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="id_ocorrencia">Id Ocorrencia</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdOcorrencia().'"  name="id_ocorrencia" id="id_ocorrencia" placeholder="Id Ocorrencia">
                						</div>
                                        <div class="form-group">
                                            <label for="tarefa">Tarefa</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getTarefa().'"  name="tarefa" id="tarefa" placeholder="Tarefa">
                						</div>
                                        <div class="form-group">
                                            <label for="id_user">Id User</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdUser().'"  name="id_user" id="id_user" placeholder="Id User">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_inclusao">Dt Inclusao</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtInclusao().'"  name="dt_inclusao" id="dt_inclusao" placeholder="Dt Inclusao">
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="editar_tarefa_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}



                                            
    public function confirmarDeletar(TarefaOcorrencia $tarefaOcorrencia) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Deletar Tarefa Ocorrencia</h1>
									</div>
						              <form class="user" method="post">                    Tem Certeza que deseja deletar este objeto?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Deletar" name="deletar_tarefa_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}