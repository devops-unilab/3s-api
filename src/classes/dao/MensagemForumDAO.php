<?php
                
/**
 * Classe feita para manipulação do objeto MensagemForum
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class MensagemForumDAO extends DAO {
    


            
            
    public function atualizar(MensagemForum $mensagemForum)
    {
        $id = $mensagemForum->getId();
            
            
        $sql = "UPDATE mensagem_forum
                SET
                tipo = :tipo,
                mensagem = :mensagem,
                id_user = :idUser,
                dt_envio = :dtEnvio,
                origem = :origem,
                ativo = :ativo
                WHERE mensagem_forum.id = :id;";
			$tipo = $mensagemForum->getTipo();
			$mensagem = $mensagemForum->getMensagem();
			$idUser = $mensagemForum->getIdUser();
			$dtEnvio = $mensagemForum->getDtEnvio();
			$origem = $mensagemForum->getOrigem();
			$ativo = $mensagemForum->getAtivo();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtEnvio", $dtEnvio, PDO::PARAM_STR);
			$stmt->bindParam(":origem", $origem, PDO::PARAM_INT);
			$stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(MensagemForum $mensagemForum){
        $sql = "INSERT INTO mensagem_forum(tipo, mensagem, id_user, dt_envio, origem, ativo) VALUES (:tipo, :mensagem, :idUser, :dtEnvio, :origem, :ativo);";
		$tipo = $mensagemForum->getTipo();
		$mensagem = $mensagemForum->getMensagem();
		$idUser = $mensagemForum->getIdUser();
		$dtEnvio = $mensagemForum->getDtEnvio();
		$origem = $mensagemForum->getOrigem();
		$ativo = $mensagemForum->getAtivo();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtEnvio", $dtEnvio, PDO::PARAM_STR);
			$stmt->bindParam(":origem", $origem, PDO::PARAM_INT);
			$stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(MensagemForum $mensagemForum){
        $sql = "INSERT INTO mensagem_forum(id, tipo, mensagem, id_user, dt_envio, origem, ativo) VALUES (:id, :tipo, :mensagem, :idUser, :dtEnvio, :origem, :ativo);";
		$id = $mensagemForum->getId();
		$tipo = $mensagemForum->getTipo();
		$mensagem = $mensagemForum->getMensagem();
		$idUser = $mensagemForum->getIdUser();
		$dtEnvio = $mensagemForum->getDtEnvio();
		$origem = $mensagemForum->getOrigem();
		$ativo = $mensagemForum->getAtivo();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtEnvio", $dtEnvio, PDO::PARAM_STR);
			$stmt->bindParam(":origem", $origem, PDO::PARAM_INT);
			$stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(MensagemForum $mensagemForum){
		$id = $mensagemForum->getId();
		$sql = "DELETE FROM mensagem_forum WHERE id = :id";
		    
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
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
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
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setIdUser( $linha ['id_user'] );
                $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
                $mensagemForum->setOrigem( $linha ['origem'] );
                $mensagemForum->setAtivo( $linha ['ativo'] );
                $lista [] = $mensagemForum;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(MensagemForum $mensagemForum) {
        $lista = array();
	    $id = $mensagemForum->getId();
                
        $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
            WHERE mensagem_forum.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $mensagemForum = new MensagemForum();
    	        $mensagemForum->setId( $linha ['id'] );
    	        $mensagemForum->setTipo( $linha ['tipo'] );
    	        $mensagemForum->setMensagem( $linha ['mensagem'] );
    	        $mensagemForum->setIdUser( $linha ['id_user'] );
    	        $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
    	        $mensagemForum->setOrigem( $linha ['origem'] );
    	        $mensagemForum->setAtivo( $linha ['ativo'] );
    			$lista [] = $mensagemForum;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorTipo(MensagemForum $mensagemForum) {
        $lista = array();
	    $tipo = $mensagemForum->getTipo();
                
        $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
            WHERE mensagem_forum.tipo = :tipo";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $mensagemForum = new MensagemForum();
    	        $mensagemForum->setId( $linha ['id'] );
    	        $mensagemForum->setTipo( $linha ['tipo'] );
    	        $mensagemForum->setMensagem( $linha ['mensagem'] );
    	        $mensagemForum->setIdUser( $linha ['id_user'] );
    	        $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
    	        $mensagemForum->setOrigem( $linha ['origem'] );
    	        $mensagemForum->setAtivo( $linha ['ativo'] );
    			$lista [] = $mensagemForum;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorMensagem(MensagemForum $mensagemForum) {
        $lista = array();
	    $mensagem = $mensagemForum->getMensagem();
                
        $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
            WHERE mensagem_forum.mensagem like :mensagem";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $mensagemForum = new MensagemForum();
    	        $mensagemForum->setId( $linha ['id'] );
    	        $mensagemForum->setTipo( $linha ['tipo'] );
    	        $mensagemForum->setMensagem( $linha ['mensagem'] );
    	        $mensagemForum->setIdUser( $linha ['id_user'] );
    	        $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
    	        $mensagemForum->setOrigem( $linha ['origem'] );
    	        $mensagemForum->setAtivo( $linha ['ativo'] );
    			$lista [] = $mensagemForum;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdUser(MensagemForum $mensagemForum) {
        $lista = array();
	    $idUser = $mensagemForum->getIdUser();
                
        $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
            WHERE mensagem_forum.id_user = :idUser";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $mensagemForum = new MensagemForum();
    	        $mensagemForum->setId( $linha ['id'] );
    	        $mensagemForum->setTipo( $linha ['tipo'] );
    	        $mensagemForum->setMensagem( $linha ['mensagem'] );
    	        $mensagemForum->setIdUser( $linha ['id_user'] );
    	        $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
    	        $mensagemForum->setOrigem( $linha ['origem'] );
    	        $mensagemForum->setAtivo( $linha ['ativo'] );
    			$lista [] = $mensagemForum;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtEnvio(MensagemForum $mensagemForum) {
        $lista = array();
	    $dtEnvio = $mensagemForum->getDtEnvio();
                
        $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
            WHERE mensagem_forum.dt_envio like :dtEnvio";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtEnvio", $dtEnvio, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $mensagemForum = new MensagemForum();
    	        $mensagemForum->setId( $linha ['id'] );
    	        $mensagemForum->setTipo( $linha ['tipo'] );
    	        $mensagemForum->setMensagem( $linha ['mensagem'] );
    	        $mensagemForum->setIdUser( $linha ['id_user'] );
    	        $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
    	        $mensagemForum->setOrigem( $linha ['origem'] );
    	        $mensagemForum->setAtivo( $linha ['ativo'] );
    			$lista [] = $mensagemForum;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorOrigem(MensagemForum $mensagemForum) {
        $lista = array();
	    $origem = $mensagemForum->getOrigem();
                
        $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
            WHERE mensagem_forum.origem = :origem";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":origem", $origem, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $mensagemForum = new MensagemForum();
    	        $mensagemForum->setId( $linha ['id'] );
    	        $mensagemForum->setTipo( $linha ['tipo'] );
    	        $mensagemForum->setMensagem( $linha ['mensagem'] );
    	        $mensagemForum->setIdUser( $linha ['id_user'] );
    	        $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
    	        $mensagemForum->setOrigem( $linha ['origem'] );
    	        $mensagemForum->setAtivo( $linha ['ativo'] );
    			$lista [] = $mensagemForum;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorAtivo(MensagemForum $mensagemForum) {
        $lista = array();
	    $ativo = $mensagemForum->getAtivo();
                
        $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
            WHERE mensagem_forum.ativo = :ativo";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $mensagemForum = new MensagemForum();
    	        $mensagemForum->setId( $linha ['id'] );
    	        $mensagemForum->setTipo( $linha ['tipo'] );
    	        $mensagemForum->setMensagem( $linha ['mensagem'] );
    	        $mensagemForum->setIdUser( $linha ['id_user'] );
    	        $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
    	        $mensagemForum->setOrigem( $linha ['origem'] );
    	        $mensagemForum->setAtivo( $linha ['ativo'] );
    			$lista [] = $mensagemForum;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(MensagemForum $mensagemForum) {
        
	    $id = $mensagemForum->getId();
	    $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
                WHERE mensagem_forum.id = :id
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
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setIdUser( $linha ['id_user'] );
                $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
                $mensagemForum->setOrigem( $linha ['origem'] );
                $mensagemForum->setAtivo( $linha ['ativo'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function preenchePorTipo(MensagemForum $mensagemForum) {
        
	    $tipo = $mensagemForum->getTipo();
	    $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
                WHERE mensagem_forum.tipo = :tipo
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setIdUser( $linha ['id_user'] );
                $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
                $mensagemForum->setOrigem( $linha ['origem'] );
                $mensagemForum->setAtivo( $linha ['ativo'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function preenchePorMensagem(MensagemForum $mensagemForum) {
        
	    $mensagem = $mensagemForum->getMensagem();
	    $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
                WHERE mensagem_forum.mensagem = :mensagem
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
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setIdUser( $linha ['id_user'] );
                $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
                $mensagemForum->setOrigem( $linha ['origem'] );
                $mensagemForum->setAtivo( $linha ['ativo'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function preenchePorIdUser(MensagemForum $mensagemForum) {
        
	    $idUser = $mensagemForum->getIdUser();
	    $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
                WHERE mensagem_forum.id_user = :idUser
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setIdUser( $linha ['id_user'] );
                $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
                $mensagemForum->setOrigem( $linha ['origem'] );
                $mensagemForum->setAtivo( $linha ['ativo'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function preenchePorDtEnvio(MensagemForum $mensagemForum) {
        
	    $dtEnvio = $mensagemForum->getDtEnvio();
	    $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
                WHERE mensagem_forum.dt_envio = :dtEnvio
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtEnvio", $dtEnvio, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setIdUser( $linha ['id_user'] );
                $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
                $mensagemForum->setOrigem( $linha ['origem'] );
                $mensagemForum->setAtivo( $linha ['ativo'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function preenchePorOrigem(MensagemForum $mensagemForum) {
        
	    $origem = $mensagemForum->getOrigem();
	    $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
                WHERE mensagem_forum.origem = :origem
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":origem", $origem, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setIdUser( $linha ['id_user'] );
                $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
                $mensagemForum->setOrigem( $linha ['origem'] );
                $mensagemForum->setAtivo( $linha ['ativo'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function preenchePorAtivo(MensagemForum $mensagemForum) {
        
	    $ativo = $mensagemForum->getAtivo();
	    $sql = "
		SELECT
        mensagem_forum.id, 
        mensagem_forum.tipo, 
        mensagem_forum.mensagem, 
        mensagem_forum.id_user, 
        mensagem_forum.dt_envio, 
        mensagem_forum.origem, 
        mensagem_forum.ativo
		FROM mensagem_forum
                WHERE mensagem_forum.ativo = :ativo
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $mensagemForum->setId( $linha ['id'] );
                $mensagemForum->setTipo( $linha ['tipo'] );
                $mensagemForum->setMensagem( $linha ['mensagem'] );
                $mensagemForum->setIdUser( $linha ['id_user'] );
                $mensagemForum->setDtEnvio( $linha ['dt_envio'] );
                $mensagemForum->setOrigem( $linha ['origem'] );
                $mensagemForum->setAtivo( $linha ['ativo'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
}