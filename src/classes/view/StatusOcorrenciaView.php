<?php
            
/**
 * Classe de visao para StatusOcorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class StatusOcorrenciaView {
    public function mostraFormInserir($listaOcorrencia, $listaStatus, $listaUsuario) {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddStatusOcorrencia">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddStatusOcorrencia" tabindex="-1" role="dialog" aria-labelledby="labelAddStatusOcorrencia" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddStatusOcorrencia">Adicionar Status Ocorrencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


          <form id="form_enviar_status_ocorrencia" class="user" method="post">
            <input type="hidden" name="enviar_status_ocorrencia" value="1">                



                                        <div class="form-group">
                                            <label for="mensagem">Mensagem</label>
                                            <input type="text" class="form-control"  name="mensagem" id="mensagem" placeholder="Mensagem">
                                        </div>

                                        <div class="form-group">
                                            <label for="data_mudanca">Data Mudanca</label>
                                            <input type="datetime-local" class="form-control"  name="data_mudanca" id="data_mudanca" placeholder="Data Mudanca">
                                        </div>
                                        <div class="form-group">
                                          <label for="ocorrencia">Ocorrencia</label>
                						  <select class="form-control" id="ocorrencia" name="ocorrencia">
                                            <option value="">Selecione o Ocorrencia</option>';
                                                
        foreach( $listaOcorrencia as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="status">Status</label>
                						  <select class="form-control" id="status" name="status">
                                            <option value="">Selecione o Status</option>';
                                                
        foreach( $listaStatus as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="usuario">Usuario</label>
                						  <select class="form-control" id="usuario" name="usuario">
                                            <option value="">Selecione o Usuario</option>';
                                                
        foreach( $listaUsuario as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_enviar_status_ocorrencia" type="submit" class="btn btn-primary">Cadastrar</button>
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
                  Lista Status Ocorrencia
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Mensagem</th>
						<th>Data Mudanca</th>
						<th>Ocorrencia</th>
						<th>Status</th>
						<th>Usuario</th>
                        <th>Ações</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Mensagem</th>
                        <th>Data Mudanca</th>
						<th>Ocorrencia</th>
						<th>Status</th>
						<th>Usuario</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $elemento){
                echo '<tr>';
                echo '<td>'.$elemento->getId().'</td>';
                echo '<td>'.$elemento->getMensagem().'</td>';
                echo '<td>'.$elemento->getDataMudanca().'</td>';
                echo '<td>'.$elemento->getOcorrencia().'</td>';
                echo '<td>'.$elemento->getStatus().'</td>';
                echo '<td>'.$elemento->getUsuario().'</td>';
                echo '<td>
                        <a href="?pagina=status_ocorrencia&selecionar='.$elemento->getId().'" class="btn btn-info text-white">Selecionar</a>
                        <a href="?pagina=status_ocorrencia&editar='.$elemento->getId().'" class="btn btn-success text-white">Editar</a>
                        <a href="?pagina=status_ocorrencia&deletar='.$elemento->getId().'" class="btn btn-danger text-white">Deletar</a>
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
            


            
        public function mostrarSelecionado(StatusOcorrencia $statusocorrencia){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Status Ocorrencia selecionado
            </div>
            <div class="card-body">
                Id: '.$statusocorrencia->getId().'<br>
                Mensagem: '.$statusocorrencia->getMensagem().'<br>
                Data Mudanca: '.$statusocorrencia->getDataMudanca().'<br>
                Ocorrencia: '.$statusocorrencia->getOcorrencia().'<br>
                Status: '.$statusocorrencia->getStatus().'<br>
                Usuario: '.$statusocorrencia->getUsuario().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


            
	public function mostraFormEditar($listaOcorrencia, $listaStatus, $listaUsuario, StatusOcorrencia $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Editar Status Ocorrencia</h1>
									</div>
						              <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="mensagem">Mensagem</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getMensagem().'"  name="mensagem" id="mensagem" placeholder="Mensagem">
                						</div>
                                        <div class="form-group">
                                            <label for="data_mudanca">Data Mudanca</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDataMudanca().'"  name="data_mudanca" id="data_mudanca" placeholder="Data Mudanca">
                						</div>
                                        <div class="form-group">
                                          <label for="ocorrencia">Ocorrencia</label>
                						  <select class="form-control" id="ocorrencia" name="ocorrencia">
                                            <option value="">Selecione o Ocorrencia</option>';
                                                
        foreach( $listaOcorrencia as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="status">Status</label>
                						  <select class="form-control" id="status" name="status">
                                            <option value="">Selecione o Status</option>';
                                                
        foreach( $listaStatus as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="usuario">Usuario</label>
                						  <select class="form-control" id="usuario" name="usuario">
                                            <option value="">Selecione o Usuario</option>';
                                                
        foreach( $listaUsuario as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="editar_status_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}



                                            
    public function confirmarDeletar(StatusOcorrencia $statusOcorrencia) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Deletar Status Ocorrencia</h1>
									</div>
						              <form class="user" method="post">                    Tem Certeza que deseja deletar este objeto?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Deletar" name="deletar_status_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}