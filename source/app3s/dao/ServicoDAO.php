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
                tempo_sla = :tempoSla,
                visao = :visao,
                id_area_responsavel = :idArea,
                WHERE servico.id = :id;";
        $nome = $servico->getNome();
        $descricao = $servico->getDescricao();
        $tempoSla = $servico->getTempoSla();
        $visao = $servico->getVisao();
        $idArea = $servico->getAreaResponsavel()->getId();

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
            $stmt->bindParam(":visao", $visao, PDO::PARAM_INT);
            $stmt->bindParam(":idArea", $idArea, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function insert(Servico $servico)
    {
        $sql = "INSERT INTO servico(nome,
            descricao,
            tempo_sla,
            visao,
            id_area_responsavel)
            VALUES (:nome,
            :descricao,
            :tempoSla,
            :visao,
            :areaResponsavel,
            :grupoServico);";
        $nome = $servico->getNome();
        $descricao = $servico->getDescricao();
        $tempoSla = $servico->getTempoSla();
        $visao = $servico->getVisao();
        $areaResponsavel = $servico->getAreaResponsavel()->getId();
        try {
            $db = $this->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
            $stmt->bindParam(":visao", $visao, PDO::PARAM_INT);
            $stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
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



    public function fillById(Servico $servico)
    {

        $id = $servico->getId();
        $sql = "SELECT servico.id,
            servico.nome,
            servico.descricao,
            servico.tempo_sla,
            servico.visao,
            area_responsavel.id as id_area_responsavel_area_responsavel,
            area_responsavel.nome as nome_area_responsavel_area_responsavel,
            area_responsavel.descricao as descricao_area_responsavel_area_responsavel,
            area_responsavel.email as email_area_responsavel_area_responsavel,
         FROM servico
        INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
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
                $servico->getAreaResponsavel()->setId($row['id_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setNome($row['nome_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setDescricao($row['descricao_area_responsavel_area_responsavel']);
                $servico->getAreaResponsavel()->setEmail($row['email_area_responsavel_area_responsavel']);

            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $servico;
    }
}
