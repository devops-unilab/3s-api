<?php

/**
 * Classe feita para manipulação do objeto StatusOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */

namespace app3s\dao;

use app3s\model\Ocorrencia;
use PDO;
use PDOException;
use app3s\model\StatusOcorrencia;

class StatusOcorrenciaDAO extends DAO
{





    public function pesquisaPorIdOcorrencia(Ocorrencia $ocorrencia)
    {
        $lista = array();
        $id = $ocorrencia->getId();

        $sql = "
		SELECT
        status_ocorrencia.id,
        status_ocorrencia.mensagem,
        status_ocorrencia.data_mudanca,
        ocorrencia.id as id_ocorrencia_ocorrencia,
        ocorrencia.id_local as id_local_ocorrencia_ocorrencia,
        ocorrencia.descricao as descricao_ocorrencia_ocorrencia,
        ocorrencia.campus as campus_ocorrencia_ocorrencia,
        ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia,
        ocorrencia.ramal as ramal_ocorrencia_ocorrencia,
        ocorrencia.local as local_ocorrencia_ocorrencia,
        ocorrencia.status as status_ocorrencia_ocorrencia,
        ocorrencia.solucao as solucao_ocorrencia_ocorrencia,
        ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia,
        ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia,
        ocorrencia.email as email_ocorrencia_ocorrencia,
        ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia,
        ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia,
        ocorrencia.anexo as anexo_ocorrencia_ocorrencia,
        ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia,
        status.id as id_status_status,
        status.sigla as sigla_status_status,
        status.nome as nome_status_status,
        usuario.id as id_usuario_usuario,
        usuario.nome as nome_usuario_usuario,
        usuario.email as email_usuario_usuario,
        usuario.login as login_usuario_usuario,
        usuario.senha as senha_usuario_usuario,
        usuario.nivel as nivel_usuario_usuario,
        usuario.id_setor as id_setor_usuario_usuario
		FROM status_ocorrencia
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
		LEFT JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
            WHERE ocorrencia.id = :id
        ORDER BY status_ocorrencia.id ASC

";

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $linha) {
                $statusOcorrencia = new StatusOcorrencia();
                $statusOcorrencia->setId($linha['id']);
                $statusOcorrencia->setMensagem($linha['mensagem']);
                $statusOcorrencia->setDataMudanca($linha['data_mudanca']);
                $statusOcorrencia->getOcorrencia()->setId($linha['id_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setIdLocal($linha['id_local_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setDescricao($linha['descricao_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setCampus($linha['campus_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setPatrimonio($linha['patrimonio_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setRamal($linha['ramal_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setLocal($linha['local_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setStatus($linha['status_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setSolucao($linha['solucao_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setPrioridade($linha['prioridade_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setAvaliacao($linha['avaliacao_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setEmail($linha['email_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setIdUsuarioAtendente($linha['id_usuario_atendente_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setIdUsuarioIndicado($linha['id_usuario_indicado_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setAnexo($linha['anexo_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setLocalSala($linha['local_sala_ocorrencia_ocorrencia']);
                $statusOcorrencia->getStatus()->setId($linha['id_status_status']);
                $statusOcorrencia->getStatus()->setSigla($linha['sigla_status_status']);
                $statusOcorrencia->getStatus()->setNome($linha['nome_status_status']);
                $statusOcorrencia->getUsuario()->setId($linha['id_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setNome($linha['nome_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setEmail($linha['email_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setLogin($linha['login_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setSenha($linha['senha_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setNivel($linha['nivel_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setIdSetor($linha['id_setor_usuario_usuario']);
                $lista[] = $statusOcorrencia;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }

    public function insert(StatusOcorrencia $statusOcorrencia)
    {
        $sql = "INSERT INTO status_ocorrencia(id_ocorrencia, id_status, mensagem, id_usuario, data_mudanca) VALUES (:ocorrencia, :status, :mensagem, :usuario, :dataMudanca);";
        $ocorrencia = $statusOcorrencia->getOcorrencia()->getId();
        $status = $statusOcorrencia->getStatus()->getId();
        $mensagem = $statusOcorrencia->getMensagem();
        $usuario = $statusOcorrencia->getUsuario()->getId();
        $dataMudanca = $statusOcorrencia->getDataMudanca();
        try {
            $db = $this->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":ocorrencia", $ocorrencia, PDO::PARAM_INT);
            $stmt->bindParam(":status", $status, PDO::PARAM_INT);
            $stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
            $stmt->bindParam(":dataMudanca", $dataMudanca, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }

    public function fillById(StatusOcorrencia $statusOcorrencia)
    {

        $id = $statusOcorrencia->getId();
        $sql = "SELECT status_ocorrencia.id, status_ocorrencia.mensagem, status_ocorrencia.data_mudanca, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, ocorrencia.data_abertura as data_abertura_ocorrencia_ocorrencia, ocorrencia.data_atendimento as data_atendimento_ocorrencia_ocorrencia, ocorrencia.data_fechamento as data_fechamento_ocorrencia_ocorrencia, ocorrencia.data_fechamento_confirmado as data_fechamento_confirmado_ocorrencia_ocorrencia, status.id as id_status_status, status.sigla as sigla_status_status, status.nome as nome_status_status, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM status_ocorrencia INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia INNER JOIN status as status ON status.id = status_ocorrencia.id_status INNER JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
                WHERE status_ocorrencia.id = :id
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
                $statusOcorrencia->setId($row['id']);
                $statusOcorrencia->setMensagem($row['mensagem']);
                $statusOcorrencia->setDataMudanca($row['data_mudanca']);
                $statusOcorrencia->getOcorrencia()->setId($row['id_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setIdLocal($row['id_local_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setDescricao($row['descricao_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setCampus($row['campus_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setPatrimonio($row['patrimonio_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setRamal($row['ramal_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setLocal($row['local_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setStatus($row['status_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setSolucao($row['solucao_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setPrioridade($row['prioridade_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setAvaliacao($row['avaliacao_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setEmail($row['email_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setIdUsuarioAtendente($row['id_usuario_atendente_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setIdUsuarioIndicado($row['id_usuario_indicado_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setAnexo($row['anexo_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setLocalSala($row['local_sala_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setDataAbertura($row['data_abertura_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setDataAtendimento($row['data_atendimento_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setDataFechamento($row['data_fechamento_ocorrencia_ocorrencia']);
                $statusOcorrencia->getOcorrencia()->setDataFechamentoConfirmado($row['data_fechamento_confirmado_ocorrencia_ocorrencia']);
                $statusOcorrencia->getStatus()->setId($row['id_status_status']);
                $statusOcorrencia->getStatus()->setSigla($row['sigla_status_status']);
                $statusOcorrencia->getStatus()->setNome($row['nome_status_status']);
                $statusOcorrencia->getUsuario()->setId($row['id_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setNome($row['nome_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setEmail($row['email_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setLogin($row['login_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setSenha($row['senha_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setNivel($row['nivel_usuario_usuario']);
                $statusOcorrencia->getUsuario()->setIdSetor($row['id_setor_usuario_usuario']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $statusOcorrencia;
    }
}
