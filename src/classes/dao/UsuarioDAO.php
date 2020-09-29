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
                nivel = :nivel,
                id_setor = :idSetor
                WHERE usuario.id = :id;";
			$nome = $usuario->getNome();
			$email = $usuario->getEmail();
			$login = $usuario->getLogin();
			$senha = $usuario->getSenha();
			$nivel = $usuario->getNivel();
			$idSetor = $usuario->getIdSetor();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
			$stmt->bindParam(":idSetor", $idSetor, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

	public function retornaLista() {
		$lista = array ();
		$sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario LIMIT 1000";

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
                $usuario->setIdSetor( $linha ['id_setor'] );
                $lista [] = $usuario;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
    public function inserir(Usuario $usuario){
        $sql = "INSERT INTO usuario(nome, email, login, senha, nivel, id_setor) VALUES (:nome, :email, :login, :senha, :nivel, :idSetor);";
		$nome = $usuario->getNome();
		$email = $usuario->getEmail();
		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$nivel = $usuario->getNivel();
		$idSetor = $usuario->getIdSetor();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
			$stmt->bindParam(":idSetor", $idSetor, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(Usuario $usuario){
        $sql = "INSERT INTO usuario(id, nome, email, login, senha, nivel, id_setor) VALUES (:id, :nome, :email, :login, :senha, :nivel, :idSetor);";
		$id = $usuario->getId();
		$nome = $usuario->getNome();
		$email = $usuario->getEmail();
		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$nivel = $usuario->getNivel();
		$idSetor = $usuario->getIdSetor();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
			$stmt->bindParam(":idSetor", $idSetor, PDO::PARAM_INT);
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


                
    public function pesquisaPorId(Usuario $usuario) {
        $lista = array();
	    $id = $usuario->getId();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $usuario = new Usuario();
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->setIdSetor( $linha ['id_setor'] );
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
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.nome like :nome";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $usuario = new Usuario();
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->setIdSetor( $linha ['id_setor'] );
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
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.email like :email";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $usuario = new Usuario();
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->setIdSetor( $linha ['id_setor'] );
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
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.login like :login";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $usuario = new Usuario();
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->setIdSetor( $linha ['id_setor'] );
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
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.senha like :senha";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $usuario = new Usuario();
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->setIdSetor( $linha ['id_setor'] );
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
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.nivel like :nivel";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $usuario = new Usuario();
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->setIdSetor( $linha ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdSetor(Usuario $usuario) {
        $lista = array();
	    $idSetor = $usuario->getIdSetor();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.id_setor = :idSetor";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idSetor", $idSetor, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
		        $usuario = new Usuario();
                $usuario->setId( $linha ['id'] );
                $usuario->setNome( $linha ['nome'] );
                $usuario->setEmail( $linha ['email'] );
                $usuario->setLogin( $linha ['login'] );
                $usuario->setSenha( $linha ['senha'] );
                $usuario->setNivel( $linha ['nivel'] );
                $usuario->setIdSetor( $linha ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(Usuario $usuario) {
        
	    $id = $usuario->getId();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
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
                $usuario->setIdSetor( $linha ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorNome(Usuario $usuario) {
        
	    $nome = $usuario->getNome();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
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
                $usuario->setIdSetor( $linha ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorEmail(Usuario $usuario) {
        
	    $email = $usuario->getEmail();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
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
                $usuario->setIdSetor( $linha ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorLogin(Usuario $usuario) {
        
	    $login = $usuario->getLogin();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
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
                $usuario->setIdSetor( $linha ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorSenha(Usuario $usuario) {
        
	    $senha = $usuario->getSenha();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
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
                $usuario->setIdSetor( $linha ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorNivel(Usuario $usuario) {
        
	    $nivel = $usuario->getNivel();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
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
                $usuario->setIdSetor( $linha ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function preenchePorIdSetor(Usuario $usuario) {
        
	    $idSetor = $usuario->getIdSetor();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
                WHERE usuario.id_setor = :idSetor
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idSetor", $idSetor, PDO::PARAM_INT);
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
                $usuario->setIdSetor( $linha ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
}