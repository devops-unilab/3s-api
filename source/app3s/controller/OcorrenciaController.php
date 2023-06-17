<?php

/**
 * Classe feita para manipulação do objeto OcorrenciaController
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\AreaResponsavelDAO;
use app3s\dao\OcorrenciaDAO;
use app3s\dao\ServicoDAO;
use app3s\dao\StatusDAO;
use app3s\dao\UsuarioDAO;
use app3s\model\AreaResponsavel;
use app3s\model\MensagemForum;
use app3s\model\Ocorrencia;
use app3s\model\Servico;
use app3s\model\Status;
use app3s\model\StatusOcorrencia;
use app3s\model\Usuario;
use app3s\util\Mail;
use app3s\util\Sessao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
	public function canWait($order)
	{
		return $this->sessao->getNivelAcesso() != Sessao::NIVEL_COMUM && $order->status == 'e' && $this->sessao->getIdUsuario() != $this->selecionado->getIdUsuarioAtendente();
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
		$order = DB::table('ocorrencia')->where('id', $_GET['selecionar'])->first();



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
			->where('status_ocorrencia.id_ocorrencia', $order->id)
			->get();


		$currentStatus = DB::table('status')->where('sigla', $this->selecionado->getStatus())->first();


		$listaUsuarios = DB::table('usuario')->whereIn('nivel', ['t', 'a'])->get();
		$listaServicos = DB::table('servico')->whereIn('visao', [1, 2])->get();
		$listaAreas = DB::table('area_responsavel')->get();

		$dataSolucao = $this->calcularHoraSolucao($order->data_abertura, $this->selecionado->getServico()->getTempoSla());
		$controller = new OcorrenciaController();
		$canEditTag = $controller->possoEditarPatrimonio($this->selecionado);
		$canEditSolution = $controller->possoEditarSolucao($this->selecionado);
		$order->service_name = $this->selecionado->getServico()->getNome();
		$canEditService = $controller->possoEditarServico($this->selecionado);
		$isClient = ($sessao->getNivelAcesso() == Sessao::NIVEL_COMUM);
		$canWait = $this->canWait($order);

		$order->tempo_sla = $this->selecionado->getServico()->getTempoSla();
		$timeNow = time();
		$timeSolucaoEstimada = strtotime($dataSolucao);
		$isLate = $timeNow > $timeSolucaoEstimada;

		$canRequestHelp = ($this->selecionado->getUsuarioCliente()->getId() == $sessao->getIdUsuario() && !isset($_SESSION['pediu_ajuda']));
		$order->client_name =  $this->selecionado->getUsuarioCliente()->getNome();


		$canEditDivision = $controller->possoEditarAreaResponsavel($this->selecionado);

		$usuarioDao = new UsuarioDAO();

		$providerName = '';

		if ($this->selecionado->getStatus() == OcorrenciaController::STATUS_RESERVADO) {
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
			'providerDivision' => $this->selecionado->getAreaResponsavel()->getNome() . ' - ' . $this->selecionado->getAreaResponsavel()->getDescricao(),
			'providerName' => $providerName,
			'canEditDivision' => $canEditDivision,
			'orderStatusLog' => $orderStatusLog,
			'currentStatus' => $currentStatus,
			'canWait' => $canWait
		]);


		// INDEX MESSAAGE
		//DAqui pra baixo só usa $order
		$canSendMessage = $this->possoEnviarMensagem($order);

		$messageList = DB::table('mensagem_forum')
		->join('usuario', 'mensagem_forum.id_usuario', '=', 'usuario.id')
		->join('ocorrencia', 'mensagem_forum.id_ocorrencia', '=', 'ocorrencia.id')
		->select(
			'mensagem_forum.id as id',
			'usuario.id as user_id',
			'usuario.nome as user_name',
			'mensagem_forum.tipo as message_type',
			'mensagem_forum.mensagem as message_content',
			'mensagem_forum.data_envio as created_at',
			'ocorrencia.status as order_status'
		)
		->where('mensagem_forum.id_ocorrencia', $order->id)
		->orderBy('mensagem_forum.id')
		->get();

        if (isset($_POST['chatDelete'])) {

            $idChat = intval($_POST['chatDelete']);

            $message = DB::table('mensagem_forum')
            ->join('usuario', 'mensagem_forum.id_usuario', '=', 'usuario.id')
            ->join('ocorrencia', 'mensagem_forum.id_ocorrencia', '=', 'ocorrencia.id')
            ->select(
                'mensagem_forum.id as id',
                'usuario.id as user_id',
                'ocorrencia.status as order_status'
            )
            ->where('mensagem_forum.id', $idChat)
            ->first();

            if ($sessao->getIdUsuario() === $message->user_id && $order->status === 'e') {

                DB::table('mensagem_forum')->where('id', $idChat)->delete();
                echo '<meta http-equiv = "refresh" content = "0 ; url =?page=ocorrencia&selecionar=' . $_GET['selecionar'] . '"/>';
            }
        }
        echo '


        <!-- Modal -->
        <div class="modal fade" id="modalDeleteChat" tabindex="-1" aria-labelledby="modalDeleteChatLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteChatLabel">Apagar Mensagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Tem certeza que deseja apagar esta mensagem?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="" method="post">
                    <input type="hidden" id="chatDelete" name="chatDelete" value=""/>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </form>

              </div>
            </div>
          </div>
        </div>


		<div class="container">
		<div class="row">
			<div class="chatbox chatbox22">
				<div class="chatbox__title">
					<h5 class="text-white">#<span id="id-ocorrencia">' . $order->id . '</span></h5>
					<!--<button class="chatbox__title__tray">
            <span></span>
        </button>-->

				</div>
				<div id="corpo-chat" class="chatbox__body">';




        $ultimoId = 0;
        foreach ($messageList as $mensagemForum) {
            $ultimoId = $mensagemForum->id;
            $name = $mensagemForum->user_name;
            $name = substr(ucwords(mb_strtolower($name, 'UTF-8')), 0, 14).(strlen($name) > 14 ? "..." : "");

            echo '



            			<div class="chatbox__body__message chatbox__body__message--left">

            				<div class="chatbox_timing">
            					<ul>
            						<li><a href="#"><i class="fa fa-calendar"></i> ' . date("d/m/Y", strtotime($mensagemForum->created_at)) . '</a></li>
            						<li><a href="#"><i class="fa fa-clock-o"></i> ' . date("H:i", strtotime($mensagemForum->created_at)) . '</a></a></li>';
            if ($mensagemForum->user_id == $sessao->getIdUsuario() && $mensagemForum->order_status === 'e') {
                echo '<li><button data-toggle="modal" onclick="changeField(' . $mensagemForum->id . ')" data-target="#modalDeleteChat"><i class="fa fa-trash-o"></i> Apagar </a></button></li>';
            }

            echo '

            					</ul>
            				</div>
            				<!-- <img src="https://www.gstatic.com/webp/gallery/2.jpg"
            					alt="Picture">-->
            				<div class="clearfix"></div>
            				<div class="ul_section_full">
            					<ul class="ul_msg">
                                    <li><strong>' .$name . '</strong></li>';
            if ($mensagemForum->message_type == self::TIPO_ARQUIVO) {
                echo '<li>Anexo: <a href="uploads/' . $mensagemForum->message_content . '">Clique aqui</a></li>';
            } else {
                echo '
                        <li>' . strip_tags($mensagemForum->message_content) . '</li>';
            }
            echo '

            					</ul>
            					<div class="clearfix"></div>

            				</div>

            			</div>';
        }
        echo '<span id="ultimo-id-post" class="escondido">' . $ultimoId . '</span>';
        echo '


				</div>
				<div class="panel-footer">';
        if ($canSendMessage) {
            echo '<form id="insert_form_mensagem_forum" class="user" method="post">
            <input type="hidden" name="enviar_mensagem_forum" value="1">
            <input type="hidden" name="ocorrencia" value="' . $order->id . '">
            <input type="hidden" id="campo_tipo" name="tipo" value="' . self::TIPO_TEXTO . '">

            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" name="muda-tipo" id="muda-tipo">
              <label class="custom-control-label" for="muda-tipo">Enviar Arquivo</label>
            </div>
            <div class="custom-file mb-3 escondido" id="campo-anexo">
                  <input type="file" class="custom-file-input" name="anexo" id="anexo" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*, application/zip,application/rar, .ovpn, .xlsx">
                  <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
            </div>
  <div class="input-group">
    <input name="mensagem" id="campo-texto" type="text" class="form-control input-sm chat_set_height" placeholder="Digite sua mensagem aqui..." tabindex="0" dir="ltr" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off" contenteditable="true" />
                <span class="input-group-btn"> <button class="btn bt_bg btn-sm" id="botao-enviar-mensagem">Enviar</button></span>
  </div>
        </form>';
        }

        echo '



				</div>
			</div>
		</div>
	</div>
    <script>
    function changeField(id) {
        document.getElementById(\'chatDelete\').value = id;
    }
    </script>

';
	}


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
			->whereIn('status', ['a', 'i', 'd', 'e', 'r', 'b'])->orderByDesc('ocorrencia.id');;
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
		$lista = $queryPendding->get();
		$lista2 = $queryFinished->get();

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


		$listaNaoAvaliados = DB::table('ocorrencia')->where('id_usuario_cliente', $this->sessao->getIdUsuario())->where('status', OcorrenciaController::STATUS_FECHADO)->get();

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

		$ocorrencia->setStatus(OcorrenciaController::STATUS_ABERTO);

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
		if (!file_exists('uploads/ocorrencia/anexo/')) {
			mkdir('uploads/ocorrencia/anexo/', 0777, true);
		}

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
				echo ':falha:arquivo não pode ser enviado';
				return;
			}
			$ocorrencia->setAnexo($novoNome);
		}

		$ocorrencia->setLocalSala($_POST['local_sala']);

		$ocorrencia->getUsuarioCliente()->setId($sessao->getIdUsuario());



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
			if ($this->dao->insertStatus($statusOcorrencia)) {
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
	public function ajaxAtender()
	{
		if (!isset($_POST['status_acao'])) {
			return false;
		}
		if ($_POST['status_acao'] != 'atender') {
			return false;
		}
		if (!isset($_POST['id_ocorrencia'])) {
			return false;
		}
		if (!isset($_POST['senha'])) {
			return false;
		}

		if (!$this->possoAtender()) {
			echo ':falha:Não é possível atender este chamado.';
			return false;
		}

		$this->sessao = new Sessao();
		$this->selecionado = new Ocorrencia();
		$this->selecionado->setId($_POST['id_ocorrencia']);



		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$ocorrenciaDao->fillById($this->selecionado);


		$usuario = new Usuario();
		$usuario->setId($this->sessao->getIdUsuario());

		$usuarioDao = new UsuarioDAO($this->dao->getConnection());
		$usuarioDao->fillById($usuario);
		$this->selecionado->getAreaResponsavel()->setId($usuario->getIdSetor());

		$this->selecionado->setIdUsuarioAtendente($this->sessao->getIdUsuario());


		$this->selecionado->setStatus(self::STATUS_ATENDIMENTO);

		$status = new Status();
		$status->setSigla(self::STATUS_ATENDIMENTO);

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem("Ocorrência em atendimento");


		$usuarioDao = new UsuarioDAO($this->dao->getConnection());
		$usuario = new Usuario();
		$usuario->setId($this->sessao->getIdUsuario());
		$usuarioDao->fillById($usuario);

		$this->selecionado->getAreaResponsavel()->setId($usuario->getIdSetor());

		if ($this->selecionado->getDataAtendimento() == null) {
			$this->selecionado->setDataAtendimento(date("Y-m-d H:i:s"));
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
		echo ':sucesso:' . $this->selecionado->getId() . ':Chamado am atendimento!';
		return true;
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

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

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



	public function possoEditarServico(Ocorrencia $ocorrencia)
	{
		$this->selecionado = $ocorrencia;
		$this->sessao = new Sessao();
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_FECHADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_FECHADO_CONFIRMADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_CANCELADO) {
			return false;
		}
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM) {
			return true;
		}
		if ($this->selecionado->getStatus() != self::STATUS_ATENDIMENTO) {
			return false;
		}

		if ($this->sessao->getIdUsuario() != $this->selecionado->getIdUsuarioAtendente()) {
			return false;
		}
		return true;
	}
	public function possoEditarAreaResponsavel(Ocorrencia $ocorrencia)
	{



		$this->selecionado = $ocorrencia;
		$this->sessao = new Sessao();
		if ($this->sessao->getNivelAcesso() != Sessao::NIVEL_ADM) {
			return false;
		}

		if ($this->selecionado->getStatus() == self::STATUS_ABERTO) {
			return true;
		}
		if ($this->selecionado->getStatus() == self::STATUS_REABERTO) {
			return true;
		}
		return false;
	}


	public function possoEditarSolucao(Ocorrencia $ocorrencia)
	{
		$this->selecionado = $ocorrencia;
		$this->sessao = new Sessao();
		if ($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO) {
			return false;
		}
		if ($this->selecionado->getStatus() != self::STATUS_ATENDIMENTO) {
			return false;
		}
		if ($this->sessao->getIdUsuario() != $this->selecionado->getIdUsuarioAtendente()) {
			return false;
		}
		return true;
	}

	public function possoEditarPatrimonio(Ocorrencia $ocorrencia)
	{
		$this->selecionado = $ocorrencia;
		$this->sessao = new Sessao();

		if ($this->selecionado->getStatus() == self::STATUS_FECHADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_CANCELADO) {
			return false;
		}
		if ($this->selecionado->getStatus() == self::STATUS_FECHADO_CONFIRMADO) {
			return false;
		}
		if ($this->sessao->getIdUsuario() == $this->selecionado->getUsuarioCliente()->getId()) {
			return true;
		}
		if ($this->sessao->getIdUsuario() == $this->selecionado->getIdUsuarioAtendente()) {
			return true;
		}
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
	public function ajaxFechar()
	{
		if (!$this->possoFechar()) {
			echo ':falha:Não é possível fechar este chamado.';
			return false;
		}

		$usuario = new Usuario();
		$usuario->setId($this->sessao->getIdUsuario());

		$usuarioDao = new UsuarioDAO($this->dao->getConnection());
		$usuarioDao->fillById($usuario);
		$this->selecionado->getAreaResponsavel()->setId($usuario->getIdSetor());


		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_FECHADO);

		$status = new Status();
		$status->setSigla(self::STATUS_FECHADO);

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem("Ocorrência fechada pelo atendente");


		$this->selecionado->setDataFechamento(date("Y-m-d H:i:s"));


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
		echo ':sucesso:' . $this->selecionado->getId() . ':Chamado fechado com sucesso!';

		return true;
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

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

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

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

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

		$usuarioDao = new UsuarioDAO($this->dao->getConnection());
		$usuarioDao->fillById($usuario);

		$this->selecionado->getAreaResponsavel()->setId($usuario->getIdSetor());
		$this->selecionado->setStatus(self::STATUS_RESERVADO);

		$status = new Status();
		$status->setSigla(self::STATUS_RESERVADO);

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Atendimento reservado para ' . $usuario->getNome());


		$ocorrenciaDao->getConnection()->beginTransaction();
		$this->selecionado->setIdUsuarioIndicado($usuario->getId());
		$this->selecionado->getAreaResponsavel()->setId($usuario->getIdSetor());


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
	public function mainAjaxStatus()
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
		switch ($_POST['status_acao']) {
			case 'cancelar':
				$status = $this->ajaxCancelar();
				$mensagem = '<p>Chamado cancelado</p>';
				break;
			case 'atender':
				$status = $this->ajaxAtender();
				$mensagem = '<p>Chamado em atendimento</p>';
				break;
			case 'fechar':
				$status = $this->ajaxFechar();
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
		if (!$this->possoEditarPatrimonio($this->selecionado)) {
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

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

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

		if (!$this->possoEditarSolucao($this->selecionado)) {
			echo ':falha:Esta solução não pode ser editada.';
			return false;
		}

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_AGUARDANDO_ATIVO);

		$status = new Status();
		$status->setSigla(self::STATUS_AGUARDANDO_ATIVO);

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

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
		if (!$this->possoEditarSolucao($this->selecionado)) {
			echo ':falha:Esta solução não pode ser editada.';
			return false;
		}
		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus(self::STATUS_AGUARDANDO_USUARIO);

		$status = new Status();
		$status->setSigla(self::STATUS_AGUARDANDO_USUARIO);

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

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
		if (!$this->possoEditarSolucao($this->selecionado)) {
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

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

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
		if (!$this->possoEditarAreaResponsavel($this->selecionado)) {
			echo ':falha:Você não pode editar a área responsável.';
			return false;
		}

		if (!isset($_POST['area_responsavel'])) {
			echo ':falha:Selecione um serviço.';
			return false;
		}
		$areaResponsavel = new AreaResponsavel();
		$areaResponsavel->setId($_POST['area_responsavel']);
		$areaResponsavelDao = new AreaResponsavelDAO($this->dao->getConnection());
		$areaResponsavelDao->fillById($areaResponsavel);

		$this->selecionado->setAreaResponsavel($areaResponsavel);

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());

		$status = new Status();
		$status->setSigla(self::STATUS_ABERTO);

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Chamado encaminhado para setor: ' . $areaResponsavel->getNome());

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
		if (!$this->possoEditarServico($this->selecionado)) {
			echo ':falha:Este serviço não pode ser editado.';
			return false;
		}

		if (!isset($_POST['id_servico'])) {
			echo ':falha:Selecione um serviço.';
			return false;
		}


		$servico = new Servico();
		$servico->setId($_POST['id_servico']);

		$servicoDao = new ServicoDAO($this->dao->getConnection());
		$servicoDao->fillById($servico);


		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());


		$status = new Status();
		$status->setSigla($this->selecionado->getStatus());

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Técnico editou o serviço ');

		$this->selecionado->getAreaResponsavel()->setId($servico->getAreaResponsavel()->getId());
		$this->selecionado->getServico()->setId($servico->getId());



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

		$statusDao = new StatusDAO($this->dao->getConnection());
		$statusDao->fillBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
		$this->statusOcorrencia->setMensagem('Liberado para atendimento');


		$ocorrenciaDao->getConnection()->beginTransaction();
		$this->selecionado->setIdUsuarioIndicado(null);
		$this->selecionado->setIdUsuarioAtendente(null);

		$servicoDao = new ServicoDAO($this->dao->getConnection());
		$servicoDao->fillById($this->selecionado->getServico());


		$this->selecionado->getAreaResponsavel()->setId($this->selecionado->getServico()->getAreaResponsavel()->getId());

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
            if ($sessao->getIdUsuario() != $order->id_usuario_cliente) {
                return false;
            }
        }
        if ($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
            if ($order->id_usuario_atendente != $sessao->getIdUsuario()) {
                if ($sessao->getIdUsuario() != $order->id_usuario_cliente) {
                    return false;
                }
            }
        }
        return true;
    }


    public function sendMailNotifyMessage(MensagemForum $mensagemForum, Ocorrencia $ocorrencia)
    {
        $mail = new Mail();

        $ocorrenciaDao = new OcorrenciaDAO();
        $ocorrenciaDao->fillById($ocorrencia);

        $assunto = "[3S] - Chamado Nº " . $ocorrencia->getId();



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
        $order = DB::table('ocorrencia')->where('id', $ocorrencia->getId())->first();

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
            echo ':sucesso:' . $ocorrencia->getId() . ':';
            $this->sendMailNotifyMessage($mensagemForum, $ocorrencia);
        } else {
            echo ':falha';
        }
    }


    const TIPO_ARQUIVO = 2;
    const TIPO_TEXTO = 1;
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
}
