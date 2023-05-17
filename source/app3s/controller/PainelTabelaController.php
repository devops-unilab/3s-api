<?php


namespace app3s\controller;

use app3s\model\AreaResponsavel;
use app3s\dao\AreaResponsavelDAO;
use app3s\dao\OcorrenciaDAO;

class PainelTabelaController
{
    private $dao;
    public function __construct()
    {
        $this->dao = new OcorrenciaDAO();
    }

    public function main()
    {
        echo '
            
<div class="card mb-4">
        <div class="card-header pb-4 mb-4 font-italic">
                    Painel Kamban';

        $this->formFiltro();

        echo '
                <button id="btn-expandir-tela" type="button" class="float-right btn ml-3 btn-warning btn-circle btn-lg collapsed"><i class="fa fa-expand icone-maior"></i></button>
            </div>
            <div class="card-body" id="quadro-tabela">';
        $this->tabelaChamados();
        echo '
	</div>
</div>
            
            
            
            
';
    }

    public function formFiltro()
    {
        $areaDao = new AreaResponsavelDAO($this->dao->getConnection());
        $lista = $areaDao->fetch();

        echo '
                <select name="setor" id="select-setores">
                    <option value="">Filtrar por Setor</option>';
        foreach ($lista as $areaResponsavel) {
            echo '<option value="' . $areaResponsavel->getNome() . '">' . $areaResponsavel->getNome() . '</option>';
        }
        echo '
                </select>';
    }
    public function tabelaChamados()
    {
        $filtro = "";
        if (!isset($_GET['setores'])) {
            echo '<h3>Para ver o painel selecione os setores</h3>';
            return;
        }
        $arrStrSetores = explode(",", $_GET['setores']);
        $filtroSetor = " area_responsavel.nome like ";
        $i = 1;
        $n = count($arrStrSetores);
        foreach ($arrStrSetores as $setor) {
            $filtroSetor .= "'$setor'";
            if ($i != $n) {
                $filtroSetor .= " OR area_responsavel.nome like ";
            }
            $i++;
        }
        $filtro = " WHERE " . $filtroSetor;


        $result = $this->dao->getConnection()->query("SELECT id, nome FROM area_responsavel $filtro");
        $setores = array();
        foreach ($result as $linha) {
            $setor = new AreaResponsavel();
            $setor->setNome($linha['nome']);
            $setor->setId($linha['id']);
            $setores[] = $setor;
        }

        $result = $this->dao->getConnection()->query("SELECT campus from ocorrencia GROUP BY campus");
        $matriz = array();
        foreach ($result as $linha) {
            foreach ($setores as $setor) {
                $matriz[$linha['campus']][$setor->getNome()] = 0;
            }
        }

        $filtroSetor = " AND (" . $filtroSetor . ")";
        $sql = "SELECT
            ocorrencia.campus as campus,
            area_responsavel.nome as setor
            FROM
            ocorrencia
            INNER JOIN status ON status.sigla = ocorrencia.status
            INNER JOIN area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
            WHERE (status.id = 2 OR status.id = 7) $filtroSetor
        ";

        $result = $this->dao->getConnection()->query($sql);



        foreach ($result as $linha) {
            if (isset($matriz[$linha['campus']][$linha['setor']])) {
                $matriz[$linha['campus']][$linha['setor']]++;
            } else {
                $matriz[$linha['campus']][$linha['setor']] = 1;
            }
        }





        echo '<br><br>
            
          <table id="tabela-quadro" class="table  text-center table-bordered">
              <thead class="thead-dark">
                <tr>';
        echo '<th scope="col">Setor</th>';
        foreach ($matriz as $chave => $valor) {
            echo '<th scope="col">' . ucfirst($chave) . '</th>';
        }
        echo '
                </tr>
              </thead>
              <tbody>';
        foreach ($setores as $setor) {
            echo '
                <tr>
                  <th scope="row">' . $setor->getNome() . '</th>';
            foreach ($matriz as $chave => $valor) {
                echo '
                  <td>' . $valor[$setor->getNome()] . '</td>';
            }

            echo '
                </tr>';
        }

        echo '
              </tbody>
            </table>';
    }
}
