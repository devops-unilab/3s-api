<?php
            
/**
 * Classe feita para manipulação do objeto Status
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace app3s\dao;
use PDO;
use PDOException;
use app3s\model\Status;

class StatusDAO extends DAO {
    
    

            
            
    public function update(Status $status)
    {
        $id = $status->getId();
            
            
        $sql = "UPDATE status
                SET
                sigla = :sigla,
                nome = :nome
                WHERE status.id = :id;";
			$sigla = $status->getSigla();
			$nome = $status->getNome();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(Status $status){
        $sql = "INSERT INTO status(sigla, nome) VALUES (:sigla, :nome);";
		$sigla = $status->getSigla();
		$nome = $status->getNome();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(Status $status){
        $sql = "INSERT INTO status(id, sigla, nome) VALUES (:id, :sigla, :nome);";
		$id = $status->getId();
		$sigla = $status->getSigla();
		$nome = $status->getNome();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }

	public function delete(Status $status){
		$id = $status->getId();
		$sql = "DELETE FROM status WHERE id = :id";
		    
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
		$sql = "SELECT status.id, status.sigla, status.nome FROM status LIMIT 1000";

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
		        $status = new Status();
                $status->setId( $row ['id'] );
                $status->setSigla( $row ['sigla'] );
                $status->setNome( $row ['nome'] );
                $list [] = $status;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(Status $status) {
        $lista = array();
	    $id = $status->getId();
                
        $sql = "SELECT status.id, status.sigla, status.nome FROM status
            WHERE status.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $status = new Status();
                $status->setId( $row ['id'] );
                $status->setSigla( $row ['sigla'] );
                $status->setNome( $row ['nome'] );
                $lista [] = $status;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchBySigla(Status $status) {
        $lista = array();
	    $sigla = $status->getSigla();
                
        $sql = "SELECT status.id, status.sigla, status.nome FROM status
            WHERE status.sigla like :sigla";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $status = new Status();
                $status->setId( $row ['id'] );
                $status->setSigla( $row ['sigla'] );
                $status->setNome( $row ['nome'] );
                $lista [] = $status;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByNome(Status $status) {
        $lista = array();
	    $nome = $status->getNome();
                
        $sql = "SELECT status.id, status.sigla, status.nome FROM status
            WHERE status.nome like :nome";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $status = new Status();
                $status->setId( $row ['id'] );
                $status->setSigla( $row ['sigla'] );
                $status->setNome( $row ['nome'] );
                $lista [] = $status;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(Status $status) {
        
	    $id = $status->getId();
	    $sql = "SELECT status.id, status.sigla, status.nome FROM status
                WHERE status.id = :id
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
                $status->setId( $row ['id'] );
                $status->setSigla( $row ['sigla'] );
                $status->setNome( $row ['nome'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $status;
    }
                
    public function fillBySigla(Status $status) {
        
	    $sigla = $status->getSigla();
	    $sql = "SELECT status.id, status.sigla, status.nome FROM status
                WHERE status.sigla = :sigla
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":sigla", $sigla, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $status->setId( $row ['id'] );
                $status->setSigla( $row ['sigla'] );
                $status->setNome( $row ['nome'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $status;
    }
                
    public function fillByNome(Status $status) {
        
	    $nome = $status->getNome();
	    $sql = "SELECT status.id, status.sigla, status.nome FROM status
                WHERE status.nome = :nome
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $status->setId( $row ['id'] );
                $status->setSigla( $row ['sigla'] );
                $status->setNome( $row ['nome'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $status;
    }
}