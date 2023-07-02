<?php

/**
 * Classe feita para manipulação do objeto AreaResponsavelController
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\model\AreaResponsavel;
use Illuminate\Support\Facades\DB;

class AreaResponsavelController
{

	public function delete()
	{
		if (!isset($_GET['delete'])) {
			return;
		}
		$selected = new AreaResponsavel();
		$selected->setId($_GET['delete']);
		if (!isset($_POST['delete_area_responsavel'])) {
			echo view('partials.confirm-delete', ['message' => 'Tem certeza que deseja deletar esta divisão?']);
			return;
		}
		$deletedRows = DB::table('area_responsavel')
		->where('id', $_GET['delete'])
		->delete();

		if ($deletedRows > 0) {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Area Responsavel
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Area Responsavel
</div>

';
		}
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=?page=area_responsavel">';
	}



	public function add()
	{

		if (!isset($_POST['enviar_area_responsavel'])) {
			echo view('partials.form-insert-division');
			return;
		}
		if (!(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['email']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing.
                </div>

                ';
			return;
		}

		$inserted = DB::table('area_responsavel')->insert([
			'nome' => $_POST['nome'],
			'descricao' => $_POST['descricao'],
			'email' => $_POST['email']
		]);

		if ($inserted) {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Area Responsavel
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Area Responsavel
</div>

';
		}
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=area_responsavel">';
	}


	public function edit()
	{
		if (!isset($_GET['edit'])) {
			return;
		}

		$selected = DB::table("area_responsavel")->where('id', $_GET['edit'])->first();

		if (!isset($_POST['edit_area_responsavel'])) {

			echo view('partials.form-edit-division', ['division' => $selected]);
			return;
		}

		if (!(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['email']))) {
			echo "Incompleto";
			return;
		}


		$affectedRows = DB::table('area_responsavel')
		->where('id', $_GET['edit'])
		->update([
			'nome' => $_POST['nome'],
			'descricao' => $_POST['descricao'],
			'email' => $_POST['email']
		]);
		if ($affectedRows > 0) {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha
</div>

';
		}
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=area_responsavel">';
	}


	public function main()
	{
		echo '<div class="card mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';

		if (isset($_GET['select'])) {

			$this->select();

			return;
		}

		if (isset($_GET['edit'])) {
			$this->edit();
		} else if (isset($_GET['delete'])) {
			$this->delete();
		} else {

			$this->add();
			$list = DB::table('area_responsavel')->get();
			echo view('partials.index-division', ['list' => $list]);

		}
		echo '</div></div></div></div>';
	}



	public function select()
	{
		if (!isset($_GET['select'])) {
			return;
		}
		$selected = DB::table("area_responsavel")->where('id', $_GET['select'])->first();
		echo view('partials.show-division', ['division' => $selected]);
	}
}
