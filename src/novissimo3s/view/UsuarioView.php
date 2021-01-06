<?php
            
/**
 * Classe de visao para Usuario
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\view;
use novissimo3s\model\Usuario;


class UsuarioView {
    public function showInsertForm() {
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
          <form id="insert_form_usuario" class="user" method="post">
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
        <button form="insert_form_usuario" type="submit" class="btn btn-primary">Cadastrar</button>
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
                        <th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Login</th>
                        <th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
            
            foreach($lista as $element){
                echo '<tr>';
                echo '<td>'.$element->getId().'</td>';
                echo '<td>'.$element->getNome().'</td>';
                echo '<td>'.$element->getEmail().'</td>';
                echo '<td>'.$element->getLogin().'</td>';
                echo '<td>
                        <a href="?page=usuario&select='.$element->getId().'" class="btn btn-info text-white">Select</a>
                        <a href="?page=usuario&edit='.$element->getId().'" class="btn btn-success text-white">Edit</a>
                        <a href="?page=usuario&delete='.$element->getId().'" class="btn btn-danger text-white">Delete</a>
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
            

            
	public function showEditForm(Usuario $selecionado) {
		echo '
	    
	    

<div class="card o-hidden border-0 shadow-lg mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Usuario</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post" id="edit_form_usuario">
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
                <input type="hidden" value="1" name="edit_usuario">
                </form>

        </div>
        <div class="modal-footer">
            <button form="edit_form_usuario" type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </div>
</div>

	    

										
						              ';
	}




            
        public function showSelected(Usuario $usuario){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg">
        <div class="card">
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


                                            
    public function confirmDelete(Usuario $usuario) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Delete Usuario</h1>
									</div>
						              <form class="user" method="post">                    Are you sure you want to delete this object?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Delete" name="delete_usuario">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


}