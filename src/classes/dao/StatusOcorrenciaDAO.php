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
                id_user = :idUser,
                dt_mudanca = :dtMudanca
                WHERE status_ocorrencia.id = :id;";
			$mensagem = $statusOcorrencia->getMensagem();
			$idUser = $statusOcorrencia->getIdUser();
			$dtMudanca = $statusOcorrencia->getDtMudanca();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtMudanca", $dtMudanca, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(StatusOcorrencia $statusOcorrencia){
        $sql = "INSERT INTO status_ocorrencia(id_status, mensagem, id_user, dt_mudanca) VALUES (:status, :mensagem, :idUser, :dtMudanca);";
		$status = $statusOcorrencia->getStatus()->getId();
		$mensagem = $statusOcorrencia->getMensagem();
		$idUser = $statusOcorrencia->getIdUser();
		$dtMudanca = $statusOcorrencia->getDtMudanca();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtMudanca", $dtMudanca, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(StatusOcorrencia $statusOcorrencia){
        $sql = "INSERT INTO status_ocorrencia(id, id_status_status, mensagem, id_user, dt_mudanca) VALUES (:id, :status, :mensagem, :idUser, :dtMudanca);";
		$id = $statusOcorrencia->getId();
		$status = $statusOcorrencia->getStatus()->getId();
		$mensagem = $statusOcorrencia->getMensagem();
		$idUser = $statusOcorrencia->getIdUser();
		$dtMudanca = $statusOcorrencia->getDtMudanca();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtMudanca", $dtMudanca, PDO::PARAM_STR);
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
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
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
                $statusOcorrencia->setIdUser( $linha ['id_user'] );
                $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
                $statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
                $statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
                $statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
                $statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
                $statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
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
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
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
    	        $statusOcorrencia->setIdUser( $linha ['id_user'] );
    	        $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
    			$statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
    			$statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
    			$statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
    			$statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
    			$statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
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
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
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
    	        $statusOcorrencia->setIdUser( $linha ['id_user'] );
    	        $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
    			$statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
    			$statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
    			$statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
    			$statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
    			$statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
    			$lista [] = $statusOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdUser(StatusOcorrencia $statusOcorrencia) {
        $lista = array();
	    $idUser = $statusOcorrencia->getIdUser();
                
        $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
            WHERE status_ocorrencia.id_user = :idUser";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $statusOcorrencia = new StatusOcorrencia();
    	        $statusOcorrencia->setId( $linha ['id'] );
    	        $statusOcorrencia->setMensagem( $linha ['mensagem'] );
    	        $statusOcorrencia->setIdUser( $linha ['id_user'] );
    	        $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
    			$statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
    			$statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
    			$statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
    			$statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
    			$statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
    			$lista [] = $statusOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtMudanca(StatusOcorrencia $statusOcorrencia) {
        $lista = array();
	    $dtMudanca = $statusOcorrencia->getDtMudanca();
                
        $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
            WHERE status_ocorrencia.dt_mudanca like :dtMudanca";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtMudanca", $dtMudanca, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $statusOcorrencia = new StatusOcorrencia();
    	        $statusOcorrencia->setId( $linha ['id'] );
    	        $statusOcorrencia->setMensagem( $linha ['mensagem'] );
    	        $statusOcorrencia->setIdUser( $linha ['id_user'] );
    	        $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
    			$statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
    			$statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
    			$statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
    			$statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
    			$statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
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
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
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
                $statusOcorrencia->setIdUser( $linha ['id_user'] );
                $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
                $statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
                $statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
                $statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
                $statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
                $statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
                
                
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
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
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
                $statusOcorrencia->setIdUser( $linha ['id_user'] );
                $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
                $statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
                $statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
                $statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
                $statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
                $statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $statusOcorrencia;
    }
                
    public function preenchePorIdUser(StatusOcorrencia $statusOcorrencia) {
        
	    $idUser = $statusOcorrencia->getIdUser();
	    $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
                WHERE status_ocorrencia.id_user = :idUser
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
                $statusOcorrencia->setId( $linha ['id'] );
                $statusOcorrencia->setMensagem( $linha ['mensagem'] );
                $statusOcorrencia->setIdUser( $linha ['id_user'] );
                $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
                $statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
                $statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
                $statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
                $statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
                $statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $statusOcorrencia;
    }
                
    public function preenchePorDtMudanca(StatusOcorrencia $statusOcorrencia) {
        
	    $dtMudanca = $statusOcorrencia->getDtMudanca();
	    $sql = "
		SELECT
        status_ocorrencia.id, 
        status_ocorrencia.mensagem, 
        status_ocorrencia.id_user, 
        status_ocorrencia.dt_mudanca, 
        status.id as id_status_status, 
        status.sigla as sigla_status_status, 
        status.nome as nome_status_status, 
        status.icone as icone_status_status, 
        status.cor as cor_status_status
		FROM status_ocorrencia
		INNER JOIN status as status ON status.id = status_ocorrencia.id_status
                WHERE status_ocorrencia.dt_mudanca = :dtMudanca
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtMudanca", $dtMudanca, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $statusOcorrencia->setId( $linha ['id'] );
                $statusOcorrencia->setMensagem( $linha ['mensagem'] );
                $statusOcorrencia->setIdUser( $linha ['id_user'] );
                $statusOcorrencia->setDtMudanca( $linha ['dt_mudanca'] );
                $statusOcorrencia->getStatus()->setId( $linha ['id_status_status'] );
                $statusOcorrencia->getStatus()->setSigla( $linha ['sigla_status_status'] );
                $statusOcorrencia->getStatus()->setNome( $linha ['nome_status_status'] );
                $statusOcorrencia->getStatus()->setIcone( $linha ['icone_status_status'] );
                $statusOcorrencia->getStatus()->setCor( $linha ['cor_status_status'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $statusOcorrencia;
    }
}