<?php

/**
 * Classe feita para manipulação do objeto ServicoController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\ServicoDAO;
use app3s\dao\TipoAtividadeDAO;
use app3s\dao\GrupoServicoDAO;
use app3s\model\Servico;
use app3s\util\Sessao;
use app3s\view\ServicoView;
use Illuminate\Support\Facades\DB;

class ServicoController
{

    protected  $view;
    protected $dao;

    public function __construct()
    {
        $this->dao = new ServicoDAO();
        $this->view = new ServicoView();
    }



    public function main()
    {
        $sessao = new Sessao();
        if ($sessao->getNivelAcesso() != Sessao::NIVEL_ADM) {
            return;
        }
        echo '

        <div class="card mb-4">
            <div class="card-body">

';

        echo '
        <div class="row">';
        echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';

        if (isset($_GET['edit'])) {
            $this->edit();
        } elseif (isset($_GET['delete'])) {
            $this->delete();
        } else {
            $this->add();
        }
        $this->fetch();

        echo '</div></div></div></div>';
    }

    public function edit()
    {
        if (!isset($_GET['edit'])) {
            return;
        }
        $selected = new Servico();
        $selected->setId($_GET['edit']);
        $this->dao->fillById($selected);

        if (!isset($_POST['edit_servico'])) {
            $tipoatividadeDao = new TipoAtividadeDAO($this->dao->getConnection());
            $listTipoAtividade = $tipoatividadeDao->fetch();

            $listAreaResponsavel = DB::table('area_responsavel')->get();

            $gruposervicoDao = new GrupoServicoDAO($this->dao->getConnection());
            $listGrupoServico = $gruposervicoDao->fetch();

            $this->view->showEditForm($listTipoAtividade, $listAreaResponsavel, $listGrupoServico, $selected);
            return;
        }

        if (!(isset($_POST['nome'])
            && isset($_POST['descricao'])
            && isset($_POST['tempo_sla'])
            && isset($_POST['visao'])
            &&  isset($_POST['tipo_atividade'])
            &&  isset($_POST['area_responsavel'])
            &&  isset($_POST['grupo_servico']))) {
            echo "Incompleto";
            return;
        }

        $selected->setNome($_POST['nome']);
        $selected->setDescricao($_POST['descricao']);
        $selected->getTipoAtividade()->setId($_POST['tipo_atividade']);
        $selected->setTempoSla($_POST['tempo_sla']);
        $selected->setVisao($_POST['visao']);
        $selected->getAreaResponsavel()->setId($_POST['area_responsavel']);
        $selected->getGrupoServico()->setId($_POST['grupo_servico']);


        if ($this->dao->update($selected)) {
            echo '<div class="alert alert-success" role="alert">Sucesso</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Falha</div>';
        }
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=servico">';
    }


    public function fetch()
    {

        $list = DB::table('servico')->select(
            'servico.id',
            'servico.nome',
            'servico.descricao',
            'servico.tempo_sla',
            'servico.visao',
            'area_responsavel.nome as area_responsavel'
        )
            ->join('area_responsavel', 'area_responsavel.id', '=', 'servico.id_area_responsavel')
            ->get();
        foreach ($list as $key => $service) {
            $list[$key]->visao = $this->toStringVisao($list[$key]->visao);
        }
        echo view('admin.service.index', ['services' => $list]);
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
        $str = "";
        switch ($visao) {
            case 0:
                $str = "Inativo";
                break;
            case 1:
                $str = "Comum";
                break;
            case 2:
                $str = "Técnico";
                break;
            case 3:
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
            echo '

             <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> Apagar Serviço</h1>
                                    </div>
                                      <form class="user" method="post">Tem certeza que deseja apagar este serviço?

                                        <input type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                            value="Delete"
                                            name="delete_servico">
                                        <hr>

                                      </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

            ';
            return;
        }
        if ($this->dao->delete($selected)) {
            echo '<div class="alert alert-success" role="alert">Sucesso ao excluir Servico</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Falha ao tentar excluir Servico</div>';
        }
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=?page=servico">';
    }

    public function add()
    {

        if (!isset($_POST['enviar_servico'])) {
            $listAreaResponsavel = DB::table('area_responsavel')->get();
            echo view('admin.service.create', ['departments' => $listAreaResponsavel]);
            return;
        }
        if (!(isset($_POST['nome'])
            && isset($_POST['descricao'])
            && isset($_POST['tempo_sla'])
            && isset($_POST['visao'])
            &&  isset($_POST['tipo_atividade'])
            &&  isset($_POST['area_responsavel'])
            &&  isset($_POST['grupo_servico']))) {
            echo '
                <div class="alert alert-danger" role="alert">Failed to register. Some field must be missing. </div>';
            return;
        }
        $servico = new Servico();
        $servico->setNome($_POST['nome']);
        $servico->setDescricao($_POST['descricao']);
        $servico->setTempoSla($_POST['tempo_sla']);
        $servico->setVisao($_POST['visao']);
        $servico->getTipoAtividade()->setId($_POST['tipo_atividade']);
        $servico->getAreaResponsavel()->setId($_POST['area_responsavel']);
        $servico->getGrupoServico()->setId($_POST['grupo_servico']);

        if ($this->dao->insert($servico)) {
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
