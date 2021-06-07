<?php
                
/**
 * Customize sua classe
 *
 */


namespace novissimo3s\custom\dao;
use novissimo3s\dao\ServicoDAO;
use novissimo3s\model\Servico;
use PDO;
use PDOException;

class  ServicoCustomDAO extends ServicoDAO {
    
    
    
    public function update(Servico $servico)
    {
        $id = $servico->getId();
        
        
        $sql = "UPDATE servico
                SET
                nome = :nome,
                descricao = :descricao,
                id_tipo_atividade = :idAtividade,
                tempo_sla = :tempoSla,
                visao = :visao, 
                id_area_responsavel = :idArea, 
                id_grupo_servico = :idGrupo 
                WHERE servico.id = :id;";
        $nome = $servico->getNome();
        $descricao = $servico->getDescricao();
        $idTipo = $servico->getTipoAtividade()->getId();
        $tempoSla = $servico->getTempoSla();
        $visao = $servico->getVisao();
        $idArea = $servico->getAreaResponsavel()->getId();
        $grupo = $servico->getGrupoServico()->getId();
        
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->bindParam(":idAtividade", $idTipo, PDO::PARAM_INT);
            $stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
            $stmt->bindParam(":visao", $visao, PDO::PARAM_INT);
            $stmt->bindParam(":idArea", $idArea, PDO::PARAM_INT);
            $stmt->bindParam(":idGrupo", $grupo, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }
    


}