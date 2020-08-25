<?php
                
/**
 * Classe feita para manipulação do objeto Perfil
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class PerfilDAO extends DAO {
    


            
            
    public function atualizar(Perfil $perfil)
    {
        $id = $perfil->getId();
            
            
        $sql = "UPDATE perfil
                SET
                nome = :nome,
                sigla = :sigla
                WHERE perfil.id = :id;";
			$nome = $perfil->getNome();
			$sigla = $perfil->getSigla();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(Perfil $perfil){
        $sql = "INSERT INTO perfil(nome, sigla) VALUES (:nome, :sigla);";
		$nome = $perfil->getNome();
		$sigla = $perfil->getSigla();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(Perfil $perfil){
        $sql = "INSERT INTO perfil(id, nome, sigla) VALUES (:id, :nome, :sigla);";
		$id = $perfil->getId();
		$nome = $perfil->getNome();
		$sigla = $perfil->getSigla();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(Perfil $perfil){
		$id = $perfil->getId();
		$sql = "DELETE FROM perfil WHERE id = :id";
		    
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
        perfil.id, 
        perfil.nome, 
        perfil.sigla
		FROM perfil
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
		        $perfil = new Perfil();
                $perfil->setId( $linha ['id'] );
                $perfil->setNome( $linha ['nome'] );
                $perfil->setSigla( $linha ['sigla'] );
                $lista [] = $perfil;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(Perfil $perfil) {
        $lista = array();
	    $id = $perfil->getId();
                
        $sql = "
		SELECT
        perfil.id, 
        perfil.nome, 
        perfil.sigla
		FROM perfil
            WHERE perfil.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $perfil = new Perfil();
    	        $perfil->setId( $linha ['id'] );
    	        $perfil->setNome( $linha ['nome'] );
    	        $perfil->setSigla( $linha ['sigla'] );
    			$lista [] = $perfil;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorNome(Perfil $perfil) {
        $lista = array();
	    $nome = $perfil->getNome();
                
        $sql = "
		SELECT
        perfil.id, 
        perfil.nome, 
        perfil.sigla
		FROM perfil
            WHERE perfil.nome like :nome";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $perfil = new Perfil();
    	        $perfil->setId( $linha ['id'] );
    	        $perfil->setNome( $linha ['nome'] );
    	        $perfil->setSigla( $linha ['sigla'] );
    			$lista [] = $perfil;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorSigla(Perfil $perfil) {
        $lista = array();
	    $sigla = $perfil->getSigla();
                
        $sql = "
		SELECT
        perfil.id, 
        perfil.nome, 
        perfil.sigla
		FROM perfil
            WHERE perfil.sigla like :sigla";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $perfil = new Perfil();
    	        $perfil->setId( $linha ['id'] );
    	        $perfil->setNome( $linha ['nome'] );
    	        $perfil->setSigla( $linha ['sigla'] );
    			$lista [] = $perfil;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(Perfil $perfil) {
        
	    $id = $perfil->getId();
	    $sql = "
		SELECT
        perfil.id, 
        perfil.nome, 
        perfil.sigla
		FROM perfil
                WHERE perfil.id = :id
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
                $perfil->setId( $linha ['id'] );
                $perfil->setNome( $linha ['nome'] );
                $perfil->setSigla( $linha ['sigla'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $perfil;
    }
                
    public function preenchePorNome(Perfil $perfil) {
        
	    $nome = $perfil->getNome();
	    $sql = "
		SELECT
        perfil.id, 
        perfil.nome, 
        perfil.sigla
		FROM perfil
                WHERE perfil.nome = :nome
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
                $perfil->setId( $linha ['id'] );
                $perfil->setNome( $linha ['nome'] );
                $perfil->setSigla( $linha ['sigla'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $perfil;
    }
                
    public function preenchePorSigla(Perfil $perfil) {
        
	    $sigla = $perfil->getSigla();
	    $sql = "
		SELECT
        perfil.id, 
        perfil.nome, 
        perfil.sigla
		FROM perfil
                WHERE perfil.sigla = :sigla
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
                $perfil->setId( $linha ['id'] );
                $perfil->setNome( $linha ['nome'] );
                $perfil->setSigla( $linha ['sigla'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $perfil;
    }
}