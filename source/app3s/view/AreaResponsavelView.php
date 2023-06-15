<?php

/**
 * Classe de visao para AreaResponsavel
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace app3s\view;
use app3s\model\AreaResponsavel;


class AreaResponsavelView {


	public function showEditForm(AreaResponsavel $selecionado) {
		echo '



<div class="card o-hidden border-0 shadow-lg mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Editar Área Responsavel</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post" id="edit_form_area_responsavel">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getNome().'"  name="nome" id="nome" placeholder="Nome">
                						</div>
                                        <div class="form-group">
                                            <label for="descricao">Descricao</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getDescricao().'"  name="descricao" id="descricao" placeholder="Descricao">
                						</div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getEmail().'"  name="email" id="email" placeholder="Email">
                						</div>
                <input type="hidden" value="1" name="edit_area_responsavel">
                </form>

        </div>
        <div class="modal-footer">
            <button form="edit_form_area_responsavel" type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </div>
</div>




						              ';
	}





        public function showSelected(AreaResponsavel $arearesponsavel){
            echo '

	<div class="card o-hidden border-0 shadow-lg">
        <div class="card">
            <div class="card-header">
                  Area Responsavel selecionado
            </div>
            <div class="card-body">
                Id: '.$arearesponsavel->getId().'<br>
                Nome: '.$arearesponsavel->getNome().'<br>
                Descricao: '.$arearesponsavel->getDescricao().'<br>
                Email: '.$arearesponsavel->getEmail().'<br>

            </div>
        </div>
    </div>


';
    }



    public function confirmDelete(AreaResponsavel $areaResponsavel) {
		echo '



				<div class="card o-hidden border-0 ">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row d-flex justify-content-center">

							<div class="col-md-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Delete Area Responsavel</h1>
									</div>
						              <form class="user" method="post">                    Tem certeza que deseja apagar esta área responsável?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Delete" name="delete_area_responsavel">
                                        <hr>

						              </form>

								</div>
							</div>
						</div>
					</div>




	</div>';
	}



}