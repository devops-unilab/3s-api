<?php
            
/**
 * Classe feita para manipulação do objeto Recesso
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace novissimo3s\dao;
use PDO;
use PDOException;
use novissimo3s\model\Recesso;


class RecessoDAO extends DAO {
    
    

            
            
    public function update(Recesso $recesso)
    {
        $id = $recesso->getId();
            
            
        $sql = "UPDATE recesso
                SET
                data = :data
                WHERE recesso.id = :id;";
			$data = $recesso->getData();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":data", $data, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(Recesso $recesso){
        $sql = "INSERT INTO recesso(data) VALUES (:data);";
		$data = $recesso->getData();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":data", $data, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(Recesso $recesso){
        $sql = "INSERT INTO recesso(id, data) VALUES (:id, :data);";
		$id = $recesso->getId();
		$data = $recesso->getData();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":data", $data, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function delete(Recesso $recesso){
		$id = $recesso->getId();
		$sql = "DELETE FROM recesso WHERE id = :id";
		    
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
		$sql = "SELECT recesso.id, recesso.data FROM recesso LIMIT 1000";

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
		        $recesso = new Recesso();
                $recesso->setId( $row ['id'] );
                $recesso->setData( $row ['data'] );
                $list [] = $recesso;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(Recesso $recesso) {
        $lista = array();
	    $id = $recesso->getId();
                
        $sql = "SELECT recesso.id, recesso.data FROM recesso
            WHERE recesso.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $recesso = new Recesso();
                $recesso->setId( $row ['id'] );
                $recesso->setData( $row ['data'] );
                $lista [] = $recesso;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByData(Recesso $recesso) {
        $lista = array();
	    $data = $recesso->getData();
                
        $sql = "SELECT recesso.id, recesso.data FROM recesso
            WHERE recesso.data like :data";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":data", $data, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $recesso = new Recesso();
                $recesso->setId( $row ['id'] );
                $recesso->setData( $row ['data'] );
                $lista [] = $recesso;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(Recesso $recesso) {
        
	    $id = $recesso->getId();
	    $sql = "SELECT recesso.id, recesso.data FROM recesso
                WHERE recesso.id = :id
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
                $recesso->setId( $row ['id'] );
                $recesso->setData( $row ['data'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $recesso;
    }
                
    public function fillByData(Recesso $recesso) {
        
	    $data = $recesso->getData();
	    $sql = "SELECT recesso.id, recesso.data FROM recesso
                WHERE recesso.data = :data
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":data", $data, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $recesso->setId( $row ['id'] );
                $recesso->setData( $row ['data'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $recesso;
    }
}