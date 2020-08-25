<?php
            
/**
 * Classe de visao para PermissaoUsuario
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class PermissaoUsuarioView {
    public function mostraFormInserir($listaSetor) {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddPermissaoUsuario">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddPermissaoUsuario" tabindex="-1" role="dialog" aria-labelledby="labelAddPermissaoUsuario" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddPermissaoUsuario">Adicionar Permissao Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


          <form id="form_enviar_permissao_usuario" class="user" method="post">
            <input type="hidden" name="enviar_permissao_usuario" value="1">                



                                        <div class="form-group">
                                            <label for="perfil">Perfil</label>
                                            <input type="text" class="form-control"  name="perfil" id="perfil" placeholder="Perfil">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_usuario_sigaa">Id Usuario Sigaa</label>
                                            <input type="number" class="form-control"  name="id_usuario_sigaa" id="id_usuario_sigaa" placeholder="Id Usuario Sigaa">
                                        </div>

                                        <div class="form-group">
                                            <label for="usuario">Usuario</label>
                                            <input type="text" class="form-control"  name="usuario" id="usuario" placeholder="Usuario">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control"  name="email" id="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                          <label for="setor">Setor</label>
                						  <select class="form-control" id="setor" name="setor">
                                            <option value="">Selecione o Setor</option>';
                                                
        foreach( $listaSetor as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_enviar_permissao_usuario" type="submit" class="btn btn-primary">Cadastrar</button>
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
                  Lista Permissao Usuario
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Perfil</th>
						<th>Id Usuario Sigaa</th>
						<th>Usuario</th>
						<th>Setor</th>
                        <th>Ações</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Perfil</th>
                        <th>Id Usuario Sigaa</th>
                        <th>Usuario</th>
						<th>Setor</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $elemento){
                echo '<tr>';
                echo '<td>'.$elemento->getId().'</td>';
                echo '<td>'.$elemento->getPerfil().'</td>';
                echo '<td>'.$elemento->getIdUsuarioSigaa().'</td>';
                echo '<td>'.$elemento->getUsuario().'</td>';
                echo '<td>'.$elemento->getSetor().'</td>';
                echo '<td>
                        <a href="?pagina=permissao_usuario&selecionar='.$elemento->getId().'" class="btn btn-info text-white">Selecionar</a>
                        <a href="?pagina=permissao_usuario&editar='.$elemento->getId().'" class="btn btn-success text-white">Editar</a>
                        <a href="?pagina=permissao_usuario&deletar='.$elemento->getId().'" class="btn btn-danger text-white">Deletar</a>
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
            


            
        public function mostrarSelecionado(PermissaoUsuario $permissaousuario){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Permissao Usuario selecionado
            </div>
            <div class="card-body">
                Id: '.$permissaousuario->getId().'<br>
                Perfil: '.$permissaousuario->getPerfil().'<br>
                Id Usuario Sigaa: '.$permissaousuario->getIdUsuarioSigaa().'<br>
                Usuario: '.$permissaousuario->getUsuario().'<br>
                Email: '.$permissaousuario->getEmail().'<br>
                Setor: '.$permissaousuario->getSetor().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


            
	public function mostraFormEditar($listaSetor, PermissaoUsuario $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Editar Permissao Usuario</h1>
									</div>
						              <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="perfil">Perfil</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getPerfil().'"  name="perfil" id="perfil" placeholder="Perfil">
                						</div>
                                        <div class="form-group">
                                            <label for="id_usuario_sigaa">Id Usuario Sigaa</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdUsuarioSigaa().'"  name="id_usuario_sigaa" id="id_usuario_sigaa" placeholder="Id Usuario Sigaa">
                						</div>
                                        <div class="form-group">
                                            <label for="usuario">Usuario</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getUsuario().'"  name="usuario" id="usuario" placeholder="Usuario">
                						</div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getEmail().'"  name="email" id="email" placeholder="Email">
                						</div>
                                        <div class="form-group">
                                          <label for="setor">Setor</label>
                						  <select class="form-control" id="setor" name="setor">
                                            <option value="">Selecione o Setor</option>';
                                                
        foreach( $listaSetor as $elemento){
            echo '<option value="'.$elemento->getId().'">'.$elemento.'</option>';
        }
            
        echo '
                                          </select>
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="editar_permissao_usuario">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}



                                            
    public function confirmarDeletar(PermissaoUsuario $permissaoUsuario) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Deletar Permissao Usuario</h1>
									</div>
						              <form class="user" method="post">                    Tem Certeza que deseja deletar este objeto?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Deletar" name="deletar_permissao_usuario">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}