<?php

/**
 * Classe feita para manipulação do objeto TipoAtividade
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */

namespace app3s\dao;

use PDO;
use PDOException;
use app3s\model\TipoAtividade;

class TipoAtividadeDAO extends DAO
{
    public function update(TipoAtividade $tipoAtividade)
    {
        $id = $tipoAtividade->getId();


        $sql = "UPDATE tipo_atividade
                SET
                nome = :nome
                WHERE tipo_atividade.id = :id;";
        $nome = $tipoAtividade->getNome();

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function insert(TipoAtividade $tipoAtividade)
    {
        $sql = "INSERT INTO tipo_atividade(nome) VALUES (:nome);";
        $nome = $tipoAtividade->getNome();
        try {
            $db = $this->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function insertWithPK(TipoAtividade $tipoAtividade)
    {
        $sql = "INSERT INTO tipo_atividade(id, nome) VALUES (:id, :nome);";
        $id = $tipoAtividade->getId();
        $nome = $tipoAtividade->getNome();
        try {
            $db = $this->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }

    public function delete(TipoAtividade $tipoAtividade)
    {
        $id = $tipoAtividade->getId();
        $sql = "DELETE FROM tipo_atividade WHERE id = :id";

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
        $sql = "SELECT tipo_atividade.id, tipo_atividade.nome FROM tipo_atividade LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                echo "<br>Mensagem de erro retornada: " . $this->connection->errorInfo()[2] . "<br>";
                return $list;
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $tipoAtividade = new TipoAtividade();
                $tipoAtividade->setId($row['id']);
                $tipoAtividade->setNome($row['nome']);
                $list[] = $tipoAtividade;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $list;
    }


    public function fetchById(TipoAtividade $tipoAtividade)
    {
        $lista = array();
        $id = $tipoAtividade->getId();

        $sql = "SELECT tipo_atividade.id, tipo_atividade.nome FROM tipo_atividade
            WHERE tipo_atividade.id = :id";

        try {

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $tipoAtividade = new TipoAtividade();
                $tipoAtividade->setId($row['id']);
                $tipoAtividade->setNome($row['nome']);
                $lista[] = $tipoAtividade;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }

    public function fetchByNome(TipoAtividade $tipoAtividade)
    {
        $lista = array();
        $nome = $tipoAtividade->getNome();

        $sql = "SELECT tipo_atividade.id, tipo_atividade.nome FROM tipo_atividade
            WHERE tipo_atividade.nome like :nome";

        try {

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $tipoAtividade = new TipoAtividade();
                $tipoAtividade->setId($row['id']);
                $tipoAtividade->setNome($row['nome']);
                $lista[] = $tipoAtividade;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }

    public function fillById(TipoAtividade $tipoAtividade)
    {

        $id = $tipoAtividade->getId();
        $sql = "SELECT tipo_atividade.id, tipo_atividade.nome FROM tipo_atividade
                WHERE tipo_atividade.id = :id
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
                $tipoAtividade->setId($row['id']);
                $tipoAtividade->setNome($row['nome']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $tipoAtividade;
    }

    public function fillByNome(TipoAtividade $tipoAtividade)
    {

        $nome = $tipoAtividade->getNome();
        $sql = "SELECT tipo_atividade.id, tipo_atividade.nome FROM tipo_atividade
                WHERE tipo_atividade.nome = :nome
                 LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                echo "<br>Mensagem de erro retornada: " . $this->connection->errorInfo()[2] . "<br>";
            }
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $tipoAtividade->setId($row['id']);
                $tipoAtividade->setNome($row['nome']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $tipoAtividade;
    }
}
