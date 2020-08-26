<?php
                
/**
 * Classe feita para manipulação do objeto StatusOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class StatusOcorrenciaDAO extends DAO {
    


            
            
    public function atualizar(StatusOcorrencia $statusOcorrencia)
    {
        $id = $statusOcorrencia->getId();
            
            
        $sql = "UPDATE status_ocorrencia
                SET
                mensagem = :mensagem,
                data_mudanca = :dataMudanca
                WHERE status_ocorrencia.id = :id;";
			$mensagem = $statusOcorrencia->getMensagem();
			$dataMudanca = $statusOcorrencia->getDataMudanca();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":dataMudanca", $dataMudanca, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(StatusOcorrencia $statusOcorrencia){
        $sql = "INSERT INTO status_ocorrencia(id_ocorrencia, id_status, mensagem, id_usuario, data_mudanca) VALUES (:ocorrencia, :status, :mensagem, :usuario, :dataMudanca);";
		$ocorrencia = $statusOcorrencia->getOcorrencia()->getId();
		$status = $statusOcorrencia->getStatus()->getId();
		$mensagem = $statusOcorrencia->getMensagem();
		$usuario = $statusOcorrencia->getUsuario()->getId();
		$dataMudanca = $statusOcorrencia->getDataMudanca();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":ocorrencia", $ocorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
			$stmt->bindParam(":dataMudanca", $dataMudanca, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(StatusOcorrencia $statusOcorrencia){
        $sql = "INSERT INTO status_ocorrencia(id, id_ocorrencia_ocorrencia, id_status_status, mensagem, id_usuario_usuario, data_mudanca) VALUES (:id, :ocorrencia, :status, :mensagem, :usuario, :dataMudanca);";
		$id = $statusOcorrencia->getId();
		$ocorrencia = $statusOcorrencia->getOcorrencia()->getId();
		$status = $statusOcorrencia->getStatus()->getId();
		$mensagem = $statusOcorrencia->getMensagem();
		$usuario = $statusOcorrencia->getUsuario()->getId();
		$dataMudanca = $statusOcorrencia->getDataMudanca();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":ocorrencia", $ocorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
			$stmt->bindParam(":dataMudanca", $dataMudanca, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(StatusOcorrencia $statusOcorrencia){
		$id = $statusOcorrencia->getId();
		$sql = "DELETE FROM status_ocorrencia WHERE id = :id";
		    
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			return $stmt->execute();
			    
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}


	public function retornaLista() {
		$lista = array ();
		$sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.data_mudanca, 
        ocorrencia.id as id_ocorrencia_ocorrencia, 
        ocorrencia.id_local as id_local_ocorrencia_ocorrencia, 
        ocorrencia.id_usuario_cliente as id_usuario_cliente_ocorrencia_ocorrencia, 
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
        usuario.nivel as nivel_usuario_usuario
		FROM status_ocorrencia
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
		INNER JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
                 LIMIT 1000";

        try {
            $stmt = $this->conexao->prepare($sql);
            
		    if(!$stmt){   
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		        return $lista;
		    }
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha ) 
            {
		        $statusOcorrencia = new StatusOcorrencia();
                $statusOcorrencia->setId( $linha ['id'] );
                $statusOcorrencia->setMensagem( $linha ['mensagem'] );
                $statusOcorrencia->setDataMudanca( $linha ['data_mudanca'] );
                $statusOcorrencia->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdUsuarioCliente( $linha ['id_usuario_cliente_ocorrencia_ocorrencia'] );
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
                $lista [] = $statusOcorrencia;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(StatusOcorrencia $statusOcorrencia) {
        $lista = array();
	    $id = $statusOcorrencia->getId();
                
        $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.data_mudanca, 
        ocorrencia.id as id_ocorrencia_ocorrencia, 
        ocorrencia.id_local as id_local_ocorrencia_ocorrencia, 
        ocorrencia.id_usuario_cliente as id_usuario_cliente_ocorrencia_ocorrencia, 
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
        usuario.nivel as nivel_usuario_usuario
		FROM status_ocorrencia
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
		INNER JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
            WHERE status_ocorrencia.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $statusOcorrencia = new StatusOcorrencia();
    	        $statusOcorrencia->setId( $linha ['id'] );
    	        $statusOcorrencia->setMensagem( $linha ['mensagem'] );
    	        $statusOcorrencia->setDataMudanca( $linha ['data_mudanca'] );
    			$statusOcorrencia->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setAreaResponsavel( $linha ['area_responsavel_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setServico( $linha ['servico_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setIdUsuarioCliente( $linha ['id_usuario_cliente_ocorrencia_ocorrencia'] );
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
    			$statusOcorrencia->getUsuario()->setSetor( $linha ['setor_usuario_usuario'] );
    			$lista [] = $statusOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorMensagem(StatusOcorrencia $statusOcorrencia) {
        $lista = array();
	    $mensagem = $statusOcorrencia->getMensagem();
                
        $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.data_mudanca, 
        ocorrencia.id as id_ocorrencia_ocorrencia, 
        ocorrencia.id_local as id_local_ocorrencia_ocorrencia, 
        ocorrencia.id_usuario_cliente as id_usuario_cliente_ocorrencia_ocorrencia, 
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
        usuario.nivel as nivel_usuario_usuario
		FROM status_ocorrencia
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
		INNER JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
            WHERE status_ocorrencia.mensagem like :mensagem";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $statusOcorrencia = new StatusOcorrencia();
    	        $statusOcorrencia->setId( $linha ['id'] );
    	        $statusOcorrencia->setMensagem( $linha ['mensagem'] );
    	        $statusOcorrencia->setDataMudanca( $linha ['data_mudanca'] );
    			$statusOcorrencia->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setAreaResponsavel( $linha ['area_responsavel_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setServico( $linha ['servico_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setIdUsuarioCliente( $linha ['id_usuario_cliente_ocorrencia_ocorrencia'] );
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
    			$statusOcorrencia->getUsuario()->setSetor( $linha ['setor_usuario_usuario'] );
    			$lista [] = $statusOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDataMudanca(StatusOcorrencia $statusOcorrencia) {
        $lista = array();
	    $dataMudanca = $statusOcorrencia->getDataMudanca();
                
        $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.data_mudanca, 
        ocorrencia.id as id_ocorrencia_ocorrencia, 
        ocorrencia.id_local as id_local_ocorrencia_ocorrencia, 
        ocorrencia.id_usuario_cliente as id_usuario_cliente_ocorrencia_ocorrencia, 
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
        usuario.nivel as nivel_usuario_usuario
		FROM status_ocorrencia
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
		INNER JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
            WHERE status_ocorrencia.data_mudanca like :dataMudanca";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dataMudanca", $dataMudanca, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $statusOcorrencia = new StatusOcorrencia();
    	        $statusOcorrencia->setId( $linha ['id'] );
    	        $statusOcorrencia->setMensagem( $linha ['mensagem'] );
    	        $statusOcorrencia->setDataMudanca( $linha ['data_mudanca'] );
    			$statusOcorrencia->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setAreaResponsavel( $linha ['area_responsavel_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setServico( $linha ['servico_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
    			$statusOcorrencia->getOcorrencia()->setIdUsuarioCliente( $linha ['id_usuario_cliente_ocorrencia_ocorrencia'] );
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
    			$statusOcorrencia->getUsuario()->setSetor( $linha ['setor_usuario_usuario'] );
    			$lista [] = $statusOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(StatusOcorrencia $statusOcorrencia) {
        
	    $id = $statusOcorrencia->getId();
	    $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.data_mudanca, 
        ocorrencia.id as id_ocorrencia_ocorrencia, 
        ocorrencia.id_local as id_local_ocorrencia_ocorrencia, 
        ocorrencia.id_usuario_cliente as id_usuario_cliente_ocorrencia_ocorrencia, 
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
        usuario.nivel as nivel_usuario_usuario
		FROM status_ocorrencia
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
		INNER JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
                WHERE status_ocorrencia.id = :id
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $statusOcorrencia->setId( $linha ['id'] );
                $statusOcorrencia->setMensagem( $linha ['mensagem'] );
                $statusOcorrencia->setDataMudanca( $linha ['data_mudanca'] );
                $statusOcorrencia->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdUsuarioCliente( $linha ['id_usuario_cliente_ocorrencia_ocorrencia'] );
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
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $statusOcorrencia;
    }
                
    public function preenchePorMensagem(StatusOcorrencia $statusOcorrencia) {
        
	    $mensagem = $statusOcorrencia->getMensagem();
	    $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.data_mudanca, 
        ocorrencia.id as id_ocorrencia_ocorrencia, 
        ocorrencia.id_local as id_local_ocorrencia_ocorrencia, 
        ocorrencia.id_usuario_cliente as id_usuario_cliente_ocorrencia_ocorrencia, 
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
        usuario.nivel as nivel_usuario_usuario
		FROM status_ocorrencia
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
		INNER JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
                WHERE status_ocorrencia.mensagem = :mensagem
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $statusOcorrencia->setId( $linha ['id'] );
                $statusOcorrencia->setMensagem( $linha ['mensagem'] );
                $statusOcorrencia->setDataMudanca( $linha ['data_mudanca'] );
                $statusOcorrencia->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdUsuarioCliente( $linha ['id_usuario_cliente_ocorrencia_ocorrencia'] );
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
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $statusOcorrencia;
    }
                
    public function preenchePorDataMudanca(StatusOcorrencia $statusOcorrencia) {
        
	    $dataMudanca = $statusOcorrencia->getDataMudanca();
	    $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.data_mudanca, 
        ocorrencia.id as id_ocorrencia_ocorrencia, 
        ocorrencia.id_local as id_local_ocorrencia_ocorrencia, 
        ocorrencia.id_usuario_cliente as id_usuario_cliente_ocorrencia_ocorrencia, 
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
        usuario.nivel as nivel_usuario_usuario
		FROM status_ocorrencia
		INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = status_ocorrencia.id_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
		INNER JOIN usuario as usuario ON usuario.id = status_ocorrencia.id_usuario
                WHERE status_ocorrencia.data_mudanca = :dataMudanca
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dataMudanca", $dataMudanca, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $statusOcorrencia->setId( $linha ['id'] );
                $statusOcorrencia->setMensagem( $linha ['mensagem'] );
                $statusOcorrencia->setDataMudanca( $linha ['data_mudanca'] );
                $statusOcorrencia->getOcorrencia()->setId( $linha ['id_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdLocal( $linha ['id_local_ocorrencia_ocorrencia'] );
                $statusOcorrencia->getOcorrencia()->setIdUsuarioCliente( $linha ['id_usuario_cliente_ocorrencia_ocorrencia'] );
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
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $statusOcorrencia;
    }
}