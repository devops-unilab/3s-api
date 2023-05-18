<?php

/**
 * Classe feita para manipulação do objeto Status
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */

namespace app3s\dao;

use PDO;
use PDOException;
use app3s\model\Status;

class StatusDAO extends DAO
{


    public function fillBySigla(Status $status)
    {

        $sigla = $status->getSigla();
        $sql = "SELECT status.id, status.sigla, status.nome FROM status
                WHERE status.sigla = :sigla
                 LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                echo "<br>Mensagem de erro retornada: " . $this->connection->errorInfo()[2] . "<br>";
            }
            $stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $status->setId($row['id']);
                $status->setSigla($row['sigla']);
                $status->setNome($row['nome']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $status;
    }
}
