<?php
                
/**
 * Customize sua classe
 *
 */


namespace novissimo3s\custom\dao;
use novissimo3s\dao\OcorrenciaDAO;
use novissimo3s\model\Ocorrencia;
use PDO;
use PDOException;
use novissimo3s\model\MensagemForum;
use novissimo3s\custom\controller\StatusOcorrenciaCustomController;

class  OcorrenciaCustomDAO extends OcorrenciaDAO {
    
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
                local_sala = :localSala, 
                id_area_responsavel = :idArea, 
                id_servico = :idServico
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
        $idArea = $ocorrencia->getAreaResponsavel()->getId();
        $idServico = $ocorrencia->getServico()->getId();
        
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
            $stmt->bindParam(":idArea", $idArea, PDO::PARAM_INT);
            $stmt->bindParam(":idServico", $idServico, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }
    public function retornaListaPorStatus($status) {
        $lista = array ();
        $sql = "
		SELECT
        ocorrencia.id,
        ocorrencia.id_local,
        ocorrencia.descricao,
        ocorrencia.campus,
        ocorrencia.patrimonio,
        ocorrencia.ramal,
        ocorrencia.local,
        ocorrencia.status,
        ocorrencia.solucao,
        ocorrencia.prioridade,
        ocorrencia.avaliacao,
        ocorrencia.email,
        ocorrencia.id_usuario_atendente,
        ocorrencia.id_usuario_indicado,
        ocorrencia.anexo,
        ocorrencia.local_sala,
        area_responsavel.id as id_area_responsavel_area_responsavel,
        area_responsavel.nome as nome_area_responsavel_area_responsavel,
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel,
        area_responsavel.email as email_area_responsavel_area_responsavel,
        servico.id as id_servico_servico,
        servico.nome as nome_servico_servico,
        servico.descricao as descricao_servico_servico,
        servico.tempo_sla as tempo_sla_servico_servico,
        servico.visao as visao_servico_servico,
        usuario_cliente.id as id_usuario_usuario_cliente,
        usuario_cliente.nome as nome_usuario_usuario_cliente,
        usuario_cliente.email as email_usuario_usuario_cliente,
        usuario_cliente.login as login_usuario_usuario_cliente,
        usuario_cliente.senha as senha_usuario_usuario_cliente,
        usuario_cliente.nivel as nivel_usuario_usuario_cliente
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
		LEFT JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
        WHERE ocorrencia.status = '$status'
        ORDER BY ocorrencia.id DESC
                 LIMIT 50";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            
            if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->getConnection()->errorInfo()[2]."<br>";
                return $lista;
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha )
            {
                $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setDescricao( $linha ['descricao'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setPatrimonio( $linha ['patrimonio'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setSolucao( $linha ['solucao'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $linha ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $linha ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $linha ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $linha ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $linha ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $linha ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $linha ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $linha ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $linha ['nivel_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;
                
                
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }
    
    public function pesquisaAdmin(Ocorrencia $ocorrencia) {
        $lista = array();
        $idUsuarioIndicado = $ocorrencia->getUsuarioCliente()->getId();
        $statusCancelado = StatusOcorrenciaCustomController::STATUS_CANCELADO;
        
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local,
            ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio,
            ocorrencia.ramal, ocorrencia.local, ocorrencia.status,
            ocorrencia.solucao,
            ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email,
            ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado,
            ocorrencia.anexo, ocorrencia.local_sala,
            area_responsavel.id as id_area_responsavel_area_responsavel,
            area_responsavel.nome as nome_area_responsavel_area_responsavel,
            area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico,
            usuario_cliente.id as id_usuario_usuario_cliente,
             usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente,
            usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente,
            usuario_cliente.nivel as nivel_usuario_usuario_cliente,
            usuario_cliente.id_setor as id_setor_usuario_usuario_cliente
            FROM ocorrencia
            INNER JOIN area_responsavel as area_responsavel
            ON area_responsavel.id = ocorrencia.id_area_responsavel
            INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            LEFT JOIN usuario as usuario_cliente
            ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE
            ocorrencia.status <> '$statusCancelado'
            ORDER BY ocorrencia.id DESC
            LIMIT 100
";
        
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
                $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setDescricao( $linha ['descricao'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setPatrimonio( $linha ['patrimonio'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setSolucao( $linha ['solucao'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $linha ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $linha ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $linha ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $linha ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $linha ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $linha ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $linha ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $linha ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $linha ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $linha ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;
                
                
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            
        }
        return $lista;
    }
    
    
    public function pesquisaPorCliente(Ocorrencia $ocorrencia) {
        $lista = array();
        $idUsuarioIndicado = $ocorrencia->getUsuarioCliente()->getId();
        $statusCancelado = StatusOcorrenciaCustomController::STATUS_CANCELADO;
        
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local,
            ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, 
            ocorrencia.ramal, ocorrencia.local, ocorrencia.status, 
            ocorrencia.solucao, 
            ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, 
            ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, 
            ocorrencia.anexo, ocorrencia.local_sala, 
            area_responsavel.id as id_area_responsavel_area_responsavel, 
            area_responsavel.nome as nome_area_responsavel_area_responsavel, 
            area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, 
            usuario_cliente.id as id_usuario_usuario_cliente,
             usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, 
            usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, 
            usuario_cliente.nivel as nivel_usuario_usuario_cliente, 
            usuario_cliente.id_setor as id_setor_usuario_usuario_cliente 
            FROM ocorrencia 
            INNER JOIN area_responsavel as area_responsavel 
            ON area_responsavel.id = ocorrencia.id_area_responsavel 
            INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico 
            LEFT JOIN usuario as usuario_cliente 
            ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE
            ocorrencia.id_usuario_cliente  = :idUsuarioIndicado
            AND ocorrencia.status <> '$statusCancelado'
            ORDER BY ocorrencia.id DESC
            LIMIT 10
";
        
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":idUsuarioIndicado", $idUsuarioIndicado, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
                $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setDescricao( $linha ['descricao'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setPatrimonio( $linha ['patrimonio'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setSolucao( $linha ['solucao'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $linha ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $linha ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $linha ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $linha ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $linha ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $linha ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $linha ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $linha ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $linha ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $linha ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;
                
                
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            
        }
        return $lista;
    }
    
    public function fillById(Ocorrencia $ocorrencia) {
        
        $id = $ocorrencia->getId();
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local, ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio, ocorrencia.ramal, ocorrencia.local, ocorrencia.status, ocorrencia.solucao, ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email, ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado, ocorrencia.anexo, ocorrencia.local_sala, area_responsavel.id as id_area_responsavel_area_responsavel, area_responsavel.nome as nome_area_responsavel_area_responsavel, area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico, usuario_cliente.id as id_usuario_usuario_cliente, usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente, usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente, usuario_cliente.nivel as nivel_usuario_usuario_cliente, usuario_cliente.id_setor as id_setor_usuario_usuario_cliente FROM ocorrencia INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel 
            INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico 
            LEFT JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
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
    
    public function pesquisaParaTec(Ocorrencia $ocorrencia) {
        $lista = array();
        $idUsuarioCliente = $ocorrencia->getUsuarioCliente()->getId();
        $idUsuarioIndicado = $ocorrencia->getIdUsuarioIndicado();
        $idUsuarioAtendente = $ocorrencia->getIdUsuarioAtendente();
        $idAreaResponsavel = $ocorrencia->getAreaResponsavel()->getId();
        
        $statusCancelado = StatusOcorrenciaCustomController::STATUS_CANCELADO;
//         $statusFechado = StatusOcorrenciaCustomController::STATUS_FECHADO;
        $statusConfirmado = StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO;
        
        $sql = "SELECT ocorrencia.id, ocorrencia.id_local,
            ocorrencia.descricao, ocorrencia.campus, ocorrencia.patrimonio,
            ocorrencia.ramal, ocorrencia.local, ocorrencia.status,
            ocorrencia.solucao,
            ocorrencia.prioridade, ocorrencia.avaliacao, ocorrencia.email,
            ocorrencia.id_usuario_atendente, ocorrencia.id_usuario_indicado,
            ocorrencia.anexo, ocorrencia.local_sala,
            area_responsavel.id as id_area_responsavel_area_responsavel,
            area_responsavel.nome as nome_area_responsavel_area_responsavel,
            area_responsavel.descricao as descricao_area_responsavel_area_responsavel, area_responsavel.email as email_area_responsavel_area_responsavel, servico.id as id_servico_servico, servico.nome as nome_servico_servico, servico.descricao as descricao_servico_servico, servico.tempo_sla as tempo_sla_servico_servico, servico.visao as visao_servico_servico,
            usuario_cliente.id as id_usuario_usuario_cliente,
             usuario_cliente.nome as nome_usuario_usuario_cliente, usuario_cliente.email as email_usuario_usuario_cliente,
            usuario_cliente.login as login_usuario_usuario_cliente, usuario_cliente.senha as senha_usuario_usuario_cliente,
            usuario_cliente.nivel as nivel_usuario_usuario_cliente,
            usuario_cliente.id_setor as id_setor_usuario_usuario_cliente
            FROM ocorrencia
            INNER JOIN area_responsavel as area_responsavel
            ON area_responsavel.id = ocorrencia.id_area_responsavel
            INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            LEFT JOIN usuario as usuario_cliente
            ON usuario_cliente.id = ocorrencia.id_usuario_cliente
            WHERE
            (ocorrencia.id_usuario_cliente  = :idUsuarioCliente
            OR 
            ocorrencia.id_usuario_indicado  = :idUsuarioIndicado
            OR 
            ocorrencia.id_usuario_atendente  = :idUsuarioAtendente
            OR 
            ocorrencia.id_area_responsavel = :idAreaResponsavel
            )
            AND ocorrencia.status <> '$statusCancelado'
            AND ocorrencia.status <> '$statusConfirmado'
            ORDER BY ocorrencia.id DESC
            LIMIT 80
";
        
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":idUsuarioCliente", $idUsuarioCliente, PDO::PARAM_INT);
            $stmt->bindParam(":idUsuarioIndicado", $idUsuarioIndicado, PDO::PARAM_INT);
            $stmt->bindParam(":idUsuarioAtendente", $idUsuarioAtendente, PDO::PARAM_INT);
            $stmt->bindParam(":idAreaResponsavel", $idAreaResponsavel, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ){
                $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setDescricao( $linha ['descricao'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setPatrimonio( $linha ['patrimonio'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setSolucao( $linha ['solucao'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $linha ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $linha ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $linha ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $linha ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $linha ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $linha ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $linha ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $linha ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $linha ['nivel_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setIdSetor( $linha ['id_setor_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;
                
                
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            
        }
        return $lista;
    }
    public function retornaLista() {
        $lista = array ();
        $sql = "
		SELECT
        ocorrencia.id,
        ocorrencia.id_local,
        ocorrencia.descricao,
        ocorrencia.campus,
        ocorrencia.patrimonio,
        ocorrencia.ramal,
        ocorrencia.local,
        ocorrencia.status,
        ocorrencia.solucao,
        ocorrencia.prioridade,
        ocorrencia.avaliacao,
        ocorrencia.email,
        ocorrencia.id_usuario_atendente,
        ocorrencia.id_usuario_indicado,
        ocorrencia.anexo,
        ocorrencia.local_sala,
        area_responsavel.id as id_area_responsavel_area_responsavel,
        area_responsavel.nome as nome_area_responsavel_area_responsavel,
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel,
        area_responsavel.email as email_area_responsavel_area_responsavel,
        servico.id as id_servico_servico,
        servico.nome as nome_servico_servico,
        servico.descricao as descricao_servico_servico,
        servico.tempo_sla as tempo_sla_servico_servico,
        servico.visao as visao_servico_servico,
        usuario_cliente.id as id_usuario_usuario_cliente,
        usuario_cliente.nome as nome_usuario_usuario_cliente,
        usuario_cliente.email as email_usuario_usuario_cliente,
        usuario_cliente.login as login_usuario_usuario_cliente,
        usuario_cliente.senha as senha_usuario_usuario_cliente,
        usuario_cliente.nivel as nivel_usuario_usuario_cliente
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
		INNER JOIN usuario as usuario_cliente ON usuario_cliente.id = ocorrencia.id_usuario_cliente
        ORDER BY ocorrencia.id DESC
                 LIMIT 100";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            
            if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->getConnection()->errorInfo()[2]."<br>";
                return $lista;
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha )
            {
                $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setDescricao( $linha ['descricao'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setPatrimonio( $linha ['patrimonio'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setSolucao( $linha ['solucao'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setIdUsuarioAtendente( $linha ['id_usuario_atendente'] );
                $ocorrencia->setIdUsuarioIndicado( $linha ['id_usuario_indicado'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                $ocorrencia->getServico()->setVisao( $linha ['visao_servico_servico'] );
                $ocorrencia->getUsuarioCliente()->setId( $linha ['id_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNome( $linha ['nome_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setEmail( $linha ['email_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setLogin( $linha ['login_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setSenha( $linha ['senha_usuario_usuario_cliente'] );
                $ocorrencia->getUsuarioCliente()->setNivel( $linha ['nivel_usuario_usuario_cliente'] );
                $lista [] = $ocorrencia;
                
                
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }
    
    
    public function fetchMensagens(Ocorrencia $ocorrencia){
        $id = $ocorrencia->getId();
        $sql = "SELECT mensagem_forum.id, mensagem_forum.tipo, mensagem_forum.mensagem, mensagem_forum.data_envio, usuario.id as id_usuario_usuario, usuario.nome as nome_usuario_usuario, usuario.email as email_usuario_usuario, usuario.login as login_usuario_usuario, usuario.senha as senha_usuario_usuario, usuario.nivel as nivel_usuario_usuario, usuario.id_setor as id_setor_usuario_usuario FROM mensagem_forum INNER JOIN usuario as usuario ON usuario.id = mensagem_forum.id_usuario
            WHERE id_ocorrencia = :id ORDER BY mensagem_forum.id ASC;";
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
                $mensagemForum->getUsuario()->setId( $row ['id_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNome( $row ['nome_usuario_usuario'] );
                $mensagemForum->getUsuario()->setEmail( $row ['email_usuario_usuario'] );
                $mensagemForum->getUsuario()->setLogin( $row ['login_usuario_usuario'] );
                $mensagemForum->getUsuario()->setSenha( $row ['senha_usuario_usuario'] );
                $mensagemForum->getUsuario()->setNivel( $row ['nivel_usuario_usuario'] );
                $mensagemForum->getUsuario()->setIdSetor( $row ['id_setor_usuario_usuario'] );
                $mensagemForum->setDataEnvio( $row ['data_envio'] );
                $ocorrencia->addMensagemForum($mensagemForum);
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            
        }
        
        
        
        
    }
    

}