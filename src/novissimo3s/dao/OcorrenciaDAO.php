<?php
            
/**
 * Classe feita para manipulação do objeto Ocorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace novissimo3s\dao;
use PDO;
use PDOException;
use novissimo3s\model\Ocorrencia;

class OcorrenciaDAO extends DAO {
    
    

            
            
    public function update(Ocorrencia $ocorrencia)
    {
        $id = $ocorrencia->getId();
            
            
        $sql = "UPDATE ocorrencia
                SET
                id_local = :idLocal,
                descricao = :descricao,
                campus = :campus,
                patrimonio = :patrimonio,
                ramal = :ramal,
                local = :local,
                status = :status,
                solucao = :solucao,
                prioridade = :prioridade,
                avaliacao = :avaliacao,
                email = :email,
                id_usuario_atendente = :idUsuarioAtendente,
                id_usuario_indicado = :idUsuarioIndicado,
                anexo = :anexo,
                local_sala = :localSala
                WHERE ocorrencia.id = :id;";
			$idLocal = $ocorrencia->getIdLocal();
			$descricao = $ocorrencia->getDescricao();
			$campus = $ocorrencia->getCampus();
			$patrimonio = $ocorrencia->getPatrimonio();
			$ramal = $ocorrencia->getRamal();
			$local = $ocorrencia->getLocal();
			$status = $ocorrencia->getStatus();
			$solucao = $ocorrencia->getSolucao();
			$prioridade = $ocorrencia->getPrioridade();
			$avaliacao = $ocorrencia->getAvaliacao();
			$email = $ocorrencia->getEmail();
			$idUsuarioAtendente = $ocorrencia->getIdUsuarioAtendente();
			$idUsuarioIndicado = $ocorrencia->getIdUsuarioIndicado();
			$anexo = $ocorrencia->getAnexo();
			$localSala = $ocorrencia->getLocalSala();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
			$stmt->bindParam(":patrimonio", $patrimonio, PDO::PARAM_STR);
			$stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
			$stmt->bindParam(":local", $local, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":solucao", $solucao, PDO::PARAM_STR);
			$stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
			$stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":idUsuarioAtendente", $idUsuarioAtendente, PDO::PARAM_INT);
			$stmt->bindParam(":idUsuarioIndicado", $idUsuarioIndicado, PDO::PARAM_INT);
			$stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
			$stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(Ocorrencia $ocorrencia){
        $sql = "INSERT INTO ocorrencia(id_area_responsavel, id_servico, id_local, id_usuario_cliente, descricao, campus, patrimonio, ramal, local, status, solucao, prioridade, avaliacao, email, id_usuario_atendente, id_usuario_indicado, anexo, local_sala) VALUES (:areaResponsavel, :servico, :idLocal, :usuarioCliente, :descricao, :campus, :patrimonio, :ramal, :local, :status, :solucao, :prioridade, :avaliacao, :email, :idUsuarioAtendente, :idUsuarioIndicado, :anexo, :localSala);";
		$areaResponsavel = $ocorrencia->getAreaResponsavel()->getId();
		$servico = $ocorrencia->getServico()->getId();
		$idLocal = $ocorrencia->getIdLocal();
		$usuarioCliente = $ocorrencia->getUsuarioCliente()->getId();
		$descricao = $ocorrencia->getDescricao();
		$campus = $ocorrencia->getCampus();
		$patrimonio = $ocorrencia->getPatrimonio();
		$ramal = $ocorrencia->getRamal();
		$local = $ocorrencia->getLocal();
		$status = $ocorrencia->getStatus();
		$solucao = $ocorrencia->getSolucao();
		$prioridade = $ocorrencia->getPrioridade();
		$avaliacao = $ocorrencia->getAvaliacao();
		$email = $ocorrencia->getEmail();
		$idUsuarioAtendente = $ocorrencia->getIdUsuarioAtendente();
		$idUsuarioIndicado = $ocorrencia->getIdUsuarioIndicado();
		$anexo = $ocorrencia->getAnexo();
		$localSala = $ocorrencia->getLocalSala();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
			$stmt->bindParam(":servico", $servico, PDO::PARAM_INT);
			$stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
			$stmt->bindParam(":usuarioCliente", $usuarioCliente, PDO::PARAM_INT);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
			$stmt->bindParam(":patrimonio", $patrimonio, PDO::PARAM_STR);
			$stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
			$stmt->bindParam(":local", $local, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":solucao", $solucao, PDO::PARAM_STR);
			$stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
			$stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":idUsuarioAtendente", $idUsuarioAtendente, PDO::PARAM_INT);
			$stmt->bindParam(":idUsuarioIndicado", $idUsuarioIndicado, PDO::PARAM_INT);
			$stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
			$stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(Ocorrencia $ocorrencia){
        $sql = "INSERT INTO ocorrencia(id, id_area_responsavel, id_servico, id_local, id_usuario_cliente, descricao, campus, patrimonio, ramal, local, status, solucao, prioridade, avaliacao, email, id_usuario_atendente, id_usuario_indicado, anexo, local_sala) VALUES (:id, :areaResponsavel, :servico, :idLocal, :usuarioCliente, :descricao, :campus, :patrimonio, :ramal, :local, :status, :solucao, :prioridade, :avaliacao, :email, :idUsuarioAtendente, :idUsuarioIndicado, :anexo, :localSala);";
		$id = $ocorrencia->getId();
		$areaResponsavel = $ocorrencia->getAreaResponsavel()->getId();
		$servico = $ocorrencia->getServico()->getId();
		$idLocal = $ocorrencia->getIdLocal();
		$usuarioCliente = $ocorrencia->getUsuarioCliente()->getId();
		$descricao = $ocorrencia->getDescricao();
		$campus = $ocorrencia->getCampus();
		$patrimonio = $ocorrencia->getPatrimonio();
		$ramal = $ocorrencia->getRamal();
		$local = $ocorrencia->getLocal();
		$status = $ocorrencia->getStatus();
		$solucao = $ocorrencia->getSolucao();
		$prioridade = $ocorrencia->getPrioridade();
		$avaliacao = $ocorrencia->getAvaliacao();
		$email = $ocorrencia->getEmail();
		$idUsuarioAtendente = $ocorrencia->getIdUsuarioAtendente();
		$idUsuarioIndicado = $ocorrencia->getIdUsuarioIndicado();
		$anexo = $ocorrencia->getAnexo();
		$localSala = $ocorrencia->getLocalSala();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
			$stmt->bindParam(":servico", $servico, PDO::PARAM_INT);
			$stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
			$stmt->bindParam(":usuarioCliente", $usuarioCliente, PDO::PARAM_INT);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
			$stmt->bindParam(":patrimonio", $patrimonio, PDO::PARAM_STR);
			$stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
			$stmt->bindParam(":local", $local, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":solucao", $solucao, PDO::PARAM_STR);
			$stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
			$stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":idUsuarioAtendente", $idUsuarioAtendente, PDO::PARAM_INT);
			$stmt->bindParam(":idUsuarioIndicado", $idUsuarioIndicado, PDO::PARAM_INT);
			$stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
			$stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }

	public function delete(Ocorrencia $ocorrencia){
		$id = $ocorrencia->getId();
		$sql = "DELETE FROM ocorrencia WHERE id = :id";
		    
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
		$sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente LIMIT 1000";

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
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $list [] = $ocorrencia;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(Ocorrencia $ocorrencia) {
        $lista = array();
	    $id = $ocorrencia->getId();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByAreaResponsavel(Ocorrencia $ocorrencia) {
        $lista = array();
	    $areaResponsavel = $ocorrencia->getAreaResponsavel()->getId();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.id_area_responsavel = :areaResponsavel";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByServico(Ocorrencia $ocorrencia) {
        $lista = array();
	    $servico = $ocorrencia->getServico()->getId();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.id_servico = :servico";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":servico", $servico, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByIdLocal(Ocorrencia $ocorrencia) {
        $lista = array();
	    $idLocal = $ocorrencia->getIdLocal();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.id_local = :idLocal";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByUsuarioCliente(Ocorrencia $ocorrencia) {
        $lista = array();
	    $usuarioCliente = $ocorrencia->getUsuarioCliente()->getId();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.id_usuario_cliente = :usuarioCliente";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":usuarioCliente", $usuarioCliente, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByDescricao(Ocorrencia $ocorrencia) {
        $lista = array();
	    $descricao = $ocorrencia->getDescricao();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.descricao like :descricao";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByCampus(Ocorrencia $ocorrencia) {
        $lista = array();
	    $campus = $ocorrencia->getCampus();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.campus like :campus";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByPatrimonio(Ocorrencia $ocorrencia) {
        $lista = array();
	    $patrimonio = $ocorrencia->getPatrimonio();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.patrimonio like :patrimonio";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":patrimonio", $patrimonio, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByRamal(Ocorrencia $ocorrencia) {
        $lista = array();
	    $ramal = $ocorrencia->getRamal();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.ramal like :ramal";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByLocal(Ocorrencia $ocorrencia) {
        $lista = array();
	    $local = $ocorrencia->getLocal();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.local like :local";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":local", $local, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByStatus(Ocorrencia $ocorrencia) {
        $lista = array();
	    $status = $ocorrencia->getStatus();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.status like :status";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchBySolucao(Ocorrencia $ocorrencia) {
        $lista = array();
	    $solucao = $ocorrencia->getSolucao();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.solucao like :solucao";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":solucao", $solucao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByPrioridade(Ocorrencia $ocorrencia) {
        $lista = array();
	    $prioridade = $ocorrencia->getPrioridade();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.prioridade like :prioridade";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByAvaliacao(Ocorrencia $ocorrencia) {
        $lista = array();
	    $avaliacao = $ocorrencia->getAvaliacao();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.avaliacao like :avaliacao";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByEmail(Ocorrencia $ocorrencia) {
        $lista = array();
	    $email = $ocorrencia->getEmail();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.email like :email";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByIdUsuarioAtendente(Ocorrencia $ocorrencia) {
        $lista = array();
	    $idUsuarioAtendente = $ocorrencia->getIdUsuarioAtendente();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.id_usuario_atendente = :idUsuarioAtendente";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":idUsuarioAtendente", $idUsuarioAtendente, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByIdUsuarioIndicado(Ocorrencia $ocorrencia) {
        $lista = array();
	    $idUsuarioIndicado = $ocorrencia->getIdUsuarioIndicado();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.id_usuario_indicado = :idUsuarioIndicado";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":idUsuarioIndicado", $idUsuarioIndicado, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByAnexo(Ocorrencia $ocorrencia) {
        $lista = array();
	    $anexo = $ocorrencia->getAnexo();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.anexo like :anexo";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByLocalSala(Ocorrencia $ocorrencia) {
        $lista = array();
	    $localSala = $ocorrencia->getLocalSala();
                
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE ocorrencia.local_sala like :localSala";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(Ocorrencia $ocorrencia) {
        
	    $id = $ocorrencia->getId();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.id = :id
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
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByIdLocal(Ocorrencia $ocorrencia) {
        
	    $idLocal = $ocorrencia->getIdLocal();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.id_local = :idLocal
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByDescricao(Ocorrencia $ocorrencia) {
        
	    $descricao = $ocorrencia->getDescricao();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.descricao = :descricao
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByCampus(Ocorrencia $ocorrencia) {
        
	    $campus = $ocorrencia->getCampus();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.campus = :campus
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByPatrimonio(Ocorrencia $ocorrencia) {
        
	    $patrimonio = $ocorrencia->getPatrimonio();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.patrimonio = :patrimonio
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":patrimonio", $patrimonio, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByRamal(Ocorrencia $ocorrencia) {
        
	    $ramal = $ocorrencia->getRamal();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.ramal = :ramal
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByLocal(Ocorrencia $ocorrencia) {
        
	    $local = $ocorrencia->getLocal();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.local = :local
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":local", $local, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByStatus(Ocorrencia $ocorrencia) {
        
	    $status = $ocorrencia->getStatus();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.status = :status
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillBySolucao(Ocorrencia $ocorrencia) {
        
	    $solucao = $ocorrencia->getSolucao();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.solucao = :solucao
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":solucao", $solucao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByPrioridade(Ocorrencia $ocorrencia) {
        
	    $prioridade = $ocorrencia->getPrioridade();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.prioridade = :prioridade
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByAvaliacao(Ocorrencia $ocorrencia) {
        
	    $avaliacao = $ocorrencia->getAvaliacao();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.avaliacao = :avaliacao
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByEmail(Ocorrencia $ocorrencia) {
        
	    $email = $ocorrencia->getEmail();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.email = :email
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
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByIdUsuarioAtendente(Ocorrencia $ocorrencia) {
        
	    $idUsuarioAtendente = $ocorrencia->getIdUsuarioAtendente();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.id_usuario_atendente = :idUsuarioAtendente
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idUsuarioAtendente", $idUsuarioAtendente, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByIdUsuarioIndicado(Ocorrencia $ocorrencia) {
        
	    $idUsuarioIndicado = $ocorrencia->getIdUsuarioIndicado();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.id_usuario_indicado = :idUsuarioIndicado
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idUsuarioIndicado", $idUsuarioIndicado, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByAnexo(Ocorrencia $ocorrencia) {
        
	    $anexo = $ocorrencia->getAnexo();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.anexo = :anexo
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function fillByLocalSala(Ocorrencia $ocorrencia) {
        
	    $localSala = $ocorrencia->getLocalSala();
	    $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
                WHERE ocorrencia.local_sala = :localSala
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $ocorrencia->setId( $row ['id'] );
                $ocorrencia->setIdLocal( $row ['id_local'] );
                $ocorrencia->setDescricao( $row ['descricao'] );
                $ocorrencia->setCampus( $row ['campus'] );
                $ocorrencia->setPatrimonio( $row ['patrimonio'] );
                $ocorrencia->setRamal( $row ['ramal'] );
                $ocorrencia->setLocal( $row ['local'] );
                $ocorrencia->setStatus( $row ['status'] );
                $ocorrencia->setSolucao( $row ['solucao'] );
                $ocorrencia->setPrioridade( $row ['prioridade'] );
                $ocorrencia->setAvaliacao( $row ['avaliacao'] );
                $ocorrencia->setEmail( $row ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $row ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $row ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $row ['anexo'] );
                $ocorrencia->setLocalSala( $row ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $row ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $row ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $row ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $row ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $row ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $row ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $row ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $row ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $row ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $row ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $row ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $row ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $row ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $row ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $row ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $row ['id_setor_usuario_usuario_cliente'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
}