<?php
            
/**
 * Classe feita para manipulação do objeto AreaResponsavel
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */
     
     
     
class AreaResponsavelDAO extends DAO {
    
    

            
            
    public function atualizar(AreaResponsavel $areaResponsavel)
    {
        $id = $areaResponsavel->getId();
            
            
        $sql = "UPDATE area_responsavel
                SET
                nome = :nome,
                descricao = :descricao,
                email = :email
                WHERE area_responsavel.id = :id;";
			$nome = $areaResponsavel->getNome();
			$descricao = $areaResponsavel->getDescricao();
			$email = $areaResponsavel->getEmail();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

	public function retornaLista() {
		$lista = array ();
		$sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel LIMIT 1000";

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
		        $areaResponsavel = new AreaResponsavel();
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                $lista [] = $areaResponsavel;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
    public function inserir(AreaResponsavel $areaResponsavel){
        $sql = "INSERT INTO area_responsavel(nome, descricao, email) VALUES (:nome, :descricao, :email);";
		$nome = $areaResponsavel->getNome();
		$descricao = $areaResponsavel->getDescricao();
		$email = $areaResponsavel->getEmail();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(AreaResponsavel $areaResponsavel){
        $sql = "INSERT INTO area_responsavel(id, nome, descricao, email) VALUES (:id, :nome, :descricao, :email);";
		$id = $areaResponsavel->getId();
		$nome = $areaResponsavel->getNome();
		$descricao = $areaResponsavel->getDescricao();
		$email = $areaResponsavel->getEmail();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(AreaResponsavel $areaResponsavel){
		$id = $areaResponsavel->getId();
		$sql = "DELETE FROM area_responsavel WHERE id = :id";
		    
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			return $stmt->execute();
			    
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}


                
    public function pesquisaPorId(AreaResponsavel $areaResponsavel) {
        $lista = array();
	    $id = $areaResponsavel->getId();
                
        $sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel
            WHERE area_responsavel.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $areaResponsavel = new AreaResponsavel();
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                $lista [] = $areaResponsavel;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorNome(AreaResponsavel $areaResponsavel) {
        $lista = array();
	    $nome = $areaResponsavel->getNome();
                
        $sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel
            WHERE area_responsavel.nome like :nome";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $areaResponsavel = new AreaResponsavel();
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                $lista [] = $areaResponsavel;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDescricao(AreaResponsavel $areaResponsavel) {
        $lista = array();
	    $descricao = $areaResponsavel->getDescricao();
                
        $sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel
            WHERE area_responsavel.descricao like :descricao";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $areaResponsavel = new AreaResponsavel();
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                $lista [] = $areaResponsavel;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorEmail(AreaResponsavel $areaResponsavel) {
        $lista = array();
	    $email = $areaResponsavel->getEmail();
                
        $sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel
            WHERE area_responsavel.email like :email";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $areaResponsavel = new AreaResponsavel();
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                $lista [] = $areaResponsavel;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(AreaResponsavel $areaResponsavel) {
        
	    $id = $areaResponsavel->getId();
	    $sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel
                WHERE area_responsavel.id = :id
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
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $areaResponsavel;
    }
                
    public function preenchePorNome(AreaResponsavel $areaResponsavel) {
        
	    $nome = $areaResponsavel->getNome();
	    $sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel
                WHERE area_responsavel.nome = :nome
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
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $areaResponsavel;
    }
                
    public function preenchePorDescricao(AreaResponsavel $areaResponsavel) {
        
	    $descricao = $areaResponsavel->getDescricao();
	    $sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel
                WHERE area_responsavel.descricao = :descricao
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $areaResponsavel;
    }
                
    public function preenchePorEmail(AreaResponsavel $areaResponsavel) {
        
	    $email = $areaResponsavel->getEmail();
	    $sql = "SELECT area_responsavel.id, area_responsavel.nome, area_responsavel.descricao, area_responsavel.email FROM area_responsavel
                WHERE area_responsavel.email = :email
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $areaResponsavel->setId( $linha ['id'] );
                $areaResponsavel->setNome( $linha ['nome'] );
                $areaResponsavel->setDescricao( $linha ['descricao'] );
                $areaResponsavel->setEmail( $linha ['email'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $areaResponsavel;
    }
}