<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\view;
use novissimo3s\model\Ocorrencia;


class OcorrenciaView {
    public function showInsertForm($listaAreaResponsavel, $listaServico, $listaUsuarioCliente) {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddOcorrencia">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddOcorrencia" tabindex="-1" role="dialog" aria-labelledby="labelAddOcorrencia" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddOcorrencia">Adicionar Ocorrencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="insert_form_ocorrencia" class="user" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="enviar_ocorrencia" value="1">                



                                        <div class="form-group">
                                            <label for="id_local">Id Local</label>
                                            <input type="number" class="form-control"  name="id_local" id="id_local" placeholder="Id Local">
                                        </div>

                                        <div class="form-group">
                                            <label for="descricao">Descricao</label>
                                            <input type="text" class="form-control"  name="descricao" id="descricao" placeholder="Descricao">
                                        </div>

                                        <div class="form-group">
                                            <label for="campus">Campus</label>
                                            <input type="text" class="form-control"  name="campus" id="campus" placeholder="Campus">
                                        </div>

                                        <div class="form-group">
                                            <label for="patrimonio">Patrimonio</label>
                                            <input type="text" class="form-control"  name="patrimonio" id="patrimonio" placeholder="Patrimonio">
                                        </div>

                                        <div class="form-group">
                                            <label for="ramal">Ramal</label>
                                            <input type="text" class="form-control"  name="ramal" id="ramal" placeholder="Ramal">
                                        </div>

                                        <div class="form-group">
                                            <label for="local">Local</label>
                                            <input type="text" class="form-control"  name="local" id="local" placeholder="Local">
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control"  name="status" id="status" placeholder="Status">
                                        </div>

                                        <div class="form-group">
                                            <label for="solucao">Solucao</label>
                                            <input type="text" class="form-control"  name="solucao" id="solucao" placeholder="Solucao">
                                        </div>

                                        <div class="form-group">
                                            <label for="prioridade">Prioridade</label>
                                            <input type="text" class="form-control"  name="prioridade" id="prioridade" placeholder="Prioridade">
                                        </div>

                                        <div class="form-group">
                                            <label for="avaliacao">Avaliacao</label>
                                            <input type="text" class="form-control"  name="avaliacao" id="avaliacao" placeholder="Avaliacao">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control"  name="email" id="email" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_usuario_atendente">Id Usuario Atendente</label>
                                            <input type="number" class="form-control"  name="id_usuario_atendente" id="id_usuario_atendente" placeholder="Id Usuario Atendente">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_usuario_indicado">Id Usuario Indicado</label>
                                            <input type="number" class="form-control"  name="id_usuario_indicado" id="id_usuario_indicado" placeholder="Id Usuario Indicado">
                                        </div>

                                        <div class="form-group">
                                            <label for="anexo">Anexo</label>
                                            <input type="file" class="form-control"  name="anexo" id="anexo"  accept="image/png, image/jpeg">
                                        </div>

                                        <div class="form-group">
                                            <label for="local_sala">Local Sala</label>
                                            <input type="text" class="form-control"  name="local_sala" id="local_sala" placeholder="Local Sala">
                                        </div>

                                        <div class="form-group">
                                            <label for="data_abertura">Data Abertura</label>
                                            <input type="datetime-local" class="form-control"  name="data_abertura" id="data_abertura" placeholder="Data Abertura">
                                        </div>

                                        <div class="form-group">
                                            <label for="data_atendimento">Data Atendimento</label>
                                            <input type="datetime-local" class="form-control"  name="data_atendimento" id="data_atendimento" placeholder="Data Atendimento">
                                        </div>

                                        <div class="form-group">
                                            <label for="data_fechamento">Data Fechamento</label>
                                            <input type="datetime-local" class="form-control"  name="data_fechamento" id="data_fechamento" placeholder="Data Fechamento">
                                        </div>

                                        <div class="form-group">
                                            <label for="data_fechamento_confirmado">Data Fechamento Confirmado</label>
                                            <input type="datetime-local" class="form-control"  name="data_fechamento_confirmado" id="data_fechamento_confirmado" placeholder="Data Fechamento Confirmado">
                                        </div>
                                        <div class="form-group">
                                          <label for="area_responsavel">Area Responsavel</label>
                						  <select class="form-control" id="area_responsavel" name="area_responsavel">
                                            <option value="">Selecione o Area Responsavel</option>';
                                                
        foreach( $listaAreaResponsavel as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="servico">Servico</label>
                						  <select class="form-control" id="servico" name="servico">
                                            <option value="">Selecione o Servico</option>';
                                                
        foreach( $listaServico as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="usuario_cliente">Usuario Cliente</label>
                						  <select class="form-control" id="usuario_cliente" name="usuario_cliente">
                                            <option value="">Selecione o Usuario Cliente</option>';
                                                
        foreach( $listaUsuarioCliente as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="insert_form_ocorrencia" type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>
            
            
			
';
	}



                                            
                                            
    public function showList($lista){
           echo '
                                            
                                            
                                            

          <div class="card">
                <div class="card-header">
                  Lista Ocorrencia
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Id Local</th>
						<th>Descricao</th>
						<th>Campus</th>
						<th>Area Responsavel</th>
						<th>Servico</th>
						<th>Usuario Cliente</th>
                        <th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Id Local</th>
                        <th>Descricao</th>
                        <th>Campus</th>
						<th>Area Responsavel</th>
						<th>Servico</th>
						<th>Usuario Cliente</th>
                        <th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $element){
                echo '<tr>';
                echo '<td>'.$element->getId().'</td>';
                echo '<td>'.$element->getIdLocal().'</td>';
                echo '<td>'.$element->getDescricao().'</td>';
                echo '<td>'.$element->getCampus().'</td>';
                echo '<td>'.$element->getAreaResponsavel().'</td>';
                echo '<td>'.$element->getServico().'</td>';
                echo '<td>'.$element->getUsuarioCliente().'</td>';
                echo '<td>
                        <a href="?page=ocorrencia&select='.$element->getId().'" class="btn btn-info text-white">Select</a>
                        <a href="?page=ocorrencia&edit='.$element->getId().'" class="btn btn-success text-white">Edit</a>
                        <a href="?page=ocorrencia&delete='.$element->getId().'" class="btn btn-danger text-white">Delete</a>
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
            

            
	public function showEditForm($listaAreaResponsavel, $listaServico, $listaUsuarioCliente, Ocorrencia $selecionado) {
		echo '
	    
	    

<div class="card o-hidden border-0 shadow-lg mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Ocorrencia</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post" id="edit_form_ocorrencia">
                                        <div class="form-group">
                                            <label for="id_local">Id Local</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdLocal().'"  name="id_local" id="id_local" placeholder="Id Local">
                						</div>
                                        <div class="form-group">
                                            <label for="descricao">Descricao</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getDescricao().'"  name="descricao" id="descricao" placeholder="Descricao">
                						</div>
                                        <div class="form-group">
                                            <label for="campus">Campus</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getCampus().'"  name="campus" id="campus" placeholder="Campus">
                						</div>
                                        <div class="form-group">
                                            <label for="patrimonio">Patrimonio</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getPatrimonio().'"  name="patrimonio" id="patrimonio" placeholder="Patrimonio">
                						</div>
                                        <div class="form-group">
                                            <label for="ramal">Ramal</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getRamal().'"  name="ramal" id="ramal" placeholder="Ramal">
                						</div>
                                        <div class="form-group">
                                            <label for="local">Local</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getLocal().'"  name="local" id="local" placeholder="Local">
                						</div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getStatus().'"  name="status" id="status" placeholder="Status">
                						</div>
                                        <div class="form-group">
                                            <label for="solucao">Solucao</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getSolucao().'"  name="solucao" id="solucao" placeholder="Solucao">
                						</div>
                                        <div class="form-group">
                                            <label for="prioridade">Prioridade</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getPrioridade().'"  name="prioridade" id="prioridade" placeholder="Prioridade">
                						</div>
                                        <div class="form-group">
                                            <label for="avaliacao">Avaliacao</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getAvaliacao().'"  name="avaliacao" id="avaliacao" placeholder="Avaliacao">
                						</div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getEmail().'"  name="email" id="email" placeholder="Email">
                						</div>
                                        <div class="form-group">
                                            <label for="id_usuario_atendente">Id Usuario Atendente</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdUsuarioAtendente().'"  name="id_usuario_atendente" id="id_usuario_atendente" placeholder="Id Usuario Atendente">
                						</div>
                                        <div class="form-group">
                                            <label for="id_usuario_indicado">Id Usuario Indicado</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdUsuarioIndicado().'"  name="id_usuario_indicado" id="id_usuario_indicado" placeholder="Id Usuario Indicado">
                						</div>
                                        <div class="form-group">
                                            <label for="anexo">Anexo</label>
                                            <input type="file" class="form-control" value="'.$selecionado->getAnexo().'"  name="anexo" id="anexo" placeholder="Anexo">
                						</div>
                                        <div class="form-group">
                                            <label for="local_sala">Local Sala</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getLocalSala().'"  name="local_sala" id="local_sala" placeholder="Local Sala">
                						</div>
                                        <div class="form-group">
                                            <label for="data_abertura">Data Abertura</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDataAbertura().'"  name="data_abertura" id="data_abertura" placeholder="Data Abertura">
                						</div>
                                        <div class="form-group">
                                            <label for="data_atendimento">Data Atendimento</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDataAtendimento().'"  name="data_atendimento" id="data_atendimento" placeholder="Data Atendimento">
                						</div>
                                        <div class="form-group">
                                            <label for="data_fechamento">Data Fechamento</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDataFechamento().'"  name="data_fechamento" id="data_fechamento" placeholder="Data Fechamento">
                						</div>
                                        <div class="form-group">
                                            <label for="data_fechamento_confirmado">Data Fechamento Confirmado</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDataFechamentoConfirmado().'"  name="data_fechamento_confirmado" id="data_fechamento_confirmado" placeholder="Data Fechamento Confirmado">
                						</div>
                                        <div class="form-group">
                                          <label for="area_responsavel">Area Responsavel</label>
                						  <select class="form-control" id="area_responsavel" name="area_responsavel">
                                            <option value="">Selecione o Area Responsavel</option>';
                                                
        foreach( $listaAreaResponsavel as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="servico">Servico</label>
                						  <select class="form-control" id="servico" name="servico">
                                            <option value="">Selecione o Servico</option>';
                                                
        foreach( $listaServico as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="usuario_cliente">Usuario Cliente</label>
                						  <select class="form-control" id="usuario_cliente" name="usuario_cliente">
                                            <option value="">Selecione o Usuario Cliente</option>';
                                                
        foreach( $listaUsuarioCliente as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                <input type="hidden" value="1" name="edit_ocorrencia">
                </form>

        </div>
        <div class="modal-footer">
            <button form="edit_form_ocorrencia" type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </div>
</div>

	    

										
						              ';
	}




            
        public function showSelected(Ocorrencia $ocorrencia){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg">
        <div class="card">
            <div class="card-header">
                  Ocorrencia selecionado
            </div>
            <div class="card-body">
                Id: '.$ocorrencia->getId().'<br>
                Id Local: '.$ocorrencia->getIdLocal().'<br>
                Descricao: '.$ocorrencia->getDescricao().'<br>
                Campus: '.$ocorrencia->getCampus().'<br>
                Patrimonio: '.$ocorrencia->getPatrimonio().'<br>
                Ramal: '.$ocorrencia->getRamal().'<br>
                Local: '.$ocorrencia->getLocal().'<br>
                Status: '.$ocorrencia->getStatus().'<br>
                Solucao: '.$ocorrencia->getSolucao().'<br>
                Prioridade: '.$ocorrencia->getPrioridade().'<br>
                Avaliacao: '.$ocorrencia->getAvaliacao().'<br>
                Email: '.$ocorrencia->getEmail().'<br>
                Id Usuario Atendente: '.$ocorrencia->getIdUsuarioAtendente().'<br>
                Id Usuario Indicado: '.$ocorrencia->getIdUsuarioIndicado().'<br>
                Anexo: '.$ocorrencia->getAnexo().'<br>
                Local Sala: '.$ocorrencia->getLocalSala().'<br>
                Data Abertura: '.$ocorrencia->getDataAbertura().'<br>
                Data Atendimento: '.$ocorrencia->getDataAtendimento().'<br>
                Data Fechamento: '.$ocorrencia->getDataFechamento().'<br>
                Data Fechamento Confirmado: '.$ocorrencia->getDataFechamentoConfirmado().'<br>
                Area Responsavel: '.$ocorrencia->getAreaResponsavel().'<br>
                Servico: '.$ocorrencia->getServico().'<br>
                Usuario Cliente: '.$ocorrencia->getUsuarioCliente().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


                                            
    public function confirmDelete(Ocorrencia $ocorrencia) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Delete Ocorrencia</h1>
									</div>
						              <form class="user" method="post">                    Are you sure you want to delete this object?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Delete" name="delete_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


    public function showMensagens(Ocorrencia $ocorrencia){
        echo '
        
    	<div class="card o-hidden border-0 shadow-lg">
              <div class="card">
                <div class="card-header">
                  MensagemForum do Ocorrencia
                </div>
                <div class="card-body">
                      
                      
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>id</th>
						<th>tipo</th>
						<th>mensagem</th><th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>id</th>
                        <th>tipo</th>
                        <th>mensagem</th><th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
                
            foreach($ocorrencia->getMensagens() as $element){
                echo '<tr>';
                echo '<td>'.$element->getId().'</td>';
                echo '<td>'.$element->getTipo().'</td>';
                echo '<td>'.$element->getMensagem().'</td>';echo '<td>
                        <a href="?page=mensagem_forum&select='.$element->getId().'" class="btn btn-info">Selecionar</a>
                        <a href="?page=ocorrencia&select='.$ocorrencia->getId().'&remover_mensagem_forum='.$element->getId().'" class="btn btn-danger">Remover</a>
                      </td>';
                echo '<tr>';
            }
                
        echo '
				</tbody>
			</table>
		</div>
                
                
                
                
      </div>
  </div>
</div>
                
                
                
        ';
                
    }
                

}