<?php

/**
 * Classe feita para manipulação do objeto GrupoServico
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */

namespace app3s\dao;

use PDO;
use PDOException;
use app3s\model\GrupoServico;

class GrupoServicoDAO extends DAO
{





    public function update(GrupoServico $grupoServico)
    {
        $id = $grupoServico->getId();


        $sql = "UPDATE grupo_servico
                SET
                nome = :nome
                WHERE grupo_servico.id = :id;";
        $nome = $grupoServico->getNome();

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function insert(GrupoServico $grupoServico)
    {
        $sql = "INSERT INTO grupo_servico(nome) VALUES (:nome);";
        $nome = $grupoServico->getNome();
        try {
            $db = $this->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function insertWithPK(GrupoServico $grupoServico)
    {
        $sql = "INSERT INTO grupo_servico(id, nome) VALUES (:id, :nome);";
        $id = $grupoServico->getId();
        $nome = $grupoServico->getNome();
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

    public function delete(GrupoServico $grupoServico)
    {
        $id = $grupoServico->getId();
        $sql = "DELETE FROM grupo_servico WHERE id = :id";

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
        $sql = "SELECT grupo_servico.id, grupo_servico.nome FROM grupo_servico LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                echo "<br>Mensagem de erro retornada: " . $this->connection->errorInfo()[2] . "<br>";
                return $list;
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $grupoServico = new GrupoServico();
                $grupoServico->setId($row['id']);
                $grupoServico->setNome($row['nome']);
                $list[] = $grupoServico;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $list;
    }


    public function fetchById(GrupoServico $grupoServico)
    {
        $lista = array();
        $id = $grupoServico->getId();

        $sql = "SELECT grupo_servico.id, grupo_servico.nome FROM grupo_servico
            WHERE grupo_servico.id = :id";

        try {

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $grupoServico = new GrupoServico();
                $grupoServico->setId($row['id']);
                $grupoServico->setNome($row['nome']);
                $lista[] = $grupoServico;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }

    public function fetchByNome(GrupoServico $grupoServico)
    {
        $lista = array();
        $nome = $grupoServico->getNome();

        $sql = "SELECT grupo_servico.id, grupo_servico.nome FROM grupo_servico
            WHERE grupo_servico.nome like :nome";

        try {

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $grupoServico = new GrupoServico();
                $grupoServico->setId($row['id']);
                $grupoServico->setNome($row['nome']);
                $lista[] = $grupoServico;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }

    public function fillById(GrupoServico $grupoServico)
    {

        $id = $grupoServico->getId();
        $sql = "SELECT grupo_servico.id, grupo_servico.nome FROM grupo_servico
                WHERE grupo_servico.id = :id
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
                $grupoServico->setId($row['id']);
                $grupoServico->setNome($row['nome']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $grupoServico;
    }

    public function fillByNome(GrupoServico $grupoServico)
    {

        $nome = $grupoServico->getNome();
        $sql = "SELECT grupo_servico.id, grupo_servico.nome FROM grupo_servico
                WHERE grupo_servico.nome = :nome
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
                $grupoServico->setId($row['id']);
                $grupoServico->setNome($row['nome']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $grupoServico;
    }
}
