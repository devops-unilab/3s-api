<?php

/**
 * Classe feita para manipulação do objeto MensagemForumController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\MensagemForumDAO;
use app3s\dao\UsuarioDAO;
use app3s\model\Ocorrencia;
use app3s\dao\OcorrenciaDAO;
use app3s\model\MensagemForum;
use app3s\model\Usuario;
use app3s\util\Mail;
use app3s\util\Sessao;
use app3s\view\MensagemForumView;


class MensagemForumController
{

    protected  $view;
    protected $dao;

    public function __construct()
    {
        $this->dao = new MensagemForumDAO();
        $this->view = new MensagemForumView();
    }


    public function allowed(Ocorrencia $ocorrencia) {
        $sessao = new Sessao();
        if ($sessao->getNivelAcesso() == SESSAO::NIVEL_COMUM) {
            if ($sessao->getIdUsuario() != $ocorrencia->getUsuarioCliente()->getId()) {
                return false;
            }
        }
        if ($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO) {
            if ($ocorrencia->getIdUsuarioAtendente() != $sessao->getIdUsuario()) {
                if ($sessao->getIdUsuario() != $ocorrencia->getUsuarioCliente()->getId()) {
                    return false;
                }
            }
        }
        return true;
    }
    public function possoEnviarMensagem(Ocorrencia $ocorrencia)
    {

        if (
            $ocorrencia->getStatus() == StatusOcorrenciaController::STATUS_FECHADO
            || $ocorrencia->getStatus() == StatusOcorrenciaController::STATUS_FECHADO_CONFIRMADO
            || $ocorrencia->getStatus() == StatusOcorrenciaController::STATUS_CANCELADO
        ) {
            return false;
        }
        return $this->allowed($ocorrencia);
        
    }

    public function mainOcorrencia(Ocorrencia $ocorrencia)
    {
        $sessao = new Sessao();

        if (isset($_POST['chatDelete'])) {
            $idChat = intval($_POST['chatDelete']);
            $mensagemForum = new MensagemForum();
            $mensagemForum->setId($idChat);
            $mensagemForumDao = new MensagemForumDAO();
            $mensagemForumDao->fillById($mensagemForum);
            if ($sessao->getIdUsuario() === $mensagemForum->getUsuario()->getId() && $ocorrencia->getStatus() === StatusOcorrenciaController::STATUS_ATENDIMENTO) {
                $mensagemForumDao->delete($mensagemForum);
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
					<h5 class="text-white">#<span id="id-ocorrencia">' . $ocorrencia->getId() . '</span></h5>
					<!--<button class="chatbox__title__tray">
            <span></span>
        </button>-->
					
				</div>
				<div id="corpo-chat" class="chatbox__body">';

        $listaForum = $ocorrencia->getMensagens();
        $ultimoId = 0;
        foreach ($listaForum as $mensagemForum) {
            $ultimoId = $mensagemForum->getId();
            $nome = $mensagemForum->getUsuario()->getNome();
            $listaNome = explode(' ', $mensagemForum->getUsuario()->getNome());
            if (isset($listaNome[0])) {
                $nome = ucfirst(strtolower($listaNome[0]));
            }
            if (isset($listaNome[1])) {
                if (strlen($listaNome[1]) <= 2) {
                    $nome .= ' ' . strtolower($listaNome[1]);
                    if (isset($listaNome[2])) {
                        $nome .= ' ' . ucfirst(strtolower($listaNome[2]));
                    }
                } else {
                    $nome .= ' ' . ucfirst(strtolower($listaNome[1]));
                }
            }


            echo '



            			<div class="chatbox__body__message chatbox__body__message--left">
            
            				<div class="chatbox_timing">
            					<ul>
            						<li><a href="#"><i class="fa fa-calendar"></i> ' . date("d/m/Y", strtotime($mensagemForum->getDataEnvio())) . '</a></li>
            						<li><a href="#"><i class="fa fa-clock-o"></i> ' . date("H:i", strtotime($mensagemForum->getDataEnvio())) . '</a></a></li>';
            if ($mensagemForum->getUsuario()->getId() == $sessao->getIdUsuario() && $ocorrencia->getStatus() === StatusOcorrenciaController::STATUS_ATENDIMENTO) {
                echo '
                                        <li><button data-toggle="modal" onclick="changeField(' . $mensagemForum->getId() . ')" data-target="#modalDeleteChat"><i class="fa fa-trash-o"></i> Apagar </a></button></li>';
            }

            echo '

            					</ul>
            				</div>
            				<!-- <img src="https://www.gstatic.com/webp/gallery/2.jpg" 
            					alt="Picture">-->
            				<div class="clearfix"></div>
            				<div class="ul_section_full">
            					<ul class="ul_msg">
                                    <li><strong>' . $nome . '</strong></li>';
            if ($mensagemForum->getTipo() == self::TIPO_ARQUIVO) {
                echo '<li>Anexo: <a href="uploads/' . $mensagemForum->getMensagem() . '">Clique aqui</a></li>';
            } else {
                echo '
                        <li>' . strip_tags($mensagemForum->getMensagem()) . '</li>';
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
        if ($this->possoEnviarMensagem($ocorrencia)) {
            $this->view->showInsertForm2($ocorrencia);
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

    public function delete()
    {
        if (!isset($_GET['delete'])) {
            return;
        }
        $selected = new MensagemForum();
        $selected->setId($_GET['delete']);
        if (!isset($_POST['delete_mensagem_forum'])) {
            $this->view->confirmDelete($selected);
            return;
        }
        if ($this->dao->delete($selected)) {
            echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Mensagem Forum
</div>

';
        } else {
            echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Mensagem Forum
</div>

';
        }
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=?page=mensagem_forum">';
    }



    public function fetch()
    {
        $list = $this->dao->fetch();
        $this->view->showList($list);
    }


    public function enviaEmail(MensagemForum $mensagemForum, Ocorrencia $ocorrencia)
    {
        $mail = new Mail();

        $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
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


        $usuarioDao = new UsuarioDAO($this->dao->getConnection());
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

    public function addAjax()
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


        if ($this->dao->insert($mensagemForum, $ocorrencia)) {
            echo ':sucesso:' . $ocorrencia->getId();
            $this->enviaEmail($mensagemForum, $ocorrencia);
        } else {
            echo ':falha';
        }
    }




    public function edit()
    {
        if (!isset($_GET['edit'])) {
            return;
        }
        $selected = new MensagemForum();
        $selected->setId($_GET['edit']);
        $this->dao->fillById($selected);

        if (!isset($_POST['edit_mensagem_forum'])) {
            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showEditForm($listUsuario, $selected);
            return;
        }

        if (!(isset($_POST['tipo']) && isset($_POST['mensagem']) && isset($_POST['data_envio']) &&  isset($_POST['usuario']))) {
            echo "Incompleto";
            return;
        }

        $selected->setTipo($_POST['tipo']);
        $selected->setMensagem($_POST['mensagem']);
        $selected->setDataEnvio($_POST['data_envio']);

        if ($this->dao->update($selected)) {
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=mensagem_forum">';
    }


    public function main()
    {

        if (isset($_GET['select'])) {
            echo '<div class="row">';
            $this->select();
            echo '</div>';
            return;
        }
        echo '
		<div class="row">';
        echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';

        if (isset($_GET['edit'])) {
            $this->edit();
        } else if (isset($_GET['delete'])) {
            $this->delete();
        }
        $this->fetch();

        echo '</div>';
        echo '</div>';
    }
    public function mainAjax()
    {

        $this->addAjax();
    }



    public function select()
    {
        if (!isset($_GET['select'])) {
            return;
        }
        $selected = new MensagemForum();
        $selected->setId($_GET['select']);

        $this->dao->fillById($selected);

        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
        $this->view->showSelected($selected);
        echo '</div>';
    }
    const TIPO_ARQUIVO = 2;
    const TIPO_TEXTO = 1;
}
