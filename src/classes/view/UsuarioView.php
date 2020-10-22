<?php
            
/**
 * Classe de visao para Usuario
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class UsuarioView {
    public function mostraFormInserir() {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddUsuario">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddUsuario" tabindex="-1" role="dialog" aria-labelledby="labelAddUsuario" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddUsuario">Adicionar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


          <form id="form_enviar_usuario" class="user" method="post">
            <input type="hidden" name="enviar_usuario" value="1">                



                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control"  name="nome" id="nome" placeholder="Nome">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control"  name="email" id="email" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <label for="login">Login</label>
                                            <input type="text" class="form-control"  name="login" id="login" placeholder="Login">
                                        </div>

                                        <div class="form-group">
                                            <label for="senha">Senha</label>
                                            <input type="text" class="form-control"  name="senha" id="senha" placeholder="Senha">
                                        </div>

                                        <div class="form-group">
                                            <label for="nivel">Nivel</label>
                                            <input type="text" class="form-control"  name="nivel" id="nivel" placeholder="Nivel">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_setor">Id Setor</label>
                                            <input type="number" class="form-control"  name="id_setor" id="id_setor" placeholder="Id Setor">
                                        </div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="form_enviar_usuario" type="submit" class="btn btn-primary">Cadastrar</button>
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
                  Lista Usuario
                </div>
                <div class="card-body">
                                            
                                            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Login</th>
                        <th>Ações</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Login</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $elemento){
                echo '<tr>';
                echo '<td>'.$elemento->getId().'</td>';
                echo '<td>'.$elemento->getNome().'</td>';
                echo '<td>'.$elemento->getEmail().'</td>';
                echo '<td>'.$elemento->getLogin().'</td>';
                echo '<td>
                        <a href="?pagina=usuario&selecionar='.$elemento->getId().'" class="btn btn-info text-white">Selecionar</a>
                        <a href="?pagina=usuario&editar='.$elemento->getId().'" class="btn btn-success text-white">Editar</a>
                        <a href="?pagina=usuario&deletar='.$elemento->getId().'" class="btn btn-danger text-white">Deletar</a>
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
            


            
        public function mostrarSelecionado(Usuario $usuario){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card mb-4">
            <div class="card-header">
                  Usuario selecionado
            </div>
            <div class="card-body">
                Id: '.$usuario->getId().'<br>
                Nome: '.$usuario->getNome().'<br>
                Email: '.$usuario->getEmail().'<br>
                Login: '.$usuario->getLogin().'<br>
                Senha: '.$usuario->getSenha().'<br>
                Nivel: '.$usuario->getNivel().'<br>
                Id Setor: '.$usuario->getIdSetor().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


            
	public function mostraFormEditar(Usuario $selecionado) {
		echo '
	    
	    
	    
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
	    
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Editar Usuario</h1>
									</div>
						              <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getNome().'"  name="nome" id="nome" placeholder="Nome">
                						</div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getEmail().'"  name="email" id="email" placeholder="Email">
                						</div>
                                        <div class="form-group">
                                            <label for="login">Login</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getLogin().'"  name="login" id="login" placeholder="Login">
                						</div>
                                        <div class="form-group">
                                            <label for="senha">Senha</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getSenha().'"  name="senha" id="senha" placeholder="Senha">
                						</div>
                                        <div class="form-group">
                                            <label for="nivel">Nivel</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getNivel().'"  name="nivel" id="nivel" placeholder="Nivel">
                						</div>
                                        <div class="form-group">
                                            <label for="id_setor">Id Setor</label>
                                            <input type="number" class="form-control" value="'.$selecionado->getIdSetor().'"  name="id_setor" id="id_setor" placeholder="Id Setor">
                						</div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar" name="editar_usuario">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
	</div>';
	}



                                            
    public function confirmarDeletar(Usuario $usuario) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Deletar Usuario</h1>
									</div>
						              <form class="user" method="post">                    Tem Certeza que deseja deletar este objeto?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Deletar" name="deletar_usuario">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}