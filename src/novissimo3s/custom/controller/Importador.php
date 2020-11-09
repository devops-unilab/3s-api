<?php 




namespace novissimo3s\custom\controller;

use novissimo3s\model\Servico;
use novissimo3s\model\TipoAtividade;
use novissimo3s\model\AreaResponsavel;
use novissimo3s\view\ServicoView;
use novissimo3s\dao\ServicoDAO;
use novissimo3s\model\GrupoServico;

class Importador{
    
    public function importar(){
        $servicoDao = new ServicoDAO();
        $listaTipo = array();
        $listaServicos = array();
        if (($handle = fopen("catalogo.csv", "r")) == FALSE) {
            echo 'Falha ao tentar abrir a planilha de metas';
            return;
        }
        $i = 0; 
        while (! feof($handle)) {
            $line = fgets($handle);
            if($i == 0){
                $i++;
                continue;
            }
            
            
            if($line == null){
                continue;
            }
            $linha = explode("|", $line);
            $servico = new Servico();
            
            $servico->setId($linha[0]);
            $servico->setNome($linha[1]);
            if($servico->getId() != null){
                $servicoDao->fillById($servico);
            }else{
                $servicoDao->fillByNome($servico);
            }
            
            $servico->setNome($linha[1]);
            $servico->setDescricao($linha[2]);
            $servico->setTempoSla(intval($linha[3]));
            
            
            $tipoAtividade = new TipoAtividade();
            $tipoAtividade->setNome(strtolower($linha[4]));
            $listaTipo[$tipoAtividade->getNome()] = $tipoAtividade;
            $servico->setTipoAtividade($tipoAtividade);
            $servico->setVisao(1);
            
            $grupoServico = new GrupoServico();
            $grupoServico->setNome($linha[5]);
            $servico->setGrupoServico($grupoServico);
            
            $areaResponsavel = new AreaResponsavel();
            $areaResponsavel->setNome($linha[6]);
            if($linha[7] == null || $linha[7] == '?'){
                $areaResponsavel->setNome("DTI");
                $areaResponsavel->setId(1);
            }
            
            
            $servico->setAreaResponsavel($areaResponsavel);
            $listaServicos[] = $servico;
        }

        

        
        
        $this->showList($listaServicos);
        
        
    }
    public function showList($lista){
        echo '
            
            
            
            
          <div class="card mb-4">
                <div class="card-header">
                  Lista Servico
                </div>
                <div class="card-body">
            
            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>SLA</th>
						<th>Tipo de Atividade</th>
                        <th>Grupo de Serviços</th>
						<th>Setor Responsável</th>

					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>SLA</th>
						<th>Tipo de Atividade</th>
                        <th>Grupo de Serviços</th>
						<th>Setor Responsável</th>

                        
					</tr>
				</tfoot>
				<tbody>';
        
        foreach($lista as $element){

            echo '<tr>';
            echo '<td>'.$element->getId().'</td>';
            echo '<td>'.$element->getNome().'</td>';
            echo '<td>'.$element->getDescricao().'</td>';
            echo '<td>'.$element->getTempoSla().'</td>';
            echo '<td>'.$element->getTipoAtividade()->getNome().'</td>';
            echo '<td>'.$element->getGrupoServico()->getNome().'</td>';
            echo '<td>'.$element->getAreaResponsavel()->getNome().'</td>';
            echo '</tr>';
        }
        
        echo '
				</tbody>
			</table>
		</div>
            
            
            
            
  </div>
</div>
            
';
    }
    
}


?>