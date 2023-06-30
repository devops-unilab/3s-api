<?php

/**
 * Classe feita para manipulação do objeto OcorrenciaController
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\OcorrenciaDAO;
use app3s\dao\ServicoDAO;
use app3s\dao\StatusOcorrenciaDAO;
use app3s\dao\UsuarioDAO;
use app3s\model\Ocorrencia;
use app3s\model\StatusOcorrencia;
use app3s\model\Usuario;
use app3s\util\Mail;
use app3s\util\Sessao;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OcorrenciaController
{

	protected $selecionado;
	protected $sessao;
	protected  $view;
	protected $dao;

	public function __construct()
	{
		$this->dao = new OcorrenciaDAO();
	}




	public function fimDeSemana($data)
	{
		$diaDaSemana = intval(date('w', strtotime($data)));
		return ($diaDaSemana == 6 || $diaDaSemana == 0);
	}

	public function foraDoExpediente($data)
	{
		$hora = date('H', strtotime($data));
		$hora = intval($hora);
		if ($hora >= 17) {
			return true;
		}
		if ($hora < 8) {
			return true;
		}
		if ($hora == 11) {
			return true;
		}
		return false;
	}
	public function calcularHoraSolucao($dataAbertura, $tempoSla)
	{
		if ($dataAbertura == null) {
			return "Indefinido";
		}
		while ($this->fimDeSemana($dataAbertura)) {
			$dataAbertura = date("Y-m-d 08:00:00", strtotime('+1 day', strtotime($dataAbertura)));
		}
		while ($this->foraDoExpediente($dataAbertura)) {
			$dataAbertura = date("Y-m-d H:00:00", strtotime('+1 hour', strtotime($dataAbertura)));
		}
		$timeEstimado = strtotime($dataAbertura);
		$tempoSla++;
		for ($i = 0; $i < $tempoSla; $i++) {
			$timeEstimado = strtotime('+' . $i . ' hour', strtotime($dataAbertura));
			$horaEstimada = date("Y-m-d H:i:s", $timeEstimado);
			while ($this->fimDeSemana($horaEstimada)) {
				$horaEstimada = date("Y-m-d 08:00:00", strtotime('+1 day', strtotime($horaEstimada)));
				$i = $i + 24;
				$tempoSla += 24;
			}

			while ($this->foraDoExpediente($horaEstimada)) {
				$horaEstimada = date("Y-m-d H:i:s", strtotime('+1 hour', strtotime($horaEstimada)));
				$i++;
				$tempoSla++;
			}
		}
		$horaEstimada = date('Y-m-d H:i:s', $timeEstimado);
		return $horaEstimada;
	}


	public function parteInteressada()
	{
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
			return true;
		} else if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM) {
			return true;
		} else if ($this->selecionado->getUsuarioCliente()->getId() == $this->sessao->getIdUsuario()) {
			return true;
		} else {
			return false;
		}
	}

	public function getColorStatus($siglaStatus)
	{
		$strCartao = ' alert-warning ';
		if ($siglaStatus == 'a') {
			$strCartao = '  notice-warning';
		} else if ($siglaStatus == 'e') {
			$strCartao = '  notice-info ';
		} else if ($siglaStatus == 'f') {
			$strCartao = 'notice-success ';
		} else if ($siglaStatus == 'g') {
			$strCartao = 'notice-success ';
		} else if ($siglaStatus == 'h') {
			$strCartao = ' notice-warning ';
		} else if ($siglaStatus == 'r') {
			$strCartao = '  notice-warning ';
		} else if ($siglaStatus == 'b') {
			$strCartao = '  notice-warning ';
		} else if ($siglaStatus == 'c') {
			$strCartao = '   notice-warning ';
		} else if ($siglaStatus == 'd') {
			$strCartao = '  notice-warning ';
		} else if ($siglaStatus == 'i') {
			$strCartao = ' notice-warning';
		}
		return $strCartao;
	}
	public function canCancel($order)
	{
		return $this->sessao->getIdUsuario() == $order->id_usuario_cliente && ($order->status == self::STATUS_REABERTO ||  $order->status == self::STATUS_ABERTO);
	}
	public function canWait($currentStatus)
	{
		return $this->sessao->getNivelAcesso() != Sessao::NIVEL_COMUM && $currentStatus == 'e' && $this->sessao->getIdUsuario() != $this->selecionado->getIdUsuarioAtendente();
	}
	public function selecionar()
	{

		if (!isset($_GET['selecionar'])) {
			return;
		}
		$sessao = new Sessao();
		$this->sessao = new Sessao();
		$this->selecionado = new Ocorrencia();
		$this->selecionado->setId($_GET['selecionar']);
		$this->dao->fillById($this->selecionado);
		$selected = DB::table('ocorrencia')->where('id', $_GET['selecionar'])->first();



		if (!$this->parteInteressada()) {
			echo '
            <div class="alert alert-danger" role="alert">
                Você não é cliente deste chamado, nem técnico para atendê-lo.
            </div>
            ';
			return;
		}

		$orderStatusLog = DB::table('status_ocorrencia')
			->join('usuario', 'status_ocorrencia.id_usuario', '=', 'usuario.id')
			->join('status', 'status_ocorrencia.id_status', '=', 'status.id')
			->select('status.sigla', 'status.nome', 'status_ocorrencia.mensagem', 'usuario.nome as nome_usuario', 'status_ocorrencia.data_mudanca')
			->where('status_ocorrencia.id_ocorrencia', $selected->id)
			->get();


		$statusController = new StatusOcorrenciaController();
		$currentStatus = DB::table('status')->where('sigla', $this->selecionado->getStatus())->first();


		$listaUsuarios = DB::table('usuario')->whereIn('nivel', ['t', 'a'])->get();
		$listaServicos = DB::table('servico')->whereIn('visao', [1, 2])->get();
		$listaAreas = DB::table('area_responsavel')->get();

		echo view('partials.modal-form-status', ['services' => $listaServicos, 'providers' => $listaUsuarios, 'divisions' => $listaAreas, 'order' => $selected]);


		$dataSolucao = $this->calcularHoraSolucao($selected->data_abertura, $this->selecionado->getServico()->getTempoSla());
		$controller = new StatusOcorrenciaController();
		$canEditTag = $controller->possoEditarPatrimonio($this->selecionado);
		$canEditSolution = $controller->possoEditarSolucao($this->selecionado);
		$selected->service_name = $this->selecionado->getServico()->getNome();
		$canEditService = $controller->possoEditarServico($this->selecionado);
		$isClient = ($sessao->getNivelAcesso() == Sessao::NIVEL_COMUM);

		$selected->tempo_sla = $this->selecionado->getServico()->getTempoSla();
		$timeNow = time();
		$timeSolucaoEstimada = strtotime($dataSolucao);
		$isLate = $timeNow > $timeSolucaoEstimada;

		$canRequestHelp = ($this->selecionado->getUsuarioCliente()->getId() == $sessao->getIdUsuario() && !isset($_SESSION['pediu_ajuda']));
		$selected->client_name =  $this->selecionado->getUsuarioCliente()->getNome();


		$canEditDivision = $controller->possoEditarAreaResponsavel($this->selecionado);

		$usuarioDao = new UsuarioDAO();

		$providerName = '';

		if ($this->selecionado->getStatus() == StatusOcorrenciaController::STATUS_RESERVADO) {
			if ($this->selecionado->getIdUsuarioIndicado() != null) {
				$indicado = new Usuario();
				$indicado->setId($this->selecionado->getIdUsuarioIndicado());
				$usuarioDao->fillById($indicado);
				$providerName = $indicado->getNome();
			}
		} else {
			if ($this->selecionado->getIdUsuarioAtendente() != null) {

				$atendente = new Usuario();
				$atendente->setId($this->selecionado->getIdUsuarioAtendente());
				$usuarioDao->fillById($atendente);
				$providerName = $atendente->getNome();
			}
		}

		foreach ($orderStatusLog as $status) {
			$status->color = $this->getColorStatus($status->sigla);
		}

		echo '
            <div class="row">
                <div class="col-md-12 blog-main">
					<div class="row">
                		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="alert  bg-light d-flex justify-content-between align-items-center" role="alert">
				<div class="btn-group">
					<button class="btn btn-light btn-lg dropdown-toggle p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Chamado ' . $selected->id . '
					</button>
					<div class="dropdown-menu">

					<button type="button" acao="cancelar" ' . ($this->canCancel($selected) ? '' : 'disabled') . ' class="dropdown-item  botao-status"  data-toggle="modal" data-target="#modalStatus">
						Cancelar
						</button>

						';
		$statusController->painelStatus($this->selecionado, $selected);

		echo view('partials.show-order', [
			'order' => $selected,
			'canEditTag' => $canEditTag,
			'canEditSolution' => $canEditSolution,
			'canEditService' => $canEditService,
			'isLevelClient' => $isClient,
			'isLate' => $isLate,
			'dataSolucao' => $dataSolucao,
			'canRequestHelp' => $canRequestHelp,
			'providerDivision' => $this->selecionado->getAreaResponsavel()->getNome() . ' - ' . $this->selecionado->getAreaResponsavel()->getDescricao(),
			'providerName' => $providerName,
			'canEditDivision' => $canEditDivision,
			'orderStatusLog' => $orderStatusLog,
			'currentStatus' => $currentStatus
		]);


		$mensagemController = new MensagemForumController();
		$this->dao->fetchMensagens($this->selecionado);
		$mensagemController->mainOcorrencia($this->selecionado);
	}


	const STATUS_ABERTO = 'a';
	const STATUS_RESERVADO = 'b';
	const STATUS_EM_ESPERA = 'c';
	const STATUS_AGUARDANDO_USUARIO = 'd';
	const STATUS_ATENDIMENTO = 'e';
	const STATUS_FECHADO = 'f';
	const STATUS_FECHADO_CONFIRMADO = 'g';
	const STATUS_CANCELADO = 'h';
	const STATUS_AGUARDANDO_ATIVO = 'i';
	const STATUS_REABERTO = 'r';
	public function main()
	{

		echo '

<div class="card mb-4">
        <div class="card-body">';

		if (isset($_GET['selecionar'])) {
			$this->selecionar();
		} else if (isset($_GET['cadastrar'])) {
			$this->telaCadastro();
		} else {
			$this->listar();
		}



		echo '


	</div>
</div>




';
	}
	public function painel($lista, $strTitulo, $id, $strShow = "")
	{
		echo view(
			'partials.index-orders',
			[
				'orders' => $lista,
				'id' => $id,
				'title' => $strTitulo,
				'strShow' => $strShow
			]
		);
	}

	public function arrayStatusPendente()
	{
		$arrStatus = array();
		$arrStatus[] = StatusOcorrenciaController::STATUS_ABERTO;
		$arrStatus[] = StatusOcorrenciaController::STATUS_AGUARDANDO_ATIVO;
		$arrStatus[] = StatusOcorrenciaController::STATUS_AGUARDANDO_USUARIO;
		$arrStatus[] = StatusOcorrenciaController::STATUS_ATENDIMENTO;
		$arrStatus[] = StatusOcorrenciaController::STATUS_REABERTO;
		$arrStatus[] = StatusOcorrenciaController::STATUS_RESERVADO;
		return $arrStatus;
	}
	public function arrayStatusFinalizado()
	{

		$arrStatus = array();
		$arrStatus[] = StatusOcorrenciaController::STATUS_FECHADO;
		$arrStatus[] = StatusOcorrenciaController::STATUS_FECHADO_CONFIRMADO;
		$arrStatus[] = StatusOcorrenciaController::STATUS_CANCELADO;
		return $arrStatus;
	}

	public function atrasado($ocorrencia)
	{
		if ($ocorrencia->tempo_sla < 1) {
			return false;
		}
		$horaEstimada = $this->calcularHoraSolucao($ocorrencia->data_abertura, $ocorrencia->tempo_sla);
		$timeHoje = time();
		$timeSolucaoEstimada = strtotime($horaEstimada);
		return $timeHoje > $timeSolucaoEstimada;
	}

	public function applyFilters($query)
	{
		if (isset($_GET['setor'])) {
			$divisionId = intval($_GET['setor']);
			$query = $query->where('ocorrencia.id_area_responsavel', $divisionId);
		}
		if (isset($_GET['demanda'])) {
			$query = $query->where(function ($query) {
				$query->where('id_usuario_indicado', $this->sessao->getIdUsuario())->orWhere('id_usuario_atendente', $this->sessao->getIdUsuario());
			});
		}
		if (isset($_GET['solicitacao'])) {
			$query = $query->where('id_usuario_cliente', $this->sessao->getIdUsuario());
		}
		if (isset($_GET['tecnico'])) {
			$query = $query->where(function ($query) {
				$query->where('id_usuario_indicado', intval($_GET['tecnico']))->orWhere('id_usuario_atendente', intval($_GET['tecnico']));
			});
		}
		if (isset($_GET['requisitante'])) {
			$query = $query->where('id_usuario_cliente', intval($_GET['requisitante']));
		}
		if (isset($_GET['data_abertura1'])) {
			$data1 = date("Y-m-d", strtotime($_GET['data_abertura1']));
			$query = $query->where('data_abertura', '>=', $data1);
		}
		if (isset($_GET['data_abertura2'])) {
			$data2 = date("Y-m-d", strtotime($_GET['data_abertura2']));
			$query = $query->where('data_abertura', '<=', $data2);
		}
		if (isset($_GET['campus'])) {
			$campusArr = explode(",", $_GET['campus']);
			$query = $query->whereIn('campus', $campusArr);
		}
		if (isset($_GET['setores_responsaveis'])) {
			$divisions = explode(",", $_GET['setores_responsaveis']);
			$query = $query->whereIn('ocorrencia.id_area_responsavel', $divisions);
		}
		if (isset($_GET['setores_requisitantes'])) {
			$divisionsSig = explode(",", $_GET['setores_requisitantes']);
			$query = $query->whereIn('id_local', $divisionsSig);
		}

		return $query;
	}
	public function listar()
	{

		$sessao = new Sessao();

		$this->sessao = new Sessao();
		$listaAtrasados = array();

		$lista = array();

		$queryPendding = DB::table('ocorrencia')
			->select(
				'ocorrencia.id as id',
				'ocorrencia.descricao as descricao',
				'servico.tempo_sla as tempo_sla',
				'ocorrencia.data_abertura as data_abertura',
				'ocorrencia.status as status'
			)
			->join('servico', 'ocorrencia.id_servico', '=', 'servico.id')
			->whereIn('status', ['a', 'i', 'd', 'e', 'r', 'b'])->orderByDesc('ocorrencia.id');
		$queryFinished = DB::table('ocorrencia')
			->select(
				'ocorrencia.id as id',
				'ocorrencia.descricao as descricao',
				'servico.tempo_sla as tempo_sla',
				'ocorrencia.data_abertura as data_abertura',
				'ocorrencia.status as status'
			)
			->join('servico', 'ocorrencia.id_servico', '=', 'servico.id')
			->whereIn('status', ['f', 'g', 'h'])->orderByDesc('ocorrencia.id');

		$queryPendding = $this->applyFilters($queryPendding);
		$queryFinished = $this->applyFilters($queryFinished);

		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM) {
			$queryPendding = $queryPendding->where('id_usuario_cliente', $this->sessao->getIdUsuario());
			$queryFinished = $queryFinished->where('id_usuario_cliente', $this->sessao->getIdUsuario());
		}
		$lista = $queryPendding->limit(300)->get();
		$lista2 = $queryFinished->limit(300)->get();

		//Painel principal
		echo '

		<div class="row">
			<div class="col-md-8 blog-main">
				<div class="panel-group" id="accordion">';
		$listaAtrasados = array();
		foreach ($lista as $ocorrencia) {
			if ($this->atrasado($ocorrencia)) {
				$listaAtrasados[] = $ocorrencia;
			}
		}

		if (count($listaAtrasados) > 0) {

			echo view(
				'partials.index-orders',
				[
					'orders' => $listaAtrasados,
					'id' => 'collapseAtraso',
					'title' => 'Ocorrências Em Atraso (' . count($listaAtrasados) . ')',
					'strShow' => "show"
				]
			);
		}
		$this->painel($lista, 'Ocorrências Em Aberto(' . count($lista) . ')', 'collapseAberto', 'show');
		$this->painel($lista2, "Ocorrências Encerradas", 'collapseEncerrada');
		echo '
			</div>
		</div>';

		//Painel Lateral
		echo '
		<aside class="col-md-4 blog-sidebar">';
		if ($sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
			$sessao = new Sessao();
			$currentUser = DB::table('usuario')->where('id', $sessao->getIdUsuario())->first();
			$userDivision = DB::table('area_responsavel')->where('id', $currentUser->id_setor)->first();
			$attendents = DB::table('usuario')->where('nivel', 'a')->orWhere('nivel', 't')->get();
			$allUsers = DB::table('usuario')->get();
			$applicants = DB::table('ocorrencia')->select('local as division_sig', 'id_local as division_sig_id')->distinct()->limit(400)->get();
			$divisions = DB::table('area_responsavel')->select('id', 'nome as name')->get();

			echo '
                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Filtros</h4>';
			echo view('partials.form-basic-filter', ['userDivision' => $userDivision, 'attendents' => $attendents, 'allUsers' => $allUsers]);
			echo view('partials.form-advanced-filter', ['divisions' => $divisions, 'applicants' => $applicants]);
			echo view('partials.form-campus-filter');
			echo '</div>';
		}
		echo view('partials.card-info');
		echo '</aside>
		</div>
		';
	}

	public function telaCadastro()
	{
		$this->sessao = new Sessao();

		$ocorrencia = new Ocorrencia();
		$ocorrencia->getUsuarioCliente()->setId($this->sessao->getIdUsuario());


		$listaNaoAvaliados = DB::table('ocorrencia')->where('id_usuario_cliente', $this->sessao->getIdUsuario())->where('status', StatusOcorrenciaController::STATUS_FECHADO)->get();

		echo '
            <div class="row">
                <div class="col-md-12 blog-main">';


		$queryService = DB::table('servico');
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM) {
			$queryService->where('visao', 1);
		}
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
			$queryService->whereIn('visao', [1, 2]);
		}
		$services = $queryService->get();

		if (count($listaNaoAvaliados) == 0) {
			echo '<h3 class="pb-4 mb-4 font-italic border-bottom">Cadastrar Ocorrência</h3>';
			echo view('partials.form-insert-order', ['services' => $services, 'email' => $this->sessao->getEmail()]);
		} else {

			echo view(
				'partials.index-orders',
				[
					'orders' => $listaNaoAvaliados,
					'title' => 'Para continuar confirme os chamados fechados.',
					'id' => 'collapseToConfirm',
					'strShow' => 'show'
				]
			);
		}
		echo '
                </div>
            </div>';
	}


	public function mainAjax()
	{
		if (!isset($_POST['enviar_ocorrencia'])) {
			return;
		}



		if (!(isset($_POST['descricao']) &&
			isset($_POST['campus'])  &&
			isset($_POST['email']) &&
			isset($_POST['patrimonio']) &&
			isset($_POST['ramal']) &&
			isset($_POST['local_sala']) &&
			isset($_POST['servico']))) {
			echo ':incompleto';
			return;
		}

		$ocorrencia = new Ocorrencia();
		$usuario = new Usuario();
		$sessao = new Sessao();
		$usuario->setId($sessao->getIdUsuario());


		$usuarioDao = new UsuarioDAO($this->dao->getConnection());

		$usuarioDao->fillById($usuario);
		$sessao = new Sessao();
		$ocorrencia->setIdLocal($sessao->getIdUnidade());
		$ocorrencia->setLocal($sessao->getUnidade());

		if (trim($ocorrencia->getLocal()) == "") {
			$ocorrencia->setLocal('Não Informado');
		}
		if (trim($ocorrencia->getIdLocal()) == "") {
			$ocorrencia->setIdLocal(1);
		}

		$ocorrencia->setStatus(StatusOcorrenciaController::STATUS_ABERTO);

		$ocorrencia->getServico()->setId($_POST['servico']);
		$servicoDao = new ServicoDAO($this->dao->getConnection());
		$servicoDao->fillById($ocorrencia->getServico());
		$ocorrencia->getAreaResponsavel()->setId($ocorrencia->getServico()->getAreaResponsavel()->getId());

		$ocorrencia->setDescricao($_POST['descricao']);
		$ocorrencia->setCampus($_POST['campus']);
		$ocorrencia->setPatrimonio($_POST['patrimonio']);
		$ocorrencia->setRamal($_POST['ramal']);
		$ocorrencia->setEmail($_POST['email']);
		$ocorrencia->setDataAbertura(date("Y-m-d H:i:s"));

		$novoNome = "";
		if (request()->hasFile('anexo')) {
			$anexo = request()->file('anexo');
			if (!Storage::exists('public/uploads')) {
				Storage::makeDirectory('public/uploads');
			}

			$novoNome = $anexo->getClientOriginalName();

			if (Storage::exists('public/uploads/' . $anexo->getClientOriginalName())) {
				$novoNome = uniqid() . '_' . $novoNome;
			}

			$extensaoArr = explode('.', $novoNome);
			$extensao = strtolower(end($extensaoArr));

			$extensoes_permitidas = [
				'xlsx', 'xlsm', 'xlsb', 'xltx', 'xltm', 'xls', 'xlt', 'xls', 'xml', 'xml', 'xlam', 'xla', 'xlw', 'xlr',
				'doc', 'docm', 'docx', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'pdf', 'rtf', 'txt', 'wps', 'xml', 'zip', 'rar', 'ovpn',
				'xml', 'xps', 'jpg', 'gif', 'png', 'pdf', 'jpeg'
			];

			if (!in_array($extensao, $extensoes_permitidas)) {
				echo ':falha:Extensão não permitida. Lista de extensões permitidas a seguir. ';
				echo '(' . implode(", ", $extensoes_permitidas) . ')';
				return;
			}


			if (!$anexo->storeAs('public/uploads/', $novoNome)) {
				echo ':falha:arquivo não pode ser enviado';
				return;
			}
		}

		$ocorrencia->setAnexo($novoNome);
		$ocorrencia->setLocalSala($_POST['local_sala']);

		$ocorrencia->getUsuarioCliente()->setId($sessao->getIdUsuario());

		$statusOcorrenciaDAO = new StatusOcorrenciaDAO($this->dao->getConnection());

		$statusOcorrencia = new StatusOcorrencia();
		$statusOcorrencia->setDataMudanca(date("Y-m-d H:i:s"));
		$statusOcorrencia->getStatus()->setId(2);
		$statusOcorrencia->setUsuario($usuario);
		$statusOcorrencia->setMensagem("Ocorrência liberada para que qualquer técnico possa atender.");

		$this->dao->getConnection()->beginTransaction();

		if ($this->dao->insert($ocorrencia)) {
			$id = $this->dao->getConnection()->lastInsertId();
			$ocorrencia->setId($id);
			$statusOcorrencia->setOcorrencia($ocorrencia);
			if ($statusOcorrenciaDAO->insert($statusOcorrencia)) {
				echo ':sucesso:' . $id . ':';

				$this->emailAbertura($statusOcorrencia);
				$this->dao->getConnection()->commit();
			} else {
				echo ':falha';
				$this->dao->getConnection()->rollBack();
			}
		} else {
			echo ':falha';
			$this->dao->getConnection()->rollBack();
		}
	}

	public function emailAbertura(StatusOcorrencia $statusOcorrencia)
	{
		$mail = new Mail();
		$destinatario = $statusOcorrencia->getOcorrencia()->getEmail();
		$nome = $statusOcorrencia->getUsuario()->getNome();
		$assunto = "[3S] - Chamado Nº " . $statusOcorrencia->getOcorrencia()->getId();
		$corpo =  '<p>Prezado(a) ' . $statusOcorrencia->getUsuario()->getNome() . ' ,</p>';
		$corpo .= '<p>Sua solicitação foi realizada com sucesso, solicitação <a href="https://3s.unilab.edu.br/?page=ocorrencia&selecionar=' . $statusOcorrencia->getOcorrencia()->getId() . '">Nº' . $statusOcorrencia->getOcorrencia()->getId() . '</a></p>';
		$corpo .= '<ul>
                        <li>Serviço Solicitado: ' . $statusOcorrencia->getOcorrencia()->getServico()->getNome() . '</li>
                        <li>Descrição do Problema: ' . $statusOcorrencia->getOcorrencia()->getDescricao() . '</li>
                        <li>Setor Responsável: ' . $statusOcorrencia->getOcorrencia()->getServico()->getAreaResponsavel()->getNome() . ' -
                        ' . $statusOcorrencia->getOcorrencia()->getServico()->getAreaResponsavel()->getDescricao() . '</li>
                </ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';

		$mail->enviarEmail($destinatario, $nome, $assunto, $corpo);
	}
	public function possoPedirAjuda()
	{
		if ($this->sessao == Sessao::NIVEL_DESLOGADO) {
			return false;
		}
		return true;
	}
	public function ajaxPedirAjuda()
	{
		$this->sessao = new Sessao();


		if (!isset($_POST['pedir_ajuda'])) {
			echo ':falha: Não posso pedir ajuda';
			return;
		}
		if (!isset($_POST['ocorrencia'])) {
			echo ':falha:Falta ocorrencia';
			return;
		}
		$ocorrencia = new Ocorrencia();
		$ocorrencia->setId($_POST['ocorrencia']);

		$this->dao->fillById($ocorrencia);

		if (!$this->possoPedirAjuda()) {
			echo ':falha:';
			return;
		}

		$usersList = DB::table('usuario')->where('id_setor', $ocorrencia->getAreaResponsavel()->getId())->get();

		$mail = new Mail();

		$assunto = "[3S] - Chamado Nº " . $ocorrencia->getId();
		$corpo = '<p>A solicitação Nº' . $ocorrencia->getId() . ' está com atraso em relação ao SLA e o cliente solicitou ajuda</p>';
		$corpo .= '<ul>
                        <li>Serviço Solicitado: ' . $ocorrencia->getServico()->getNome() . '</li>
                        <li>Descrição do Problema: ' . $ocorrencia->getDescricao() . '</li>
                        <li>Setor Responsável: ' . $ocorrencia->getServico()->getAreaResponsavel()->getNome() . ' -
                        ' . $ocorrencia->getServico()->getAreaResponsavel()->getDescricao() . '</li>
                </ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';


		foreach ($usersList as $adm) {
			if ($usersList->nivel == Sessao::NIVEL_ADM) {
				$saudacao =  '<p>Prezado(a) ' . $adm->nome . ' ,</p>';
				$mail->enviarEmail($adm->email, $adm->nome, $assunto, $saudacao . $corpo);
			}
		}
		$_SESSION['pediu_ajuda'] = 1;
		echo ':sucesso:UM e-mail foi enviado aos chefes:';
	}
}
