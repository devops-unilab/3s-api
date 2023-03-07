<?php
            
/**
 * Classe de visao para Servico
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\view;

use novissimo3s\controller\ServicoController;
use novissimo3s\model\Servico;


class ServicoView {
    
    public function showInsertForm($listaTipoAtividade, $listaAreaResponsavel, $listaGrupoServico) {
        
        $visoes = array(ServicoController::VISAO_ADMIN, ServicoController::VISAO_INATIVO, ServicoController::VISAO_COMUM, ServicoController::VISAO_TECNICO);
        
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
                                          <label for="visao">Visão</label>
                						  <select class="form-control" id="tipo_atividade" name="visao" id="visao">
                                            <option value="">Selecione uma visão</option>';
        
        foreach( $visoes as $element){

            echo '<option value="'.$element.'" >'.ServicoController::toStringVisao($element).'</option>';
        }
        
        echo '
                                          </select>
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



     
    
    public function showList($lista)
    {
        echo '
            
            
            
            
          <div class="card">
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
						<th>Visão</th>
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
						<th>Visão</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';

        foreach ($lista as $element) {
            echo '<tr>';
            echo '<td>' . $element->getId() . '</td>';
            echo '<td>' . $element->getNome() . '</td>';
            echo '<td>' . $element->getDescricao() . '</td>';
            echo '<td>' . $element->getTempoSla() . '</td>';
            echo '<td>' . $element->getTipoAtividade()->getNome() . '</td>';
            echo '<td>' . $element->getAreaResponsavel()->getNome() . '</td>';
            echo '<td>' . $element->getGrupoServico()->getNome() . '</td>';
            echo '<td>' . ServicoController::toStringVisao($element->getVisao()). '</td>';
            echo '<td>

<a href="?page=servico&edit=' . $element->getId() . '" class="btn btn-success btn-circle btn-lg"><i class="fa fa-pencil icone-maior"></i></a>
<a href="?page=servico&delete=' . $element->getId() . '" class="btn btn-danger btn-circle btn-lg"><i class="fa fa-trash icone-maior"></i></a>

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
        
        $visoes = array(ServicoController::VISAO_ADMIN, ServicoController::VISAO_INATIVO, ServicoController::VISAO_COMUM, ServicoController::VISAO_TECNICO);
        
        echo '
            
            
            
<div class="card o-hidden border-0 shadow-lg mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Servico</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post" id="edit_form_servico">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getNome().'"  name="nome" id="nome" placeholder="Nome">
                						</div>
                                        <div class="form-group">
                                            <label for="descricao">Descricao</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getDescricao().'"  name="descricao" id="descricao" placeholder="Descricao">
                						</div>
                                        <div class="form-group">
                                            <label for="tempo_sla">Tempo SLA(Em horas)</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getTempoSla().'"  name="tempo_sla" id="tempo_sla" placeholder="Tempo Sla">
                						</div>


                                        <div class="form-group">
                                          <label for="visao">Visão</label>
                						  <select class="form-control" name="visao" id="visao">
                                            <option value="">Selecione uma visão</option>';
        
        foreach( $visoes as $element){
            $strAtribut = "";
            if($element == $selecionado->getVisao()){
                $strAtribut = "selected";
            }
            echo '<option value="'.$element.'" '.$strAtribut.' >'.ServicoController::toStringVisao($element).'</option>';
        }
        
        echo '
                                          </select>
                						</div>



                                        <div class="form-group">
                                          <label for="tipo_atividade">Tipo Atividade</label>
                						  <select class="form-control" id="tipo_atividade" name="tipo_atividade">
                                            <option value="">Selecione o Tipo Atividade</option>';
        
        foreach( $listaTipoAtividade as $element){
            $strAtribut = "";
            if($element->getId() == $selecionado->getTipoAtividade()->getId()){
                $strAtribut = "selected";
            }
            echo '<option value="'.$element->getId().'" '.$strAtribut.' >'.$element->getNome().'</option>';
        }
        
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="area_responsavel">Area Responsavel</label>
                						  <select class="form-control" id="area_responsavel" name="area_responsavel">
                                            <option value="">Selecione o Area Responsavel</option>';
        
        foreach( $listaAreaResponsavel as $element){
            $strAtribut = "";
            if($element->getId() == $selecionado->getAreaResponsavel()->getId()){
                $strAtribut = "selected";
            }
            echo '<option value="'.$element->getId().'" '.$strAtribut.' >'.$element->getNome().'</option>';
        }
        
        echo '
                                          </select>
                						</div>
                                        <div class="form-group">
                                          <label for="grupo_servico">Grupo Servico</label>
                						  <select class="form-control" id="grupo_servico" name="grupo_servico">
                                            <option value="">Selecione o Grupo Servico</option>';
        
        foreach( $listaGrupoServico as $element){
            $strAtribut = "";
            if($element->getId() == $selecionado->getGrupoServico()->getId()){
                $strAtribut = "selected";
            }
            echo '<option value="'.$element->getId().'" '.$strAtribut.' >'.$element->getNome().'</option>';
        }
        
        echo '
                                          </select>
                						</div>
                <input type="hidden" value="1" name="edit_servico">
                </form>
            
        </div>
        <div class="modal-footer">
            <button form="edit_form_servico" type="submit" class="btn btn-primary">Alterar</button>
        </div>
    </div>
</div>
            
            
            
            
						              ';
    }




            
        public function showSelected(Servico $servico){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg">
        <div class="card">
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
            
            
            
				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
            
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Apagar Serviço</h1>
									</div>
						              <form class="user" method="post">Tem certeza que deseja apagar este serviço?
            
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