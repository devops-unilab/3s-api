<?php 

include_once 'classes/dao/DAO.php';


define("DB_INI", "../../../3s/3s_bd.ini");

$dao = new DAO();
$dao->getConexao();

$sqls = "

DROP TABLE interrupcoes;
DROP TABLE script;
DROP TABLE script_tipo;
DROP TABLE grava_reaberto;
DROP TABLE meses;
DROP TABLE perfil;
DROP TRIGGER sequencia_ano ON ocorrencias;



ALTER TABLE ocorrencias DROP COLUMN sequencia_ano;
ALTER TABLE ocorrencias DROP COLUMN contato;
ALTER TABLE ocorrencias DROP COLUMN funcionario;
ALTER TABLE ocorrencias DROP COLUMN id_classific_ocorrencia;
ALTER TABLE ocorrencias DROP COLUMN id_classific_ocorrencia_usuario;
ALTER TABLE ocorrencias DROP COLUMN id_item_ocorrencia_usuario;
ALTER TABLE ocorrencias DROP COLUMN id_subitem_ocorrencia;
ALTER TABLE ocorrencias DROP COLUMN dt_abertura;
ALTER TABLE ocorrencias DROP COLUMN dt_atendimento;
ALTER TABLE ocorrencias DROP COLUMN dt_fechamento;
ALTER TABLE ocorrencias DROP COLUMN dt_fecha_confirmado;
ALTER TABLE ocorrencias DROP COLUMN dt_cancelamento;
ALTER TABLE ocorrencias DROP COLUMN dt_liberacao;
ALTER TABLE ocorrencias DROP COLUMN dt_espera;
ALTER TABLE ocorrencias DROP COLUMN dt_aguardando_usuario;
ALTER TABLE ocorrencias DROP COLUMN reaberto;
ALTER TABLE ocorrencias DROP COLUMN fecha_confirmado;
ALTER TABLE ocorrencias RENAME COLUMN obs TO solucao;
ALTER TABLE ocorrencias RENAME COLUMN desc_problema TO descricao;
ALTER TABLE ocorrencias RENAME COLUMN etiq_equipamento TO patrimonio;
ALTER TABLE ocorrencias RENAME COLUMN id_funcionario TO id_usuario_cliente;
ALTER TABLE ocorrencias RENAME COLUMN id_atendente TO id_usuario_atendente;
ALTER TABLE ocorrencias RENAME COLUMN id_tecnico_indicado TO id_usuario_indicado;

ALTER TABLE ocorrencias RENAME TO ocorrencia;


DROP TABLE subitem_ocorrencia;


ALTER TABLE status DROP COLUMN cor;
ALTER TABLE status DROP COLUMN icone;
ALTER TABLE status RENAME COLUMN id_status TO id;

ALTER TABLE status_ocorrencia RENAME COLUMN id_user TO id_usuario;
ALTER TABLE status_ocorrencia RENAME COLUMN dt_mudanca TO data_mudanca;

ALTER TABLE tarefa_ocorrencia RENAME COLUMN id_user TO id_usuario;
ALTER TABLE tarefa_ocorrencia RENAME COLUMN dt_inclusao TO data_inclusao;


ALTER TABLE mensagens_forum DROP COLUMN ativo;
ALTER TABLE mensagens_forum DROP COLUMN origem;
ALTER TABLE mensagens_forum RENAME COLUMN dt_envio TO data_envio;
ALTER TABLE mensagens_forum RENAME COLUMN id_user TO id_usuario;
ALTER TABLE mensagens_forum RENAME TO mensagem_forum;

ALTER TABLE area_responsavel DROP COLUMN id_admin;


CREATE TABLE usuario 
    AS 
        SELECT 
            id_usuario_sigaa as id, 
            usuario as nome, 
            email,
            email as login,
            email as senha,
            perfil as nivel, 
            id_setor
        FROM permissao_usuario;
DELETE FROM usuario WHERE id is NULL;
DELETE FROM usuario WHERE id = 1;
ALTER TABLE usuario 
    ADD CONSTRAINT pk_usuario PRIMARY KEY (id);
DROP TABLE permissao_usuario;


ALTER TABLE itens_ocorrencias DROP COLUMN hardware;
ALTER TABLE itens_ocorrencias DROP COLUMN sla;
ALTER TABLE itens_ocorrencias DROP COLUMN ativo;
ALTER TABLE itens_ocorrencias RENAME TO servico;


ALTER TABLE classific_ocorrencias DROP COLUMN descricao;
ALTER TABLE classific_ocorrencias DROP COLUMN visao;
ALTER TABLE classific_ocorrencias DROP COLUMN ativo;
ALTER TABLE classific_ocorrencias RENAME TO tipo_atividade;


ALTER TABLE ocorrencia RENAME COLUMN id_item_ocorrencia TO id_servico;
ALTER TABLE servico RENAME COLUMN id_classific_ocorrencias TO id_tipo_atividade;


CREATE TABLE grupo_servico (
        id serial  NOT NULL, 
        CONSTRAINT pk_grupo_servico PRIMARY KEY (id), 
        nome character varying (150)
);
ALTER TABLE servico ADD COLUMN  visao integer;
ALTER TABLE servico ADD COLUMN  id_area_responsavel integer;
ALTER TABLE servico ADD COLUMN  id_grupo_servico integer;

ALTER TABLE servico 
    ADD CONSTRAINT fk_servico_area_responsavel FOREIGN KEY (id_area_responsavel)
    REFERENCES area_responsavel (id);


ALTER TABLE servico 
    ADD CONSTRAINT fk_servico_grupo_servico FOREIGN KEY (id_grupo_servico)
    REFERENCES grupo_servico (id);

CREATE TABLE recesso (
        id serial  NOT NULL, 
        CONSTRAINT pk_recesso PRIMARY KEY (id), 
        data date
);

INSERT INTO grupo_servico(id, nome) VALUES (0, 'Indefinido');
UPDATE servico SET id_area_responsavel = 1;
UPDATE servico SET id_grupo_servico = 0;



";


$lista = explode(';', $sqls);
foreach($lista as $statement){
    echo $statement.'<br>';
    echo $dao->getConexao()->exec($statement);
    echo '<hr>';
}


?>