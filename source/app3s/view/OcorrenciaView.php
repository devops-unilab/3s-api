<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace app3s\view;

use DateTime;
use app3s\controller\StatusOcorrenciaController;
use app3s\dao\UsuarioDAO;
use app3s\model\Ocorrencia;
use app3s\model\Usuario;
use app3s\util\Sessao;

class OcorrenciaView {

    
    public function mostraFormInserir2($listaServico){
        
        $sessao = new Sessao();
        
        echo '
            
            
            
  <div class="card card-body">
            
            
<form  id="insert_form_ocorrencia"  method="post" action="" enctype="multipart/form-data">
    <span class="titulo medio">Informe os dados para cadastro</span><br>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="select-demanda">Serviço*</label>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <select id="select-servicos" name="servico" required>
                        <option value="" selected="selected">Selecione um serviço</option>';
        foreach($listaServico as $servico){
            echo '
                        <option value="'.$servico->getId().'">'.$servico->getNome();
            if($servico->getDescricao() != ""){
                echo ' - ('.$servico->getDescricao().') ';
                

            }
            echo '</option>';
            
        }
        echo '
            
            
            
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="descricao">Descrição*</label>
                    <textarea class="form-control" rows="3" name="descricao" id="descricao" required></textarea>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="anexo" id="anexo" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*, application/zip,application/rar, .ovpn, .xlsx">
                      <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
                    </div>
            
                </div>
            </div>

        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row"><!--Campus Local Sala Contato(Ramal e email)-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="campus">Campus*</label>
                    <select name="campus" id="select-campus" required>
                        <option value="" selected>Selecione um Campus</option>
                        <option value="liberdade">Campus Liberdade</option>
                        <option value="auroras">Campus Auroras</option>
                        <option value="palmares">Campus Palmares</option>
                        <option value="males">Campus dos Malês</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="local_sala">Local/Sala</label>
                    <input class="form-control" type="text" name="local_sala" id="local_sala" value="" >
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="patrimonio">Patrimônio</label>
                    <input class="form-control" type="text" name="patrimonio" id="patrimonio" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >Ramal</label>
                    <input class="form-control" type="number" name="ramal" id="ramal" value="">
                </div>
            
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="email" >E-mail*</label>
                    <input class="form-control" type="email" name="email" id="email" value="'.trim($sessao->getEmail()).'" required>
                </div>
                        
            </div>
        </div>
    </div>
    <input type="hidden" name="enviar_ocorrencia" value="1">
                        
</form>
                        
                        
  </div><br><br>
<div class="d-flex justify-content-center m-3">
        <button id="btn-inserir-ocorrencia" form="insert_form_ocorrencia" type="submit" class="btn btn-primary">Cadastrar Ocorrência</button>
                        
</div><br><br>
                        
                        
';
    }
    
    public function mostraFormEditar2(Ocorrencia $ocorrencia, $listaServico){
        $sessao = new Sessao();
        echo '
            
            
  <div class="card card-body">
            
            
<form method="post" action="" enctype="multipart/form-data">
    <span class="titulo medio">Informe os dados para cadastro</span><br>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="select-demanda">Serviço*</label>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <select id="select-servicos" name="item_ocorrencia" required>
                        <option value="" selected="selected">Selecione um serviço</option>';
        foreach($listaServico as $servico){
            if($servico->getDescricao() == ""){
                $descricao = $servico->getNome();
            }else{
                $descricao = $servico->getDescricao();
            }
            echo '
                        <option value="'.$servico->getId().'">'.$descricao.'</option>';
        }
        echo '
            
            
            
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="desc_problema">Descrição*</label>
                    <textarea class="form-control" rows="3" name="desc_problema" id="desc_problema" required>'.ltrim($ocorrencia->getDescricao()).'</textarea>
                </div>
            </div>
            <br>
<!--
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="anexo" id="anexo">
                      <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
                    </div>
                        
                </div>
            </div>
-->
                        
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row"><!--Campus Local Sala Contato(Ramal e email)-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="campus">Campus*</label>
                    <select name="campus" id="select-campus" required>
                        <option value="" selected>Selecione um Campus</option>
                        <option value="liberdade">Campus Liberdade</option>
                        <option value="auroras">Campus Auroras</option>
                        <option value="palmares">Campus Palmares</option>
                        <option value="males">Campus dos Malês</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="local_sala">Local/Sala</label>
                    <input class="form-control" type="text" name="local_sala" id="local_sala" value="" >
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="etiq_equipamento">Patrimônio</label>
                    <input class="form-control" type="text" name="etiq_equipamento" id="etiq_equipamento" rel="tooltip" title="Identificação do Equipamento. (Opcional)" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >Ramal</label>
                    <input class="form-control" type="text" name="ramal" id="ramal" value="">
                </div>
                        
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >E-mail*</label>
                    <input class="form-control" type="text" name="email" id="email" value="'.$sessao->getEmail().'" required>
                </div>
                        
            </div>
        </div>
    </div>
                        
</form>
                        
                        
  </div><br><br>
<div class="d-flex justify-content-center m-3">
        <input type="submit" id="btn-submit" name="enviar_ocorrencia" value="Cadastrar Ocorrência" class="btn btn-primary" >
</div><br><br>
                        
                        
';
    }
    
    public function exibirListaTab($lista)
    {
        
        echo '
            
            
                   <div class="alert-group">';
        
        
        
        
        echo '
            
<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Campus</th>
						<th>Setor</th>
						<th>Servico</th>
						<th>Usuario Cliente</th>
                        <th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Campus</th>
						<th>Setor</th>
						<th>Servico</th>
						<th>Usuario Cliente</th>
                        <th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
        
        foreach($lista as $elemento){
            $strClass = 'alert-warning';
            if($elemento->getStatus() == 'a'){
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'e'){//Em atendimento
                $strClass = 'alert-info';
            }else if($elemento->getStatus() == 'f'){//Fechado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'g'){//Fechado confirmado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'h'){//Cancelado
                $strClass = 'alert-secondary';
            }else if($elemento->getStatus() == 'r'){//reaberto
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'b'){//reservado
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'c'){//em espera
                $strClass = 'alert-info';
            }else if($elemento->getStatus() == 'd'){//Aguardando usuario
                $strClass = 'alert-danger';
            }else if($elemento->getStatus() == 'i'){//Aguardando ativo
                $strClass = 'alert-danger';
            }
            

            
            echo '<tr class="alert '.$strClass.' alert-dismissable">';
            echo '<td>'.$elemento->getId().'</td>';
            echo '<td>'.$elemento->getCampus().'</td>';
            echo '<td>'.$elemento->getAreaResponsavel()->getNome().'</td>';
            echo '<td>'.$elemento->getServico()->getNome().'</td>';
            echo '<td>'.$elemento->getUsuarioCliente()->getNome().'</td>';
            echo '<td>
                    <a href="?page=ocorrencia&selecionar='.$elemento->getId().'" class="btn btn-info text-white"><i class="fa fa-search icone-maior"></i></a>
                  </td>';
            echo '</tr>';
            

            //      <a href="" class="list-group-item active"> -</a>
            
        }
        echo '
				</tbody>
			</table>
		</div>';
        
        echo '
                    </div>';
        
        
        
        
    }
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



          
    
    public function exibirLista($lista)
    {
        
        echo '
            
            
                   <div class="alert-group">';
        
        $strClass = 'alert-warning';
        foreach($lista as $elemento){
            
            if($elemento->getStatus() == 'a'){
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'e'){//Em atendimento
                $strClass = 'alert-info';
            }else if($elemento->getStatus() == 'f'){//Fechado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'g'){//Fechado confirmado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'h'){//Cancelado
                $strClass = 'alert-secondary';
            }else if($elemento->getStatus() == 'r'){//reaberto
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'b'){//reservado
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'c'){//em espera
                $strClass = 'alert-info';
            }else if($elemento->getStatus() == 'd'){//Aguardando usuario
                $strClass = 'alert-danger';
            }else if($elemento->getStatus() == 'i'){//Aguardando ativo
                $strClass = 'alert-danger';
            }
            
            echo '
                
            <div class="alert '.$strClass.' alert-dismissable">
                <a href="?page=ocorrencia&selecionar='.$elemento->getId().'" class="close"><i class="fa fa-search icone-maior"></i></a>
                    
                <strong>#'.$elemento->getId().'</strong>
                 '.substr($elemento->getDescricao(), 0, 80).'...
            </div>
                  ';
            
        }
        
        if(count($lista) == 0){
            echo '
                
            <div class="alert alert-light alert-dismissable text-center">
                <strong>Nenhuma Ocorrência</strong>
                
            </div>
                  ';
        }
        echo '
                    </div>';
        
        
        
        
    }
    
    public function exibirListaPaginada($lista, $id = '')
    {
        $strId = "";
        if($id != ''){
            $strId = " id = ".$id;
        }
        echo '
            
            
                   <div '.$strId.' class="alert-group">';
        
        $strClass = 'alert-warning';
        foreach($lista as $elemento){
            
            if($elemento->getStatus() == 'a'){
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'e'){//Em atendimento
                $strClass = 'alert-info';
            }else if($elemento->getStatus() == 'f'){//Fechado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'g'){//Fechado confirmado
                $strClass = 'alert-success';
            }else if($elemento->getStatus() == 'h'){//Cancelado
                $strClass = 'alert-secondary';
            }else if($elemento->getStatus() == 'r'){//reaberto
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'b'){//reservado
                $strClass = 'alert-warning';
            }else if($elemento->getStatus() == 'c'){//em espera
                $strClass = 'alert-info';
            }else if($elemento->getStatus() == 'd'){//Aguardando usuario
                $strClass = ' alert-secondary';
            }else if($elemento->getStatus() == 'i'){//Aguardando ativo
                $strClass = 'alert-danger';
            }
            
            $descricao = "";
            $descricao = htmlspecialchars($elemento->getDescricao());
            if(strlen($descricao) > 200){
                $descricao = substr($descricao, 0, 200).'...';
            }
            echo '
                
            <div class="alert '.$strClass.' alert-dismissable">
                <a href="?page=ocorrencia&selecionar='.$elemento->getId().'" class="close"><i class="fa fa-search icone-maior"></i></a>
                    
                <strong>#'.$elemento->getId().' </strong>';
            echo $descricao;
            echo '</div>
                  ';
            
        }
        
        if(count($lista) == 0){
            echo '
                
            <div class="alert alert-light alert-dismissable text-center">
                <strong>Nenhuma Ocorrência</strong>
                
            </div>
                  ';
        }
        echo '
                    </div>';
        
        
        
        
    }
    
    
    /**
     * Passe a sigla do status
     * @param string $status
     */
    public function getStrStatus($status){
        $strStatus = "Aberto";
        switch ($status){
            case StatusOcorrenciaController::STATUS_ABERTO:
                $strStatus = "Aberto";
                break;
            case StatusOcorrenciaController::STATUS_ATENDIMENTO:
                $strStatus = "Em atendimento";
                break;
            case StatusOcorrenciaController::STATUS_FECHADO:
                $strStatus = "Fechado";
                break;
            case StatusOcorrenciaController::STATUS_FECHADO_CONFIRMADO:
                $strStatus = "Fechado Confirmado";
                break;
            case StatusOcorrenciaController::STATUS_CANCELADO:
                $strStatus = "Cancelado";
                break;
            case StatusOcorrenciaController::STATUS_REABERTO:
                $strStatus = "Reaberto";
                break;
            case StatusOcorrenciaController::STATUS_RESERVADO:
                $strStatus = "Reservado";
                break;
            case StatusOcorrenciaController::STATUS_EM_ESPERA:
                $strStatus = "Em espera";
                break;
            case StatusOcorrenciaController::STATUS_AGUARDANDO_USUARIO:
                $strStatus = "Aguardando Usuário";
                break;
            case StatusOcorrenciaController::STATUS_AGUARDANDO_ATIVO:
                $strStatus = "Aguardando ativo da DTI";
                break;
        }
        return $strStatus;
    }
    
         
    
    /**
     *
     * @param Ocorrencia $ocorrencia
     * @param array:StatusOcorrencia $listaStatus
     */
    public function mostrarSelecionado2(Ocorrencia $ocorrencia, $listaStatus, $dataAbertura, $dataSolucao){
        $statusView = new StatusOcorrenciaView();
        $controller = new StatusOcorrenciaController();
        
        echo '

            
            
            <div class="row">';
        echo '
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    ';
        
        echo '
                <div class="card mb-4">
                    <div class="card-body">';
        echo '
                   <b> Descricao: </b>'.strip_tags($ocorrencia->getDescricao()).'<br>';
        
        
        
        

      

        
        if(trim($ocorrencia->getAnexo()) != ""){
            echo '<b>Anexo: </b><a target="_blank" href="uploads/'.$ocorrencia->getAnexo().'"> Clique aqui</a> <br>';
        }

        echo '
            
            
                    </div>
                </div>


';
        
        echo '
                <div class="card mb-4">
                    <div class="card-body">';
        
        echo '<b>Patrimônio: </b>'.strip_tags($ocorrencia->getPatrimonio()).'<br>';
        
        
        
        
        if($controller->possoEditarPatrimonio($ocorrencia)){
            $statusView->botaoEditarPatrimonio();
        }
        
        echo '
            
                    </div>
                </div>
            
            
';


            echo '
                <div class="card mb-4">
                    <div class="card-body">';
            
           echo '<b>Solucao: </b>'.strip_tags($ocorrencia->getSolucao()).'<br>';
           

           

           if($controller->possoEditarSolucao($ocorrencia)){
               $statusView->botaoEditarSolucao();
           }
           
            echo '



                    </div>
                </div>
                
                
';
            


        echo '
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    ';
        echo '
                <div class="card mb-4">
                    <div class="card-body">
                        <b>Classificação do Chamado: </b>'.$ocorrencia->getServico()->getNome().'<br>';
        if($controller->possoEditarServico($ocorrencia)){
            $statusView->botaoEditarServico();
        }
        echo '<hr>';
        
        $this->painelSLA($ocorrencia, $listaStatus, $dataAbertura, $dataSolucao);
        
        echo '
                    </div>
                </div>

';
        echo '
            
            <div class="card mb-4">
                <div class="card-body">
                    <b>Requisitante: </b>'.$ocorrencia->getUsuarioCliente()->getNome().' <br>';
        if(trim($ocorrencia->getLocal()) != ""){
            echo ' <b>Setor do Requisitante:</b> '.$ocorrencia->getLocal().'<br>';
        }
        echo '
                    <b>Campus: </b>'.$ocorrencia->getCampus().' <br>
                    <b>Email: </b>'.$ocorrencia->getEmail().' <br> ';
        
        
        if(trim($ocorrencia->getLocalSala()) != ""){
            echo ' <b>Local/Sala: </b>'.$ocorrencia->getLocalSala().'<br>';
        }
        if(trim($ocorrencia->getRamal()) != ""){
            echo '<b>Ramal: </b>'.$ocorrencia->getRamal().'<br>';
        }
        
        echo '
                </div>
            </div>';
        
        
        echo '
            
        <div class="card mb-4">
            <div class="card-body">';
        echo '<b>Setor Responsável: </b>'.$ocorrencia->getAreaResponsavel()->getNome().
        ' - '.$ocorrencia->getAreaResponsavel()->getDescricao().'<br>';
        
        $usuarioDao = new UsuarioDAO();
        

        
        if($ocorrencia->getStatus() == StatusOcorrenciaController::STATUS_RESERVADO){
            if($ocorrencia->getIdUsuarioIndicado() != null){
                $indicado = new Usuario();
                $indicado->setId($ocorrencia->getIdUsuarioIndicado());
                $usuarioDao->fillById($indicado);
                echo '<b>Técnico Responsável: </b>'.$indicado->getNome().'<br>';
            }
        }else{
            if($ocorrencia->getIdUsuarioAtendente() != null){
                
                $atendente = new Usuario();
                $atendente->setId($ocorrencia->getIdUsuarioAtendente());
                $usuarioDao->fillById($atendente);
                echo '<b>Técnico Responsável:</b> '.$atendente->getNome().'<br>';
            }
        }
        
        if($controller->possoEditarAreaResponsavel($ocorrencia)){
            $statusView->botaoEditarAreaResponsavel();
        }
        
        echo '
            
            
            
            </div>
        </div>
            
            
            
';
        echo '
                </div>
';
        echo '</div>';
        
        
        
        
        
    }
    
    public function painelSLA(Ocorrencia $ocorrencia, $listaStatus, $dataAbertura, $dataSolucao){
 

        
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
            if($ocorrencia->getServico()->getTempoSla() > 1)
            {
                echo '<b>SLA: </b>'.$ocorrencia->getServico()->getTempoSla(). ' Horas úteis<br>';
            }else if($ocorrencia->getServico()->getTempoSla() == 1){
                echo '<b>SLA: </b> 1 Hora útil<br>';
                
            }else{
                echo ' SLA não definido. <br>';
                return;
            }
        }
        
        echo '
            
            <b>Data de Abertura: </b>'.date("d/m/Y" , strtotime($dataAbertura)).' '.date("H" , strtotime($dataAbertura)).'h'.date("i" , strtotime($dataAbertura)).' min <br>';
        
        
        if($ocorrencia->getStatus() == StatusOcorrenciaController::STATUS_FECHADO)
        {
            return;
        }
        if($ocorrencia->getStatus() == StatusOcorrenciaController::STATUS_FECHADO_CONFIRMADO)
        {
            return;
        }
        if($ocorrencia->getStatus() == StatusOcorrenciaController::STATUS_FECHADO)
        {
            return;
        }
        
        $timeHoje = time();
        $timeSolucaoEstimada = strtotime($dataSolucao);
        $timeAbertura = strtotime($dataAbertura);
        $timeRecorrido = $timeHoje - $timeAbertura;
        $total = $timeSolucaoEstimada - $timeAbertura;
            
            
            
        $date1 = new DateTime($dataAbertura);
        $date2 = new DateTime($dataSolucao);
        $diff = $date2->diff($date1);
        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);
        $minutos = $diff->i;
        $segundos  = $diff->s;
            
            
            
            
        if($timeHoje > $timeSolucaoEstimada){
            
            
            
            echo '<span class="text-danger"><b>Solução Estimada: </b>'.date("d/m/Y" , strtotime($dataSolucao)).' '.date("H" , strtotime($dataSolucao)).'h'.date("i" , strtotime($dataSolucao)).' min </span><br>';
            echo '<span class="escondido" id="tempo-total">'. str_pad($hours, 2 , '0' , STR_PAD_LEFT).':'.str_pad($minutos, 2 , '0' , STR_PAD_LEFT).':'.str_pad($segundos, 2 , '0' , STR_PAD_LEFT).'</span>';

            $sessao = new Sessao();
            if($ocorrencia->getUsuarioCliente()->getId() == $sessao->getIdUsuario()){
                if(!isset($_SESSION['pediu_ajuda'])){
                    $this->modalPedirAjuda($ocorrencia);
                }else{
                    echo '<br>Você solicitou ajuda, aguarde a resposta.';
                }
            }
            //O form do modal vai chamar o ajax no controller
            
            
        }else{
            $percentual = ($timeRecorrido *100)/$total;
            echo '
                    <p class="text-primary"><b>Solução Estimada: </b>'.date("d/m/Y" , strtotime($dataSolucao)).' '.date("H" , strtotime($dataSolucao)).'h'.date("i" , strtotime($dataSolucao)).' min.';
            echo '<p class="escondido">Tempo Total: <span id="tempo-total">'. str_pad($hours, 2 , '0' , STR_PAD_LEFT).':'.str_pad($minutos, 2 , '0' , STR_PAD_LEFT).':'.str_pad($segundos, 2 , '0' , STR_PAD_LEFT).'</span></p>';
            echo '';
            
            $date1 = new DateTime();
            $date2 = new DateTime($dataSolucao);
            $diff = $date2->diff($date1);
            $hours = $diff->h;
            $hours = $hours + ($diff->days*24);
            $minutos = $diff->i;
            $segundos  = $diff->s;
                
                
            echo '<p class="escondido">Tempo Restante:<span id="tempo-restante">'. str_pad($hours, 2 , '0' , STR_PAD_LEFT).':'.str_pad($minutos, 2 , '0' , STR_PAD_LEFT).':'.str_pad($segundos, 2 , '0' , STR_PAD_LEFT).'</span></p>
                            
';
                
                echo '
            <img src="img/bonequinho.gif" height="75" class="escondido"> 
            <div class="progress escondido">
				<div id="barra-progresso" class="progress-bar" role="progressbar" aria-valuenow="'.$percentual.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentual.'%;" data-toggle="tooltip" data-placement="top" title="Solução">
					<span id="label-progresso" class="sr-only">'.$percentual.'% Completo</span>
					<span id="label-progresso2" class="progress-type">Progresso '.intval($percentual).'% </span>
				</div>
			</div>
					    
';
                
        }
            
            
        
        

    }
    public function painelTopoSLA(Ocorrencia $ocorrencia, $listaStatus, $dataAbertura, $dataSolucao){
        
        
        if($ocorrencia->getServico()->getTempoSla() > 1)
        {
            echo '<b>Prazo de Resolução: </b>'.$ocorrencia->getServico()->getTempoSla(). ' Horas úteis ';
            echo '<br><b>Abertura: </b>'.date("d/m/Y G:i:s", strtotime($dataAbertura)).' </span>';
        }else if($ocorrencia->getServico()->getTempoSla() == 1){
            echo '<b>Prazo de Resolução: </b> 1 Hora útil';
            echo '<br><b>Abertura: </b>'.date("d/m/Y G:i:s", strtotime($dataAbertura)).' </span>';
        }else{
            echo ' SLA não definido. ';
            echo '<br><b>Abertura: </b>'.date("d/m/Y G:i:s", strtotime($dataAbertura)).' </span>';
            return;
        }
        
        
        
        
        
        
        
    }
    public function modalPedirAjuda(Ocorrencia $ocorrencia){
        echo '

<!-- Button trigger modal -->
<button type="button" id="botao-pedir-ajuda" class="dropdown-item text-right" data-toggle="modal" data-target="#modalPedirAjuda">
  Pedir Ajuda
</button>
            
<!-- Modal -->
<div class="modal fade" id="modalPedirAjuda" tabindex="-1" role="dialog" aria-labelledby="labelPedirAjuda" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelPedirAjuda">Pedir Ajuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_pedir_ajuda" class="user" method="post">
            <input type="hidden" name="pedir_ajuda" value="1">
            <input type="hidden" name="ocorrencia" value="'.$ocorrencia->getId().'">
            
            <span>Clique em solicitar ajuda para enviar um e-mail aos responsáveis pelo setor</span>    
            
		</form>
            
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_pedir_ajuda" type="submit" class="btn btn-primary">Solicitar Ajuda</button>
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