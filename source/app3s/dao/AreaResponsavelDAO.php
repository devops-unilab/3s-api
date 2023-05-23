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
}
