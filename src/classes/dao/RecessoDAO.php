<?php
                
/**
 * Classe feita para manipulação do objeto Recesso
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class RecessoDAO extends DAO {
    


            
            
    public function atualizar(Recesso $recesso)
    {
        $id = $recesso->getId();
            
            
        $sql = "UPDATE recesso
                SET
                data = :data
                WHERE recesso.id = :id;";
			$data = $recesso->getData();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":data", $data, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(Recesso $recesso){
        $sql = "INSERT INTO recesso(data) VALUES (:data);";
		$data = $recesso->getData();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":data", $data, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(Recesso $recesso){
        $sql = "INSERT INTO recesso(id, data) VALUES (:id, :data);";
		$id = $recesso->getId();
		$data = $recesso->getData();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":data", $data, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(Recesso $recesso){
		$id = $recesso->getId();
		$sql = "DELETE FROM recesso WHERE id = :id";
		    
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
        recesso.id, 
        recesso.data
		FROM recesso
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
		        $recesso = new Recesso();
                $recesso->setId( $linha ['id'] );
                $recesso->setData( $linha ['data'] );
                $lista [] = $recesso;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(Recesso $recesso) {
        $lista = array();
	    $id = $recesso->getId();
                
        $sql = "
		SELECT
        recesso.id, 
        recesso.data
		FROM recesso
            WHERE recesso.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $recesso = new Recesso();
                $recesso->setId( $linha ['id'] );
                $recesso->setData( $linha ['data'] );
                $lista [] = $recesso;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorData(Recesso $recesso) {
        $lista = array();
	    $data = $recesso->getData();
                
        $sql = "
		SELECT
        recesso.id, 
        recesso.data
		FROM recesso
            WHERE recesso.data like :data";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":data", $data, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $recesso = new Recesso();
                $recesso->setId( $linha ['id'] );
                $recesso->setData( $linha ['data'] );
                $lista [] = $recesso;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(Recesso $recesso) {
        
	    $id = $recesso->getId();
	    $sql = "
		SELECT
        recesso.id, 
        recesso.data
		FROM recesso
                WHERE recesso.id = :id
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
                $recesso->setId( $linha ['id'] );
                $recesso->setData( $linha ['data'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $recesso;
    }
                
    public function preenchePorData(Recesso $recesso) {
        
	    $data = $recesso->getData();
	    $sql = "
		SELECT
        recesso.id, 
        recesso.data
		FROM recesso
                WHERE recesso.data = :data
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":data", $data, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $recesso->setId( $linha ['id'] );
                $recesso->setData( $linha ['data'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $recesso;
    }
}