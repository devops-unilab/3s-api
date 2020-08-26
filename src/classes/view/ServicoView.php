<?php
            
/**
 * Classe de visao para Servico
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class ServicoView {
    public function mostraFormInserir($listaTipoAtividade, $listaAreaResponsavel, $listaGrupoServico) {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddServico">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddServico" tabindex="-1" role="dialog" aria-labelledby="labelAddServico" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddServico">Adicionar Servico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


          <form id="form_enviar_servico" class="user" method="post">
            <input type="hidden" name="enviar_servico" value="1">                



                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control"  name="nome" id="nome" placeholder="Nome">
                                        </div>

                                        <div class="form-group">
                                            <label for="descricao">Descricao</label>
                                            <input type="text" class="form-control"  name="descricao" id="descricao" placeholder="Descricao">
                                        </div>

                                        <div class="form-group">
                                            <label for="tempo_sla">Tempo Sla</label>
                                            <input type="number" class="form-control"  name="tempo_sla" id="tempo_sla" placeholder="Tempo Sla">
                                        </div>

                                        <div class="form-group">
                                            <label for="visao">Visao</label>
                                            <input type="number" class="form-control"  name="visao" id="visao" placeholder="Visao">
                                        </div>
                                        <div class="form-group">
                                          <label for="tipo_atividade">Tipo Atividade</label>
                						  <select class="form-control" id="tipo_atividade" name="tipo_atividade">
                                            <option value="">Selecione o Tipo Atividade</option>';
                                                
        foreach( $listaTipoAtividade as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
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
                                          <label for="grupo_servico">Grupo Servico</label>
                						  <select class="form-control" id="grupo_servico" name="grupo_servico">
                                            <option value="">Selecione o Grupo Servico</option>';
                                                
        foreach( $listaGrupoServico as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_enviar_servico" type="submit" class="btn btn-primary">Cadastrar</button>
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
                  Lista Servico
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nome</th>
						<th>Descricao</th>
						<th>Tempo Sla</th>
						<th>Tipo Atividade</th>
						<th>Area Responsavel</th>
						<th>Grupo Servico</th>
                        <th>Ações</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th>Tempo Sla</th>
						<th>Tipo Atividade</th>
						<th>Area Responsavel</th>
						<th>Grupo Servico</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $elemento){
                echo '<tr>';
                echo '<td>'.$elemento->getId().'</td>';
                echo '<td>'.$elemento->getNome().'</td>';
                echo '<td>'.$elemento->getDescricao().'</td>';
                echo '<td>'.$elemento->getTempoSla().'</td>';
                echo '<td>'.$elemento->getTipoAtividade().'</td>';
                echo '<td>'.$elemento->getAreaResponsavel().'</td>';
                echo '<td>'.$elemento->getGrupoServico().'</td>';
                echo '<td>
                        <a href="?pagina=servico&selecionar='.$elemento->getId().'" class="btn btn-info text-white">Selecionar</a>
                        <a href="?pagina=servico&editar='.$elemento->getId().'" class="btn btn-success text-white">Editar</a>
                        <a href="?pagina=servico&deletar='.$elemento->getId().'" class="btn btn-danger text-white">Deletar</a>
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
            


            
        public function mostrarSelecionado(Servico $servico){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Servico selecionado
            </div>
            <div class="card-body">
                Id: '.$servico->getId().'<br>
                Nome: '.$servico->getNome().'<br>
                Descricao: '.$servico->getDescricao().'<br>
                Tempo Sla: '.$servico->getTempoSla().'<br>
                Visao: '.$servico->getVisao().'<br>
                Tipo Atividade: '.$servico->getTipoAtividade().'<br>
                Area Responsavel: '.$servico->getAreaResponsavel().'<br>
                Grupo Servico: '.$servico->getGrupoServico().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


            
	public function mostraFormEditar($listaTipoAtividade, $listaAreaResponsavel, $listaGrupoServico, Servico $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Editar Servico</h1>
									</div>
						              <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getNome().'"  name="nome" id="nome" placeholder="Nome">
                						</div>
                                        <div class="form-group">
                                            <label for="descricao">Descricao</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getDescricao().'"  name="descricao" id="descricao" placeholder="Descricao">
                						</div>
                                        <div class="form-group">
                                            <label for="tempo_sla">Tempo Sla</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getTempoSla().'"  name="tempo_sla" id="tempo_sla" placeholder="Tempo Sla">
                						</div>
                                        <div class="form-group">
                                            <label for="visao">Visao</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getVisao().'"  name="visao" id="visao" placeholder="Visao">
                						</div>
                                        <div class="form-group">
                                          <label for="tipo_atividade">Tipo Atividade</label>
                						  <select class="form-control" id="tipo_atividade" name="tipo_atividade">
                                            <option value="">Selecione o Tipo Atividade</option>';
                                                
        foreach( $listaTipoAtividade as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
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
                                          <label for="grupo_servico">Grupo Servico</label>
                						  <select class="form-control" id="grupo_servico" name="grupo_servico">
                                            <option value="">Selecione o Grupo Servico</option>';
                                                
        foreach( $listaGrupoServico as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="editar_servico">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}



                                            
    public function confirmarDeletar(Servico $servico) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Deletar Servico</h1>
									</div>
						              <form class="user" method="post">                    Tem Certeza que deseja deletar este objeto?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Deletar" name="deletar_servico">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}