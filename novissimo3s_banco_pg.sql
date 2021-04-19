
CREATE TABLE tarefa_ocorrencia (
        id serial NOT NULL, 
        CONSTRAINT pk_tarefa_ocorrencia PRIMARY KEY (id), 
        id_ocorrencia integer NOT NULL, 
        tarefa integer, 
        id_usuario integer NOT NULL, 
        data_inclusao timestamp without time zone
);

CREATE TABLE area_responsavel (
        id serial NOT NULL, 
        CONSTRAINT pk_area_responsavel PRIMARY KEY (id), 
        nome character varying(400), 
        descricao character varying(400), 
        email character varying(400)
);

CREATE TABLE grupo_servico (
        id serial NOT NULL, 
        CONSTRAINT pk_grupo_servico PRIMARY KEY (id), 
        nome character varying(400)
);

CREATE TABLE mensagem_forum (
        id serial NOT NULL, 
        CONSTRAINT pk_mensagem_forum PRIMARY KEY (id), 
        tipo integer, 
        mensagem character varying(400), 
        id_usuario integer NOT NULL, 
        data_envio timestamp without time zone
);

CREATE TABLE ocorrencia (
        id serial NOT NULL, 
        CONSTRAINT pk_ocorrencia PRIMARY KEY (id), 
        id_area_responsavel integer NOT NULL, 
        id_servico integer NOT NULL, 
        id_local integer, 
        id_usuario_cliente integer NOT NULL, 
        descricao character varying(400), 
        campus character varying(400), 
        patrimonio character varying(400), 
        ramal character varying(400), 
        local character varying(400), 
        status character varying(400), 
        solucao character varying(400), 
        prioridade character varying(400), 
        avaliacao character varying(400), 
        email character varying(400), 
        id_usuario_atendente integer, 
        id_usuario_indicado integer, 
        anexo character varying(200), 
        local_sala character varying(400), 
        data_abertura timestamp without time zone, 
        data_atendimento timestamp without time zone, 
        data_fechamento timestamp without time zone, 
        data_fechamento_confirmado timestamp without time zone
);

CREATE TABLE recesso (
        id serial NOT NULL, 
        CONSTRAINT pk_recesso PRIMARY KEY (id), 
        data date
);

CREATE TABLE servico (
        id serial NOT NULL, 
        CONSTRAINT pk_servico PRIMARY KEY (id), 
        nome character varying(400), 
        descricao character varying(400), 
        id_tipo_atividade integer NOT NULL, 
        tempo_sla integer, 
        visao integer, 
        id_area_responsavel integer NOT NULL, 
        id_grupo_servico integer NOT NULL
);

CREATE TABLE status (
        id serial NOT NULL, 
        CONSTRAINT pk_status PRIMARY KEY (id), 
        sigla character varying(400), 
        nome character varying(400)
);

CREATE TABLE status_ocorrencia (
        id serial NOT NULL, 
        CONSTRAINT pk_status_ocorrencia PRIMARY KEY (id), 
        id_ocorrencia integer NOT NULL, 
        id_status integer NOT NULL, 
        mensagem character varying(400), 
        id_usuario integer NOT NULL, 
        data_mudanca timestamp without time zone
);

CREATE TABLE tipo_atividade (
        id serial NOT NULL, 
        CONSTRAINT pk_tipo_atividade PRIMARY KEY (id), 
        nome character varying(400)
);

CREATE TABLE usuario (
        id serial NOT NULL, 
        CONSTRAINT pk_usuario PRIMARY KEY (id), 
        nome character varying(400), 
        email character varying(400), 
        login character varying(400), 
        senha character varying(400), 
        nivel character varying(400), 
        id_setor integer
);


ALTER TABLE tarefa_ocorrencia 
    ADD CONSTRAINT fk_tarefa_ocorrencia_ocorrencia FOREIGN KEY (id_ocorrencia)
    REFERENCES ocorrencia (id);


ALTER TABLE tarefa_ocorrencia 
    ADD CONSTRAINT fk_tarefa_ocorrencia_usuario FOREIGN KEY (id_usuario)
    REFERENCES usuario (id);


ALTER TABLE mensagem_forum 
    ADD CONSTRAINT fk_mensagem_forum_usuario FOREIGN KEY (id_usuario)
    REFERENCES usuario (id);


ALTER TABLE ocorrencia 
    ADD CONSTRAINT fk_ocorrencia_area_responsavel FOREIGN KEY (id_area_responsavel)
    REFERENCES area_responsavel (id);


ALTER TABLE ocorrencia 
    ADD CONSTRAINT fk_ocorrencia_servico FOREIGN KEY (id_servico)
    REFERENCES servico (id);


ALTER TABLE ocorrencia 
    ADD CONSTRAINT fk_ocorrencia_usuario_cliente FOREIGN KEY (id_usuario)
    REFERENCES usuario (id);


ALTER TABLE servico 
    ADD CONSTRAINT fk_servico_tipo_atividade FOREIGN KEY (id_tipo_atividade)
    REFERENCES tipo_atividade (id);


ALTER TABLE servico 
    ADD CONSTRAINT fk_servico_area_responsavel FOREIGN KEY (id_area_responsavel)
    REFERENCES area_responsavel (id);


ALTER TABLE servico 
    ADD CONSTRAINT fk_servico_grupo_servico FOREIGN KEY (id_grupo_servico)
    REFERENCES grupo_servico (id);


ALTER TABLE status_ocorrencia 
    ADD CONSTRAINT fk_status_ocorrencia_ocorrencia FOREIGN KEY (id_ocorrencia)
    REFERENCES ocorrencia (id);


ALTER TABLE status_ocorrencia 
    ADD CONSTRAINT fk_status_ocorrencia_status FOREIGN KEY (id_status)
    REFERENCES status (id);


ALTER TABLE status_ocorrencia 
    ADD CONSTRAINT fk_status_ocorrencia_usuario FOREIGN KEY (id_usuario)
    REFERENCES usuario (id);

ALTER TABLE mensagem_forum ADD COLUMN  id_ocorrencia  integer ;

ALTER TABLE mensagem_forum 
    ADD CONSTRAINT
    fk_ocorrencia_mensagens FOREIGN KEY (id_ocorrencia)
    REFERENCES ocorrencia (id);
