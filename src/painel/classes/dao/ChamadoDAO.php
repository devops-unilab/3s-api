<?php
                
/**
 * Classe feita para manipulação do objeto Chamado
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 *
 *
 */
use novissimo3s\dao\DAO;

class ChamadoDAO extends DAO {
    
	    
			    
	public function retornaLista($strSetor = null, $data1 = null, $data2 = null) {
	    $filtroSetor = "";
	    $filtroDatas = "";
	    $filtro = "";
	    if($strSetor != null){
	        $filtroSetor = "area_responsavel.nome like '$strSetor'";
	        $filtro = "WHERE ".$filtroSetor;
	    }
	    if($data1 != null && $data2 != null)
	    {
	        
	        $filtroDatas = "ocorrencia.dt_abertura BETWEEN '$data1 01:00:00' AND '$data2 23:59:59'";
	        if($filtroSetor != ""){
	            $filtro = "WHERE ".$filtroSetor." AND ".$filtroDatas;
	        }else{
	            $filtro = "WHERE ". $filtroDatas;
	        }
	        
	    }
	    
	    
		$lista = array ();
		$sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                ocorrencia.funcionario as demandante, 
                ocorrencia.local as setor_demandante, 
                ocorrencia.dt_fecha_confirmado,

                status.id as idstatus,
                status.nome as status,

                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,

                permissao_usuario.usuario as atendente, 
                status_ocorrencia.dt_mudanca as data_mudanca

                FROM ocorrencia

                LEFT JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_atendente

                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                INNER JOIN status_ocorrencia
                ON status_ocorrencia.id_ocorrencia = ocorrencia.id
                $filtro
                ORDER BY ocorrencia.id DESC
                ";

		$result = $this->getConexao ()->query ( $sql );
                
		foreach ( $result as $linha ) {
		    if(!isset($lista [$linha ['id']])){
		        $chamado = new Chamado();
		        $lista [$linha ['id']] = $chamado;
		    }else{
		        $chamado = $lista [$linha ['id']];
		    }
		    
			$chamado->setFechamentoConfirmado($linha['dt_fecha_confirmado']);
            $chamado->setDemandante($linha['demandante']);
            $chamado->setSetorDemandante($linha['setor_demandante']);
			$chamado->setId( $linha ['id'] );
			$chamado->setDescricao( $linha ['descricao'] );
			$chamado->setAbertura( $linha ['abertura'] );
			$chamado->setAtendimento( $linha ['atendimento'] );
			$chamado->setFechamento( $linha ['fechamento'] );
			$chamado->setCampus( $linha ['campus'] );
			$chamado->setIdstatus( $linha ['idstatus'] );
			$chamado->setStatus( $linha ['status'] );
			$chamado->setAtendente( $linha ['atendente'] );
			$chamado->setIdsetor( $linha ['idsetor'] );
			$chamado->setSetor( $linha ['setor'] );
			$chamado->addMudanca($linha['data_mudanca']);
			
		}
		return $lista;
	}
     
	public function retornaFechados($strSetor = null, $data1 = null, $data2 = null) {
	    $filtroSetor = "";
	    $filtroDatas = "";
	    $filtro = "";
	    if($strSetor != null){
	        $filtroSetor = "area_responsavel.nome like '$strSetor'";
	        $filtro = "WHERE ".$filtroSetor;
	    }
	    if($data1 != null && $data2 != null)
	    {
	        
	        $filtroDatas = "ocorrencia.dt_abertura BETWEEN '$data1 01:00:00' AND '$data2 23:59:59'";
	        if($filtroSetor != ""){
	            $filtro = "WHERE ".$filtroSetor." AND ".$filtroDatas;
	        }else{
	            $filtro = "WHERE ". $filtroDatas;
	        }
	        
	    }
	    $filtroStatus = "(status.id = 5 OR status.id = 4 )";
	    if($filtro == ""){
	        $filtro = "WHERE ".$filtroStatus;
	    }else{
	        $filtro .= " AND ".$filtroStatus;
	    }
	    
	    $lista = array ();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                ocorrencia.funcionario as demandante,
                ocorrencia.local as setor_demandante,
                ocorrencia.dt_fecha_confirmado,
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente,
                status_ocorrencia.dt_mudanca as data_mudanca
                
                FROM ocorrencia
                
                LEFT JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_atendente
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                INNER JOIN status_ocorrencia
                ON status_ocorrencia.id_ocorrencia = ocorrencia.id
                $filtro
                ORDER BY ocorrencia.id DESC
                LIMIT 80
                ";

                
        $result = $this->getConexao ()->query ( $sql );
        
        foreach ( $result as $linha ) {
            if(!isset($lista [$linha ['id']])){
                $chamado = new Chamado();
                $lista [$linha ['id']] = $chamado;
            }else{
                $chamado = $lista [$linha ['id']];
            }
            
            $chamado->setFechamentoConfirmado($linha['dt_fecha_confirmado']);
            $chamado->setDemandante($linha['demandante']);
            $chamado->setSetorDemandante($linha['setor_demandante']);
            $chamado->setId( $linha ['id'] );
            $chamado->setDescricao( $linha ['descricao'] );
            $chamado->setAbertura( $linha ['abertura'] );
            $chamado->setAtendimento( $linha ['atendimento'] );
            $chamado->setFechamento( $linha ['fechamento'] );
            $chamado->setCampus( $linha ['campus'] );
            $chamado->setIdstatus( $linha ['idstatus'] );
            $chamado->setStatus( $linha ['status'] );
            $chamado->setAtendente( $linha ['atendente'] );
            $chamado->setIdsetor( $linha ['idsetor'] );
            $chamado->setSetor( $linha ['setor'] );
            $chamado->addMudanca($linha['data_mudanca']);
            
        }
        return $lista;
	}
    public function pesquisaPorId(Chamado $chamado) {
        $lista = array();
	    $id = $chamado->getId();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.id = $id";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorDescricao(Chamado $chamado) {
        $lista = array();
	    $descricao = $chamado->getDescricao();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.descricao like '%$descricao%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorAbertura(Chamado $chamado) {
        $lista = array();
	    $abertura = $chamado->getAbertura();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE abertura like '%$abertura%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorAtendimento(Chamado $chamado) {
        $lista = array();
	    $atendimento = $chamado->getAtendimento();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.atendimento like '%$atendimento%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorFechamento(Chamado $chamado) {
        $lista = array();
	    $fechamento = $chamado->getFechamento();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.fechamento like '%$fechamento%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorCampus(Chamado $chamado) {
        $lista = array();
	    $campus = $chamado->getCampus();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.campus like '%$campus%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorIdstatus(Chamado $chamado) {
        $lista = array();
	    $idstatus = $chamado->getIdstatus();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.idstatus = $idstatus";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorStatus(Chamado $chamado) {
        $lista = array();
	    $status = $chamado->getStatus();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.status like '%$status%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorAtendente(Chamado $chamado) {
        $lista = array();
	    $atendente = $chamado->getAtendente();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.atendente like '%$atendente%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorIdsetor(Chamado $chamado) {
        $lista = array();
	    $idsetor = $chamado->getIdsetor();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.idsetor = $idsetor";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function pesquisaPorSetor(Chamado $chamado) {
        $lista = array();
	    $setor = $chamado->getSetor();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.setor like '%$setor%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
            $chamado = new Chamado();
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );
			$lista [] = $chamado;
		}
		return $lista;
    }
                    
    public function preenchePorId(Chamado $chamado) {

	    $id = $chamado->getId();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.id = $id";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorDescricao(Chamado $chamado) {

	    $descricao = $chamado->getDescricao();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.descricao like '%$descricao%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorAbertura(Chamado $chamado) {

	    $abertura = $chamado->getAbertura();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.abertura like '%$abertura%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorAtendimento(Chamado $chamado) {

	    $atendimento = $chamado->getAtendimento();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.atendimento like '%$atendimento%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorFechamento(Chamado $chamado) {

	    $fechamento = $chamado->getFechamento();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.fechamento like '%$fechamento%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorCampus(Chamado $chamado) {

	    $campus = $chamado->getCampus();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.campus like '%$campus%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorIdstatus(Chamado $chamado) {

	    $idstatus = $chamado->getIdstatus();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.idstatus = $idstatus";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorStatus(Chamado $chamado) {

	    $status = $chamado->getStatus();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.status like '%$status%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorAtendente(Chamado $chamado) {

	    $atendente = $chamado->getAtendente();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.atendente like '%$atendente%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorIdsetor(Chamado $chamado) {

	    $idsetor = $chamado->getIdsetor();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.idsetor = $idsetor";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                    
    public function preenchePorSetor(Chamado $chamado) {

	    $setor = $chamado->getSetor();
	    $sql = "SELECT
                ocorrencia.id as id,
                ocorrencia.desc_problema as descricao,
                ocorrencia.dt_abertura as abertura,
                ocorrencia.dt_atendimento as atendimento,
                ocorrencia.dt_fechamento as fechamento,
                ocorrencia.campus,
                
                
                status.id as idstatus,
                status.nome as status,
                
                area_responsavel.id as idsetor,
                area_responsavel.nome as setor,
                
                permissao_usuario.usuario as atendente
                
                FROM ocorrencia
                
                INNER JOIN
                permissao_usuario
                ON permissao_usuario.id_usuario_sigaa = ocorrencia.id_funcionario
                
                INNER JOIN status
                ON status.sigla = ocorrencia.status
                INNER JOIN area_responsavel
                ON area_responsavel.id = ocorrencia.id_area_responsavel
                WHERE ocorrencia.setor like '%$setor%'";
	    $result = $this->getConexao ()->query ( $sql );
                    
	    foreach ( $result as $linha ) {
	        $chamado->setId( $linha ['id'] );
	        $chamado->setDescricao( $linha ['descricao'] );
	        $chamado->setAbertura( $linha ['abertura'] );
	        $chamado->setAtendimento( $linha ['atendimento'] );
	        $chamado->setFechamento( $linha ['fechamento'] );
	        $chamado->setCampus( $linha ['campus'] );
	        $chamado->setIdstatus( $linha ['idstatus'] );
	        $chamado->setStatus( $linha ['status'] );
	        $chamado->setAtendente( $linha ['atendente'] );
	        $chamado->setIdsetor( $linha ['idsetor'] );
	        $chamado->setSetor( $linha ['setor'] );

		}
		return $chamado;
    }
                
                
}