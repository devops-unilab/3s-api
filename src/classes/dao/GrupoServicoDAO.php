<?php
                
/**
 * Classe feita para manipulação do objeto GrupoServico
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class GrupoServicoDAO extends DAO {
    


            
            
    public function atualizar(GrupoServico $grupoServico)
    {
        $id = $grupoServico->getId();
            
            
        $sql = "UPDATE grupo_servico
                SET
                nome = :nome
                WHERE grupo_servico.id = :id;";
			$nome = $grupoServico->getNome();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(GrupoServico $grupoServico){
        $sql = "INSERT INTO grupo_servico(nome) VALUES (:nome);";
		$nome = $grupoServico->getNome();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(GrupoServico $grupoServico){
        $sql = "INSERT INTO grupo_servico(id, nome) VALUES (:id, :nome);";
		$id = $grupoServico->getId();
		$nome = $grupoServico->getNome();
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

	public function excluir(GrupoServico $grupoServico){
		$id = $grupoServico->getId();
		$sql = "DELETE FROM grupo_servico WHERE id = :id";
		    
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
        grupo_servico.id, 
        grupo_servico.nome
		FROM grupo_servico
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
		        $grupoServico = new GrupoServico();
                $grupoServico->setId( $linha ['id'] );
                $grupoServico->setNome( $linha ['nome'] );
                $lista [] = $grupoServico;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(GrupoServico $grupoServico) {
        $lista = array();
	    $id = $grupoServico->getId();
                
        $sql = "
		SELECT
        grupo_servico.id, 
        grupo_servico.nome
		FROM grupo_servico
            WHERE grupo_servico.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $grupoServico = new GrupoServico();
                $grupoServico->setId( $linha ['id'] );
                $grupoServico->setNome( $linha ['nome'] );
                $lista [] = $grupoServico;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorNome(GrupoServico $grupoServico) {
        $lista = array();
	    $nome = $grupoServico->getNome();
                
        $sql = "
		SELECT
        grupo_servico.id, 
        grupo_servico.nome
		FROM grupo_servico
            WHERE grupo_servico.nome like :nome";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $grupoServico = new GrupoServico();
                $grupoServico->setId( $linha ['id'] );
                $grupoServico->setNome( $linha ['nome'] );
                $lista [] = $grupoServico;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(GrupoServico $grupoServico) {
        
	    $id = $grupoServico->getId();
	    $sql = "
		SELECT
        grupo_servico.id, 
        grupo_servico.nome
		FROM grupo_servico
                WHERE grupo_servico.id = :id
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
                $grupoServico->setId( $linha ['id'] );
                $grupoServico->setNome( $linha ['nome'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $grupoServico;
    }
                
    public function preenchePorNome(GrupoServico $grupoServico) {
        
	    $nome = $grupoServico->getNome();
	    $sql = "
		SELECT
        grupo_servico.id, 
        grupo_servico.nome
		FROM grupo_servico
                WHERE grupo_servico.nome = :nome
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
                $grupoServico->setId( $linha ['id'] );
                $grupoServico->setNome( $linha ['nome'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $grupoServico;
    }
}