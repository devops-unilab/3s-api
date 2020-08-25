<?php
                
/**
 * Classe feita para manipulação do objeto Servico
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */



class ServicoDAO extends DAO {
    


            
            
    public function atualizar(Servico $servico)
    {
        $id = $servico->getId();
            
            
        $sql = "UPDATE servico
                SET
                nome = :nome,
                descricao = :descricao,
                ativo = :ativo,
                tempo_sla = :tempoSla
                WHERE servico.id = :id;";
			$nome = $servico->getNome();
			$descricao = $servico->getDescricao();
			$ativo = $servico->getAtivo();
			$tempoSla = $servico->getTempoSla();
            
        try {
            
            $stmt = $this->getConexao()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
			$stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function inserir(Servico $servico){
        $sql = "INSERT INTO servico(nome, descricao, ativo, tempo_sla, id_area_responsavel, id_grupo_servico, id_tipo_atividade) VALUES (:nome, :descricao, :ativo, :tempoSla, :areaResponsavel, :grupoServico, :tipoAtividade);";
		$nome = $servico->getNome();
		$descricao = $servico->getDescricao();
		$ativo = $servico->getAtivo();
		$tempoSla = $servico->getTempoSla();
		$areaResponsavel = $servico->getAreaResponsavel()->getId();
		$grupoServico = $servico->getGrupoServico()->getId();
		$tipoAtividade = $servico->getTipoAtividade()->getId();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
			$stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
			$stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
			$stmt->bindParam(":grupoServico", $grupoServico, PDO::PARAM_INT);
			$stmt->bindParam(":tipoAtividade", $tipoAtividade, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function inserirComPK(Servico $servico){
        $sql = "INSERT INTO servico(id, nome, descricao, ativo, tempo_sla, id_area_responsavel_area_responsavel, id_grupo_servico_grupo_servico, id_tipo_atividade_tipo_atividade) VALUES (:id, :nome, :descricao, :ativo, :tempoSla, :areaResponsavel, :grupoServico, :tipoAtividade);";
		$id = $servico->getId();
		$nome = $servico->getNome();
		$descricao = $servico->getDescricao();
		$ativo = $servico->getAtivo();
		$tempoSla = $servico->getTempoSla();
		$areaResponsavel = $servico->getAreaResponsavel()->getId();
		$grupoServico = $servico->getGrupoServico()->getId();
		$tipoAtividade = $servico->getTipoAtividade()->getId();
		try {
			$db = $this->getConexao();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
			$stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
			$stmt->bindParam(":areaResponsavel", $areaResponsavel, PDO::PARAM_INT);
			$stmt->bindParam(":grupoServico", $grupoServico, PDO::PARAM_INT);
			$stmt->bindParam(":tipoAtividade", $tipoAtividade, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

    }

	public function excluir(Servico $servico){
		$id = $servico->getId();
		$sql = "DELETE FROM servico WHERE id = :id";
		    
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
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
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
		        $servico = new Servico();
                $servico->setId( $linha ['id'] );
                $servico->setNome( $linha ['nome'] );
                $servico->setDescricao( $linha ['descricao'] );
                $servico->setAtivo( $linha ['ativo'] );
                $servico->setTempoSla( $linha ['tempo_sla'] );
                $servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
                $servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
                $servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
                $servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
                $lista [] = $servico;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $lista;	
    }
        
                
    public function pesquisaPorId(Servico $servico) {
        $lista = array();
	    $id = $servico->getId();
                
        $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
            WHERE servico.id = :id";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $servico = new Servico();
    	        $servico->setId( $linha ['id'] );
    	        $servico->setNome( $linha ['nome'] );
    	        $servico->setDescricao( $linha ['descricao'] );
    	        $servico->setAtivo( $linha ['ativo'] );
    	        $servico->setTempoSla( $linha ['tempo_sla'] );
    			$servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
    			$servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
    			$servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
    			$servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
    			$lista [] = $servico;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorNome(Servico $servico) {
        $lista = array();
	    $nome = $servico->getNome();
                
        $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
            WHERE servico.nome like :nome";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $servico = new Servico();
    	        $servico->setId( $linha ['id'] );
    	        $servico->setNome( $linha ['nome'] );
    	        $servico->setDescricao( $linha ['descricao'] );
    	        $servico->setAtivo( $linha ['ativo'] );
    	        $servico->setTempoSla( $linha ['tempo_sla'] );
    			$servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
    			$servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
    			$servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
    			$servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
    			$lista [] = $servico;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorDescricao(Servico $servico) {
        $lista = array();
	    $descricao = $servico->getDescricao();
                
        $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
            WHERE servico.descricao like :descricao";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $servico = new Servico();
    	        $servico->setId( $linha ['id'] );
    	        $servico->setNome( $linha ['nome'] );
    	        $servico->setDescricao( $linha ['descricao'] );
    	        $servico->setAtivo( $linha ['ativo'] );
    	        $servico->setTempoSla( $linha ['tempo_sla'] );
    			$servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
    			$servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
    			$servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
    			$servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
    			$lista [] = $servico;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorAtivo(Servico $servico) {
        $lista = array();
	    $ativo = $servico->getAtivo();
                
        $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
            WHERE servico.ativo = :ativo";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $servico = new Servico();
    	        $servico->setId( $linha ['id'] );
    	        $servico->setNome( $linha ['nome'] );
    	        $servico->setDescricao( $linha ['descricao'] );
    	        $servico->setAtivo( $linha ['ativo'] );
    	        $servico->setTempoSla( $linha ['tempo_sla'] );
    			$servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
    			$servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
    			$servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
    			$servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
    			$lista [] = $servico;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function pesquisaPorTempoSla(Servico $servico) {
        $lista = array();
	    $tempoSla = $servico->getTempoSla();
                
        $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
            WHERE servico.tempo_sla = :tempoSla";
                
        try {
                
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $servico = new Servico();
    	        $servico->setId( $linha ['id'] );
    	        $servico->setNome( $linha ['nome'] );
    	        $servico->setDescricao( $linha ['descricao'] );
    	        $servico->setAtivo( $linha ['ativo'] );
    	        $servico->setTempoSla( $linha ['tempo_sla'] );
    			$servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
    			$servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
    			$servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
    			$servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
    			$servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
    			$servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
    			$lista [] = $servico;
    			    
            }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function preenchePorId(Servico $servico) {
        
	    $id = $servico->getId();
	    $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
                WHERE servico.id = :id
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
                $servico->setId( $linha ['id'] );
                $servico->setNome( $linha ['nome'] );
                $servico->setDescricao( $linha ['descricao'] );
                $servico->setAtivo( $linha ['ativo'] );
                $servico->setTempoSla( $linha ['tempo_sla'] );
                $servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
                $servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
                $servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
                $servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $servico;
    }
                
    public function preenchePorNome(Servico $servico) {
        
	    $nome = $servico->getNome();
	    $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
                WHERE servico.nome = :nome
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
                $servico->setId( $linha ['id'] );
                $servico->setNome( $linha ['nome'] );
                $servico->setDescricao( $linha ['descricao'] );
                $servico->setAtivo( $linha ['ativo'] );
                $servico->setTempoSla( $linha ['tempo_sla'] );
                $servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
                $servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
                $servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
                $servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $servico;
    }
                
    public function preenchePorDescricao(Servico $servico) {
        
	    $descricao = $servico->getDescricao();
	    $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
                WHERE servico.descricao = :descricao
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $servico->setId( $linha ['id'] );
                $servico->setNome( $linha ['nome'] );
                $servico->setDescricao( $linha ['descricao'] );
                $servico->setAtivo( $linha ['ativo'] );
                $servico->setTempoSla( $linha ['tempo_sla'] );
                $servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
                $servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
                $servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
                $servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $servico;
    }
                
    public function preenchePorAtivo(Servico $servico) {
        
	    $ativo = $servico->getAtivo();
	    $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
                WHERE servico.ativo = :ativo
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $servico->setId( $linha ['id'] );
                $servico->setNome( $linha ['nome'] );
                $servico->setDescricao( $linha ['descricao'] );
                $servico->setAtivo( $linha ['ativo'] );
                $servico->setTempoSla( $linha ['tempo_sla'] );
                $servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
                $servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
                $servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
                $servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $servico;
    }
                
    public function preenchePorTempoSla(Servico $servico) {
        
	    $tempoSla = $servico->getTempoSla();
	    $sql = "
		SELECT
        servico.id, 
        servico.nome, 
        servico.descricao, 
        servico.ativo, 
        servico.tempo_sla, 
        area_responsavel.id as id_area_responsavel_area_responsavel, 
        area_responsavel.nome as nome_area_responsavel_area_responsavel, 
        area_responsavel.descricao as descricao_area_responsavel_area_responsavel, 
        area_responsavel.email as email_area_responsavel_area_responsavel, 
        area_responsavel.id_admin as id_admin_area_responsavel_area_responsavel, 
        grupo_servico.id as id_grupo_servico_grupo_servico, 
        grupo_servico.nome as nome_grupo_servico_grupo_servico, 
        tipo_atividade.id as id_tipo_atividade_tipo_atividade, 
        tipo_atividade.nome as nome_tipo_atividade_tipo_atividade
		FROM servico
		INNER JOIN area_responsavel as area_responsavel ON area_responsavel.id = servico.id_area_responsavel
		INNER JOIN grupo_servico as grupo_servico ON grupo_servico.id = servico.id_grupo_servico
		INNER JOIN tipo_atividade as tipo_atividade ON tipo_atividade.id = servico.id_tipo_atividade
                WHERE servico.tempo_sla = :tempoSla
                 LIMIT 1000";
                
        try {
            $stmt = $this->conexao->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":tempoSla", $tempoSla, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $linha )
            {
                $servico->setId( $linha ['id'] );
                $servico->setNome( $linha ['nome'] );
                $servico->setDescricao( $linha ['descricao'] );
                $servico->setAtivo( $linha ['ativo'] );
                $servico->setTempoSla( $linha ['tempo_sla'] );
                $servico->getAreaResponsavel()->setId( $linha ['id_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setNome( $linha ['nome_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setDescricao( $linha ['descricao_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setEmail( $linha ['email_area_responsavel_area_responsavel'] );
                $servico->getAreaResponsavel()->setIdAdmin( $linha ['id_admin_area_responsavel_area_responsavel'] );
                $servico->getGrupoServico()->setId( $linha ['id_grupo_servico_grupo_servico'] );
                $servico->getGrupoServico()->setNome( $linha ['nome_grupo_servico_grupo_servico'] );
                $servico->getTipoAtividade()->setId( $linha ['id_tipo_atividade_tipo_atividade'] );
                $servico->getTipoAtividade()->setNome( $linha ['nome_tipo_atividade_tipo_atividade'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $servico;
    }
}