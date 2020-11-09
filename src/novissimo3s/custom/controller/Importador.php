<?php 




namespace novissimo3s\custom\controller;

use novissimo3s\model\Servico;
use novissimo3s\model\TipoAtividade;
use novissimo3s\model\AreaResponsavel;
use novissimo3s\view\ServicoView;

class Importador{
    
    public function importar(){
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
            $servico->setNome($linha[1]);
            $servico->setDescricao($linha[2]);
            $servico->setTempoSla(intval($linha[4]));
            
            
            $tipoAtividade = new TipoAtividade();
            $tipoAtividade->setNome(strtolower($linha[5]));
            $listaTipo[$tipoAtividade->getNome()] = $tipoAtividade;
            $servico->setTipoAtividade($tipoAtividade);
            $servico->setVisao(1);
            
            $areaResponsavel = new AreaResponsavel();
            $areaResponsavel->setNome($linha[7]);
            if($linha[7] == null || $linha[7] == '?'){
                $areaResponsavel->setNome("DTI");
                $areaResponsavel->setId(1);
            }
            
            
            $servico->setAreaResponsavel($areaResponsavel);
            $listaServicos[] = $servico;
        }

        $servicoview = new ServicoView();
        $servicoview->showList($listaServicos);
        
        
    }
    
}


?>