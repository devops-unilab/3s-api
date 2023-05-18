<?php

/**
 * Classe feita para manipulação do objeto Servico
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */

namespace app3s\dao;

use PDO;
use PDOException;
use app3s\model\Servico;

class ServicoDAO extends DAO
{
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



    public function insert(Servico $servico)
    {
        $sql = "INSERT INTO servico(nome, descricao, id_tipo_atividade, tempo_sla, visao, id_area_responsavel, id_grupo_servico) VALUES (:nome, :descricao, :tipoAtividade, :tempoSla, :visao, :areaResponsavel, :grupoServico);";
        $nome = $servico->getNome();
        $descricao = $servico->getDescricao();
        $tipoAtividade = $servico->getTipoAtividade()->getId();
        $tempoSla = $servico->getTempoSla();
        $visao = $servico->getVisao();
        $areaResponsavel = $servico->getAreaResponsavel()->getId();
        $grupoServico = $servico->getGrupoServico()->getId();
        try {
            $db = $this->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->bindParam(":tipoAtividade", $tipoAtividade, PDO::PARAM_INT);
            $stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
            $stmt->bindParam(":visao", $visao, PDO::PARAM_INT);
            $stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
            $stmt->bindParam(":grupoServico", $grupoServico, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
  

    public function delete(Servico $servico)
    {
        $id = $servico->getId();
        $sql = "DELETE FROM servico WHERE id = :id";

        try {
            $db = $this->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }


    public function fetch()
    {
        $list = array();
        $sql = "SELECT servico.id, servico.nome, servico.descricao, servico.tempo_sla, servico.visao, tipo_atividade.id as id_tipo_atividade_tipo_atividade, tipo_atividade.nome as nome_tipo_atividade_tipo_atividade, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, grupo_servico.id as id_grupo_servico_grupo_servico, grupo_servico.nome as nome_grupo_servico_grupo_servico FROM servico INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                echo "<br>Mensagem de erro retornada: " . $this->connection->errorInfo()[2] . "<br>";
                return $list;
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $servico = new Servico();
                $servico->setId($row['id']);
                $servico->setNome($row['nome']);
                $servico->setDescricao($row['descricao']);
                $servico->setTempoSla($row['tempo_sla']);
                $servico->setVisao($row['visao']);
                $servico->getTipoAtividade()->setId($row['id_tipo_atividade_tipo_atividade']);
                $servico->getTipoAtividade()->setNome($row['nome_tipo_atividade_tipo_atividade']);
                $servico->getAreaResponsavel()->setId($row['id_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setNome($row['nome_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setDescricao($row['descricao_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setEmail($row['email_area_responsavel_area_responsavel']);
                $servico->getGrupoServico()->setId($row['id_grupo_servico_grupo_servico']);
                $servico->getGrupoServico()->setNome($row['nome_grupo_servico_grupo_servico']);
                $list[] = $servico;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $list;
    }


    public function fetchByVisao(Servico $servico)
    {
        $lista = array();
        $visao = $servico->getVisao();

        $sql = "SELECT servico.id, servico.nome, servico.descricao, servico.tempo_sla, servico.visao, tipo_atividade.id as id_tipo_atividade_tipo_atividade, tipo_atividade.nome as nome_tipo_atividade_tipo_atividade, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, grupo_servico.id as id_grupo_servico_grupo_servico, grupo_servico.nome as nome_grupo_servico_grupo_servico FROM servico INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
            WHERE servico.visao = :visao";

        try {

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":visao", $visao, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $servico = new Servico();
                $servico->setId($row['id']);
                $servico->setNome($row['nome']);
                $servico->setDescricao($row['descricao']);
                $servico->setTempoSla($row['tempo_sla']);
                $servico->setVisao($row['visao']);
                $servico->getTipoAtividade()->setId($row['id_tipo_atividade_tipo_atividade']);
                $servico->getTipoAtividade()->setNome($row['nome_tipo_atividade_tipo_atividade']);
                $servico->getAreaResponsavel()->setId($row['id_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setNome($row['nome_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setDescricao($row['descricao_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setEmail($row['email_area_responsavel_area_responsavel']);
                $servico->getGrupoServico()->setId($row['id_grupo_servico_grupo_servico']);
                $servico->getGrupoServico()->setNome($row['nome_grupo_servico_grupo_servico']);
                $lista[] = $servico;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }

    public function fillById(Servico $servico)
    {

        $id = $servico->getId();
        $sql = "SELECT servico.id, servico.nome, servico.descricao, servico.tempo_sla, servico.visao, tipo_atividade.id as id_tipo_atividade_tipo_atividade, tipo_atividade.nome as nome_tipo_atividade_tipo_atividade, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, grupo_servico.id as id_grupo_servico_grupo_servico, grupo_servico.nome as nome_grupo_servico_grupo_servico FROM servico INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
                WHERE servico.id = :id
                 LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                echo "<br>Mensagem de erro retornada: " . $this->connection->errorInfo()[2] . "<br>";
            }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $servico->setId($row['id']);
                $servico->setNome($row['nome']);
                $servico->setDescricao($row['descricao']);
                $servico->setTempoSla($row['tempo_sla']);
                $servico->setVisao($row['visao']);
                $servico->getTipoAtividade()->setId($row['id_tipo_atividade_tipo_atividade']);
                $servico->getTipoAtividade()->setNome($row['nome_tipo_atividade_tipo_atividade']);
                $servico->getAreaResponsavel()->setId($row['id_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setNome($row['nome_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setDescricao($row['descricao_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setEmail($row['email_area_responsavel_area_responsavel']);
                $servico->getGrupoServico()->setId($row['id_grupo_servico_grupo_servico']);
                $servico->getGrupoServico()->setNome($row['nome_grupo_servico_grupo_servico']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $servico;
    }
}
