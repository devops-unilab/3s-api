<?php
            
/**
 * Classe feita para manipulação do objeto Usuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace app3s\dao;
use PDO;
use PDOException;
use app3s\model\Usuario;
use app3s\util\Sessao;

class UsuarioDAO extends DAO {

	/**
	 * Undocumented function
	 *
	 * @param PDO|null $connection
	 * @param string $type
	 */
	public function __construct(PDO $connection = null, $type = "default") {
	    $this->type = $type;
		if ($connection  != null) {
			$this->connection = $connection;
		} else {
			$this->connect();
		}
	}
    
    public function getIdUnidade(Usuario $usuario){
        $idUnidade = array();
        $id = $usuario->getId();
        $daoSIGAA = new DAO(null, "SIG");
        $sql2 = "SELECT
                *
                FROM vw_autenticacao_3s
                WHERE id = :id LIMIT 1";
        try {
            $stmt = $daoSIGAA->getConnection()->prepare($sql2);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha2 ) {
                
                if($linha2['id_status_servidor'] == 1)
                {
                    $idUnidade[$linha2['id_unidade']] = $linha2['sigla_unidade'];
                    return $idUnidade;//Status Inativo
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            return $idUnidade;
        }
        return $idUnidade;
        
    }

  /**
     * Verifica na base de autenticação se usuário está ativo ou não.
     * @param Usuario $usuario
     * @return boolean
     */
    public function usuarioAtivo(Usuario $usuario){
        $id = $usuario->getId();
        $daoSIGAA = new DAO(null, "SIG");
        $sql2 = "SELECT
                *
                FROM vw_autenticacao_3s
                WHERE id = :id LIMIT 1";
        try {
            $stmt = $daoSIGAA->getConnection()->prepare($sql2);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha2 ) {
                
                if($linha2['id_status_servidor'] == 1)
                {
                    
                    return true;//Status Inativo
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return false;
        
    }
    


    public function autenticar(Usuario $usuario)
    {
        
        $login = $usuario->getLogin();
        $senha = $usuario->getSenha() ;
        
        $sql = "SELECT * FROM
                usuario WHERE
                LOWER(login) =  LOWER(:login) AND senha = :senha LIMIT 1";
        
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $usuario->setId( $linha ['id'] );
                $usuario->setNome($linha['nome']);
                $usuario->setEmail( $linha ['email'] );
                $usuario->setNivel($linha['nivel']);
                
                return true;
//                 if($this->usuarioAtivo($usuario)){
                    
//                     return true;
//                 }else{
//                     return false;
//                 }
                
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        
        $daoSIGAA = new DAO(null, "SIG");
        
        $sql2 = "SELECT * FROM vw_autenticacao_3s
                WHERE LOWER(login) = LOWER(:login)
                AND senha = :senha LIMIT 1";
        
        
        try {
            $stmt2 = $daoSIGAA->getConnection()->prepare($sql2);
            $stmt2->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt2->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt2->execute();
            $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result2 as $linha2 ) {
                $usuario->setId($linha2['id']);
//                 if($linha2['id_status_servidor'] != 1){
//                     return false;//Status Inativo
//                 }//Verificar se servidor ativo; 
                
                if(sizeof($this->fetchById($usuario)) == 0)
                {
                    $usuario->setNome($linha2['nome']);
                    $usuario->setEmail($linha2['email']);
                    $usuario->setNivel(Sessao::NIVEL_COMUM);
                    $this->insertWithPK($usuario);
                    
                    return true;
                }
                else
                {
                    
                    $this->fillById($usuario);
                    $usuario->setNome($linha2['nome']);
                    $usuario->setEmail($linha2['email']);
                    $usuario->setLogin($linha2['login']);
                    $usuario->setSenha($linha2['senha']);
                    $this->update($usuario);
                    return true;
                }
                
            }
            
            return false;
        } catch(PDOException $e) {
            echo $e->getMessage();
            
            return false;
        }
        
    }
    

            
            
    public function update(Usuario $usuario)
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
            
            $stmt = $this->getConnection()->prepare($sql);
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
            
            

    public function insert(Usuario $usuario){
        $sql = "INSERT INTO usuario(nome, email, login, senha, nivel, id_setor) VALUES (:nome, :email, :login, :senha, :nivel, :idSetor);";
		$nome = $usuario->getNome();
		$email = $usuario->getEmail();
		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$nivel = $usuario->getNivel();
		$idSetor = $usuario->getIdSetor();
		try {
			$db = $this->getConnection();
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
    public function insertWithPK(Usuario $usuario){
        $sql = "INSERT INTO usuario(id, nome, email, login, senha, nivel, id_setor) VALUES (:id, :nome, :email, :login, :senha, :nivel, :idSetor);";
		$id = $usuario->getId();
		$nome = $usuario->getNome();
		$email = $usuario->getEmail();
		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$nivel = $usuario->getNivel();
		$idSetor = $usuario->getIdSetor();
		try {
			$db = $this->getConnection();
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

	public function delete(Usuario $usuario){
		$id = $usuario->getId();
		$sql = "DELETE FROM usuario WHERE id = :id";
		    
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
		$sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario LIMIT 1000";

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
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                $list [] = $usuario;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(Usuario $usuario) {
        $lista = array();
	    $id = $usuario->getId();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByNome(Usuario $usuario) {
        $lista = array();
	    $nome = $usuario->getNome();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.nome like :nome";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByEmail(Usuario $usuario) {
        $lista = array();
	    $email = $usuario->getEmail();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.email like :email";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByLogin(Usuario $usuario) {
        $lista = array();
	    $login = $usuario->getLogin();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.login like :login";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchBySenha(Usuario $usuario) {
        $lista = array();
	    $senha = $usuario->getSenha();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.senha like :senha";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByNivel(Usuario $usuario) {
        $lista = array();
	    $nivel = $usuario->getNivel();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.nivel like :nivel";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByIdSetor(Usuario $usuario) {
        $lista = array();
	    $idSetor = $usuario->getIdSetor();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
            WHERE usuario.id_setor = :idSetor";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":idSetor", $idSetor, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(Usuario $usuario) {
        
	    $id = $usuario->getId();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
                WHERE usuario.id = :id
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
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByNome(Usuario $usuario) {
        
	    $nome = $usuario->getNome();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
                WHERE usuario.nome = :nome
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
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByEmail(Usuario $usuario) {
        
	    $email = $usuario->getEmail();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
                WHERE usuario.email = :email
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByLogin(Usuario $usuario) {
        
	    $login = $usuario->getLogin();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
                WHERE usuario.login = :login
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillBySenha(Usuario $usuario) {
        
	    $senha = $usuario->getSenha();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
                WHERE usuario.senha = :senha
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByNivel(Usuario $usuario) {
        
	    $nivel = $usuario->getNivel();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
                WHERE usuario.nivel = :nivel
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByIdSetor(Usuario $usuario) {
        
	    $idSetor = $usuario->getIdSetor();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel, usuario.id_setor FROM usuario
                WHERE usuario.id_setor = :idSetor
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idSetor", $idSetor, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $usuario->setIdSetor( $row ['id_setor'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
}