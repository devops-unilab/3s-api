<?php
                
/**
 * Classe feita para manipulação do objeto Status
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class StatusDAO extends DAO {
    


            
            
    public function atualizar(Status $status)
    {
        $id = $status->getId();
            
            
        $sql = "UPDATE status
                SET
                sigla = :sigla,
                nome = :nome,
                icone = :icone,
                cor = :cor
                WHERE status.id = :id;";
			$sigla = $status->getSigla();
			$nome = $status->getNome();
			$icone = $status->getIcone();
			$cor = $status->getCor();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":icone", $icone, PDO::PARAM_STR);
			$stmt->bindParam(":cor", $cor, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(Status $status){
        $sql = "INSERT INTO status(sigla, nome, icone, cor) VALUES (:sigla, :nome, :icone, :cor);";
		$sigla = $status->getSigla();
		$nome = $status->getNome();
		$icone = $status->getIcone();
		$cor = $status->getCor();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":icone", $icone, PDO::PARAM_STR);
			$stmt->bindParam(":cor", $cor, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(Status $status){
        $sql = "INSERT INTO status(id, sigla, nome, icone, cor) VALUES (:id, :sigla, :nome, :icone, :cor);";
		$id = $status->getId();
		$sigla = $status->getSigla();
		$nome = $status->getNome();
		$icone = $status->getIcone();
		$cor = $status->getCor();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":icone", $icone, PDO::PARAM_STR);
			$stmt->bindParam(":cor", $cor, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(Status $status){
		$id = $status->getId();
		$sql = "DELETE FROM status WHERE id = :id";
		    
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
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
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
		        $status = new Status();
                $status->setId( $linha ['id'] );
                $status->setSigla( $linha ['sigla'] );
                $status->setNome( $linha ['nome'] );
                $status->setIcone( $linha ['icone'] );
                $status->setCor( $linha ['cor'] );
                $lista [] = $status;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(Status $status) {
        $lista = array();
	    $id = $status->getId();
                
        $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
            WHERE status.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $status = new Status();
    	        $status->setId( $linha ['id'] );
    	        $status->setSigla( $linha ['sigla'] );
    	        $status->setNome( $linha ['nome'] );
    	        $status->setIcone( $linha ['icone'] );
    	        $status->setCor( $linha ['cor'] );
    			$lista [] = $status;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorSigla(Status $status) {
        $lista = array();
	    $sigla = $status->getSigla();
                
        $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
            WHERE status.sigla like :sigla";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $status = new Status();
    	        $status->setId( $linha ['id'] );
    	        $status->setSigla( $linha ['sigla'] );
    	        $status->setNome( $linha ['nome'] );
    	        $status->setIcone( $linha ['icone'] );
    	        $status->setCor( $linha ['cor'] );
    			$lista [] = $status;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorNome(Status $status) {
        $lista = array();
	    $nome = $status->getNome();
                
        $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
            WHERE status.nome like :nome";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $status = new Status();
    	        $status->setId( $linha ['id'] );
    	        $status->setSigla( $linha ['sigla'] );
    	        $status->setNome( $linha ['nome'] );
    	        $status->setIcone( $linha ['icone'] );
    	        $status->setCor( $linha ['cor'] );
    			$lista [] = $status;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIcone(Status $status) {
        $lista = array();
	    $icone = $status->getIcone();
                
        $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
            WHERE status.icone like :icone";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":icone", $icone, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $status = new Status();
    	        $status->setId( $linha ['id'] );
    	        $status->setSigla( $linha ['sigla'] );
    	        $status->setNome( $linha ['nome'] );
    	        $status->setIcone( $linha ['icone'] );
    	        $status->setCor( $linha ['cor'] );
    			$lista [] = $status;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorCor(Status $status) {
        $lista = array();
	    $cor = $status->getCor();
                
        $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
            WHERE status.cor like :cor";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":cor", $cor, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $status = new Status();
    	        $status->setId( $linha ['id'] );
    	        $status->setSigla( $linha ['sigla'] );
    	        $status->setNome( $linha ['nome'] );
    	        $status->setIcone( $linha ['icone'] );
    	        $status->setCor( $linha ['cor'] );
    			$lista [] = $status;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(Status $status) {
        
	    $id = $status->getId();
	    $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
                WHERE status.id = :id
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
                $status->setId( $linha ['id'] );
                $status->setSigla( $linha ['sigla'] );
                $status->setNome( $linha ['nome'] );
                $status->setIcone( $linha ['icone'] );
                $status->setCor( $linha ['cor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $status;
    }
                
    public function preenchePorSigla(Status $status) {
        
	    $sigla = $status->getSigla();
	    $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
                WHERE status.sigla = :sigla
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $status->setId( $linha ['id'] );
                $status->setSigla( $linha ['sigla'] );
                $status->setNome( $linha ['nome'] );
                $status->setIcone( $linha ['icone'] );
                $status->setCor( $linha ['cor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $status;
    }
                
    public function preenchePorNome(Status $status) {
        
	    $nome = $status->getNome();
	    $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
                WHERE status.nome = :nome
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $status->setId( $linha ['id'] );
                $status->setSigla( $linha ['sigla'] );
                $status->setNome( $linha ['nome'] );
                $status->setIcone( $linha ['icone'] );
                $status->setCor( $linha ['cor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $status;
    }
                
    public function preenchePorIcone(Status $status) {
        
	    $icone = $status->getIcone();
	    $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
                WHERE status.icone = :icone
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":icone", $icone, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $status->setId( $linha ['id'] );
                $status->setSigla( $linha ['sigla'] );
                $status->setNome( $linha ['nome'] );
                $status->setIcone( $linha ['icone'] );
                $status->setCor( $linha ['cor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $status;
    }
                
    public function preenchePorCor(Status $status) {
        
	    $cor = $status->getCor();
	    $sql = "
		SELECT
        status.id, 
        status.sigla, 
        status.nome, 
        status.icone, 
        status.cor
		FROM status
                WHERE status.cor = :cor
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":cor", $cor, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $status->setId( $linha ['id'] );
                $status->setSigla( $linha ['sigla'] );
                $status->setNome( $linha ['nome'] );
                $status->setIcone( $linha ['icone'] );
                $status->setCor( $linha ['cor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $status;
    }
}