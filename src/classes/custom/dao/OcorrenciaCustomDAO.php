<?php
                
/**
 * Customize sua classe
 *
 */



class  OcorrenciaCustomDAO extends OcorrenciaDAO {
    
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

}