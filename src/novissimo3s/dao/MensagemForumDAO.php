<?php
            
/**
 * Classe feita para manipulação do objeto MensagemForum
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace novissimo3s\dao;
use PDO;
use PDOException;
use novissimo3s\model\MensagemForum;


class MensagemForumDAO extends DAO {
    
    

            
            
    public function update(MensagemForum $mensagemForum)
    {
        $id = $mensagemForum->getId();
            
            
        $sql = "UPDATE mensagem_forum
                SET
                tipo = :tipo,
                mensagem = :mensagem,
                data_envio = :dataEnvio
                WHERE mensagem_forum.id = :id;";
			$tipo = $mensagemForum->getTipo();
			$mensagem = $mensagemForum->getMensagem();
			$dataEnvio = $mensagemForum->getDataEnvio();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(MensagemForum $mensagemForum){
        $sql = "INSERT INTO mensagem_forum(id_ocorrencia, tipo, mensagem, id_usuario, data_envio) VALUES (:ocorrencia, :tipo, :mensagem, :usuario, :dataEnvio);";
		$ocorrencia = $mensagemForum->getOcorrencia()->getId();
		$tipo = $mensagemForum->getTipo();
		$mensagem = $mensagemForum->getMensagem();
		$usuario = $mensagemForum->getUsuario()->getId();
		$dataEnvio = $mensagemForum->getDataEnvio();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":ocorrencia", $ocorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
			$stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(MensagemForum $mensagemForum){
        $sql = "INSERT INTO mensagem_forum(id, id_ocorrencia_ocorrencia, tipo, mensagem, id_usuario_usuario, data_envio) VALUES (:id, :ocorrencia, :tipo, :mensagem, :usuario, :dataEnvio);";
		$id = $mensagemForum->getId();
		$ocorrencia = $mensagemForum->getOcorrencia()->getId();
		$tipo = $mensagemForum->getTipo();
		$mensagem = $mensagemForum->getMensagem();
		$usuario = $mensagemForum->getUsuario()->getId();
		$dataEnvio = $mensagemForum->getDataEnvio();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":ocorrencia", $ocorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
			$stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function delete(MensagemForum $mensagemForum){
		$id = $mensagemForum->getId();
		$sql = "DELETE FROM mensagem_forum WHERE id = :id";
		    
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			return $stmt->execute();
			    
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}


	public function fetch() {
		$list = array ();
		$sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);
            
		    if(!$stmt){   
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		        return $list;
		    }
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row) 
            {
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $list [] = $mensagemForum;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(MensagemForum $mensagemForum) {
        $lista = array();
	    $id = $mensagemForum->getId();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByTipo(MensagemForum $mensagemForum) {
        $lista = array();
	    $tipo = $mensagemForum->getTipo();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.tipo = :tipo";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByMensagem(MensagemForum $mensagemForum) {
        $lista = array();
	    $mensagem = $mensagemForum->getMensagem();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.mensagem like :mensagem";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByDataEnvio(MensagemForum $mensagemForum) {
        $lista = array();
	    $dataEnvio = $mensagemForum->getDataEnvio();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.data_envio like :dataEnvio";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(MensagemForum $mensagemForum) {
        
	    $id = $mensagemForum->getId();
	    $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                WHERE mensagem_forum.id = :id
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function fillByTipo(MensagemForum $mensagemForum) {
        
	    $tipo = $mensagemForum->getTipo();
	    $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                WHERE mensagem_forum.tipo = :tipo
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function fillByMensagem(MensagemForum $mensagemForum) {
        
	    $mensagem = $mensagemForum->getMensagem();
	    $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                WHERE mensagem_forum.mensagem = :mensagem
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function fillByDataEnvio(MensagemForum $mensagemForum) {
        
	    $dataEnvio = $mensagemForum->getDataEnvio();
	    $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = mensagem_forum.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                WHERE mensagem_forum.data_envio = :dataEnvio
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $mensagemForum->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
}