<?php

/**
 * Classe feita para manipulação do objeto AreaResponsavelController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\AreaResponsavelDAO;
use app3s\model\AreaResponsavel;
use app3s\view\AreaResponsavelView;
use Illuminate\Support\Facades\DB;

class AreaResponsavelController
{

    protected  $view;
    protected $dao;

    public function __construct()
    {
        $this->dao = new AreaResponsavelDAO();
    }


    public function delete()
    {
        if (!isset($_GET['delete'])) {
            return;
        }
        $selected = new AreaResponsavel();
        $selected->setId($_GET['delete']);
        if (!isset($_POST['delete_area_responsavel'])) {
            echo view('admin.department.confirm-delete');
            return;
        }

        if (DB::table('area_responsavel')->delete($_GET['delete'])) {
            echo '<div class="alert alert-success" role="alert">Sucesso ao excluir Area Responsavel</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Falha ao tentar excluir Area Responsavel</div>';
        }
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=?page=area_responsavel">';
    }

    public function add()
    {

        if (!isset($_POST['enviar_area_responsavel'])) {
            echo view('admin.department.create');
            return;
        }
        if (!(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['email']))) {
            echo '<div class="alert alert-danger" role="alert">Failed to register. Some field must be missing.</div>';
            return;
        }
        $areaResponsavel = new AreaResponsavel();
        $areaResponsavel->setNome($_POST['nome']);
        $areaResponsavel->setDescricao($_POST['descricao']);
        $areaResponsavel->setEmail($_POST['email']);

        if ($this->dao->insert($areaResponsavel)) {
            echo '<div class="alert alert-success" role="alert">Sucesso ao inserir Area Responsavel</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Falha ao tentar Inserir Area Responsavel</div>';
        }
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=area_responsavel">';
    }





    public function edit()
    {
        if (!isset($_GET['edit'])) {
            return;
        }

        $selected2 = DB::table('area_responsavel')->where('id', intval($_GET['edit']))->first();

        if (!isset($_POST['edit_area_responsavel'])) {
            echo view('admin.department.edit', ['department' => $selected2]);
            return;
        }

        if (!(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['email']))) {
            echo "Incompleto";
            return;
        }

        $afected = DB::table('area_responsavel')
            ->where('id', intval($_GET['edit']))
            ->update(
                [
                    'nome' => $_POST['nome'],
                    'descricao' => $_POST['descricao'],
                    'email' => $_POST['email']
                ]
            );
        if ($afected) {
            echo '<div class="alert alert-success" role="alert">Sucesso</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Falha</div>';
        }
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=area_responsavel">';
    }


    public function main()
    {


        echo '<div class="card mb-4"><div class="card-body">';
        echo '<div class="row"><div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';

        if (isset($_GET['edit'])) {
            $this->edit();
        } elseif (isset($_GET['delete'])) {
            $this->delete();
        } else {
            $this->add();
        }
        $list = DB::table('area_responsavel')->get();
        echo view('admin.department.index', ['departments' => $list]);

        echo '</div></div></div></div>';
    }
}
