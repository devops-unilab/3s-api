<?php
            
/**
 * Classe feita para manipulação do objeto MensagemForum
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace novissimo3s\dao;
use PDO;
use PDOException;
use novissimo3s\model\MensagemForum;
use novissimo3s\model\Ocorrencia;

class MensagemForumDAO extends DAO {
    
    

            
            
    public function update(MensagemForum $mensagemForum)
    {
        $id = $mensagemForum->getId();
            
            
        $sql = "UPDATE mensagem_forum
                SET
                tipo = :tipo,
                mensagem = :mensagem,
                data_envio = :dataEnvio
                WHERE mensagem_forum.id = :id;";
			$tipo = $mensagemForum->getTipo();
			$mensagem = $mensagemForum->getMensagem();
			$dataEnvio = $mensagemForum->getDataEnvio();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(MensagemForum $mensagemForum, Ocorrencia $ocorrencia){
        $sql = "INSERT INTO mensagem_forum(tipo, mensagem, id_usuario, data_envio, id_ocorrencia) VALUES (:tipo, :mensagem, :usuario, :dataEnvio, :idOcorrencia);";
		$tipo = $mensagemForum->getTipo();
		$mensagem = $mensagemForum->getMensagem();
		$usuario = $mensagemForum->getUsuario()->getId();
		$dataEnvio = $mensagemForum->getDataEnvio();
        $idOcorrencia = $ocorrencia->getId();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
			$stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
			$stmt->bindParam(":idOcorrencia", $idOcorrencia, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(MensagemForum $mensagemForum, Ocorrencia $ocorrencia){
        $sql = "INSERT INTO mensagem_forum(id, tipo, mensagem, id_usuario, data_envio, id_ocorrencia) VALUES (:id, :tipo, :mensagem, :usuario, :dataEnvio, :idOcorrencia);";
		$id = $mensagemForum->getId();
		$tipo = $mensagemForum->getTipo();
		$mensagem = $mensagemForum->getMensagem();
		$usuario = $mensagemForum->getUsuario()->getId();
		$dataEnvio = $mensagemForum->getDataEnvio();
        $idOcorrencia = $ocorrencia->getId();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
			$stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
			$stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
			$stmt->bindParam(":idOcorrencia", $idOcorrencia, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }

	public function delete(MensagemForum $mensagemForum){
		$id = $mensagemForum->getId();
		$sql = "DELETE FROM mensagem_forum WHERE id = :id";
		    
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
		$sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario LIMIT 1000";

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
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $list [] = $mensagemForum;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(MensagemForum $mensagemForum) {
        $lista = array();
	    $id = $mensagemForum->getId();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByTipo(MensagemForum $mensagemForum) {
        $lista = array();
	    $tipo = $mensagemForum->getTipo();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.tipo = :tipo";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByMensagem(MensagemForum $mensagemForum) {
        $lista = array();
	    $mensagem = $mensagemForum->getMensagem();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.mensagem like :mensagem";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByUsuario(MensagemForum $mensagemForum) {
        $lista = array();
	    $usuario = $mensagemForum->getUsuario()->getId();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.id_usuario = :usuario";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByDataEnvio(MensagemForum $mensagemForum) {
        $lista = array();
	    $dataEnvio = $mensagemForum->getDataEnvio();
                
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE mensagem_forum.data_envio like :dataEnvio";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $mensagemForum;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(MensagemForum $mensagemForum) {
        
	    $id = $mensagemForum->getId();
	    $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                WHERE mensagem_forum.id = :id
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
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function fillByTipo(MensagemForum $mensagemForum) {
        
	    $tipo = $mensagemForum->getTipo();
	    $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                WHERE mensagem_forum.tipo = :tipo
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function fillByMensagem(MensagemForum $mensagemForum) {
        
	    $mensagem = $mensagemForum->getMensagem();
	    $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                WHERE mensagem_forum.mensagem = :mensagem
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
                
    public function fillByDataEnvio(MensagemForum $mensagemForum) {
        
	    $dataEnvio = $mensagemForum->getDataEnvio();
	    $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                WHERE mensagem_forum.data_envio = :dataEnvio
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dataEnvio", $dataEnvio, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $mensagemForum;
    }
	public function fetchByNN(Ocorrencia $ocorrencia) {
		$list = array ();
        $idOcorrencia = $ocorrencia->getId();
		$sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
                    WHERE mensagem_forum.id_ocorrencia = :idOcorrencia LIMIT 1000";
            
        try {
            $stmt = $this->connection->prepare($sql);
            
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		        return $list;
		    }
            $stmt->bindParam(":idOcorrencia", $idOcorrencia, PDO::PARAM_INT);

            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row)
            {
		        $mensagemForum = new MensagemForum();
                $mensagemForum->setId( $row ['id'] );
                $mensagemForum->setTipo( $row ['tipo'] );
                $mensagemForum->setMensagem( $row ['mensagem'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $list [] = $mensagemForum;
            
            
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;
    }
        
}