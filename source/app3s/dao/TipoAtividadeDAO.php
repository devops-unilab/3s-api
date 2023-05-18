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


}
