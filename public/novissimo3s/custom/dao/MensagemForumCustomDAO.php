<?php
                
/**
 * Customize sua classe
 *
 */


namespace novissimo3s\custom\dao;
use novissimo3s\dao\MensagemForumDAO;
use PDO;
use PDOException;
use novissimo3s\model\Ocorrencia;
use novissimo3s\model\MensagemForum;

class  MensagemForumCustomDAO extends MensagemForumDAO {
    
    public function retornaListaPorOcorrencia(Ocorrencia $ocorrencia) {
        $id = intval($ocorrencia->getId());
        $lista = array ();
        $sql = "
		SELECT
        mensagem_forum.id,
        mensagem_forum.tipo,
        mensagem_forum.mensagem,
        mensagem_forum.data_envio,
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
        usuario.id as id_usuario_usuario,
        usuario.nome as nome_usuario_usuario,
        usuario.email as email_usuario_usuario,
        usuario.login as login_usuario_usuario,
        usuario.senha as senha_usuario_usuario,
        usuario.nivel as nivel_usuario_usuario,
        usuario.id_setor as id_setor_usuario_usuario
		FROM mensagem_forum
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia
		LEFT JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
        WHERE ocorrencia.id = $id
        ORDER BY mensagem_forum.id DESC
         LIMIT 1000";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            
            if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
                return $lista;
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha )
            {
                $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setDataEnvio( $linha ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $linha ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $linha ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $linha ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $linha ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $linha ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $linha ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $linha ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $linha ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $linha ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $linha ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $linha ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $linha ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $linha ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $linha ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $linha ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $linha ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $linha ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $linha ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $linha ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $linha ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $linha ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;
                
                
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }
    


}