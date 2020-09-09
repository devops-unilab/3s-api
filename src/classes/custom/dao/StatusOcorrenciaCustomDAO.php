<?php
                
/**
 * Customize sua classe
 *
 */



class  StatusOcorrenciaCustomDAO extends StatusOcorrenciaDAO {
    public function pesquisaPorIdOcorrencia(Ocorrencia $ocorrencia) {
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
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
                $statusOcorrencia = new StatusOcorrencia();
                $statusOcorrencia->setId( $linha ['id'] );
                $statusOcorrencia->setMensagem( $linha ['mensagem'] );
                $statusOcorrencia->setDataMudanca( $linha ['data_mudanca'] );
                $statusOcorrencia->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setDescricao( $linha ['descricao_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setCampus( $linha ['campus_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setPatrimonio( $linha ['patrimonio_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setRamal( $linha ['ramal_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setLocal( $linha ['local_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setStatus( $linha ['status_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setSolucao( $linha ['solucao_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setPrioridade( $linha ['prioridade_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setAvaliacao( $linha ['avaliacao_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setEmail( $linha ['email_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdUsuarioAtendente( $linha ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdUsuarioIndicado( $linha ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setAnexo( $linha ['anexo_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setLocalSala( $linha ['local_sala_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
                $statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
                $statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
                $statusOcorrencia->getUsuario()->setId( $linha ['id_usuario_usuario'] );
                $statusOcorrencia->getUsuario()->setNome( $linha ['nome_usuario_usuario'] );
                $statusOcorrencia->getUsuario()->setEmail( $linha ['email_usuario_usuario'] );
                $statusOcorrencia->getUsuario()->setLogin( $linha ['login_usuario_usuario'] );
                $statusOcorrencia->getUsuario()->setSenha( $linha ['senha_usuario_usuario'] );
                $statusOcorrencia->getUsuario()->setNivel( $linha ['nivel_usuario_usuario'] );
                $statusOcorrencia->getUsuario()->setIdSetor( $linha ['id_setor_usuario_usuario'] );
                $lista [] = $statusOcorrencia;
                
                
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            
        }
        return $lista;
    }
    


}