<?php
                
/**
 * Classe feita para manipulação do objeto PermissaoUsuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class PermissaoUsuarioDAO extends DAO {
    


            
            
    public function atualizar(PermissaoUsuario $permissaoUsuario)
    {
        $id = $permissaoUsuario->getId();
            
            
        $sql = "UPDATE permissao_usuario
                SET
                perfil = :perfil,
                id_usuario_sigaa = :idUsuarioSigaa,
                usuario = :usuario,
                email = :email
                WHERE permissao_usuario.id = :id;";
			$perfil = $permissaoUsuario->getPerfil();
			$idUsuarioSigaa = $permissaoUsuario->getIdUsuarioSigaa();
			$usuario = $permissaoUsuario->getUsuario();
			$email = $permissaoUsuario->getEmail();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":perfil", $perfil, PDO::PARAM_STR);
			$stmt->bindParam(":idUsuarioSigaa", $idUsuarioSigaa, PDO::PARAM_INT);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(PermissaoUsuario $permissaoUsuario){
        $sql = "INSERT INTO permissao_usuario(perfil, id_usuario_sigaa, usuario, email, id_setor) VALUES (:perfil, :idUsuarioSigaa, :usuario, :email, :setor);";
		$perfil = $permissaoUsuario->getPerfil();
		$idUsuarioSigaa = $permissaoUsuario->getIdUsuarioSigaa();
		$usuario = $permissaoUsuario->getUsuario();
		$email = $permissaoUsuario->getEmail();
		$setor = $permissaoUsuario->getSetor()->getId();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":perfil", $perfil, PDO::PARAM_STR);
			$stmt->bindParam(":idUsuarioSigaa", $idUsuarioSigaa, PDO::PARAM_INT);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(PermissaoUsuario $permissaoUsuario){
        $sql = "INSERT INTO permissao_usuario(id, perfil, id_usuario_sigaa, usuario, email, id_area_responsavel_setor) VALUES (:id, :perfil, :idUsuarioSigaa, :usuario, :email, :setor);";
		$id = $permissaoUsuario->getId();
		$perfil = $permissaoUsuario->getPerfil();
		$idUsuarioSigaa = $permissaoUsuario->getIdUsuarioSigaa();
		$usuario = $permissaoUsuario->getUsuario();
		$email = $permissaoUsuario->getEmail();
		$setor = $permissaoUsuario->getSetor()->getId();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":perfil", $perfil, PDO::PARAM_STR);
			$stmt->bindParam(":idUsuarioSigaa", $idUsuarioSigaa, PDO::PARAM_INT);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(PermissaoUsuario $permissaoUsuario){
		$id = $permissaoUsuario->getId();
		$sql = "DELETE FROM permissao_usuario WHERE id = :id";
		    
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
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
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
		        $permissaoUsuario = new PermissaoUsuario();
                $permissaoUsuario->setId( $linha ['id'] );
                $permissaoUsuario->setPerfil( $linha ['perfil'] );
                $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
                $permissaoUsuario->setUsuario( $linha ['usuario'] );
                $permissaoUsuario->setEmail( $linha ['email'] );
                $permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
                $lista [] = $permissaoUsuario;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(PermissaoUsuario $permissaoUsuario) {
        $lista = array();
	    $id = $permissaoUsuario->getId();
                
        $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
            WHERE permissao_usuario.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $permissaoUsuario = new PermissaoUsuario();
    	        $permissaoUsuario->setId( $linha ['id'] );
    	        $permissaoUsuario->setPerfil( $linha ['perfil'] );
    	        $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
    	        $permissaoUsuario->setUsuario( $linha ['usuario'] );
    	        $permissaoUsuario->setEmail( $linha ['email'] );
    			$permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
    			$lista [] = $permissaoUsuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorPerfil(PermissaoUsuario $permissaoUsuario) {
        $lista = array();
	    $perfil = $permissaoUsuario->getPerfil();
                
        $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
            WHERE permissao_usuario.perfil like :perfil";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":perfil", $perfil, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $permissaoUsuario = new PermissaoUsuario();
    	        $permissaoUsuario->setId( $linha ['id'] );
    	        $permissaoUsuario->setPerfil( $linha ['perfil'] );
    	        $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
    	        $permissaoUsuario->setUsuario( $linha ['usuario'] );
    	        $permissaoUsuario->setEmail( $linha ['email'] );
    			$permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
    			$lista [] = $permissaoUsuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdUsuarioSigaa(PermissaoUsuario $permissaoUsuario) {
        $lista = array();
	    $idUsuarioSigaa = $permissaoUsuario->getIdUsuarioSigaa();
                
        $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
            WHERE permissao_usuario.id_usuario_sigaa = :idUsuarioSigaa";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idUsuarioSigaa", $idUsuarioSigaa, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $permissaoUsuario = new PermissaoUsuario();
    	        $permissaoUsuario->setId( $linha ['id'] );
    	        $permissaoUsuario->setPerfil( $linha ['perfil'] );
    	        $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
    	        $permissaoUsuario->setUsuario( $linha ['usuario'] );
    	        $permissaoUsuario->setEmail( $linha ['email'] );
    			$permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
    			$lista [] = $permissaoUsuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorUsuario(PermissaoUsuario $permissaoUsuario) {
        $lista = array();
	    $usuario = $permissaoUsuario->getUsuario();
                
        $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
            WHERE permissao_usuario.usuario like :usuario";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $permissaoUsuario = new PermissaoUsuario();
    	        $permissaoUsuario->setId( $linha ['id'] );
    	        $permissaoUsuario->setPerfil( $linha ['perfil'] );
    	        $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
    	        $permissaoUsuario->setUsuario( $linha ['usuario'] );
    	        $permissaoUsuario->setEmail( $linha ['email'] );
    			$permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
    			$lista [] = $permissaoUsuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorEmail(PermissaoUsuario $permissaoUsuario) {
        $lista = array();
	    $email = $permissaoUsuario->getEmail();
                
        $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
            WHERE permissao_usuario.email like :email";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $permissaoUsuario = new PermissaoUsuario();
    	        $permissaoUsuario->setId( $linha ['id'] );
    	        $permissaoUsuario->setPerfil( $linha ['perfil'] );
    	        $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
    	        $permissaoUsuario->setUsuario( $linha ['usuario'] );
    	        $permissaoUsuario->setEmail( $linha ['email'] );
    			$permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
    			$lista [] = $permissaoUsuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(PermissaoUsuario $permissaoUsuario) {
        
	    $id = $permissaoUsuario->getId();
	    $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
                WHERE permissao_usuario.id = :id
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
                $permissaoUsuario->setId( $linha ['id'] );
                $permissaoUsuario->setPerfil( $linha ['perfil'] );
                $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
                $permissaoUsuario->setUsuario( $linha ['usuario'] );
                $permissaoUsuario->setEmail( $linha ['email'] );
                $permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $permissaoUsuario;
    }
                
    public function preenchePorPerfil(PermissaoUsuario $permissaoUsuario) {
        
	    $perfil = $permissaoUsuario->getPerfil();
	    $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
                WHERE permissao_usuario.perfil = :perfil
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":perfil", $perfil, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $permissaoUsuario->setId( $linha ['id'] );
                $permissaoUsuario->setPerfil( $linha ['perfil'] );
                $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
                $permissaoUsuario->setUsuario( $linha ['usuario'] );
                $permissaoUsuario->setEmail( $linha ['email'] );
                $permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $permissaoUsuario;
    }
                
    public function preenchePorIdUsuarioSigaa(PermissaoUsuario $permissaoUsuario) {
        
	    $idUsuarioSigaa = $permissaoUsuario->getIdUsuarioSigaa();
	    $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
                WHERE permissao_usuario.id_usuario_sigaa = :idUsuarioSigaa
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idUsuarioSigaa", $idUsuarioSigaa, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $permissaoUsuario->setId( $linha ['id'] );
                $permissaoUsuario->setPerfil( $linha ['perfil'] );
                $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
                $permissaoUsuario->setUsuario( $linha ['usuario'] );
                $permissaoUsuario->setEmail( $linha ['email'] );
                $permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $permissaoUsuario;
    }
                
    public function preenchePorUsuario(PermissaoUsuario $permissaoUsuario) {
        
	    $usuario = $permissaoUsuario->getUsuario();
	    $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
                WHERE permissao_usuario.usuario = :usuario
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $permissaoUsuario->setId( $linha ['id'] );
                $permissaoUsuario->setPerfil( $linha ['perfil'] );
                $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
                $permissaoUsuario->setUsuario( $linha ['usuario'] );
                $permissaoUsuario->setEmail( $linha ['email'] );
                $permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $permissaoUsuario;
    }
                
    public function preenchePorEmail(PermissaoUsuario $permissaoUsuario) {
        
	    $email = $permissaoUsuario->getEmail();
	    $sql = "
		SELECT
        permissao_usuario.id, 
        permissao_usuario.perfil, 
        permissao_usuario.id_usuario_sigaa, 
        permissao_usuario.usuario, 
        permissao_usuario.email, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor, 
        setor.id_admin as id_admin_area_responsavel_setor
		FROM permissao_usuario
		INNER JOIN area_responsavel as setor ON setor.id = permissao_usuario.id_setor
                WHERE permissao_usuario.email = :email
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
                $permissaoUsuario->setId( $linha ['id'] );
                $permissaoUsuario->setPerfil( $linha ['perfil'] );
                $permissaoUsuario->setIdUsuarioSigaa( $linha ['id_usuario_sigaa'] );
                $permissaoUsuario->setUsuario( $linha ['usuario'] );
                $permissaoUsuario->setEmail( $linha ['email'] );
                $permissaoUsuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                $permissaoUsuario->getSetor()->setIdAdmin( $linha ['id_admin_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $permissaoUsuario;
    }
}