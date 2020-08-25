<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class OcorrenciaView {
    public function mostraFormInserir($listaAreaResponsavel, $listaServico) {
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
                                            <label for="id_funcionario">Id Funcionario</label>
                                            <input type="number" class="form-control"  name="id_funcionario" id="id_funcionario" placeholder="Id Funcionario">
                                        </div>

                                        <div class="form-group">
                                            <label for="desc_problema">Desc Problema</label>
                                            <input type="text" class="form-control"  name="desc_problema" id="desc_problema" placeholder="Desc Problema">
                                        </div>

                                        <div class="form-group">
                                            <label for="campus">Campus</label>
                                            <input type="text" class="form-control"  name="campus" id="campus" placeholder="Campus">
                                        </div>

                                        <div class="form-group">
                                            <label for="etiq_equipamento">Etiq Equipamento</label>
                                            <input type="text" class="form-control"  name="etiq_equipamento" id="etiq_equipamento" placeholder="Etiq Equipamento">
                                        </div>

                                        <div class="form-group">
                                            <label for="contato">Contato</label>
                                            <input type="text" class="form-control"  name="contato" id="contato" placeholder="Contato">
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
                                            <label for="funcionario">Funcionario</label>
                                            <input type="text" class="form-control"  name="funcionario" id="funcionario" placeholder="Funcionario">
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control"  name="status" id="status" placeholder="Status">
                                        </div>

                                        <div class="form-group">
                                            <label for="obs">Obs</label>
                                            <input type="text" class="form-control"  name="obs" id="obs" placeholder="Obs">
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
                                            <label for="fecha_confirmado">Fecha Confirmado</label>
                                            <input type="text" class="form-control"  name="fecha_confirmado" id="fecha_confirmado" placeholder="Fecha Confirmado">
                                        </div>

                                        <div class="form-group">
                                            <label for="reaberto">Reaberto</label>
                                            <input type="text" class="form-control"  name="reaberto" id="reaberto" placeholder="Reaberto">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_abertura">Dt Abertura</label>
                                            <input type="datetime-local" class="form-control"  name="dt_abertura" id="dt_abertura" placeholder="Dt Abertura">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_atendimento">Dt Atendimento</label>
                                            <input type="datetime-local" class="form-control"  name="dt_atendimento" id="dt_atendimento" placeholder="Dt Atendimento">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_fechamento">Dt Fechamento</label>
                                            <input type="datetime-local" class="form-control"  name="dt_fechamento" id="dt_fechamento" placeholder="Dt Fechamento">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_fecha_confirmado">Dt Fecha Confirmado</label>
                                            <input type="datetime-local" class="form-control"  name="dt_fecha_confirmado" id="dt_fecha_confirmado" placeholder="Dt Fecha Confirmado">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_cancelamento">Dt Cancelamento</label>
                                            <input type="datetime-local" class="form-control"  name="dt_cancelamento" id="dt_cancelamento" placeholder="Dt Cancelamento">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_atendente">Id Atendente</label>
                                            <input type="number" class="form-control"  name="id_atendente" id="id_atendente" placeholder="Id Atendente">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_tecnico_indicado">Id Tecnico Indicado</label>
                                            <input type="number" class="form-control"  name="id_tecnico_indicado" id="id_tecnico_indicado" placeholder="Id Tecnico Indicado">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_liberacao">Dt Liberacao</label>
                                            <input type="datetime-local" class="form-control"  name="dt_liberacao" id="dt_liberacao" placeholder="Dt Liberacao">
                                        </div>

                                        <div class="form-group">
                                            <label for="anexo">Anexo</label>
                                            <input type="text" class="form-control"  name="anexo" id="anexo" placeholder="Anexo">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_espera">Dt Espera</label>
                                            <input type="datetime-local" class="form-control"  name="dt_espera" id="dt_espera" placeholder="Dt Espera">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_aguardando_usuario">Dt Aguardando Usuario</label>
                                            <input type="datetime-local" class="form-control"  name="dt_aguardando_usuario" id="dt_aguardando_usuario" placeholder="Dt Aguardando Usuario">
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
						<th>Area Responsavel</th>
						<th>Servico</th>
                        <th>Ações</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
						<th>Area Responsavel</th>
						<th>Servico</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $elemento){
                echo '<tr>';
                echo '<td>'.$elemento->getId().'</td>';
                echo '<td>'.$elemento->getAreaResponsavel()->getNome().'</td>';
                echo '<td>'.$elemento->getServico()->getNome().'</td>';
                echo '<td>
                        <a href="?pagina=ocorrencia&selecionar='.$elemento->getId().'" class="btn btn-info text-white">Selecionar</a>
                        
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
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Ocorrencia selecionado
            </div>
            <div class="card-body">
                Id: '.$ocorrencia->getId().'<br>
                Id Local: '.$ocorrencia->getIdLocal().'<br>
                Id Funcionario: '.$ocorrencia->getIdFuncionario().'<br>
                Desc Problema: '.$ocorrencia->getDescProblema().'<br>
                Campus: '.$ocorrencia->getCampus().'<br>
                Etiq Equipamento: '.$ocorrencia->getEtiqEquipamento().'<br>
                Contato: '.$ocorrencia->getContato().'<br>
                Ramal: '.$ocorrencia->getRamal().'<br>
                Local: '.$ocorrencia->getLocal().'<br>
                Funcionario: '.$ocorrencia->getFuncionario().'<br>
                Status: '.$ocorrencia->getStatus().'<br>
                Obs: '.$ocorrencia->getObs().'<br>
                Prioridade: '.$ocorrencia->getPrioridade().'<br>
                Avaliacao: '.$ocorrencia->getAvaliacao().'<br>
                Email: '.$ocorrencia->getEmail().'<br>
                Fecha Confirmado: '.$ocorrencia->getFechaConfirmado().'<br>
                Reaberto: '.$ocorrencia->getReaberto().'<br>
                Dt Abertura: '.$ocorrencia->getDtAbertura().'<br>
                Dt Atendimento: '.$ocorrencia->getDtAtendimento().'<br>
                Dt Fechamento: '.$ocorrencia->getDtFechamento().'<br>
                Dt Fecha Confirmado: '.$ocorrencia->getDtFechaConfirmado().'<br>
                Dt Cancelamento: '.$ocorrencia->getDtCancelamento().'<br>
                Id Atendente: '.$ocorrencia->getIdAtendente().'<br>
                Id Tecnico Indicado: '.$ocorrencia->getIdTecnicoIndicado().'<br>
                Dt Liberacao: '.$ocorrencia->getDtLiberacao().'<br>
                Anexo: '.$ocorrencia->getAnexo().'<br>
                Dt Espera: '.$ocorrencia->getDtEspera().'<br>
                Dt Aguardando Usuario: '.$ocorrencia->getDtAguardandoUsuario().'<br>
                Local Sala: '.$ocorrencia->getLocalSala().'<br>
                Area Responsavel: '.$ocorrencia->getAreaResponsavel().'<br>
                Servico: '.$ocorrencia->getServico().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


            
	public function mostraFormEditar($listaAreaResponsavel, $listaServico, Ocorrencia $selecionado) {
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
                                            <label for="id_funcionario">Id Funcionario</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdFuncionario().'"  name="id_funcionario" id="id_funcionario" placeholder="Id Funcionario">
                						</div>
                                        <div class="form-group">
                                            <label for="desc_problema">Desc Problema</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getDescProblema().'"  name="desc_problema" id="desc_problema" placeholder="Desc Problema">
                						</div>
                                        <div class="form-group">
                                            <label for="campus">Campus</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getCampus().'"  name="campus" id="campus" placeholder="Campus">
                						</div>
                                        <div class="form-group">
                                            <label for="etiq_equipamento">Etiq Equipamento</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getEtiqEquipamento().'"  name="etiq_equipamento" id="etiq_equipamento" placeholder="Etiq Equipamento">
                						</div>
                                        <div class="form-group">
                                            <label for="contato">Contato</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getContato().'"  name="contato" id="contato" placeholder="Contato">
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
                                            <label for="funcionario">Funcionario</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getFuncionario().'"  name="funcionario" id="funcionario" placeholder="Funcionario">
                						</div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getStatus().'"  name="status" id="status" placeholder="Status">
                						</div>
                                        <div class="form-group">
                                            <label for="obs">Obs</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getObs().'"  name="obs" id="obs" placeholder="Obs">
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
                                            <label for="fecha_confirmado">Fecha Confirmado</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getFechaConfirmado().'"  name="fecha_confirmado" id="fecha_confirmado" placeholder="Fecha Confirmado">
                						</div>
                                        <div class="form-group">
                                            <label for="reaberto">Reaberto</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getReaberto().'"  name="reaberto" id="reaberto" placeholder="Reaberto">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_abertura">Dt Abertura</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtAbertura().'"  name="dt_abertura" id="dt_abertura" placeholder="Dt Abertura">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_atendimento">Dt Atendimento</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtAtendimento().'"  name="dt_atendimento" id="dt_atendimento" placeholder="Dt Atendimento">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_fechamento">Dt Fechamento</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtFechamento().'"  name="dt_fechamento" id="dt_fechamento" placeholder="Dt Fechamento">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_fecha_confirmado">Dt Fecha Confirmado</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtFechaConfirmado().'"  name="dt_fecha_confirmado" id="dt_fecha_confirmado" placeholder="Dt Fecha Confirmado">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_cancelamento">Dt Cancelamento</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtCancelamento().'"  name="dt_cancelamento" id="dt_cancelamento" placeholder="Dt Cancelamento">
                						</div>
                                        <div class="form-group">
                                            <label for="id_atendente">Id Atendente</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdAtendente().'"  name="id_atendente" id="id_atendente" placeholder="Id Atendente">
                						</div>
                                        <div class="form-group">
                                            <label for="id_tecnico_indicado">Id Tecnico Indicado</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdTecnicoIndicado().'"  name="id_tecnico_indicado" id="id_tecnico_indicado" placeholder="Id Tecnico Indicado">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_liberacao">Dt Liberacao</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtLiberacao().'"  name="dt_liberacao" id="dt_liberacao" placeholder="Dt Liberacao">
                						</div>
                                        <div class="form-group">
                                            <label for="anexo">Anexo</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getAnexo().'"  name="anexo" id="anexo" placeholder="Anexo">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_espera">Dt Espera</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtEspera().'"  name="dt_espera" id="dt_espera" placeholder="Dt Espera">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_aguardando_usuario">Dt Aguardando Usuario</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtAguardandoUsuario().'"  name="dt_aguardando_usuario" id="dt_aguardando_usuario" placeholder="Dt Aguardando Usuario">
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