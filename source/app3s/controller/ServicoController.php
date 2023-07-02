<?php

/**
 * Classe feita para manipulação do objeto ServicoController
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\model\Servico;
use app3s\util\Sessao;
use Illuminate\Support\Facades\DB;

class ServicoController
{







	public function main()
	{
		$sessao = new Sessao();
		if ($sessao->getNivelAcesso() != Sessao::NIVEL_ADM) {
			return;
		}


		if (isset($_GET['edit'])) {
			$this->edit();
		} else if (isset($_GET['delete'])) {
			$this->delete();
		} else {
			echo '

        <div class="card mb-4">
            <div class="card-body">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';
			$this->add();
			$services = DB::table('servico')
				->join('area_responsavel', 'servico.id_area_responsavel', '=', 'area_responsavel.id')
				->join('grupo_servico', 'servico.id_grupo_servico', '=', 'grupo_servico.id')
				->join('tipo_atividade', 'servico.id_tipo_atividade', '=', 'tipo_atividade.id')
				->select(
					'servico.id',
					'servico.tempo_sla',
					'servico.visao',
					'servico.nome AS nome',
					'servico.descricao AS descricao',
					'area_responsavel.nome AS area_responsavel',
					'grupo_servico.nome AS grupo_servico',
					'tipo_atividade.nome AS tipo_atividade'
				)
				->get();
			foreach ($services as $service) {
				$service->visao = $this->toStringVisao($service->visao);
			}
			echo view('partials.index-service', ['services' => $services]);
			echo '		</div>
				</div>
			</div>
		</div>';
		}
	}

	public function edit()
	{
		if (!isset($_GET['edit'])) {
			return;
		}

		$selected = DB::table('servico')->find($_GET['edit']);
		if (!isset($_POST['edit_servico'])) {

			$listTipoAtividade = DB::table('tipo_atividade')->get();
			$listAreaResponsavel = DB::table('area_responsavel')->get();
			$listGrupoServico = DB::table('grupo_servico')->get();
			echo view(
				'partials.form-edit-service',
				[
					'listaTipoAtividade' => $listTipoAtividade,
					'listaAreaResponsavel' => $listAreaResponsavel,
					'listaGrupoServico' => $listGrupoServico,
					'selected' => $selected
				]
			);
			return;
		}

		if (!(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['tempo_sla']) && isset($_POST['visao']) &&  isset($_POST['tipo_atividade']) &&  isset($_POST['area_responsavel']) &&  isset($_POST['grupo_servico']))) {
			echo "Incompleto";
			return;
		}



		$id = $_GET['edit'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$idTipo = $_POST['tipo_atividade'];
		$tempoSla = $_POST['tempo_sla'];
		$visao = $_POST['visao'];
		$idArea = $_POST['area_responsavel'];
		$grupo = $_POST['grupo_servico'];


		$affectedRows = DB::table('servico')
			->where('id', $id)
			->update([
				'nome' => $nome,
				'descricao' => $descricao,
				'id_tipo_atividade' => $idTipo,
				'tempo_sla' => $tempoSla,
				'visao' => $visao,
				'id_area_responsavel' => $idArea,
				'id_grupo_servico' => $grupo
			]);

		if ($affectedRows) {
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
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=servico">';
	}



	const VISAO_INATIVO = 0;
	const VISAO_COMUM = 1;
	const VISAO_TECNICO = 2;
	const VISAO_ADMIN = 3;

	/**
	 *
	 * @param int $visao
	 * @return string
	 */
	public static function toStringVisao($visao)
	{
		$str = "Valor inválido";
		switch ($visao) {
			case self::VISAO_INATIVO:
				$str = "Inativo";
				break;
			case self::VISAO_COMUM:
				$str = "Comum";
				break;
			case self::VISAO_TECNICO:
				$str = "Técnico";
				break;
			case self::VISAO_ADMIN:
				$str = "Administrador";
				break;
			default:
				$str = "Valor inválido";
				break;
		}
		return $str;
	}
	public function delete()
	{
		if (!isset($_GET['delete'])) {
			return;
		}
		$selected = new Servico();
		$selected->setId($_GET['delete']);
		if (!isset($_POST['delete_servico'])) {
			echo view('partials.confirm-delete', ['message' => 'Tem certeza que deseja apagar este serviço?']);
			return;
		}

		try {
			DB::table('servico')->where('id', $_GET['delete'])->delete();
			echo '
			<div class="alert alert-success" role="alert">
			  Sucesso ao excluir Servico
			</div>';
		} catch (\Exception $e) {
			echo '
				<div class="alert alert-danger" role="alert">
				Falha ao tentar excluir Servico
				</div>';
		}
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=?page=servico">';
	}






	public function add()
	{

		if (!isset($_POST['enviar_servico'])) {
			$listTipoAtividade = DB::table('tipo_atividade')->get();


			$listAreaResponsavel = DB::table('area_responsavel')->get();
			$listGrupoServico = DB::table('grupo_servico')->get();

			echo view('partials.form-insert-service', [
				'listaTipoAtividade' => $listTipoAtividade,
				'listaAreaResponsavel' => $listAreaResponsavel,
				'listaGrupoServico' => $listGrupoServico
			]);

			return;
		}
		if (!(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['tempo_sla']) && isset($_POST['visao']) &&  isset($_POST['tipo_atividade']) &&  isset($_POST['area_responsavel']) &&  isset($_POST['grupo_servico']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing.
                </div>

                ';
			return;
		}

		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$tempoSla = $_POST['tempo_sla'];
		$visao = $_POST['visao'];
		$tipoAtividade = $_POST['tipo_atividade'];
		$areaResponsavel = $_POST['area_responsavel'];
		$grupoServico = $_POST['grupo_servico'];
		$result = DB::table('servico')->insert([
			'nome' => $nome,
			'descricao' => $descricao,
			'id_tipo_atividade' => $tipoAtividade,
			'tempo_sla' => $tempoSla,
			'visao' => $visao,
			'id_area_responsavel' => $areaResponsavel,
			'id_grupo_servico' => $grupoServico
		]);
		if ($result) {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Servico
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Servico
</div>

';
		}
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=servico">';
	}
}
