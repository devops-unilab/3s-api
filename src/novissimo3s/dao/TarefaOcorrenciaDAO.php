<?php
            
/**
 * Classe feita para manipulação do objeto TarefaOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace novissimo3s\dao;
use PDO;
use PDOException;
use novissimo3s\model\TarefaOcorrencia;


class TarefaOcorrenciaDAO extends DAO {
    
    

            
            
    public function update(TarefaOcorrencia $tarefaOcorrencia)
    {
        $id = $tarefaOcorrencia->getId();
            
            
        $sql = "UPDATE tarefa_ocorrencia
                SET
                tarefa = :tarefa,
                data_inclusao = :dataInclusao
                WHERE tarefa_ocorrencia.id = :id;";
			$tarefa = $tarefaOcorrencia->getTarefa();
			$dataInclusao = $tarefaOcorrencia->getDataInclusao();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
			$stmt->bindParam(":dataInclusao", $dataInclusao, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(TarefaOcorrencia $tarefaOcorrencia){
        $sql = "INSERT INTO tarefa_ocorrencia(id_ocorrencia, tarefa, id_usuario, data_inclusao) VALUES (:ocorrencia, :tarefa, :usuario, :dataInclusao);";
		$ocorrencia = $tarefaOcorrencia->getOcorrencia()->getId();
		$tarefa = $tarefaOcorrencia->getTarefa();
		$usuario = $tarefaOcorrencia->getUsuario()->getId();
		$dataInclusao = $tarefaOcorrencia->getDataInclusao();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":ocorrencia", $ocorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
			$stmt->bindParam(":dataInclusao", $dataInclusao, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(TarefaOcorrencia $tarefaOcorrencia){
        $sql = "INSERT INTO tarefa_ocorrencia(id, id_ocorrencia_ocorrencia, tarefa, id_usuario_usuario, data_inclusao) VALUES (:id, :ocorrencia, :tarefa, :usuario, :dataInclusao);";
		$id = $tarefaOcorrencia->getId();
		$ocorrencia = $tarefaOcorrencia->getOcorrencia()->getId();
		$tarefa = $tarefaOcorrencia->getTarefa();
		$usuario = $tarefaOcorrencia->getUsuario()->getId();
		$dataInclusao = $tarefaOcorrencia->getDataInclusao();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":ocorrencia", $ocorrencia, PDO::PARAM_INT);
			$stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
			$stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
			$stmt->bindParam(":dataInclusao", $dataInclusao, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function delete(TarefaOcorrencia $tarefaOcorrencia){
		$id = $tarefaOcorrencia->getId();
		$sql = "DELETE FROM tarefa_ocorrencia WHERE id = :id";
		    
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
		$sql = "SELECT tarefa_ocorrencia.id, tarefa_ocorrencia.tarefa, tarefa_ocorrencia.data_inclusao, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM tarefa_ocorrencia INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = tarefa_ocorrencia.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = tarefa_ocorrencia.id_usuario LIMIT 1000";

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
		        $tarefaOcorrencia = new TarefaOcorrencia();
                $tarefaOcorrencia->setId( $row ['id'] );
                $tarefaOcorrencia->setTarefa( $row ['tarefa'] );
                $tarefaOcorrencia->setDataInclusao( $row ['data_inclusao'] );
                $tarefaOcorrencia->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $list [] = $tarefaOcorrencia;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(TarefaOcorrencia $tarefaOcorrencia) {
        $lista = array();
	    $id = $tarefaOcorrencia->getId();
                
        $sql = "SELECT tarefa_ocorrencia.id, tarefa_ocorrencia.tarefa, tarefa_ocorrencia.data_inclusao, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM tarefa_ocorrencia INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = tarefa_ocorrencia.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = tarefa_ocorrencia.id_usuario
            WHERE tarefa_ocorrencia.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $tarefaOcorrencia = new TarefaOcorrencia();
                $tarefaOcorrencia->setId( $row ['id'] );
                $tarefaOcorrencia->setTarefa( $row ['tarefa'] );
                $tarefaOcorrencia->setDataInclusao( $row ['data_inclusao'] );
                $tarefaOcorrencia->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $tarefaOcorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByTarefa(TarefaOcorrencia $tarefaOcorrencia) {
        $lista = array();
	    $tarefa = $tarefaOcorrencia->getTarefa();
                
        $sql = "SELECT tarefa_ocorrencia.id, tarefa_ocorrencia.tarefa, tarefa_ocorrencia.data_inclusao, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM tarefa_ocorrencia INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = tarefa_ocorrencia.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = tarefa_ocorrencia.id_usuario
            WHERE tarefa_ocorrencia.tarefa = :tarefa";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $tarefaOcorrencia = new TarefaOcorrencia();
                $tarefaOcorrencia->setId( $row ['id'] );
                $tarefaOcorrencia->setTarefa( $row ['tarefa'] );
                $tarefaOcorrencia->setDataInclusao( $row ['data_inclusao'] );
                $tarefaOcorrencia->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $tarefaOcorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByDataInclusao(TarefaOcorrencia $tarefaOcorrencia) {
        $lista = array();
	    $dataInclusao = $tarefaOcorrencia->getDataInclusao();
                
        $sql = "SELECT tarefa_ocorrencia.id, tarefa_ocorrencia.tarefa, tarefa_ocorrencia.data_inclusao, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM tarefa_ocorrencia INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = tarefa_ocorrencia.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = tarefa_ocorrencia.id_usuario
            WHERE tarefa_ocorrencia.data_inclusao like :dataInclusao";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":dataInclusao", $dataInclusao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $tarefaOcorrencia = new TarefaOcorrencia();
                $tarefaOcorrencia->setId( $row ['id'] );
                $tarefaOcorrencia->setTarefa( $row ['tarefa'] );
                $tarefaOcorrencia->setDataInclusao( $row ['data_inclusao'] );
                $tarefaOcorrencia->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $lista [] = $tarefaOcorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(TarefaOcorrencia $tarefaOcorrencia) {
        
	    $id = $tarefaOcorrencia->getId();
	    $sql = "SELECT tarefa_ocorrencia.id, tarefa_ocorrencia.tarefa, tarefa_ocorrencia.data_inclusao, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM tarefa_ocorrencia INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = tarefa_ocorrencia.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = tarefa_ocorrencia.id_usuario
                WHERE tarefa_ocorrencia.id = :id
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
                $tarefaOcorrencia->setId( $row ['id'] );
                $tarefaOcorrencia->setTarefa( $row ['tarefa'] );
                $tarefaOcorrencia->setDataInclusao( $row ['data_inclusao'] );
                $tarefaOcorrencia->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tarefaOcorrencia;
    }
                
    public function fillByTarefa(TarefaOcorrencia $tarefaOcorrencia) {
        
	    $tarefa = $tarefaOcorrencia->getTarefa();
	    $sql = "SELECT tarefa_ocorrencia.id, tarefa_ocorrencia.tarefa, tarefa_ocorrencia.data_inclusao, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM tarefa_ocorrencia INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = tarefa_ocorrencia.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = tarefa_ocorrencia.id_usuario
                WHERE tarefa_ocorrencia.tarefa = :tarefa
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":tarefa", $tarefa, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $tarefaOcorrencia->setId( $row ['id'] );
                $tarefaOcorrencia->setTarefa( $row ['tarefa'] );
                $tarefaOcorrencia->setDataInclusao( $row ['data_inclusao'] );
                $tarefaOcorrencia->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tarefaOcorrencia;
    }
                
    public function fillByDataInclusao(TarefaOcorrencia $tarefaOcorrencia) {
        
	    $dataInclusao = $tarefaOcorrencia->getDataInclusao();
	    $sql = "SELECT tarefa_ocorrencia.id, tarefa_ocorrencia.tarefa, tarefa_ocorrencia.data_inclusao, ocorrencia.id as id_ocorrencia_ocorrencia, ocorrencia.id_local as id_local_ocorrencia_ocorrencia, ocorrencia.descricao as descricao_ocorrencia_ocorrencia, ocorrencia.campus as campus_ocorrencia_ocorrencia, ocorrencia.patrimonio as patrimonio_ocorrencia_ocorrencia, ocorrencia.ramal as ramal_ocorrencia_ocorrencia, ocorrencia.local as local_ocorrencia_ocorrencia, ocorrencia.status as status_ocorrencia_ocorrencia, ocorrencia.solucao as solucao_ocorrencia_ocorrencia, ocorrencia.prioridade as prioridade_ocorrencia_ocorrencia, ocorrencia.avaliacao as avaliacao_ocorrencia_ocorrencia, ocorrencia.email as email_ocorrencia_ocorrencia, ocorrencia.id_usuario_atendente as id_usuario_atendente_ocorrencia_ocorrencia, ocorrencia.id_usuario_indicado as id_usuario_indicado_ocorrencia_ocorrencia, ocorrencia.anexo as anexo_ocorrencia_ocorrencia, ocorrencia.local_sala as local_sala_ocorrencia_ocorrencia, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM tarefa_ocorrencia INNER JOIN ocorrencia as ocorrencia ON ocorrencia.id = tarefa_ocorrencia.id_ocorrencia INNER JOIN usuario as usuario ON usuario.id = tarefa_ocorrencia.id_usuario
                WHERE tarefa_ocorrencia.data_inclusao = :dataInclusao
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dataInclusao", $dataInclusao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $tarefaOcorrencia->setId( $row ['id'] );
                $tarefaOcorrencia->setTarefa( $row ['tarefa'] );
                $tarefaOcorrencia->setDataInclusao( $row ['data_inclusao'] );
                $tarefaOcorrencia->getOcorrencia()->setId( $row ['id_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdLocal( $row ['id_local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setDescricao( $row ['descricao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setCampus( $row ['campus_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPatrimonio( $row ['patrimonio_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setRamal( $row ['ramal_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocal( $row ['local_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setStatus( $row ['status_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setSolucao( $row ['solucao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setPrioridade( $row ['prioridade_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAvaliacao( $row ['avaliacao_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setEmail( $row ['email_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioAtendente( $row ['id_usuario_atendente_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setIdUsuarioIndicado( $row ['id_usuario_indicado_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setAnexo( $row ['anexo_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getOcorrencia()->setLocalSala( $row ['local_sala_ocorrencia_ocorrencia'] );
                $tarefaOcorrencia->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $tarefaOcorrencia->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $tarefaOcorrencia;
    }
}