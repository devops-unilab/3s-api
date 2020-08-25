<?php
                
/**
 * Classe feita para manipulação do objeto TipoAtividade
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class TipoAtividadeDAO extends DAO {
    


            
            
    public function atualizar(TipoAtividade $tipoAtividade)
    {
        $id = $tipoAtividade->getId();
            
            
        $sql = "UPDATE tipo_atividade
                SET
                nome = :nome
                WHERE tipo_atividade.id = :id;";
			$nome = $tipoAtividade->getNome();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(TipoAtividade $tipoAtividade){
        $sql = "INSERT INTO tipo_atividade(nome) VALUES (:nome);";
		$nome = $tipoAtividade->getNome();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(TipoAtividade $tipoAtividade){
        $sql = "INSERT INTO tipo_atividade(id, nome) VALUES (:id, :nome);";
		$id = $tipoAtividade->getId();
		$nome = $tipoAtividade->getNome();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(TipoAtividade $tipoAtividade){
		$id = $tipoAtividade->getId();
		$sql = "DELETE FROM tipo_atividade WHERE id = :id";
		    
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
        tipo_atividade.id, 
        tipo_atividade.nome
		FROM tipo_atividade
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
		        $tipoAtividade = new TipoAtividade();
                $tipoAtividade->setId( $linha ['id'] );
                $tipoAtividade->setNome( $linha ['nome'] );
                $lista [] = $tipoAtividade;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(TipoAtividade $tipoAtividade) {
        $lista = array();
	    $id = $tipoAtividade->getId();
                
        $sql = "
		SELECT
        tipo_atividade.id, 
        tipo_atividade.nome
		FROM tipo_atividade
            WHERE tipo_atividade.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $tipoAtividade = new TipoAtividade();
    	        $tipoAtividade->setId( $linha ['id'] );
    	        $tipoAtividade->setNome( $linha ['nome'] );
    			$lista [] = $tipoAtividade;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorNome(TipoAtividade $tipoAtividade) {
        $lista = array();
	    $nome = $tipoAtividade->getNome();
                
        $sql = "
		SELECT
        tipo_atividade.id, 
        tipo_atividade.nome
		FROM tipo_atividade
            WHERE tipo_atividade.nome like :nome";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $tipoAtividade = new TipoAtividade();
    	        $tipoAtividade->setId( $linha ['id'] );
    	        $tipoAtividade->setNome( $linha ['nome'] );
    			$lista [] = $tipoAtividade;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(TipoAtividade $tipoAtividade) {
        
	    $id = $tipoAtividade->getId();
	    $sql = "
		SELECT
        tipo_atividade.id, 
        tipo_atividade.nome
		FROM tipo_atividade
                WHERE tipo_atividade.id = :id
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
                $tipoAtividade->setId( $linha ['id'] );
                $tipoAtividade->setNome( $linha ['nome'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tipoAtividade;
    }
                
    public function preenchePorNome(TipoAtividade $tipoAtividade) {
        
	    $nome = $tipoAtividade->getNome();
	    $sql = "
		SELECT
        tipo_atividade.id, 
        tipo_atividade.nome
		FROM tipo_atividade
                WHERE tipo_atividade.nome = :nome
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
                $tipoAtividade->setId( $linha ['id'] );
                $tipoAtividade->setNome( $linha ['nome'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tipoAtividade;
    }
}