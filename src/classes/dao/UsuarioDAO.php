<?php
                
/**
 * Classe feita para manipulação do objeto Usuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class UsuarioDAO extends DAO {
    


            
            
    public function atualizar(Usuario $usuario)
    {
        $id = $usuario->getId();
            
            
        $sql = "UPDATE usuario
                SET
                nome = :nome,
                email = :email,
                login = :login,
                senha = :senha,
                nivel = :nivel
                WHERE usuario.id = :id;";
			$nome = $usuario->getNome();
			$email = $usuario->getEmail();
			$login = $usuario->getLogin();
			$senha = $usuario->getSenha();
			$nivel = $usuario->getNivel();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(Usuario $usuario){
        $sql = "INSERT INTO usuario(nome, email, login, senha, nivel, id_setor) VALUES (:nome, :email, :login, :senha, :nivel, :setor);";
		$nome = $usuario->getNome();
		$email = $usuario->getEmail();
		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$nivel = $usuario->getNivel();
		$setor = $usuario->getSetor()->getId();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
			$stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(Usuario $usuario){
        $sql = "INSERT INTO usuario(id, nome, email, login, senha, nivel, id_area_responsavel_setor) VALUES (:id, :nome, :email, :login, :senha, :nivel, :setor);";
		$id = $usuario->getId();
		$nome = $usuario->getNome();
		$email = $usuario->getEmail();
		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$nivel = $usuario->getNivel();
		$setor = $usuario->getSetor()->getId();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
			$stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(Usuario $usuario){
		$id = $usuario->getId();
		$sql = "DELETE FROM usuario WHERE id = :id";
		    
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
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
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
		        $usuario = new Usuario();
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                $lista [] = $usuario;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(Usuario $usuario) {
        $lista = array();
	    $id = $usuario->getId();
                
        $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
            WHERE usuario.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $usuario = new Usuario();
    	        $usuario->setId( $linha ['id'] );
    	        $usuario->setNome( $linha ['nome'] );
    	        $usuario->setEmail( $linha ['email'] );
    	        $usuario->setLogin( $linha ['login'] );
    	        $usuario->setSenha( $linha ['senha'] );
    	        $usuario->setNivel( $linha ['nivel'] );
    			$usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$lista [] = $usuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorNome(Usuario $usuario) {
        $lista = array();
	    $nome = $usuario->getNome();
                
        $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
            WHERE usuario.nome like :nome";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $usuario = new Usuario();
    	        $usuario->setId( $linha ['id'] );
    	        $usuario->setNome( $linha ['nome'] );
    	        $usuario->setEmail( $linha ['email'] );
    	        $usuario->setLogin( $linha ['login'] );
    	        $usuario->setSenha( $linha ['senha'] );
    	        $usuario->setNivel( $linha ['nivel'] );
    			$usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$lista [] = $usuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorEmail(Usuario $usuario) {
        $lista = array();
	    $email = $usuario->getEmail();
                
        $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
            WHERE usuario.email like :email";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $usuario = new Usuario();
    	        $usuario->setId( $linha ['id'] );
    	        $usuario->setNome( $linha ['nome'] );
    	        $usuario->setEmail( $linha ['email'] );
    	        $usuario->setLogin( $linha ['login'] );
    	        $usuario->setSenha( $linha ['senha'] );
    	        $usuario->setNivel( $linha ['nivel'] );
    			$usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$lista [] = $usuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorLogin(Usuario $usuario) {
        $lista = array();
	    $login = $usuario->getLogin();
                
        $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
            WHERE usuario.login like :login";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $usuario = new Usuario();
    	        $usuario->setId( $linha ['id'] );
    	        $usuario->setNome( $linha ['nome'] );
    	        $usuario->setEmail( $linha ['email'] );
    	        $usuario->setLogin( $linha ['login'] );
    	        $usuario->setSenha( $linha ['senha'] );
    	        $usuario->setNivel( $linha ['nivel'] );
    			$usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$lista [] = $usuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorSenha(Usuario $usuario) {
        $lista = array();
	    $senha = $usuario->getSenha();
                
        $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
            WHERE usuario.senha like :senha";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $usuario = new Usuario();
    	        $usuario->setId( $linha ['id'] );
    	        $usuario->setNome( $linha ['nome'] );
    	        $usuario->setEmail( $linha ['email'] );
    	        $usuario->setLogin( $linha ['login'] );
    	        $usuario->setSenha( $linha ['senha'] );
    	        $usuario->setNivel( $linha ['nivel'] );
    			$usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$lista [] = $usuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorNivel(Usuario $usuario) {
        $lista = array();
	    $nivel = $usuario->getNivel();
                
        $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
            WHERE usuario.nivel like :nivel";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $usuario = new Usuario();
    	        $usuario->setId( $linha ['id'] );
    	        $usuario->setNome( $linha ['nome'] );
    	        $usuario->setEmail( $linha ['email'] );
    	        $usuario->setLogin( $linha ['login'] );
    	        $usuario->setSenha( $linha ['senha'] );
    	        $usuario->setNivel( $linha ['nivel'] );
    			$usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
    			$usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
    			$usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
    			$usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
    			$lista [] = $usuario;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(Usuario $usuario) {
        
	    $id = $usuario->getId();
	    $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
                WHERE usuario.id = :id
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
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorNome(Usuario $usuario) {
        
	    $nome = $usuario->getNome();
	    $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
                WHERE usuario.nome = :nome
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
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorEmail(Usuario $usuario) {
        
	    $email = $usuario->getEmail();
	    $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
                WHERE usuario.email = :email
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
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorLogin(Usuario $usuario) {
        
	    $login = $usuario->getLogin();
	    $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
                WHERE usuario.login = :login
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorSenha(Usuario $usuario) {
        
	    $senha = $usuario->getSenha();
	    $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
                WHERE usuario.senha = :senha
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorNivel(Usuario $usuario) {
        
	    $nivel = $usuario->getNivel();
	    $sql = "
		SELECT
        usuario.id, 
        usuario.nome, 
        usuario.email, 
        usuario.login, 
        usuario.senha, 
        usuario.nivel, 
        setor.id as id_area_responsavel_setor, 
        setor.nome as nome_area_responsavel_setor, 
        setor.descricao as descricao_area_responsavel_setor, 
        setor.email as email_area_responsavel_setor
		FROM usuario
		INNER JOIN area_responsavel as setor ON setor.id = usuario.id_setor
                WHERE usuario.nivel = :nivel
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->getSetor()->setId( $linha ['id_area_responsavel_setor'] );
                $usuario->getSetor()->setNome( $linha ['nome_area_responsavel_setor'] );
                $usuario->getSetor()->setDescricao( $linha ['descricao_area_responsavel_setor'] );
                $usuario->getSetor()->setEmail( $linha ['email_area_responsavel_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
}