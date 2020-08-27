<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class OcorrenciaView {
    public function mostraFormInserir($listaAreaResponsavel, $listaServico, $listaUsuarioCliente) {
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
        


          <form id="form_enviar_ocorrencia" class="user" method="post">
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
                                            <input type="text" class="form-control"  name="anexo" id="anexo" placeholder="Anexo">
                                        </div>

                                        <div class="form-group">
                                            <label for="local_sala">Local Sala</label>
                                            <input type="text" class="form-control"  name="local_sala" id="local_sala" placeholder="Local Sala">
                                        </div>
                                        <div class="form-group">
                                          <label for="area_responsavel">Area Responsavel</label>
                						  <select class="form-control" id="area_responsavel" name="area_responsavel">
                                            <option value="">Selecione o Area Responsavel</option>';
                                                
        foreach( $listaAreaResponsavel as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="servico">Servico</label>
                						  <select class="form-control" id="servico" name="servico">
                                            <option value="">Selecione o Servico</option>';
                                                
        foreach( $listaServico as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="usuario_cliente">Usuario Cliente</label>
                						  <select class="form-control" id="usuario_cliente" name="usuario_cliente">
                                            <option value="">Selecione o Usuario Cliente</option>';
                                                
        foreach( $listaUsuarioCliente as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_enviar_ocorrencia" type="submit" class="btn btn-primary">Cadastrar</button>
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
                        <th>Ações</th>
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
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $elemento){
                echo '<tr>';
                echo '<td>'.$elemento->getId().'</td>';
                echo '<td>'.$elemento->getIdLocal().'</td>';
                echo '<td>'.$elemento->getDescricao().'</td>';
                echo '<td>'.$elemento->getCampus().'</td>';
                echo '<td>'.$elemento->getAreaResponsavel().'</td>';
                echo '<td>'.$elemento->getServico().'</td>';
                echo '<td>'.$elemento->getUsuarioCliente().'</td>';
                echo '<td>
                        <a href="?pagina=ocorrencia&selecionar='.$elemento->getId().'" class="btn btn-info text-white">Selecionar</a>
                        <a href="?pagina=ocorrencia&editar='.$elemento->getId().'" class="btn btn-success text-white">Editar</a>
                        <a href="?pagina=ocorrencia&deletar='.$elemento->getId().'" class="btn btn-danger text-white">Deletar</a>
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
            


            
        public function mostrarSelecionado(Ocorrencia $ocorrencia){
            echo '
            

        <div class="card mb-4">
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
                Area Responsavel: '.$ocorrencia->getAreaResponsavel().'<br>
                Servico: '.$ocorrencia->getServico().'<br>
                Usuario Cliente: '.$ocorrencia->getUsuarioCliente().'<br>
            
            </div>
        </div>

            
            
';
    }


            
	public function mostraFormEditar($listaAreaResponsavel, $listaServico, $listaUsuarioCliente, Ocorrencia $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Editar Ocorrencia</h1>
									</div>
						              <form class="user" method="post">
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
                                            <input type="text" class="form-control" value="'.$selecionado->getAnexo().'"  name="anexo" id="anexo" placeholder="Anexo">
                						</div>
                                        <div class="form-group">
                                            <label for="local_sala">Local Sala</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getLocalSala().'"  name="local_sala" id="local_sala" placeholder="Local Sala">
                						</div>
                                        <div class="form-group">
                                          <label for="area_responsavel">Area Responsavel</label>
                						  <select class="form-control" id="area_responsavel" name="area_responsavel">
                                            <option value="">Selecione o Area Responsavel</option>';
                                                
        foreach( $listaAreaResponsavel as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="servico">Servico</label>
                						  <select class="form-control" id="servico" name="servico">
                                            <option value="">Selecione o Servico</option>';
                                                
        foreach( $listaServico as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="usuario_cliente">Usuario Cliente</label>
                						  <select class="form-control" id="usuario_cliente" name="usuario_cliente">
                                            <option value="">Selecione o Usuario Cliente</option>';
                                                
        foreach( $listaUsuarioCliente as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="editar_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}



                                            
    public function confirmarDeletar(Ocorrencia $ocorrencia) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Deletar Ocorrencia</h1>
									</div>
						              <form class="user" method="post">                    Tem Certeza que deseja deletar este objeto?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Deletar" name="deletar_ocorrencia">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}