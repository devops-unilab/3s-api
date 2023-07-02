<?php

/**
 * Classe feita para manipulação do objeto OcorrenciaController
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\OcorrenciaDAO;
use app3s\dao\UsuarioDAO;
use app3s\model\MensagemForum;
use app3s\model\Ocorrencia;
use app3s\model\Status;
use app3s\model\StatusOcorrencia;
use app3s\model\Usuario;
use app3s\util\Mail;
use app3s\util\Sessao;
use App\Models\Division;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class OcorrenciaController
{

	protected $selecionado;
	protected $sessao;
	protected  $view;
	protected $dao;
	private $statusOcorrencia;

	public function __construct()
	{
		$this->dao = new OcorrenciaDAO();
	}

	public function main()
	{

		echo '

<div class="card mb-4">
        <div class="card-body">';

		if (isset($_GET['selecionar'])) {
			$this->show();
		} else if (isset($_GET['cadastrar'])) {
			$this->store();
			$this->create();
		} else {
			$this->index();
		}



		echo '
	</div>
</div>


';
	}
	public function fimDeSemana($data)
	{
		$diaDaSemana = intval(date('w', strtotime($data)));
		return ($diaDaSemana == 6 || $diaDaSemana == 0);
	}

	public function foraDoExpediente($data)
	{
		$hora = intval(date('H', strtotime($data)));
		return ($hora >= 17 || $hora < 8 || $hora == 11);
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


	public function parteInteressada($order, $user)
	{
		return ($user->role === Sessao::NIVEL_ADM
			|| $user->role === Sessao::NIVEL_TECNICO
			|| $order->customer_user_id === $user->id);
	}

	public function getColorStatus($status)
	{
		$strCartao = ' alert-warning ';
		if ($status === 'opened') {
			$strCartao = '  notice-warning';
		} else if ($status === 'in progress') {
			$strCartao = '  notice-info ';
		} else if ($status == 'closed') {
			$strCartao = 'notice-success ';
		} else if ($status === 'committed') {
			$strCartao = 'notice-success ';
		} else if ($status == 'canceled') {
			$strCartao = ' notice-warning ';
		} else if ($status == 'reserved') {
			$strCartao = '  notice-warning ';
		} else if ($status === 'pending customer response') {
			$strCartao = '  notice-warning ';
		} else if ($status == 'pending it resource') {
			$strCartao = ' notice-warning';
		}
		return $strCartao;
	}
	public function canCancel($order)
	{
		return $this->sessao->getIdUsuario() == $order->customer_user_id && ($order->status == self::STATUS_REABERTO ||  $order->status == self::STATUS_ABERTO);
	}
	public function canWait($order, $user)
	{
		return ($user->id === $order->provider_user_id) &&
			($order->status === self::STATUS_ATENDIMENTO);
	}
	public function show()
	{
		$user = request()->user();
		$order = Order::findOrFail($_GET['selecionar']);

		if (!$this->parteInteressada($order, $user)) {
			echo '
            <div class="alert alert-danger" role="alert">
                Você não é cliente deste chamado, nem técnico para atendê-lo.
            </div>
            ';
			return;
		}

		$orderStatusLog = DB::table('order_status_logs')
			->join('users', 'order_status_logs.user_id', '=', 'users.id')
			->select('order_status_logs.message', 'order_status_logs.status', 'users.name as nome_usuario', 'order_status_logs.updated_at')
			->where('order_status_logs.order_id', $order->id)
			->get();


		$listaUsuarios = User::whereIn('role', ['provider', 'administrator'])->get();
		$listaServicos = Service::whereIn('role', ['customer', 'provider'])->get();
		$listaAreas = Division::get();
		$dataSolucao = $this->calcularHoraSolucao($order->created_at, $order->sla_duration);
		$canEditTag = $this->possoEditarPatrimonio($order, $user);
		$canEditSolution = $this->possoEditarSolucao($order, $user);
		$service = Service::findOrFail($order->service_id);

		$order->service_name = $service->name;
		$canEditService = $this->possoEditarServico($order, $user);
		$isClient = ($user->role === Sessao::NIVEL_COMUM);
		$canWait = $this->canWait($order, $user);

		$order->tempo_sla = $service->sla_duration;
		$timeNow = time();
		$timeSolucaoEstimada = strtotime($dataSolucao);
		$isLate = $timeNow > $timeSolucaoEstimada;

		$canRequestHelp = ($order->customer_user_id == $user->id && !isset($_SESSION['pediu_ajuda']) && !$isLate);
		$customer = User::findOrFail($order->customer_user_id);
		$order->client_name =  $customer->name;
		$canEditDivision = $this->possoEditarAreaResponsavel($order, $user);

		$providerName = '';
		$providerId = null;

		$providerId = $order->provider_user_id;
		$provider = User::find($providerId);
		$providerDivision = null;
		$providerName = '';
		if ($provider != null) {
			$providerDivision = Division::find($provider->division_id);
			$providerName = $provider->name;
		}

		foreach ($orderStatusLog as $status) {
			$status->color = $this->getColorStatus($status->status);
			echo view('partials.modal-form-status', ['services' => $listaServicos, 'providers' => $listaUsuarios, 'divisions' => $listaAreas, 'order' => $order]);
		}

		echo view('partials.show-order', [
			'order' => $order,
			'canEditTag' => $canEditTag,
			'canEditSolution' => $canEditSolution,
			'canEditService' => $canEditService,
			'isLevelClient' => $isClient,
			'isLate' => $isLate,
			'dataSolucao' => $dataSolucao,
			'canRequestHelp' => $canRequestHelp,
			'providerDivision' => $providerDivision,
			'providerName' => $providerName,
			'canEditDivision' => $canEditDivision,
			'orderStatusLog' => $orderStatusLog,
			'canWait' => $canWait
		]);


		if (isset($_POST['chatDelete'])) {

			$idChat = intval($_POST['chatDelete']);

			$message = DB::table('order_messages')
				->join('users', 'order_messages.user_id', '=', 'users.id')
				->join('orders', 'order_messages.order_id', '=', 'orders.id')
				->select(
					'order_messages.id as id',
					'users.id as user_id',
					'orders.status as order_status'
				)
				->where('order_messages.id', $idChat)
				->first();

			if ($user->id === $message->user_id && $order->status === self::STATUS_ATENDIMENTO) {
				DB::table('order_messages')->where('id', $idChat)->delete();
				echo '<meta http-equiv = "refresh" content = "0 ; url =?page=ocorrencia&selecionar=' . $_GET['selecionar'] . '"/>';
			}
		}
		$canSendMessage = $this->possoEnviarMensagem($order);
		$messageList = DB::table('order_messages')
			->join('users', 'order_messages.user_id', '=', 'users.id')
			->join('orders', 'order_messages.order_id', '=', 'orders.id')
			->select(
				'order_messages.id as id',
				'users.id as user_id',
				'users.name as user_name',
				'order_messages.type as message_type',
				'order_messages.message as message_content',
				'order_messages.created_at as created_at',
				'orders.status as order_status'
			)
			->where('order_messages.order_id', $order->id)
			->orderBy('order_messages.id')
			->get();


		echo view('partials.index-messages-order', [
			'order' => $order,
			'messageList' => $messageList,
			'canSendMessage' => $canSendMessage,
			'userId' => $user->id
		]);
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
		$arrStatus[] = OcorrenciaController::STATUS_ABERTO;
		$arrStatus[] = OcorrenciaController::STATUS_AGUARDANDO_ATIVO;
		$arrStatus[] = OcorrenciaController::STATUS_AGUARDANDO_USUARIO;
		$arrStatus[] = OcorrenciaController::STATUS_ATENDIMENTO;
		$arrStatus[] = OcorrenciaController::STATUS_REABERTO;
		$arrStatus[] = OcorrenciaController::STATUS_RESERVADO;
		return $arrStatus;
	}
	public function arrayStatusFinalizado()
	{

		$arrStatus = array();
		$arrStatus[] = OcorrenciaController::STATUS_FECHADO;
		$arrStatus[] = OcorrenciaController::STATUS_FECHADO_CONFIRMADO;
		$arrStatus[] = OcorrenciaController::STATUS_CANCELADO;
		return $arrStatus;
	}

	public function atrasado($order)
	{
		if ($order->sla_duration < 1) {
			return false;
		}
		$horaEstimada = $this->calcularHoraSolucao($order->created_at, $order->sla_duration);
		$timeHoje = time();
		$timeSolucaoEstimada = strtotime($horaEstimada);
		return $timeHoje > $timeSolucaoEstimada;
	}

	public function applyFilters($query)
	{
		if (isset($_GET['setor'])) {
			$divisionId = intval($_GET['setor']);
			$query = $query->where('orders.division_id', $divisionId);
		}
		if (isset($_GET['demanda'])) {
			$query = $query->where('provider_user_id', $this->sessao->getIdUsuario());
		}
		if (isset($_GET['solicitacao'])) {
			$query = $query->where('customer_user_id', $this->sessao->getIdUsuario());
		}
		if (isset($_GET['tecnico'])) {
			$query = $query->where('provider_user_id', intval($_GET['tecnico']));
		}
		if (isset($_GET['requisitante'])) {
			$query = $query->where('customer_user_id', intval($_GET['requisitante']));
		}
		if (isset($_GET['data_abertura1'])) {
			$data1 = date("Y-m-d", strtotime($_GET['data_abertura1']));
			$query = $query->where('created_at', '>=', $data1);
		}
		if (isset($_GET['data_abertura2'])) {
			$data2 = date("Y-m-d", strtotime($_GET['data_abertura2']));
			$query = $query->where('created_at', '<=', $data2);
		}
		if (isset($_GET['campus'])) {
			$campusArr = explode(",", $_GET['campus']);
			$query = $query->whereIn('campus', $campusArr);
		}
		if (isset($_GET['setores_responsaveis'])) {
			$divisions = explode(",", $_GET['setores_responsaveis']);
			$query = $query->whereIn('orders.division_id', $divisions);
		}
		if (isset($_GET['setores_requisitantes'])) {
			$divisionsSig = explode(",", $_GET['setores_requisitantes']);
			$query = $query->whereIn('division_sig_id', $divisionsSig);
		}

		return $query;
	}
	public function index()
	{

		$sessao = new Sessao();

		$this->sessao = new Sessao();



		$lista = array();
		$fields = [
			'orders.id as id',
			'orders.description as description',
			'services.sla_duration as sla_duration',
			'orders.created_at as created_at',
			'orders.status as status'
		];
		$statusPendding = [
			'opened',
			'pending it resource',
			'pending customer response',
			'in progress',
			'reserved'
		];
		$queryPendding = DB::table('orders')
			->select($fields)
			->join('services', 'orders.service_id', '=', 'services.id')
			->whereIn(
				'status',
				$statusPendding
			)->orderByDesc('orders.id')->limit(300);

		$queryFinished = DB::table('orders')
			->select($fields)
			->join('services', 'orders.service_id', '=', 'services.id')
			->whereIn('status', ['closed', 'committed', 'canceled'])
			->orderByDesc('orders.id')->limit(300);

		$queryPendding = $this->applyFilters($queryPendding);
		$queryFinished = $this->applyFilters($queryFinished);

		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM) {
			$queryPendding = $queryPendding->where('customer_user_id', $this->sessao->getIdUsuario());
			$queryFinished = $queryFinished->where('customer_user_id', $this->sessao->getIdUsuario());
		}
		$lista = $queryPendding->get();
		$lista2 = $queryFinished->get();

		//Painel principal
		echo '

		<div class="row">
			<div class="col-md-8 blog-main">
				<div class="panel-group" id="accordion">';
		$listaAtrasados = array();

		$notLate = array();

		foreach ($lista as $order) {
			if ($this->atrasado($order)) {
				$listaAtrasados[] = $order;
			} else {
				$notLate[] = $order;
			}
		}
		if ($sessao->getNivelAcesso() === Sessao::NIVEL_COMUM) {
			$listaAtrasados = array();
			$notLate = $lista;
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
		$this->painel($notLate, 'Ocorrências Em Aberto(' . count($notLate) . ')', 'collapseAberto', 'show');
		$this->painel($lista2, "Ocorrências Encerradas", 'collapseEncerrada');
		echo '
			</div>
		</div>
		<aside class="col-md-4 blog-sidebar">';
		if ($sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
			$sessao = new Sessao();
			$currentUser = DB::table('users')->where('id', $sessao->getIdUsuario())->first();
			$userDivision = DB::table('divisions')->where('id', $currentUser->division_id)->first();
			$attendents = DB::table('users')->where('role', 'a')->orWhere('role', 't')->get();
			$allUsers = DB::table('users')->get();
			$applicants = DB::table('orders')->select('division_sig', 'division_sig_id')->distinct()->limit(400)->get();
			$divisions = DB::table('divisions')->select('id', 'name')->get();

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

	public function create()
	{
		$this->sessao = new Sessao();

		$ocorrencia = new Ocorrencia();
		$ocorrencia->getUsuarioCliente()->setId($this->sessao->getIdUsuario());


		$listaNaoAvaliados = DB::table('orders')->where('customer_user_id', $this->sessao->getIdUsuario())->where('status', OcorrenciaController::STATUS_FECHADO)->get();
		// dd(OcorrenciaController::STATUS_FECHADO);
		echo '
            <div class="row">
                <div class="col-md-12 blog-main">';


		$services = [];
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM) {
			$filterServices = ['customer'];
		}
		if (
			$this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM ||
			$this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO
		) {
			$filterServices = ['customer', 'provider'];
		}

		$services = Service::whereIn('role', $filterServices)->get();

		if (count($listaNaoAvaliados) > 0) {
			echo view(
				'partials.index-orders',
				[
					'orders' => $listaNaoAvaliados,
					'title' => 'Para continuar confirme os chamados fechados.',
					'id' => 'collapseToConfirm',
					'strShow' => 'show'
				]
			);
		} else {
			echo '<h3 class="pb-4 mb-4 font-italic border-bottom">Cadastrar Ocorrência</h3>';
			echo view('partials.form-insert-order', ['services' => $services, 'email' => $this->sessao->getEmail()]);
		}
		echo '
                </div>
            </div>';
	}


	public function store()
	{

		if (!isset($_POST['enviar_ocorrencia'])) {
			return;
		}
		$request = request();

		if (!(isset($_POST['description']) &&
			isset($_POST['campus'])  &&
			isset($_POST['email']) &&
			isset($_POST['tag']) &&
			isset($_POST['phone_number']) &&
			isset($_POST['place']) &&
			isset($_POST['service_id']))) {
			echo ':incompleto';
			return;
		}
		$novoNome = "";
		if ($request->hasFile('attachment')) {
			$attachment = $request->file('attachment');
			if (!Storage::exists('public/uploads')) {
				Storage::makeDirectory('public/uploads');
			}

			$novoNome = $attachment->getClientOriginalName();

			if (Storage::exists('public/uploads/' . $attachment->getClientOriginalName())) {
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


			if (!$attachment->storeAs('public/uploads/', $novoNome)) {
				echo ':falha:arquivo não pode ser enviado';
				return;
			}
		}

		$user = request()->user();

		$service = DB::table('services')
			->select(
				'services.*',
				'divisions.name as area_responsavel_nome',
				'divisions.description as area_responsavel_descricao'
			)->join(
				'divisions',
				'services.division_id',
				'=',
				'divisions.id'
			)
			->where('services.id', '=', $request->service_id)
			->first();


		try {
			DB::beginTransaction();
			$data =
				[
					'division_id' =>  $service->division_id,
					'service_id' => $service->id,
					'division_sig_id' => $user->division_sig_id,
					'division_sig' => $user->division_sig,
					'customer_user_id' => $user->id,
					'description' => $request->description,
					'campus' => $request->campus,
					'tag' => $request->tag,
					'phone_number' => $request->phone_number,
					'status' => 'opened',
					'email' => $request->email,
					'attachment' => $novoNome,
					'place' => $request->place
				];

			// dd($data);
			$order = Order::create($data);
			$ocorrenciaInsertedId = $order->id;

			DB::table('order_status_logs')->insert([
				'order_id' => $ocorrenciaInsertedId,
				'status' => 'opened',
				'message' => "Ocorrência liberada para que qualquer técnico possa atender.",
				'user_id' => $user->id
			]);

			DB::commit();
			echo '<div class="alert alert-success" role="alert">
						Ocorrência adicionada com sucesso!
			  </div>';
		} catch (\Exception $e) {
			$message = $e->getMessage();
			echo '
				<div class="alert alert-danger" role="alert">
  					Falha ao tentar cadastrar ocorrência. ' . $message . '
				</div>
				';
			DB::rollBack();
			// echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=?page=ocorrencia&cadastrar=1">';
		}
		$mail = new Mail();

		$assunto = "[3S] - Chamado Nº " . $ocorrenciaInsertedId;
		$corpo =  '<p>Prezado(a) ' . $user->name . ' ,</p>';
		$corpo .= '<p>Sua solicitação foi realizada com sucesso, solicitação
			<a href="https://3s.unilab.edu.br/?page=ocorrencia&selecionar='
			. $ocorrenciaInsertedId . '">Nº' . $ocorrenciaInsertedId . '</a></p>';
		$corpo .= '<ul>
							<li>Serviço Solicitado: ' . $service->name . '</li>
							<li>Descrição do Problema: ' . $request->description . '</li>
							<li>Setor Responsável: ' . $service->area_responsavel_nome .
			' - ' . $service->area_responsavel_descricao . '</li>
					</ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';

		$mail->enviarEmail($user->email, $user->nome, $assunto, $corpo);
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=?page=ocorrencia&selecionar=' . $ocorrenciaInsertedId . '">';
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
			if ($adm->nivel == Sessao::NIVEL_ADM) {
				$saudacao =  '<p>Prezado(a) ' . $adm->nome . ' ,</p>';
				$mail->enviarEmail($adm->email, $adm->nome, $assunto, $saudacao . $corpo);
			}
		}
		$_SESSION['pediu_ajuda'] = 1;
		echo ':sucesso:UM e-mail foi enviado aos chefes:';
	}


	public function possoAtender()
	{
		if (
			$this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO
			|| $this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM
		) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_ATENDIMENTO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_CANCELADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_FECHADO || $this->selecionado->getStatus() == self::STATUS_FECHADO_CONFIRMADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_RESERVADO) {
			if ($this->sessao->getIdUsuario() != $this->selecionado->getIdUsuarioIndicado()) {
				return false;
			}
		}
		if (
			$this->selecionado->getStatus() == self::STATUS_AGUARDANDO_ATIVO
			|| $this->selecionado->getStatus() == self::STATUS_AGUARDANDO_USUARIO
			|| $this->selecionado->getStatus() == self::STATUS_EM_ESPERA
		) {
			if ($this->sessao->getIdUsuario() != $this->selecionado->getIdUsuarioAtendente()) {
				return false;
			}
		}
		if ($this->selecionado->getStatus() == self::STATUS_ABERTO || $this->selecionado->getStatus() == self::STATUS_REABERTO) {
			return true;
		}

		return true;
	}
	public function possoCancelar()
	{
		return $this->sessao->getIdUsuario() === $this->selecionado->getUsuarioCliente()->getId()
			&&
			($this->selecionado->getStatus() == self::STATUS_REABERTO || $this->selecionado->getStatus() == self::STATUS_ABERTO);
	}

	public function passwordVerify()
	{
		$this->sessao = new Sessao();
		if (!isset($_POST['senha'])) {
			return false;
		}
		$login = $this->sessao->getLoginUsuario();
		$senha = $_POST['senha'];
		$data = ['login' =>  $login, 'senha' => $senha];
		$response = Http::post(env('UNILAB_API_ORIGIN') . '/authenticate', $data);
		$responseJ = json_decode($response->body());

		$idUsuario  = 0;

		if (isset($responseJ->id)) {
			$idUsuario = intval($responseJ->id);
		}
		if ($idUsuario === 0) {
			return false;
		}
		if ($responseJ->id != $this->sessao->getIdUsuario()) {
			echo ":falha:Senha Incorreta.";
			return false;
		}
		return true;
	}
	public function ajaxAtender($order, $user, $sigla)
	{

		if (!$this->possoAtender()) {
			echo ':falha:Não é possível atender este chamado.';
			return false;
		}

		$this->sessao = new Sessao();

		$status = DB::table('status')
			->select('id', 'sigla', 'nome')->where('sigla', $sigla)->get()->first();

		$orderUpdate = [
			'status' => $status->sigla,
			'id_usuario_atendente' => $user->id,
			'id_area_responsavel' => $user->id_setor,
		];
		if ($order->data_atendimento == null) {
			$orderUpdate['data_atendimento'] = date("Y-m-d G:i:s");
		}

		try {

			DB::beginTransaction();
			DB::table('orders')
				->where('id', $order->id)
				->update($orderUpdate);
			DB::table('status_ocorrencia')->insert([
				'id_ocorrencia' => $_POST['id_ocorrencia'],
				'id_status' => $status->id,
				'mensagem' => "Ocorrência em atendimento",
				'id_usuario' => $user->id,
				'data_mudanca' => date("Y-m-d G:i:s"),
			]);

			DB::commit();
			echo ':sucesso:' . $order->id . ':Chamado am atendimento!';
			return true;
		} catch (\Exception $e) {
			DB::rollBack();
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
	}

	public function ajaxCancelar()
	{
		if (!isset($_POST['status_acao'])) {
			return false;
		}
		if ($_POST['status_acao'] != 'cancelar') {
			return false;
		}
		if (!isset($_POST['id_ocorrencia'])) {
			return false;
		}
		if (!isset($_POST['senha'])) {
			return false;
		}



		if (!$this->possoCancelar()) {
			echo ":falha:Este chamado não pode ser cancelado.";
			return false;
		}


		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_CANCELADO);

		$status = new Status();
		$status->setSigla(self::STATUS_CANCELADO);

		$this->dao->fillStatusBySigla($status);


		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem("Ocorrência cancelada pelo usuário");


		$ocorrenciaDao->getConnection()->beginTransaction();

		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();
		echo ':sucesso:' . $this->selecionado->getId() . ':Chamado cancelado com sucesso!';
		return true;
	}



	public function possoEditarServico($order, $user)
	{
		return (
			($user->role === Sessao::NIVEL_ADM || $user->role === Sessao::NIVEL_TECNICO)
			&& $order->status === self::STATUS_ATENDIMENTO);
	}
	public function possoEditarAreaResponsavel($order, $user)
	{
		return ($order->status === self::STATUS_ABERTO ||
			$order->status === self::STATUS_ATENDIMENTO)
			&& $user->role === Sessao::NIVEL_ADM;
	}


	public function possoEditarSolucao($order, $user)
	{
		return true;
	}

	public function possoEditarPatrimonio($order, $user)
	{
		return (
			($user->role === Sessao::NIVEL_ADM
				|| $user->role === Sessao::NIVEL_TECNICO
				&& $order->provider_user_id === $user->id
				&& $order->status === self::STATUS_ATENDIMENTO)
			||
			($user->id === $order->customer_user_id
				&& $order->status === self::STATUS_ATENDIMENTO));
	}
	public function possoAvaliar()
	{
		//Só permitir isso se o usuário for cliente do chamado
		//O chamado deve estar fechado.
		if ($this->sessao->getIdUsuario() != $this->selecionado->getUsuarioCliente()->getId()) {
			return false;
		}
		if ($this->selecionado->getStatus() != self::STATUS_FECHADO) {
			return false;
		}
		return true;
	}
	public function possoReabrir()
	{
		//Só permitir isso se o usuário for cliente do chamado
		//O chamado deve estar fechado.
		if ($this->sessao->getIdUsuario() != $this->selecionado->getUsuarioCliente()->getId()) {
			return false;
		}
		if ($this->selecionado->getStatus() != self::STATUS_FECHADO) {
			return false;
		}
		return true;
	}

	public function possoFechar()
	{
		if (trim($this->selecionado->getSolucao()) == "") {
			return false;
		}
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM) {
			return false;
		}
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO) {
			return false;
		}

		if ($this->selecionado->getStatus() == Self::STATUS_ATENDIMENTO) {
			if ($this->sessao->getIdUsuario() == $this->selecionado->getIdUsuarioAtendente()) {
				return true;
			}
		}

		return false;
	}
	public function possoReservar()
	{
		if ($this->sessao->getNivelAcesso() != Sessao::NIVEL_ADM) {
			return false;
		}
		if ($this->selecionado->getStatus() == Self::STATUS_FECHADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == Self::STATUS_FECHADO_CONFIRMADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == Self::STATUS_CANCELADO) {
			return false;
		}

		return true;
	}
	public function ajaxFechar($order, $user, $sigla, $message)
	{
		if (!$this->possoFechar()) {
			echo ':falha:Não é possível fechar este chamado.';
			return false;
		}
		$status = DB::table('status')->select('id', 'sigla', 'nome')
			->where('sigla', $sigla)
			->get()
			->first();

		$orderUpdate = [
			'status' => $status->sigla
		];

		try {
			DB::beginTransaction();

			$updateResult = DB::table('orders')
				->where('id', $order->id)
				->update($orderUpdate);

			if ($updateResult > 0) {
				DB::table('status_ocorrencia')->insert([
					'id_ocorrencia' => $order->id,
					'id_status' => $status->id,
					'mensagem' => $message,
					'id_usuario' => $user->id,
					'data_mudanca' => date("Y-m-d G:i:s"),
				]);

				DB::commit();
				echo ':sucesso:' . $this->selecionado->getId() . ':Chamado em atendimento!';
			} else {
				DB::rollBack();
				echo ':falha:Falha ao tentar atualizar a ocorrência.';
			}
		} catch (\Exception $e) {
			DB::rollBack();
			echo ':falha:Falha ao tentar inserir histórico.';
		}
	}
	public function ajaxAvaliar()
	{
		if (!isset($_POST['avaliacao'])) {
			echo ':falha:Faça uma avaliação';
			return false;
		}
		if (!$this->possoAvaliar()) {
			return false;
		}

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_FECHADO_CONFIRMADO);

		$status = new Status();
		$status->setSigla(self::STATUS_FECHADO_CONFIRMADO);

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem("Atendimento avaliado pelo cliente");

		$this->selecionado->setDataFechamentoConfirmado(date("Y-m-d H:i:s"));
		$this->selecionado->setAvaliacao($_POST['avaliacao']);

		$ocorrenciaDao->getConnection()->beginTransaction();



		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();

		echo ':sucesso:' . $this->selecionado->getId() . ':Atendimento avaliado com sucesso!';
		return true;
	}
	public function ajaxReabrir()
	{
		if (!$this->possoReabrir()) {
			return false;
		}

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_REABERTO);

		$status = new Status();
		$status->setSigla(self::STATUS_REABERTO);

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem("Ocorrência Reaberta pelo cliente");
		if (isset($_POST['mensagem-status'])) {
			$this->statusOcorrencia->setMensagem($_POST['mensagem-status']);
		}


		$ocorrenciaDao->getConnection()->beginTransaction();



		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();

		echo ':sucesso:' . $this->selecionado->getId() . ':Atendimento reaberto com sucesso!';
		return true;
	}

	public function ajaxReservar()
	{
		$user = request()->user();
		if (!isset($_POST['tecnico'])) {
			echo ':falha:Técnico especificado';
			return false;
		}
		if (!$this->possoReservar()) {
			echo ':falha:Você não pode reservar esse chamado.';
			return false;
		}

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$ocorrenciaDao->fillById($this->selecionado);

		$usuario = new Usuario();
		$usuario->setId($_POST['tecnico']);



		$this->selecionado->getAreaResponsavel()->setId($user->division_id);
		$this->selecionado->setStatus(self::STATUS_RESERVADO);

		$status = new Status();
		$status->setSigla(self::STATUS_RESERVADO);

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($user->id);
		$this->statusOcorrencia->setMensagem('Atendimento reservado para ' . $usuario->getNome());


		$ocorrenciaDao->getConnection()->beginTransaction();
		$this->selecionado->setIdUsuarioIndicado($user->id);
		$this->selecionado->getAreaResponsavel()->setId($user->division_id);


		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();

		echo ':sucesso:' . $this->selecionado->getId() . ':Reservado com sucesso!';
		return true;
	}
	public function updateOrder()
	{
		//Verifica-se qual o form que foi submetido.

		if (!isset($_POST['status_acao'])) {
			echo ':falha:Ação não especificada';
			return;
		}
		if (!$this->passwordVerify()) {
			echo ':falha:Senha incorreta';
			return;
		}

		$this->sessao = new Sessao();
		$this->selecionado = new Ocorrencia();
		$this->selecionado->setId($_POST['id_ocorrencia']);
		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$ocorrenciaDao->fillById($this->selecionado);
		$status = false;
		$mensagem = "";

		$order = DB::table('orders')->where('id', $_POST['id_ocorrencia'])->first();
		$user = DB::table('usuario')->where('id', $this->sessao->getIdUsuario())->first();


		switch ($_POST['status_acao']) {
			case 'cancelar':
				$status = $this->ajaxCancelar();
				$mensagem = '<p>Chamado cancelado</p>';
				break;
			case 'atender':
				$status = $this->ajaxAtender($order, $user, self::STATUS_ATENDIMENTO);
				$mensagem = '<p>Chamado em atendimento</p>';
				break;
			case 'fechar':
				$status = $this->ajaxFechar($order, $user, self::STATUS_FECHADO, "Ocorrência fechada pelo atendente");
				$mensagem = '<p>Chamado fechado</p>';
				break;
			case 'reservar':
				$status = $this->ajaxReservar();
				$mensagem = '<p>Chamado reservado</p>';
				break;
			case 'liberar_atendimento':
				$status = $this->ajaxLiberar();
				$mensagem = '<p>Chamado Liberado para atendimento</p>';
				break;
			case 'avaliar':
				$status = $this->ajaxAvaliar();
				$mensagem = '<p>Chamado avaliado</p>';
				break;
			case 'reabrir':
				$status = $this->ajaxReabrir();
				$mensagem = '<p>Chamado reaberto</p>';
				break;
			case 'editar_servico':
				$status = $this->ajaxEditarServico();
				$mensagem = '<p>Serviço alterado</p>';
				break;
			case 'editar_solucao':
				$status = $this->ajaxEditarSolucao();
				$mensagem = '<p>Solução editada</p>';
				break;
			case 'editar_area':
				$status = $this->ajaxEditarArea();
				$mensagem = '<p>Área Editada Com Sucesso</p>';
				break;
			case 'aguardar_ativos':
				$status = $this->ajaxAguardandoAtivo();
				$mensagem = '<p>Aguardando ativo de TI</p>';
				break;
			case 'aguardar_usuario':
				$status = $this->ajaxAguardandoUsuario();
				$mensagem = '<p>Aguardando resposta do cliente</p>';
				break;
			case 'editar_patrimonio':
				$status = $this->ajaxEditarPatrimonio();
				$mensagem = '<p>Patrimônio editado.</p>';
				break;
			default:
				echo ':falha:Ação não encontrada';

				break;
		}
		if ($status) {
			$this->sendNotfyChange($mensagem);
		}
	}
	public function ajaxEditarPatrimonio()
	{
		$sessao = new Sessao();
		$userId = $sessao->getIdUsuario();
		$order = Order::findOrFail($this->selecionado->getId());
		$user = User::findOrFail($userId);
		if (!$this->possoEditarPatrimonio($order, $user)) {
			echo ':falha:Este patrimônio não pode ser editado.';
			return false;
		}
		if (!isset($_POST['patrimonio'])) {
			echo ':falha:Digite um patrimônio.';
			return false;
		}
		if (trim($_POST['patrimonio']) == "") {
			echo ':falha:Digite um patrimônio.';
			return false;
		}



		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$status = new Status();
		$status->setSigla($this->selecionado->getStatus());

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Técnico editou o Patrimônio para: ' . $_POST['patrimonio'] . '.');

		$this->selecionado->setPatrimonio(strip_tags($_POST['patrimonio']));
		$ocorrenciaDao->getConnection()->beginTransaction();


		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do patrimonio da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();

		echo ':sucesso:' . $this->selecionado->getId() . ':Patrimonio editado com sucesso!';
		return true;
	}

	public function sendNotfyChange($mensagem = "")
	{
		$mail = new Mail();
		$assunto = "[3S] - Chamado Nº " . $this->statusOcorrencia->getOcorrencia()->getId();



		$saldacao =  '<p>Prezado(a) ' . $this->statusOcorrencia->getUsuario()->getNome() . ' ,</p>';

		$corpo = '<p>Avisamos que houve uma mudança no status da solicitação <a href="https://3s.unilab.edu.br/?page=ocorrencia&selecionar=' . $this->statusOcorrencia->getOcorrencia()->getId() . '">Nº' . $this->statusOcorrencia->getOcorrencia()->getId() . '</a></p>';
		$corpo .= $mensagem;
		$corpo .= '<ul>
                        <li>Serviço Solicitado: ' . $this->statusOcorrencia->getOcorrencia()->getServico()->getNome() . '</li>
                        <li>Descrição do Problema: ' . $this->statusOcorrencia->getOcorrencia()->getDescricao() . '</li>
                        <li>Setor Responsável: ' . $this->statusOcorrencia->getOcorrencia()->getAreaResponsavel()->getNome() . ' -
                        ' . $this->statusOcorrencia->getOcorrencia()->getAreaResponsavel()->getDescricao() . '</li>
                        <li>Cliente: ' . $this->selecionado->getUsuarioCliente()->getNome() . '</li>
                </ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';


		$destinatario = $this->statusOcorrencia->getOcorrencia()->getEmail();
		$nome = $this->statusOcorrencia->getOcorrencia()->getUsuarioCliente()->getNome();
		//Cliente do chamado
		$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo);

		$usuarioDao = new UsuarioDAO($this->dao->getConnection());


		$destinatario = $this->statusOcorrencia->getOcorrencia()->getAreaResponsavel()->getEmail();
		$nome = $this->statusOcorrencia->getOcorrencia()->getAreaResponsavel()->getNome();
		$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo); //Email para area responsavel


		if ($this->statusOcorrencia->getOcorrencia()->getIdUsuarioAtendente() != null) {

			$atendente = new Usuario();
			$atendente->setId($this->statusOcorrencia->getOcorrencia()->getIdUsuarioAtendente());
			$usuarioDao->fillById($atendente);
			$destinatario = $atendente->getEmail();
			$nome = $atendente->getNome();

			$saldacao =  '<p>Prezado(a) ' . $nome . ' ,</p>';
			$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo);
		} else if ($this->statusOcorrencia->getOcorrencia()->getIdUsuarioIndicado() != null) {

			$indicado = new Usuario();
			$indicado->setId($this->statusOcorrencia->getOcorrencia()->getIdUsuarioIndicado());
			$usuarioDao->fillById($indicado);
			$destinatario = $indicado->getEmail();
			$nome = $indicado->getNome();

			$saldacao =  '<p>Prezado(a) ' . $nome . ' ,</p>';
			$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo);
		}
	}

	public function ajaxAguardandoAtivo()
	{

		$order = Order::findOrFail($this->selecionado->getId());
		$sessao = new Sessao();
		$idUser = $sessao->getIdUsuario();
		$user = User::findOrFail($idUser);

		if (!$this->possoEditarSolucao($order, $user)) {
			echo ':falha:Esta solução não pode ser editada.';
			return false;
		}

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_AGUARDANDO_ATIVO);

		$status = new Status();
		$status->setSigla(self::STATUS_AGUARDANDO_ATIVO);

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem("Aguardando ativo de TI");


		$ocorrenciaDao->getConnection()->beginTransaction();

		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();
		echo ':sucesso:' . $this->selecionado->getId() . ':Alterado para aguardando ativo de ti!';
		return true;
	}
	public function ajaxAguardandoUsuario()
	{
		$order = Order::findOrFail($this->selecionado->getId());
		$sessao = new Sessao();
		$idUser = $sessao->getIdUsuario();
		$user = User::findOrFail($idUser);

		if (!$this->possoEditarSolucao($order, $user)) {
			echo ':falha:Esta solução não pode ser editada.';
			return false;
		}
		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_AGUARDANDO_USUARIO);

		$status = new Status();
		$status->setSigla(self::STATUS_AGUARDANDO_USUARIO);

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem("Aguardando Usuário");


		$ocorrenciaDao->getConnection()->beginTransaction();

		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();
		echo ':sucesso:' . $this->selecionado->getId() . ':Alterado para aguardando usuário!';
		return true;
	}

	public function ajaxEditarSolucao()
	{
		$order = Order::findOrFail($this->selecionado->getId());
		$sessao = new Sessao();
		$idUser = $sessao->getIdUsuario();
		$user = User::findOrFail($idUser);

		if (!$this->possoEditarSolucao($order, $user)) {
			echo ':falha:Esta solução não pode ser editada.';
			return false;
		}
		if (!isset($_POST['solucao'])) {
			echo ':falha:Digite uma solução.';
			return false;
		}
		if (trim($_POST['solucao']) == "") {
			echo ':falha:Digite uma solução.';
			return false;
		}



		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$status = new Status();
		$status->setSigla($this->selecionado->getStatus());

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Técnico editou a solução. ');

		$this->selecionado->setSolucao(strip_tags($_POST['solucao']));
		$ocorrenciaDao->getConnection()->beginTransaction();


		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();

		echo ':sucesso:' . $this->selecionado->getId() . ':Solução editada com sucesso!';
		return true;
	}
	public function ajaxEditarArea()
	{
		$order = Order::findOrFail($this->selecionado->getId());
		$user = request()->user();
		if (!$this->possoEditarAreaResponsavel($order, $user)) {
			echo ':falha:Você não pode editar a área responsável.';
			return false;
		}

		if (!isset($_POST['area_responsavel'])) {
			echo ':falha:Selecione um serviço.';
			return false;
		}

		$division = DB::table('area_responsavel')
			->where('id', $_POST['area_responsavel'])
			->first();
		$this->selecionado->getAreaResponsavel()->setId($division->id);

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());

		$status = new Status();
		$status->setSigla(self::STATUS_ABERTO);

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Chamado encaminhado para setor: ' . $division->nome);

		$ocorrenciaDao->getConnection()->beginTransaction();

		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();

		echo ':sucesso:' . $this->selecionado->getId() . ':Área Responsável Editada Com Sucesso!';
		return true;
	}
	public function ajaxEditarServico()
	{
		$order = Order::findOrFail($this->selecionado->getId());
		$user = request()->user();
		if (!$this->possoEditarServico($order, $user)) {
			echo ':falha:Este serviço não pode ser editado.';
			return false;
		}

		if (!isset($_POST['id_servico'])) {
			echo ':falha:Selecione um serviço.';
			return false;
		}




		$servico = DB::table('servico')
			->join(
				'area_responsavel',
				'area_responsavel.id',
				'=',
				'servico.id_area_responsavel as division_id'
			)
			->select(
				'servico.id as id',
				'area_responsavel.nome as nome_area',
				'servico.nome as nome_servico',
				'servico.descricao as descricao_servico'
			)
			->where('servico.id', $_POST['id_servico'])->first();

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());


		$status = new Status();
		$status->setSigla($this->selecionado->getStatus());

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Alteração do Serviço');

		$this->selecionado->getAreaResponsavel()->setId($servico->division_id);
		$this->selecionado->getServico()->setId($servico->id);



		$ocorrenciaDao->getConnection()->beginTransaction();




		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();

		echo ':sucesso:' . $this->selecionado->getId() . ':Serviço editado com sucesso!';
		return true;
	}
	public function possoLiberar()
	{
		if ($this->sessao->getNivelAcesso() != Sessao::NIVEL_ADM) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_REABERTO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_FECHADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_CANCELADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_FECHADO_CONFIRMADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_ABERTO) {
			return false;
		}
		return true;
	}
	public function ajaxLiberar()
	{
		if (!$this->possoLiberar()) {
			echo ':falha:Não é possível liberar esse atendimento.';
			return false;
		}

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_ABERTO);

		$status = new Status();
		$status->setSigla(self::STATUS_ABERTO);

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Liberado para atendimento');


		$ocorrenciaDao->getConnection()->beginTransaction();
		$this->selecionado->setIdUsuarioIndicado(null);
		$this->selecionado->setIdUsuarioAtendente(null);

		if (!$ocorrenciaDao->update($this->selecionado)) {
			echo ':falha:Falha na alteração do status da ocorrência.';
			$ocorrenciaDao->getConnection()->rollBack();
			return false;
		}

		if (!$this->dao->insertStatus($this->statusOcorrencia)) {
			echo ':falha:Falha ao tentar inserir histórico.';
			return false;
		}
		$ocorrenciaDao->getConnection()->commit();

		echo ':sucesso:' . $this->selecionado->getId() . ':Liberado com sucesso!';

		return true;
	}


	public function possoEnviarMensagem($order)
	{

		if ($order->status == OcorrenciaController::STATUS_FECHADO) {
			return false;
		}
		if ($order->status == OcorrenciaController::STATUS_FECHADO_CONFIRMADO) {
			return false;
		}
		if ($order->status == OcorrenciaController::STATUS_CANCELADO) {
			return false;
		}
		$sessao = new Sessao();
		if ($sessao->getNivelAcesso() == SESSAO::NIVEL_COMUM) {
			if ($sessao->getIdUsuario() != $order->customer_user_id) {
				return false;
			}
		}
		if ($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
			if ($order->id_usuario_atendente != $sessao->getIdUsuario()) {
				if ($sessao->getIdUsuario() != $order->customer_user_id) {
					return false;
				}
			}
		}
		return true;
	}


	public function sendMailNotifyMessage(MensagemForum $mensagemForum, Ocorrencia $ocorrencia, $order)
	{
		$mail = new Mail();

		$ocorrenciaDao = new OcorrenciaDAO();
		$ocorrenciaDao->fillById($ocorrencia);

		$assunto = "[3S] - Chamado Nº " . $order->id;



		$saldacao =  '<p>Prezado(a) ' . $ocorrencia->getUsuarioCliente()->getNome() . ' ,</p>';
		$corpo = '<p>Avisamos que houve uma mensagem nova na solicitação <a href="https://3s.unilab.edu.br/?page=ocorrencia&selecionar=' . $ocorrencia->getId() . '">Nº' . $ocorrencia->getId() . '</a></p>';

		$corpo .= '<ul>

                        <li>Corpo: ' . $mensagemForum->getMensagem() . '</li>
                        <li>Serviço Solicitado: ' . $ocorrencia->getServico()->getNome() . '</li>
                        <li>Descrição do Problema: ' . $ocorrencia->getDescricao() . '</li>
                        <li>Setor Responsável: ' . $ocorrencia->getServico()->getAreaResponsavel()->getNome() . ' -
                        ' . $ocorrencia->getServico()->getAreaResponsavel()->getDescricao() . '</li>
                        <li>Cliente: ' . $ocorrencia->getUsuarioCliente()->getNome() . '</li>
                </ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';


		$destinatario = $ocorrencia->getEmail();
		$nome = $ocorrencia->getUsuarioCliente()->getNome();
		$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo);


		$usuarioDao = new UsuarioDAO();
		if ($ocorrencia->getIdUsuarioAtendente() != null) {

			$atendente = new Usuario();
			$atendente->setId($ocorrencia->getIdUsuarioAtendente());
			$usuarioDao->fillById($atendente);
			$destinatario = $atendente->getEmail();
			$nome = $atendente->getNome();

			$saldacao =  '<p>Prezado(a) ' . $nome . ' ,</p>';
			$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo);
		} else if ($ocorrencia->getIdUsuarioIndicado() != null) {

			$indicado = new Usuario();
			$indicado->setId($ocorrencia->getIdUsuarioIndicado());
			$usuarioDao->fillById($indicado);
			$destinatario = $indicado->getEmail();
			$nome = $indicado->getNome();

			$saldacao =  '<p>Prezado(a) ' . $nome . ' ,</p>';
			$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo);
		}
	}

	public function ajaxAddMessage()
	{

		$sessao = new Sessao();
		if (!isset($_POST['enviar_mensagem_forum'])) {
			return;
		}
		if (!(isset($_POST['tipo'])
			&& isset($_POST['mensagem'])
			&& isset($_POST['ocorrencia']))) {
			echo ':incompleto';
			return;
		}

		$mensagemForum = new MensagemForum();
		$mensagemForum->setTipo($_POST['tipo']);

		if ($_POST['tipo'] == self::TIPO_TEXTO) {
			$mensagemForum->setMensagem($_POST['mensagem']);
		} else {
			if ($_FILES['anexo']['name'] != null) {
				if (!file_exists('uploads/')) {
					mkdir('uploads/', 0777, true);
				}
				$novoNome = $_FILES['anexo']['name'];

				if (file_exists('uploads/' . $_FILES['anexo']['name'])) {
					$novoNome = uniqid() . '_' . $novoNome;
				}

				$extensaoArr = explode('.', $novoNome);
				$extensao = strtolower(end($extensaoArr));

				$extensoes_permitidas = array(
					'xlsx', 'xlsm', 'xlsb', 'xltx', 'xltm', 'xls', 'xlt', 'xls', 'xml', 'xml', 'xlam', 'xla', 'xlw', 'xlr',
					'doc', 'docm', 'docx', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'pdf', 'rtf', 'txt', 'wps', 'xml', 'zip', 'rar', 'ovpn',
					'xml', 'xps', 'jpg', 'gif', 'png', 'pdf', 'jpeg'
				);

				if (!(in_array($extensao, $extensoes_permitidas))) {
					echo ':falha:Extensão não permitida. Lista de extensões permitidas a seguir. ';
					echo '(' . implode(", ", $extensoes_permitidas) . ')';
					return;
				}

				if (!move_uploaded_file($_FILES['anexo']['tmp_name'], 'uploads/' . $novoNome)) {
					echo ':falha:Falha na tentativa de enviar arquivo';
					return;
				}
				$mensagemForum->setMensagem($novoNome);
			}
		}


		$mensagemForum->setDataEnvio(date("Y-m-d G:i:s"));

		$mensagemForum->getUsuario()->setId($sessao->getIdUsuario());
		$ocorrencia = new Ocorrencia();
		$ocorrencia->setId($_POST['ocorrencia']);
		$order = DB::table('orders')->where('id', $ocorrencia->getId())->first();


		if ($order->status == 'f' || $order->status == 'g') {
			echo ':falha:O chamado já foi fechado.';
			return;
		}

		$result = DB::table('mensagem_forum')->insert([
			'tipo' => $_POST['tipo'],
			'mensagem' => $_POST['mensagem'],
			'id_usuario' => $sessao->getIdUsuario(),
			'data_envio' => date("Y-m-d G:i:s"),
			'id_ocorrencia' => $order->id
		]);

		if ($result) {
			echo ':sucesso:' . $order->id . ':';
			$this->sendMailNotifyMessage($mensagemForum, $ocorrencia, $order);
		} else {
			echo ':falha';
		}
	}


	const TIPO_ARQUIVO = 2;
	const TIPO_TEXTO = 1;
	const STATUS_ABERTO = 'opened';
	const STATUS_RESERVADO = 'reserved';
	const STATUS_EM_ESPERA = 'opened';
	const STATUS_AGUARDANDO_USUARIO = 'pending customer response';
	const STATUS_ATENDIMENTO = 'in progress';
	const STATUS_FECHADO = 'closed';
	const STATUS_FECHADO_CONFIRMADO = 'committed';
	const STATUS_CANCELADO = 'canceled';
	const STATUS_AGUARDANDO_ATIVO = 'pending it resource';
	const STATUS_REABERTO = 'opened';
}
