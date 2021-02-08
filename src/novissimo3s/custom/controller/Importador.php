<?php 




namespace novissimo3s\custom\controller;



use novissimo3s\model\Servico;
use novissimo3s\dao\ServicoDAO;
use novissimo3s\dao\TipoAtividadeDAO;
use novissimo3s\dao\AreaResponsavelDAO;
use novissimo3s\dao\GrupoServicoDAO;
use novissimo3s\custom\dao\ServicoCustomDAO;

class Importador{
    
    public function main(){
        $servicoDao = new ServicoCustomDAO();
        $tipoDao = new TipoAtividadeDAO($servicoDao->getConnection());
        $areaDao = new AreaResponsavelDAO($servicoDao->getConnection());
        $grupoDao = new GrupoServicoDAO($servicoDao->getConnection());
        
        $lista = $this->buscar();
        foreach($lista as $servico){
            $nomeServico = $servico->getNome();
            $nomeAtividade = $servico->getTipoAtividade()->getNome();
            $nomeGruposervico = $servico->getGrupoServico()->getNome();
            $descricao = $servico->getDescricao();
            $nomeArea = $servico->getAreaResponsavel()->getNome();
            if($servico->getId() != null){
                $servicoDao->fillById($servico);
                $servico->setNome($nomeServico);
            }else{
                $servicoDao->fillByNome($servico);
            }
            
            $servico->getTipoAtividade()->setNome(trim($nomeAtividade));
            $servico->setDescricao($descricao);
            
            $tipoDao->fillByNome($servico->getTipoAtividade());
            
            
            
            if($servico->getTipoAtividade()->getId() == null){
                $tipoDao->insert($servico->getTipoAtividade());
                $servico->getTipoAtividade()->setId($tipoDao->getConnection()->lastInsertId());
            }
            $servico->setVisao(1);
            
            
            
            $servico->getGrupoServico()->setNome(trim($nomeGruposervico));
            
            $grupoDao->fillByNome($servico->getGrupoServico());
            
            if($servico->getGrupoServico()->getId() == null){
                $grupoDao->insert($servico->getGrupoServico());
                $servico->getGrupoServico()->setId($grupoDao->getConnection()->lastInsertId());
            }
            
            
            
            $areaDao->fillByNome($servico->getAreaResponsavel());
            
            $servico->getAreaResponsavel()->setNome($nomeArea);
            
            if($servico->getAreaResponsavel()->getNome() == null){
                $servico->getAreaResponsavel()->setNome("DTI");
                $servico->getAreaResponsavel()->setId(1);
            }else{
                $areaDao->fillByNome($servico->getAreaResponsavel());
                
            }
            if($servico->getAreaResponsavel()->getId() == null){
                $areaDao->insert($servico->getAreaResponsavel());
                $servico->getAreaResponsavel()->setId($areaDao->getConnection()->lastInsertId());
            }
            
            if($servico->getId() == null){
                $servicoDao->insert($servico);
                $servico->setId($servicoDao->getConnection()->lastInsertId());
            }else{
                $servicoDao->update($servico);
            }
            
        }
        
        
        $this->showList($lista);

    }
    public function buscar(){
        
        
        $nomeArquivo = "catalogo.csv";
        // Exemplo de scrip para exibir os nomes obtidos no arquivo CSV de exemplo
        $lista = array();
        $delimitador = ',';
        $cerca = '"';
        
        // Abrir arquivo para leitura
        $f = fopen($nomeArquivo, 'r');
        if ($f) {
            
            // Ler cabecalho do arquivo
            $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
            
            // Enquanto nao terminar o arquivo
            while (!feof($f)) {
                
                // Ler uma linha do arquivo
                $linha = fgetcsv($f, 0, $delimitador, $cerca);
                if (!$linha) {
                    continue;
                }
                
                // Montar registro com valores indexados pelo cabecalho
                $registro = array_combine($cabecalho, $linha);
                
                // Obtendo o nome
                
                
                if(!isset($registro['ID'])){
                    $this->erro('<p>Erro na planilha, campo Nome não encontrado</p>');
                    break;
                }
                if(!isset($registro['Nome'])){
                    $this->erro('<p>Erro na planilha, campo Matrícula não encontrado</p>');
                    break;
                }
                if(!isset($registro['Descricao'])){
                    $this->erro('<p>Erro na planilha, campo CPF_Discente não encontrado</p>');
                    break;
                }
                
                if(!isset($registro['SLA'])){
                    $this->erro('<p>Erro na planilha, campo Campus_Curso não encontrado</p>');
                    break;
                }
                
                if(!isset($registro['Tipo_Atividade'])){
                    $this->erro('<p>Erro na planilha, campo Codigo_Curso não encontrado</p>');
                    break;
                }
                
                if(!isset($registro['Grupo_Servico'])){
                    $this->erro('<p>Erro na planilha, campo Nome_Curso não encontrado</p>');
                    break;
                }
                
                if(!isset($registro['Setor_Responsavel'])){
                    $this->erro('<p>Erro na planilha, campo Qtd_Disciplinas_20201 não encontrado</p>');
                    break;
                }
                
                if(!isset($registro['Nivel_Acesso'])){
                    $this->erro('<p>Erro na planilha, campo Cidade_Moradia não encontrado</p>');
                    break;
                }

                $servico = new Servico();
                $servico->setId($registro['ID']);
                $servico->setNome($registro['Nome']);
                $servico->setDescricao($registro['Descricao']);
                $servico->setTempoSla($registro['SLA']);
                $servico->getTipoAtividade()->setNome($registro['Tipo_Atividade']);
                $servico->getAreaResponsavel()->setNome($registro['Setor_Responsavel']);
                $servico->getGrupoServico()->setNome($registro['Grupo_Servico']);
                
                $lista[] = $servico;
            }
            fclose($f);
        }
        return $lista;
    }
    
    public function erro($mensagem){
        echo '
<div class="alert alert-danger" role="alert">
'.$mensagem.'<br>
A planilha deve ser salva em CSV(Formato UTF-8) e conter os seguintes campos: <br>
Nome	Matrícula	CPF_Discente	Campus_Curso	Codigo_Curso	Nome_Curso	Qtd_Disciplinas_20201	Cidade_Moradia	Estado_Moradia	CEP	Endereço	Renda_Per_Capita	Faixa_Renda	Codigo_Chip
</div>
';
    }
    /*
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
            
           
            
            
            
            
            $grupoServico = new GrupoServico();
            $grupoServico->setNome($linha[5]);
            
            $grupoDao = new GrupoServicoDAO($servicoDao->getConnection());
            $grupoDao->fillByNome($grupoServico);
            if($grupoServico->getId() == null){
                $grupoDao->insert($grupoServico);
                $grupoServico->setId($grupoDao->getConnection()->lastInsertId());
            }
            
            
            $servico->setGrupoServico($grupoServico);
            
            $areaResponsavel = new AreaResponsavel();
            $areaResponsavel->setNome($linha[6]);
            
            if($linha[6] == null || $linha[6] == ''){
                $areaResponsavel->setNome("DTI");
                $areaResponsavel->setId(1);
            }else{
                $areaDao = new AreaResponsavelDAO($servicoDao->getConnection());
                $areaDao->fillByNome($areaResponsavel);
            }
            
            
            $servico->setAreaResponsavel($areaResponsavel);
            $listaServicos[] = $servico;
        }

        foreach($listaServicos as $servico){
            if($servico->getId() == null){
                $servicoDao->insert($servico);
                $servico->setId($servicoDao->getConnection()->lastInsertId());
            }else{
                $servicoDao->update($servico);
            }
        }

        
        
        $this->showList($listaServicos);
     
        
        
    }
       */
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