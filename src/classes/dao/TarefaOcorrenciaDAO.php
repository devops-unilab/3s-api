<?php
                
/**
 * Classe feita para manipulação do objeto TarefaOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class TarefaOcorrenciaDAO extends DAO {
    


            
            
    public function atualizar(TarefaOcorrencia $tarefaOcorrencia)
    {
        $id = $tarefaOcorrencia->getId();
            
            
        $sql = "UPDATE tarefa_ocorrencia
                SET
                id_ocorrencia = :idOcorrencia,
                tarefa = :tarefa,
                id_user = :idUser,
                dt_inclusao = :dtInclusao
                WHERE tarefa_ocorrencia.id = :id;";
			$idOcorrencia = $tarefaOcorrencia->getIdOcorrencia();
			$tarefa = $tarefaOcorrencia->getTarefa();
			$idUser = $tarefaOcorrencia->getIdUser();
			$dtInclusao = $tarefaOcorrencia->getDtInclusao();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":idOcorrencia", $idOcorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtInclusao", $dtInclusao, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(TarefaOcorrencia $tarefaOcorrencia){
        $sql = "INSERT INTO tarefa_ocorrencia(id_ocorrencia, tarefa, id_user, dt_inclusao) VALUES (:idOcorrencia, :tarefa, :idUser, :dtInclusao);";
		$idOcorrencia = $tarefaOcorrencia->getIdOcorrencia();
		$tarefa = $tarefaOcorrencia->getTarefa();
		$idUser = $tarefaOcorrencia->getIdUser();
		$dtInclusao = $tarefaOcorrencia->getDtInclusao();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":idOcorrencia", $idOcorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtInclusao", $dtInclusao, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(TarefaOcorrencia $tarefaOcorrencia){
        $sql = "INSERT INTO tarefa_ocorrencia(id, id_ocorrencia, tarefa, id_user, dt_inclusao) VALUES (:id, :idOcorrencia, :tarefa, :idUser, :dtInclusao);";
		$id = $tarefaOcorrencia->getId();
		$idOcorrencia = $tarefaOcorrencia->getIdOcorrencia();
		$tarefa = $tarefaOcorrencia->getTarefa();
		$idUser = $tarefaOcorrencia->getIdUser();
		$dtInclusao = $tarefaOcorrencia->getDtInclusao();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":idOcorrencia", $idOcorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
			$stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$stmt->bindParam(":dtInclusao", $dtInclusao, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(TarefaOcorrencia $tarefaOcorrencia){
		$id = $tarefaOcorrencia->getId();
		$sql = "DELETE FROM tarefa_ocorrencia WHERE id = :id";
		    
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
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
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
		        $tarefaOcorrencia = new TarefaOcorrencia();
                $tarefaOcorrencia->setId( $linha ['id'] );
                $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
                $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
                $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
                $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
                $lista [] = $tarefaOcorrencia;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(TarefaOcorrencia $tarefaOcorrencia) {
        $lista = array();
	    $id = $tarefaOcorrencia->getId();
                
        $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
            WHERE tarefa_ocorrencia.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $tarefaOcorrencia = new TarefaOcorrencia();
    	        $tarefaOcorrencia->setId( $linha ['id'] );
    	        $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
    	        $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
    	        $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
    	        $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
    			$lista [] = $tarefaOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdOcorrencia(TarefaOcorrencia $tarefaOcorrencia) {
        $lista = array();
	    $idOcorrencia = $tarefaOcorrencia->getIdOcorrencia();
                
        $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
            WHERE tarefa_ocorrencia.id_ocorrencia = :idOcorrencia";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idOcorrencia", $idOcorrencia, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $tarefaOcorrencia = new TarefaOcorrencia();
    	        $tarefaOcorrencia->setId( $linha ['id'] );
    	        $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
    	        $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
    	        $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
    	        $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
    			$lista [] = $tarefaOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorTarefa(TarefaOcorrencia $tarefaOcorrencia) {
        $lista = array();
	    $tarefa = $tarefaOcorrencia->getTarefa();
                
        $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
            WHERE tarefa_ocorrencia.tarefa = :tarefa";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $tarefaOcorrencia = new TarefaOcorrencia();
    	        $tarefaOcorrencia->setId( $linha ['id'] );
    	        $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
    	        $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
    	        $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
    	        $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
    			$lista [] = $tarefaOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdUser(TarefaOcorrencia $tarefaOcorrencia) {
        $lista = array();
	    $idUser = $tarefaOcorrencia->getIdUser();
                
        $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
            WHERE tarefa_ocorrencia.id_user = :idUser";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $tarefaOcorrencia = new TarefaOcorrencia();
    	        $tarefaOcorrencia->setId( $linha ['id'] );
    	        $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
    	        $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
    	        $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
    	        $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
    			$lista [] = $tarefaOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtInclusao(TarefaOcorrencia $tarefaOcorrencia) {
        $lista = array();
	    $dtInclusao = $tarefaOcorrencia->getDtInclusao();
                
        $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
            WHERE tarefa_ocorrencia.dt_inclusao like :dtInclusao";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtInclusao", $dtInclusao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $tarefaOcorrencia = new TarefaOcorrencia();
    	        $tarefaOcorrencia->setId( $linha ['id'] );
    	        $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
    	        $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
    	        $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
    	        $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
    			$lista [] = $tarefaOcorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(TarefaOcorrencia $tarefaOcorrencia) {
        
	    $id = $tarefaOcorrencia->getId();
	    $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
                WHERE tarefa_ocorrencia.id = :id
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
                $tarefaOcorrencia->setId( $linha ['id'] );
                $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
                $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
                $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
                $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tarefaOcorrencia;
    }
                
    public function preenchePorIdOcorrencia(TarefaOcorrencia $tarefaOcorrencia) {
        
	    $idOcorrencia = $tarefaOcorrencia->getIdOcorrencia();
	    $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
                WHERE tarefa_ocorrencia.id_ocorrencia = :idOcorrencia
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idOcorrencia", $idOcorrencia, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $tarefaOcorrencia->setId( $linha ['id'] );
                $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
                $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
                $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
                $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tarefaOcorrencia;
    }
                
    public function preenchePorTarefa(TarefaOcorrencia $tarefaOcorrencia) {
        
	    $tarefa = $tarefaOcorrencia->getTarefa();
	    $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
                WHERE tarefa_ocorrencia.tarefa = :tarefa
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $tarefaOcorrencia->setId( $linha ['id'] );
                $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
                $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
                $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
                $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tarefaOcorrencia;
    }
                
    public function preenchePorIdUser(TarefaOcorrencia $tarefaOcorrencia) {
        
	    $idUser = $tarefaOcorrencia->getIdUser();
	    $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
                WHERE tarefa_ocorrencia.id_user = :idUser
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
                $tarefaOcorrencia->setId( $linha ['id'] );
                $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
                $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
                $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
                $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tarefaOcorrencia;
    }
                
    public function preenchePorDtInclusao(TarefaOcorrencia $tarefaOcorrencia) {
        
	    $dtInclusao = $tarefaOcorrencia->getDtInclusao();
	    $sql = "
		SELECT
        tarefa_ocorrencia.id, 
        tarefa_ocorrencia.id_ocorrencia, 
        tarefa_ocorrencia.tarefa, 
        tarefa_ocorrencia.id_user, 
        tarefa_ocorrencia.dt_inclusao
		FROM tarefa_ocorrencia
                WHERE tarefa_ocorrencia.dt_inclusao = :dtInclusao
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtInclusao", $dtInclusao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $tarefaOcorrencia->setId( $linha ['id'] );
                $tarefaOcorrencia->setIdOcorrencia( $linha ['id_ocorrencia'] );
                $tarefaOcorrencia->setTarefa( $linha ['tarefa'] );
                $tarefaOcorrencia->setIdUser( $linha ['id_user'] );
                $tarefaOcorrencia->setDtInclusao( $linha ['dt_inclusao'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tarefaOcorrencia;
    }
}