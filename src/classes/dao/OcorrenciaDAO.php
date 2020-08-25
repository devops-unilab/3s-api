<?php
                
/**
 * Classe feita para manipulação do objeto Ocorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class OcorrenciaDAO extends DAO {
    


            
            
    public function atualizar(Ocorrencia $ocorrencia)
    {
        $id = $ocorrencia->getId();
            
            
        $sql = "UPDATE ocorrencia
                SET
                id_local = :idLocal,
                id_funcionario = :idFuncionario,
                desc_problema = :descProblema,
                campus = :campus,
                etiq_equipamento = :etiqEquipamento,
                contato = :contato,
                ramal = :ramal,
                local = :local,
                funcionario = :funcionario,
                status = :status,
                obs = :obs,
                prioridade = :prioridade,
                avaliacao = :avaliacao,
                email = :email,
                fecha_confirmado = :fechaConfirmado,
                reaberto = :reaberto,
                dt_abertura = :dtAbertura,
                dt_atendimento = :dtAtendimento,
                dt_fechamento = :dtFechamento,
                dt_fecha_confirmado = :dtFechaConfirmado,
                dt_cancelamento = :dtCancelamento,
                id_atendente = :idAtendente,
                id_tecnico_indicado = :idTecnicoIndicado,
                dt_liberacao = :dtLiberacao,
                anexo = :anexo,
                dt_espera = :dtEspera,
                dt_aguardando_usuario = :dtAguardandoUsuario,
                local_sala = :localSala
                WHERE ocorrencia.id = :id;";
			$idLocal = $ocorrencia->getIdLocal();
			$idFuncionario = $ocorrencia->getIdFuncionario();
			$descProblema = $ocorrencia->getDescProblema();
			$campus = $ocorrencia->getCampus();
			$etiqEquipamento = $ocorrencia->getEtiqEquipamento();
			$contato = $ocorrencia->getContato();
			$ramal = $ocorrencia->getRamal();
			$local = $ocorrencia->getLocal();
			$funcionario = $ocorrencia->getFuncionario();
			$status = $ocorrencia->getStatus();
			$obs = $ocorrencia->getObs();
			$prioridade = $ocorrencia->getPrioridade();
			$avaliacao = $ocorrencia->getAvaliacao();
			$email = $ocorrencia->getEmail();
			$fechaConfirmado = $ocorrencia->getFechaConfirmado();
			$reaberto = $ocorrencia->getReaberto();
			$dtAbertura = $ocorrencia->getDtAbertura();
			$dtAtendimento = $ocorrencia->getDtAtendimento();
			$dtFechamento = $ocorrencia->getDtFechamento();
			$dtFechaConfirmado = $ocorrencia->getDtFechaConfirmado();
			$dtCancelamento = $ocorrencia->getDtCancelamento();
			$idAtendente = $ocorrencia->getIdAtendente();
			$idTecnicoIndicado = $ocorrencia->getIdTecnicoIndicado();
			$dtLiberacao = $ocorrencia->getDtLiberacao();
			$anexo = $ocorrencia->getAnexo();
			$dtEspera = $ocorrencia->getDtEspera();
			$dtAguardandoUsuario = $ocorrencia->getDtAguardandoUsuario();
			$localSala = $ocorrencia->getLocalSala();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
			$stmt->bindParam(":idFuncionario", $idFuncionario, PDO::PARAM_INT);
			$stmt->bindParam(":descProblema", $descProblema, PDO::PARAM_STR);
			$stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
			$stmt->bindParam(":etiqEquipamento", $etiqEquipamento, PDO::PARAM_STR);
			$stmt->bindParam(":contato", $contato, PDO::PARAM_STR);
			$stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
			$stmt->bindParam(":local", $local, PDO::PARAM_STR);
			$stmt->bindParam(":funcionario", $funcionario, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":obs", $obs, PDO::PARAM_STR);
			$stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
			$stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":fechaConfirmado", $fechaConfirmado, PDO::PARAM_STR);
			$stmt->bindParam(":reaberto", $reaberto, PDO::PARAM_STR);
			$stmt->bindParam(":dtAbertura", $dtAbertura, PDO::PARAM_STR);
			$stmt->bindParam(":dtAtendimento", $dtAtendimento, PDO::PARAM_STR);
			$stmt->bindParam(":dtFechamento", $dtFechamento, PDO::PARAM_STR);
			$stmt->bindParam(":dtFechaConfirmado", $dtFechaConfirmado, PDO::PARAM_STR);
			$stmt->bindParam(":dtCancelamento", $dtCancelamento, PDO::PARAM_STR);
			$stmt->bindParam(":idAtendente", $idAtendente, PDO::PARAM_INT);
			$stmt->bindParam(":idTecnicoIndicado", $idTecnicoIndicado, PDO::PARAM_INT);
			$stmt->bindParam(":dtLiberacao", $dtLiberacao, PDO::PARAM_STR);
			$stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
			$stmt->bindParam(":dtEspera", $dtEspera, PDO::PARAM_STR);
			$stmt->bindParam(":dtAguardandoUsuario", $dtAguardandoUsuario, PDO::PARAM_STR);
			$stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(Ocorrencia $ocorrencia){
        $sql = "INSERT INTO ocorrencia(id_area_responsavel, id_servico, id_local, id_funcionario, desc_problema, campus, etiq_equipamento, contato, ramal, local, funcionario, status, obs, prioridade, avaliacao, email, fecha_confirmado, reaberto, dt_abertura, dt_atendimento, dt_fechamento, dt_fecha_confirmado, dt_cancelamento, id_atendente, id_tecnico_indicado, dt_liberacao, anexo, dt_espera, dt_aguardando_usuario, local_sala) VALUES (:areaResponsavel, :servico, :idLocal, :idFuncionario, :descProblema, :campus, :etiqEquipamento, :contato, :ramal, :local, :funcionario, :status, :obs, :prioridade, :avaliacao, :email, :fechaConfirmado, :reaberto, :dtAbertura, :dtAtendimento, :dtFechamento, :dtFechaConfirmado, :dtCancelamento, :idAtendente, :idTecnicoIndicado, :dtLiberacao, :anexo, :dtEspera, :dtAguardandoUsuario, :localSala);";
		$areaResponsavel = $ocorrencia->getAreaResponsavel()->getId();
		$servico = $ocorrencia->getServico()->getId();
		$idLocal = $ocorrencia->getIdLocal();
		$idFuncionario = $ocorrencia->getIdFuncionario();
		$descProblema = $ocorrencia->getDescProblema();
		$campus = $ocorrencia->getCampus();
		$etiqEquipamento = $ocorrencia->getEtiqEquipamento();
		$contato = $ocorrencia->getContato();
		$ramal = $ocorrencia->getRamal();
		$local = $ocorrencia->getLocal();
		$funcionario = $ocorrencia->getFuncionario();
		$status = $ocorrencia->getStatus();
		$obs = $ocorrencia->getObs();
		$prioridade = $ocorrencia->getPrioridade();
		$avaliacao = $ocorrencia->getAvaliacao();
		$email = $ocorrencia->getEmail();
		$fechaConfirmado = $ocorrencia->getFechaConfirmado();
		$reaberto = $ocorrencia->getReaberto();
		$dtAbertura = $ocorrencia->getDtAbertura();
		$dtAtendimento = $ocorrencia->getDtAtendimento();
		$dtFechamento = $ocorrencia->getDtFechamento();
		$dtFechaConfirmado = $ocorrencia->getDtFechaConfirmado();
		$dtCancelamento = $ocorrencia->getDtCancelamento();
		$idAtendente = $ocorrencia->getIdAtendente();
		$idTecnicoIndicado = $ocorrencia->getIdTecnicoIndicado();
		$dtLiberacao = $ocorrencia->getDtLiberacao();
		$anexo = $ocorrencia->getAnexo();
		$dtEspera = $ocorrencia->getDtEspera();
		$dtAguardandoUsuario = $ocorrencia->getDtAguardandoUsuario();
		$localSala = $ocorrencia->getLocalSala();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
			$stmt->bindParam(":servico", $servico, PDO::PARAM_INT);
			$stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
			$stmt->bindParam(":idFuncionario", $idFuncionario, PDO::PARAM_INT);
			$stmt->bindParam(":descProblema", $descProblema, PDO::PARAM_STR);
			$stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
			$stmt->bindParam(":etiqEquipamento", $etiqEquipamento, PDO::PARAM_STR);
			$stmt->bindParam(":contato", $contato, PDO::PARAM_STR);
			$stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
			$stmt->bindParam(":local", $local, PDO::PARAM_STR);
			$stmt->bindParam(":funcionario", $funcionario, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":obs", $obs, PDO::PARAM_STR);
			$stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
			$stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":fechaConfirmado", $fechaConfirmado, PDO::PARAM_STR);
			$stmt->bindParam(":reaberto", $reaberto, PDO::PARAM_STR);
			$stmt->bindParam(":dtAbertura", $dtAbertura, PDO::PARAM_STR);
			$stmt->bindParam(":dtAtendimento", $dtAtendimento, PDO::PARAM_STR);
			$stmt->bindParam(":dtFechamento", $dtFechamento, PDO::PARAM_STR);
			$stmt->bindParam(":dtFechaConfirmado", $dtFechaConfirmado, PDO::PARAM_STR);
			$stmt->bindParam(":dtCancelamento", $dtCancelamento, PDO::PARAM_STR);
			$stmt->bindParam(":idAtendente", $idAtendente, PDO::PARAM_INT);
			$stmt->bindParam(":idTecnicoIndicado", $idTecnicoIndicado, PDO::PARAM_INT);
			$stmt->bindParam(":dtLiberacao", $dtLiberacao, PDO::PARAM_STR);
			$stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
			$stmt->bindParam(":dtEspera", $dtEspera, PDO::PARAM_STR);
			$stmt->bindParam(":dtAguardandoUsuario", $dtAguardandoUsuario, PDO::PARAM_STR);
			$stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(Ocorrencia $ocorrencia){
        $sql = "INSERT INTO ocorrencia(id, id_area_responsavel_area_responsavel, id_servico_servico, id_local, id_funcionario, desc_problema, campus, etiq_equipamento, contato, ramal, local, funcionario, status, obs, prioridade, avaliacao, email, fecha_confirmado, reaberto, dt_abertura, dt_atendimento, dt_fechamento, dt_fecha_confirmado, dt_cancelamento, id_atendente, id_tecnico_indicado, dt_liberacao, anexo, dt_espera, dt_aguardando_usuario, local_sala) VALUES (:id, :areaResponsavel, :servico, :idLocal, :idFuncionario, :descProblema, :campus, :etiqEquipamento, :contato, :ramal, :local, :funcionario, :status, :obs, :prioridade, :avaliacao, :email, :fechaConfirmado, :reaberto, :dtAbertura, :dtAtendimento, :dtFechamento, :dtFechaConfirmado, :dtCancelamento, :idAtendente, :idTecnicoIndicado, :dtLiberacao, :anexo, :dtEspera, :dtAguardandoUsuario, :localSala);";
		$id = $ocorrencia->getId();
		$areaResponsavel = $ocorrencia->getAreaResponsavel()->getId();
		$servico = $ocorrencia->getServico()->getId();
		$idLocal = $ocorrencia->getIdLocal();
		$idFuncionario = $ocorrencia->getIdFuncionario();
		$descProblema = $ocorrencia->getDescProblema();
		$campus = $ocorrencia->getCampus();
		$etiqEquipamento = $ocorrencia->getEtiqEquipamento();
		$contato = $ocorrencia->getContato();
		$ramal = $ocorrencia->getRamal();
		$local = $ocorrencia->getLocal();
		$funcionario = $ocorrencia->getFuncionario();
		$status = $ocorrencia->getStatus();
		$obs = $ocorrencia->getObs();
		$prioridade = $ocorrencia->getPrioridade();
		$avaliacao = $ocorrencia->getAvaliacao();
		$email = $ocorrencia->getEmail();
		$fechaConfirmado = $ocorrencia->getFechaConfirmado();
		$reaberto = $ocorrencia->getReaberto();
		$dtAbertura = $ocorrencia->getDtAbertura();
		$dtAtendimento = $ocorrencia->getDtAtendimento();
		$dtFechamento = $ocorrencia->getDtFechamento();
		$dtFechaConfirmado = $ocorrencia->getDtFechaConfirmado();
		$dtCancelamento = $ocorrencia->getDtCancelamento();
		$idAtendente = $ocorrencia->getIdAtendente();
		$idTecnicoIndicado = $ocorrencia->getIdTecnicoIndicado();
		$dtLiberacao = $ocorrencia->getDtLiberacao();
		$anexo = $ocorrencia->getAnexo();
		$dtEspera = $ocorrencia->getDtEspera();
		$dtAguardandoUsuario = $ocorrencia->getDtAguardandoUsuario();
		$localSala = $ocorrencia->getLocalSala();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
			$stmt->bindParam(":servico", $servico, PDO::PARAM_INT);
			$stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
			$stmt->bindParam(":idFuncionario", $idFuncionario, PDO::PARAM_INT);
			$stmt->bindParam(":descProblema", $descProblema, PDO::PARAM_STR);
			$stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
			$stmt->bindParam(":etiqEquipamento", $etiqEquipamento, PDO::PARAM_STR);
			$stmt->bindParam(":contato", $contato, PDO::PARAM_STR);
			$stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
			$stmt->bindParam(":local", $local, PDO::PARAM_STR);
			$stmt->bindParam(":funcionario", $funcionario, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":obs", $obs, PDO::PARAM_STR);
			$stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
			$stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":fechaConfirmado", $fechaConfirmado, PDO::PARAM_STR);
			$stmt->bindParam(":reaberto", $reaberto, PDO::PARAM_STR);
			$stmt->bindParam(":dtAbertura", $dtAbertura, PDO::PARAM_STR);
			$stmt->bindParam(":dtAtendimento", $dtAtendimento, PDO::PARAM_STR);
			$stmt->bindParam(":dtFechamento", $dtFechamento, PDO::PARAM_STR);
			$stmt->bindParam(":dtFechaConfirmado", $dtFechaConfirmado, PDO::PARAM_STR);
			$stmt->bindParam(":dtCancelamento", $dtCancelamento, PDO::PARAM_STR);
			$stmt->bindParam(":idAtendente", $idAtendente, PDO::PARAM_INT);
			$stmt->bindParam(":idTecnicoIndicado", $idTecnicoIndicado, PDO::PARAM_INT);
			$stmt->bindParam(":dtLiberacao", $dtLiberacao, PDO::PARAM_STR);
			$stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
			$stmt->bindParam(":dtEspera", $dtEspera, PDO::PARAM_STR);
			$stmt->bindParam(":dtAguardandoUsuario", $dtAguardandoUsuario, PDO::PARAM_STR);
			$stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(Ocorrencia $ocorrencia){
		$id = $ocorrencia->getId();
		$sql = "DELETE FROM ocorrencia WHERE id = :id";
		    
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
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
        ORDER BY id DESC
                 LIMIT 10";

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
		        $ocorrencia = new Ocorrencia();
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                $lista [] = $ocorrencia;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(Ocorrencia $ocorrencia) {
        $lista = array();
	    $id = $ocorrencia->getId();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdLocal(Ocorrencia $ocorrencia) {
        $lista = array();
	    $idLocal = $ocorrencia->getIdLocal();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.id_local = :idLocal";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdFuncionario(Ocorrencia $ocorrencia) {
        $lista = array();
	    $idFuncionario = $ocorrencia->getIdFuncionario();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.id_funcionario = :idFuncionario";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idFuncionario", $idFuncionario, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDescProblema(Ocorrencia $ocorrencia) {
        $lista = array();
	    $descProblema = $ocorrencia->getDescProblema();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.desc_problema like :descProblema";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":descProblema", $descProblema, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorCampus(Ocorrencia $ocorrencia) {
        $lista = array();
	    $campus = $ocorrencia->getCampus();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.campus like :campus";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorEtiqEquipamento(Ocorrencia $ocorrencia) {
        $lista = array();
	    $etiqEquipamento = $ocorrencia->getEtiqEquipamento();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.etiq_equipamento like :etiqEquipamento";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":etiqEquipamento", $etiqEquipamento, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorContato(Ocorrencia $ocorrencia) {
        $lista = array();
	    $contato = $ocorrencia->getContato();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.contato like :contato";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":contato", $contato, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorRamal(Ocorrencia $ocorrencia) {
        $lista = array();
	    $ramal = $ocorrencia->getRamal();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.ramal like :ramal";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorLocal(Ocorrencia $ocorrencia) {
        $lista = array();
	    $local = $ocorrencia->getLocal();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.local like :local";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":local", $local, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorFuncionario(Ocorrencia $ocorrencia) {
        $lista = array();
	    $funcionario = $ocorrencia->getFuncionario();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.funcionario like :funcionario";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":funcionario", $funcionario, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorStatus(Ocorrencia $ocorrencia) {
        $lista = array();
	    $status = $ocorrencia->getStatus();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.status like :status";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorObs(Ocorrencia $ocorrencia) {
        $lista = array();
	    $obs = $ocorrencia->getObs();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.obs like :obs";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":obs", $obs, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorPrioridade(Ocorrencia $ocorrencia) {
        $lista = array();
	    $prioridade = $ocorrencia->getPrioridade();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.prioridade like :prioridade";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorAvaliacao(Ocorrencia $ocorrencia) {
        $lista = array();
	    $avaliacao = $ocorrencia->getAvaliacao();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.avaliacao like :avaliacao";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorEmail(Ocorrencia $ocorrencia) {
        $lista = array();
	    $email = $ocorrencia->getEmail();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.email like :email";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorFechaConfirmado(Ocorrencia $ocorrencia) {
        $lista = array();
	    $fechaConfirmado = $ocorrencia->getFechaConfirmado();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.fecha_confirmado like :fechaConfirmado";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":fechaConfirmado", $fechaConfirmado, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorReaberto(Ocorrencia $ocorrencia) {
        $lista = array();
	    $reaberto = $ocorrencia->getReaberto();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.reaberto like :reaberto";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":reaberto", $reaberto, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtAbertura(Ocorrencia $ocorrencia) {
        $lista = array();
	    $dtAbertura = $ocorrencia->getDtAbertura();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.dt_abertura like :dtAbertura";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtAbertura", $dtAbertura, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtAtendimento(Ocorrencia $ocorrencia) {
        $lista = array();
	    $dtAtendimento = $ocorrencia->getDtAtendimento();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.dt_atendimento like :dtAtendimento";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtAtendimento", $dtAtendimento, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtFechamento(Ocorrencia $ocorrencia) {
        $lista = array();
	    $dtFechamento = $ocorrencia->getDtFechamento();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.dt_fechamento like :dtFechamento";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtFechamento", $dtFechamento, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtFechaConfirmado(Ocorrencia $ocorrencia) {
        $lista = array();
	    $dtFechaConfirmado = $ocorrencia->getDtFechaConfirmado();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.dt_fecha_confirmado like :dtFechaConfirmado";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtFechaConfirmado", $dtFechaConfirmado, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtCancelamento(Ocorrencia $ocorrencia) {
        $lista = array();
	    $dtCancelamento = $ocorrencia->getDtCancelamento();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.dt_cancelamento like :dtCancelamento";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtCancelamento", $dtCancelamento, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdAtendente(Ocorrencia $ocorrencia) {
        $lista = array();
	    $idAtendente = $ocorrencia->getIdAtendente();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.id_atendente = :idAtendente";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idAtendente", $idAtendente, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorIdTecnicoIndicado(Ocorrencia $ocorrencia) {
        $lista = array();
	    $idTecnicoIndicado = $ocorrencia->getIdTecnicoIndicado();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.id_tecnico_indicado = :idTecnicoIndicado";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":idTecnicoIndicado", $idTecnicoIndicado, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtLiberacao(Ocorrencia $ocorrencia) {
        $lista = array();
	    $dtLiberacao = $ocorrencia->getDtLiberacao();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.dt_liberacao like :dtLiberacao";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtLiberacao", $dtLiberacao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorAnexo(Ocorrencia $ocorrencia) {
        $lista = array();
	    $anexo = $ocorrencia->getAnexo();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.anexo like :anexo";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtEspera(Ocorrencia $ocorrencia) {
        $lista = array();
	    $dtEspera = $ocorrencia->getDtEspera();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.dt_espera like :dtEspera";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtEspera", $dtEspera, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDtAguardandoUsuario(Ocorrencia $ocorrencia) {
        $lista = array();
	    $dtAguardandoUsuario = $ocorrencia->getDtAguardandoUsuario();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.dt_aguardando_usuario like :dtAguardandoUsuario";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":dtAguardandoUsuario", $dtAguardandoUsuario, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorLocalSala(Ocorrencia $ocorrencia) {
        $lista = array();
	    $localSala = $ocorrencia->getLocalSala();
                
        $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
            WHERE ocorrencia.local_sala like :localSala";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $ocorrencia = new Ocorrencia();
    	        $ocorrencia->setId( $linha ['id'] );
    	        $ocorrencia->setIdLocal( $linha ['id_local'] );
    	        $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
    	        $ocorrencia->setDescProblema( $linha ['desc_problema'] );
    	        $ocorrencia->setCampus( $linha ['campus'] );
    	        $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
    	        $ocorrencia->setContato( $linha ['contato'] );
    	        $ocorrencia->setRamal( $linha ['ramal'] );
    	        $ocorrencia->setLocal( $linha ['local'] );
    	        $ocorrencia->setFuncionario( $linha ['funcionario'] );
    	        $ocorrencia->setStatus( $linha ['status'] );
    	        $ocorrencia->setObs( $linha ['obs'] );
    	        $ocorrencia->setPrioridade( $linha ['prioridade'] );
    	        $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
    	        $ocorrencia->setEmail( $linha ['email'] );
    	        $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
    	        $ocorrencia->setReaberto( $linha ['reaberto'] );
    	        $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
    	        $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
    	        $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
    	        $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
    	        $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
    	        $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
    	        $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
    	        $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
    	        $ocorrencia->setAnexo( $linha ['anexo'] );
    	        $ocorrencia->setDtEspera( $linha ['dt_espera'] );
    	        $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
    	        $ocorrencia->setLocalSala( $linha ['local_sala'] );
    			$ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
    			$ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
    			$ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
    			$ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
    			$ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
    			$ocorrencia->getServico()->setAreaResponsavel( $linha ['area_responsavel_servico_servico'] );
    			$ocorrencia->getServico()->setGrupoServico( $linha ['grupo_servico_servico_servico'] );
    			$ocorrencia->getServico()->setTipoAtividade( $linha ['tipo_atividade_servico_servico'] );
    			$lista [] = $ocorrencia;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(Ocorrencia $ocorrencia) {
        
	    $id = $ocorrencia->getId();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.id = :id
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
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorIdLocal(Ocorrencia $ocorrencia) {
        
	    $idLocal = $ocorrencia->getIdLocal();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.id_local = :idLocal
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idLocal", $idLocal, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorIdFuncionario(Ocorrencia $ocorrencia) {
        
	    $idFuncionario = $ocorrencia->getIdFuncionario();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.id_funcionario = :idFuncionario
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idFuncionario", $idFuncionario, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDescProblema(Ocorrencia $ocorrencia) {
        
	    $descProblema = $ocorrencia->getDescProblema();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.desc_problema = :descProblema
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":descProblema", $descProblema, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorCampus(Ocorrencia $ocorrencia) {
        
	    $campus = $ocorrencia->getCampus();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.campus = :campus
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorEtiqEquipamento(Ocorrencia $ocorrencia) {
        
	    $etiqEquipamento = $ocorrencia->getEtiqEquipamento();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.etiq_equipamento = :etiqEquipamento
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":etiqEquipamento", $etiqEquipamento, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorContato(Ocorrencia $ocorrencia) {
        
	    $contato = $ocorrencia->getContato();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.contato = :contato
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":contato", $contato, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorRamal(Ocorrencia $ocorrencia) {
        
	    $ramal = $ocorrencia->getRamal();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.ramal = :ramal
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":ramal", $ramal, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorLocal(Ocorrencia $ocorrencia) {
        
	    $local = $ocorrencia->getLocal();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.local = :local
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":local", $local, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorFuncionario(Ocorrencia $ocorrencia) {
        
	    $funcionario = $ocorrencia->getFuncionario();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.funcionario = :funcionario
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":funcionario", $funcionario, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorStatus(Ocorrencia $ocorrencia) {
        
	    $status = $ocorrencia->getStatus();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.status = :status
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorObs(Ocorrencia $ocorrencia) {
        
	    $obs = $ocorrencia->getObs();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.obs = :obs
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":obs", $obs, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorPrioridade(Ocorrencia $ocorrencia) {
        
	    $prioridade = $ocorrencia->getPrioridade();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.prioridade = :prioridade
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":prioridade", $prioridade, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorAvaliacao(Ocorrencia $ocorrencia) {
        
	    $avaliacao = $ocorrencia->getAvaliacao();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.avaliacao = :avaliacao
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":avaliacao", $avaliacao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorEmail(Ocorrencia $ocorrencia) {
        
	    $email = $ocorrencia->getEmail();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.email = :email
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
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorFechaConfirmado(Ocorrencia $ocorrencia) {
        
	    $fechaConfirmado = $ocorrencia->getFechaConfirmado();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.fecha_confirmado = :fechaConfirmado
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":fechaConfirmado", $fechaConfirmado, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorReaberto(Ocorrencia $ocorrencia) {
        
	    $reaberto = $ocorrencia->getReaberto();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.reaberto = :reaberto
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":reaberto", $reaberto, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDtAbertura(Ocorrencia $ocorrencia) {
        
	    $dtAbertura = $ocorrencia->getDtAbertura();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.dt_abertura = :dtAbertura
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtAbertura", $dtAbertura, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDtAtendimento(Ocorrencia $ocorrencia) {
        
	    $dtAtendimento = $ocorrencia->getDtAtendimento();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.dt_atendimento = :dtAtendimento
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtAtendimento", $dtAtendimento, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDtFechamento(Ocorrencia $ocorrencia) {
        
	    $dtFechamento = $ocorrencia->getDtFechamento();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.dt_fechamento = :dtFechamento
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtFechamento", $dtFechamento, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDtFechaConfirmado(Ocorrencia $ocorrencia) {
        
	    $dtFechaConfirmado = $ocorrencia->getDtFechaConfirmado();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.dt_fecha_confirmado = :dtFechaConfirmado
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtFechaConfirmado", $dtFechaConfirmado, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDtCancelamento(Ocorrencia $ocorrencia) {
        
	    $dtCancelamento = $ocorrencia->getDtCancelamento();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.dt_cancelamento = :dtCancelamento
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtCancelamento", $dtCancelamento, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorIdAtendente(Ocorrencia $ocorrencia) {
        
	    $idAtendente = $ocorrencia->getIdAtendente();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.id_atendente = :idAtendente
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idAtendente", $idAtendente, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorIdTecnicoIndicado(Ocorrencia $ocorrencia) {
        
	    $idTecnicoIndicado = $ocorrencia->getIdTecnicoIndicado();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.id_tecnico_indicado = :idTecnicoIndicado
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":idTecnicoIndicado", $idTecnicoIndicado, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDtLiberacao(Ocorrencia $ocorrencia) {
        
	    $dtLiberacao = $ocorrencia->getDtLiberacao();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.dt_liberacao = :dtLiberacao
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtLiberacao", $dtLiberacao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorAnexo(Ocorrencia $ocorrencia) {
        
	    $anexo = $ocorrencia->getAnexo();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.anexo = :anexo
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":anexo", $anexo, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDtEspera(Ocorrencia $ocorrencia) {
        
	    $dtEspera = $ocorrencia->getDtEspera();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.dt_espera = :dtEspera
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtEspera", $dtEspera, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorDtAguardandoUsuario(Ocorrencia $ocorrencia) {
        
	    $dtAguardandoUsuario = $ocorrencia->getDtAguardandoUsuario();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.dt_aguardando_usuario = :dtAguardandoUsuario
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":dtAguardandoUsuario", $dtAguardandoUsuario, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
                
    public function preenchePorLocalSala(Ocorrencia $ocorrencia) {
        
	    $localSala = $ocorrencia->getLocalSala();
	    $sql = "
		SELECT
        ocorrencia.id, 
        ocorrencia.id_local, 
        ocorrencia.id_funcionario, 
        ocorrencia.desc_problema, 
        ocorrencia.campus, 
        ocorrencia.etiq_equipamento, 
        ocorrencia.contato, 
        ocorrencia.ramal, 
        ocorrencia.local, 
        ocorrencia.funcionario, 
        ocorrencia.status, 
        ocorrencia.obs, 
        ocorrencia.prioridade, 
        ocorrencia.avaliacao, 
        ocorrencia.email, 
        ocorrencia.fecha_confirmado, 
        ocorrencia.reaberto, 
        ocorrencia.dt_abertura, 
        ocorrencia.dt_atendimento, 
        ocorrencia.dt_fechamento, 
        ocorrencia.dt_fecha_confirmado, 
        ocorrencia.dt_cancelamento, 
        ocorrencia.id_atendente, 
        ocorrencia.id_tecnico_indicado, 
        ocorrencia.dt_liberacao, 
        ocorrencia.anexo, 
        ocorrencia.dt_espera, 
        ocorrencia.dt_aguardando_usuario, 
        ocorrencia.local_sala, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        servico.id as id_servico_servico, 
        servico.nome as nome_servico_servico, 
        servico.descricao as descricao_servico_servico, 
        servico.ativo as ativo_servico_servico, 
        servico.tempo_sla as tempo_sla_servico_servico
		FROM ocorrencia
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = ocorrencia.id_area_responsavel
		INNER JOIN servico as servico ON servico.id = ocorrencia.id_servico
                WHERE ocorrencia.local_sala = :localSala
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":localSala", $localSala, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $ocorrencia->setId( $linha ['id'] );
                $ocorrencia->setIdLocal( $linha ['id_local'] );
                $ocorrencia->setIdFuncionario( $linha ['id_funcionario'] );
                $ocorrencia->setDescProblema( $linha ['desc_problema'] );
                $ocorrencia->setCampus( $linha ['campus'] );
                $ocorrencia->setEtiqEquipamento( $linha ['etiq_equipamento'] );
                $ocorrencia->setContato( $linha ['contato'] );
                $ocorrencia->setRamal( $linha ['ramal'] );
                $ocorrencia->setLocal( $linha ['local'] );
                $ocorrencia->setFuncionario( $linha ['funcionario'] );
                $ocorrencia->setStatus( $linha ['status'] );
                $ocorrencia->setObs( $linha ['obs'] );
                $ocorrencia->setPrioridade( $linha ['prioridade'] );
                $ocorrencia->setAvaliacao( $linha ['avaliacao'] );
                $ocorrencia->setEmail( $linha ['email'] );
                $ocorrencia->setFechaConfirmado( $linha ['fecha_confirmado'] );
                $ocorrencia->setReaberto( $linha ['reaberto'] );
                $ocorrencia->setDtAbertura( $linha ['dt_abertura'] );
                $ocorrencia->setDtAtendimento( $linha ['dt_atendimento'] );
                $ocorrencia->setDtFechamento( $linha ['dt_fechamento'] );
                $ocorrencia->setDtFechaConfirmado( $linha ['dt_fecha_confirmado'] );
                $ocorrencia->setDtCancelamento( $linha ['dt_cancelamento'] );
                $ocorrencia->setIdAtendente( $linha ['id_atendente'] );
                $ocorrencia->setIdTecnicoIndicado( $linha ['id_tecnico_indicado'] );
                $ocorrencia->setDtLiberacao( $linha ['dt_liberacao'] );
                $ocorrencia->setAnexo( $linha ['anexo'] );
                $ocorrencia->setDtEspera( $linha ['dt_espera'] );
                $ocorrencia->setDtAguardandoUsuario( $linha ['dt_aguardando_usuario'] );
                $ocorrencia->setLocalSala( $linha ['local_sala'] );
                $ocorrencia->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $ocorrencia->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $ocorrencia->getServico()->setId( $linha ['id_servico_servico'] );
                $ocorrencia->getServico()->setNome( $linha ['nome_servico_servico'] );
                $ocorrencia->getServico()->setDescricao( $linha ['descricao_servico_servico'] );
                $ocorrencia->getServico()->setAtivo( $linha ['ativo_servico_servico'] );
                $ocorrencia->getServico()->setTempoSla( $linha ['tempo_sla_servico_servico'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $ocorrencia;
    }
}