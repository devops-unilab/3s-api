<?php
            
/**
 * Classe de visao para Servico
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\view;
use novissimo3s\model\Servico;



class ServicoView {
    public function showInsertForm($listaTipoAtividade, $listaAreaResponsavel, $listaGrupoServico) {
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
        


          <form id="insert_form_servico" class="user" method="post">
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
                                                
        foreach( $listaTipoAtividade as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
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
                                          <label for="grupo_servico">Grupo Servico</label>
                						  <select class="form-control" id="grupo_servico" name="grupo_servico">
                                            <option value="">Selecione o Grupo Servico</option>';
                                                
        foreach( $listaGrupoServico as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="insert_form_servico" type="submit" class="btn btn-primary">Cadastrar</button>
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
                        <th>Actions</th>
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
                        <th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $element){
                echo '<tr>';
                echo '<td>'.$element->getId().'</td>';
                echo '<td>'.$element->getNome().'</td>';
                echo '<td>'.$element->getDescricao().'</td>';
                echo '<td>'.$element->getTempoSla().'</td>';
                echo '<td>'.$element->getTipoAtividade().'</td>';
                echo '<td>'.$element->getAreaResponsavel().'</td>';
                echo '<td>'.$element->getGrupoServico().'</td>';
                echo '<td>
                        <a href="?page=servico&select='.$element->getId().'" class="btn btn-info text-white">Select</a>
                        <a href="?page=servico&edit='.$element->getId().'" class="btn btn-success text-white">Edit</a>
                        <a href="?page=servico&delete='.$element->getId().'" class="btn btn-danger text-white">Delete</a>
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
            

            
	public function showEditForm($listaTipoAtividade, $listaAreaResponsavel, $listaGrupoServico, Servico $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Edit Servico</h1>
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
                                                
        foreach( $listaTipoAtividade as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
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
                                          <label for="grupo_servico">Grupo Servico</label>
                						  <select class="form-control" id="grupo_servico" name="grupo_servico">
                                            <option value="">Selecione o Grupo Servico</option>';
                                                
        foreach( $listaGrupoServico as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="edit_servico">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}




            
        public function showSelected(Servico $servico){
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


                                            
    public function confirmDelete(Servico $servico) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Delete Servico</h1>
									</div>
						              <form class="user" method="post">                    Are you sure you want to delete this object?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Delete" name="delete_servico">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}