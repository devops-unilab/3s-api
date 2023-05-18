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
    public function fetch()
    {
        $list = array();
        $sql = "SELECT grupo_servico.id, grupo_servico.nome
                FROM grupo_servico LIMIT 1000";

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
}
