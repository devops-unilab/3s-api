<?php

/**
 * Classe feita para manipulação do objeto AreaResponsavel
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */

namespace app3s\dao;

use PDO;
use PDOException;
use app3s\model\AreaResponsavel;

class AreaResponsavelDAO extends DAO
{

    public function insert(AreaResponsavel $areaResponsavel)
    {
        $sql = "INSERT INTO area_responsavel(nome, descricao, email)
        VALUES (:nome, :descricao, :email);";
        $nome = $areaResponsavel->getNome();
        $descricao = $areaResponsavel->getDescricao();
        $email = $areaResponsavel->getEmail();
        try {
            $db = $this->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }


    public function fetch()
    {
        $list = array();
        $sql = "SELECT area_responsavel.id,
                area_responsavel.nome,
                area_responsavel.descricao,
                area_responsavel.email FROM area_responsavel LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                echo "<br>Mensagem de erro retornada: " . $this->connection->errorInfo()[2] . "<br>";
                return $list;
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $areaResponsavel = new AreaResponsavel();
                $areaResponsavel->setId($row['id']);
                $areaResponsavel->setNome($row['nome']);
                $areaResponsavel->setDescricao($row['descricao']);
                $areaResponsavel->setEmail($row['email']);
                $list[] = $areaResponsavel;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $list;
    }

    public function fillById(AreaResponsavel $areaResponsavel)
    {

        $id = $areaResponsavel->getId();
        $sql = "SELECT area_responsavel.id,
                    area_responsavel.nome,
                    area_responsavel.descricao,
                    area_responsavel.email FROM area_responsavel
                WHERE area_responsavel.id = :id
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
                $areaResponsavel->setId($row['id']);
                $areaResponsavel->setNome($row['nome']);
                $areaResponsavel->setDescricao($row['descricao']);
                $areaResponsavel->setEmail($row['email']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $areaResponsavel;
    }
}
