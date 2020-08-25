<?php
            
/**
 * Classe de visao para MensagemForum
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class MensagemForumView {
    public function mostraFormInserir() {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddMensagemForum">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddMensagemForum" tabindex="-1" role="dialog" aria-labelledby="labelAddMensagemForum" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddMensagemForum">Adicionar Mensagem Forum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


          <form id="form_enviar_mensagem_forum" class="user" method="post">
            <input type="hidden" name="enviar_mensagem_forum" value="1">                



                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <input type="number" class="form-control"  name="tipo" id="tipo" placeholder="Tipo">
                                        </div>

                                        <div class="form-group">
                                            <label for="mensagem">Mensagem</label>
                                            <input type="text" class="form-control"  name="mensagem" id="mensagem" placeholder="Mensagem">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_user">Id User</label>
                                            <input type="number" class="form-control"  name="id_user" id="id_user" placeholder="Id User">
                                        </div>

                                        <div class="form-group">
                                            <label for="dt_envio">Dt Envio</label>
                                            <input type="datetime-local" class="form-control"  name="dt_envio" id="dt_envio" placeholder="Dt Envio">
                                        </div>

                                        <div class="form-group">
                                            <label for="origem">Origem</label>
                                            <input type="number" class="form-control"  name="origem" id="origem" placeholder="Origem">
                                        </div>

                                        <div class="form-group">
                                            <label for="ativo">Ativo</label>
                                            
                    <select class="form-control" id="ativo" name="ativo">
                        <option value="">Selecione Um Valor</option>
                          <option value="1">Sim</option>
                          <option value="0">Não</option>
                    </select>
                                        </div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_enviar_mensagem_forum" type="submit" class="btn btn-primary">Cadastrar</button>
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
                  Lista Mensagem Forum
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Tipo</th>
						<th>Mensagem</th>
						<th>Id User</th>
                        <th>Ações</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Tipo</th>
                        <th>Mensagem</th>
                        <th>Id User</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $elemento){
                echo '<tr>';
                echo '<td>'.$elemento->getId().'</td>';
                echo '<td>'.$elemento->getTipo().'</td>';
                echo '<td>'.$elemento->getMensagem().'</td>';
                echo '<td>'.$elemento->getIdUser().'</td>';
                echo '<td>
                        <a href="?pagina=mensagem_forum&selecionar='.$elemento->getId().'" class="btn btn-info text-white">Selecionar</a>
                        <a href="?pagina=mensagem_forum&editar='.$elemento->getId().'" class="btn btn-success text-white">Editar</a>
                        <a href="?pagina=mensagem_forum&deletar='.$elemento->getId().'" class="btn btn-danger text-white">Deletar</a>
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
            


            
        public function mostrarSelecionado(MensagemForum $mensagemforum){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Mensagem Forum selecionado
            </div>
            <div class="card-body">
                Id: '.$mensagemforum->getId().'<br>
                Tipo: '.$mensagemforum->getTipo().'<br>
                Mensagem: '.$mensagemforum->getMensagem().'<br>
                Id User: '.$mensagemforum->getIdUser().'<br>
                Dt Envio: '.$mensagemforum->getDtEnvio().'<br>
                Origem: '.$mensagemforum->getOrigem().'<br>
                Ativo: '.$mensagemforum->getAtivo().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


            
	public function mostraFormEditar(MensagemForum $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Editar Mensagem Forum</h1>
									</div>
						              <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getTipo().'"  name="tipo" id="tipo" placeholder="Tipo">
                						</div>
                                        <div class="form-group">
                                            <label for="mensagem">Mensagem</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getMensagem().'"  name="mensagem" id="mensagem" placeholder="Mensagem">
                						</div>
                                        <div class="form-group">
                                            <label for="id_user">Id User</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdUser().'"  name="id_user" id="id_user" placeholder="Id User">
                						</div>
                                        <div class="form-group">
                                            <label for="dt_envio">Dt Envio</label>
                                            <input type="datetime-local" class="form-control" value="'.$selecionado->getDtEnvio().'"  name="dt_envio" id="dt_envio" placeholder="Dt Envio">
                						</div>
                                        <div class="form-group">
                                            <label for="origem">Origem</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getOrigem().'"  name="origem" id="origem" placeholder="Origem">
                						</div>
                                        <div class="form-group">
                                            <label for="ativo">Ativo</label>
                                            
                    <select class="form-control" id="ativo" name="ativo" required>
                        <option value="">Selecione Um Valor</option>
                          <option value="1">Sim</option>
                          <option value="0">Não</option>
                    </select>
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="editar_mensagem_forum">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}



                                            
    public function confirmarDeletar(MensagemForum $mensagemForum) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Deletar Mensagem Forum</h1>
									</div>
						              <form class="user" method="post">                    Tem Certeza que deseja deletar este objeto?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Deletar" name="deletar_mensagem_forum">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}