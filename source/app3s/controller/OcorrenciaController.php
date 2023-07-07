<?php

/**
 * Classe feita para manipulação do objeto OcorrenciaController
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\OcorrenciaDAO;
use app3s\model\MensagemForum;
use app3s\model\Ocorrencia;
use app3s\model\Status;
use app3s\model\StatusOcorrencia;
use app3s\model\Usuario;
use app3s\util\Mail;
use App\Models\Order;
use App\Models\User;
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




	public function ajaxPedirAjuda()
	{



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
			if ($adm->nivel == 'administrator') {
				$saudacao =  '<p>Prezado(a) ' . $adm->nome . ' ,</p>';
				$mail->enviarEmail($adm->email, $adm->nome, $assunto, $saudacao . $corpo);
			}
		}
		$_SESSION['pediu_ajuda'] = 1;
		echo ':sucesso:UM e-mail foi enviado aos chefes:';
	}


	public function possoCancelar()
	{
		return (auth()->user()->id === $this->selecionado->getUsuarioCliente()->getId()) && ($this->selecionado->getStatus() == 'opened');
	}

	public function passwordVerify()
	{
		if (!isset($_POST['senha'])) {
			return false;
		}
		$login = auth()->user()->login;
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
		if ($responseJ->id != auth()->user()->id) {
			return false;
		}
		return true;
	}
	public function ajaxAtender($order, $user, $sigla)
	{


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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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
			($user->role === 'administrator' || $user->role === 'provider')
			&& $order->status === self::STATUS_ATENDIMENTO);
	}
	public function possoEditarAreaResponsavel($order, $user)
	{
		return ($order->status === self::STATUS_ABERTO ||
			$order->status === self::STATUS_ATENDIMENTO)
			&& $user->role === 'administrator';
	}


	public function possoEditarSolucao($order, $user)
	{
		return true;
	}

	public function possoEditarPatrimonio($order, $user)
	{
		return (
			($user->role === 'administrator'
				|| $user->role === 'provider'
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
		if (auth()->user()->id != $this->selecionado->getUsuarioCliente()->getId()) {
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
		if (auth()->user()->id != $this->selecionado->getUsuarioCliente()->getId()) {
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
		if (request()->session()->get('role') == 'customer') {
			return false;
		}




		return false;
	}
	public function possoReservar()
	{
		if (request()->session()->get('role') != 'administrator') {
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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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


		$this->selecionado = new Ocorrencia();
		$this->selecionado->setId($_POST['id_ocorrencia']);
		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$ocorrenciaDao->fillById($this->selecionado);
		$status = false;
		$mensagem = "";

		$order = DB::table('orders')->where('id', $_POST['id_ocorrencia'])->first();
		$user = DB::table('usuario')->where('id', auth()->user()->id)->first();


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

		$order = Order::findOrFail($this->selecionado->getId());
		$user = auth()->user();
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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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
		$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo);

		$destinatario = $this->statusOcorrencia->getOcorrencia()->getAreaResponsavel()->getEmail();
		$nome = $this->statusOcorrencia->getOcorrencia()->getAreaResponsavel()->getNome();
		$mail->enviarEmail($destinatario, $nome, $assunto, $saldacao . $corpo); //Email para area responsavel


		if ($this->statusOcorrencia->getOcorrencia()->getIdUsuarioAtendente() != null) {
			$provider = User::find($this->statusOcorrencia->getOcorrencia()->getIdUsuarioAtendente());
			$saldacao =  '<p>Prezado(a) ' . $nome . ' ,</p>';
			$mail->enviarEmail($provider->email, $provider->name, $assunto, $saldacao . $corpo);
		}
	}

	public function ajaxAguardandoAtivo()
	{

		$order = Order::findOrFail($this->selecionado->getId());
		$user = auth()->user();

		if (!$this->possoEditarSolucao($order, $user)) {
			echo ':falha:Esta solução não pode ser editada.';
			return false;
		}

		$ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
		$this->selecionado->setStatus('pending it resource');

		$status = new Status();
		$status->setSigla('pending it resource');

		$this->dao->fillStatusBySigla($status);

		$this->statusOcorrencia = new StatusOcorrencia();
		$this->statusOcorrencia->setOcorrencia($this->selecionado);
		$this->statusOcorrencia->setStatus($status);
		$this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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


		$user = auth()->user();

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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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
		$user = auth()->user();

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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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
		if (request()->session()->get('role') != 'administrator') {
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
		$this->statusOcorrencia->getUsuario()->setId(auth()->user()->id);
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
		if (request()->session()->get('role') == 'customer') {
			if (auth()->user()->id != $order->customer_user_id) {
				return false;
			}
		}
		if (request()->session()->get('role') == 'provider') {
			if ($order->id_usuario_atendente != auth()->user()->id) {
				if (auth()->user()->id != $order->customer_user_id) {
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



		if ($ocorrencia->getIdUsuarioAtendente() != null) {

			$provider = User::find($ocorrencia->getIdUsuarioAtendente());
			$saldacao =  '<p>Prezado(a) ' . $provider->name . ' ,</p>';
			$mail->enviarEmail($provider->email, $provider->name, $assunto, $saldacao . $corpo);
		}
	}

	public function ajaxAddMessage()
	{


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

		$mensagemForum->getUsuario()->setId(auth()->user()->id);
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
			'id_usuario' => auth()->user()->id,
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
	const STATUS_AGUARDANDO_USUARIO = 'pending customer response';
	const STATUS_ATENDIMENTO = 'in progress';
	const STATUS_FECHADO = 'closed';
	const STATUS_FECHADO_CONFIRMADO = 'committed';
	const STATUS_CANCELADO = 'canceled';
	const STATUS_AGUARDANDO_ATIVO = 'pending it resource';
	const STATUS_REABERTO = 'opened';
}
