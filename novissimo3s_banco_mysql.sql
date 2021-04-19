
CREATE TABLE IF NOT EXISTS tarefa_ocorrencia (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        id_ocorrencia INT NOT NULL, 
        tarefa INT, 
        id_usuario INT NOT NULL, 
        data_inclusao  DATETIME
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS area_responsavel (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        nome VARCHAR(400), 
        descricao VARCHAR(400), 
        email VARCHAR(400)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS grupo_servico (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        nome VARCHAR(400)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS mensagem_forum (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        tipo INT, 
        mensagem VARCHAR(400), 
        id_usuario INT NOT NULL, 
        data_envio  DATETIME
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS ocorrencia (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        id_area_responsavel INT NOT NULL, 
        id_servico INT NOT NULL, 
        id_local INT, 
        id_usuario_cliente INT NOT NULL, 
        descricao VARCHAR(400), 
        campus VARCHAR(400), 
        patrimonio VARCHAR(400), 
        ramal VARCHAR(400), 
        local VARCHAR(400), 
        status VARCHAR(400), 
        solucao VARCHAR(400), 
        prioridade VARCHAR(400), 
        avaliacao VARCHAR(400), 
        email VARCHAR(400), 
        id_usuario_atendente INT, 
        id_usuario_indicado INT, 
        anexo VARCHAR(400), 
        local_sala VARCHAR(400), 
        data_abertura  DATETIME, 
        data_atendimento  DATETIME, 
        data_fechamento  DATETIME, 
        data_fechamento_confirmado  DATETIME
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS recesso (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        data  DATE 
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS servico (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        nome VARCHAR(400), 
        descricao VARCHAR(400), 
        id_tipo_atividade INT NOT NULL, 
        tempo_sla INT, 
        visao INT, 
        id_area_responsavel INT NOT NULL, 
        id_grupo_servico INT NOT NULL
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS status (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        sigla VARCHAR(400), 
        nome VARCHAR(400)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS status_ocorrencia (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        id_ocorrencia INT NOT NULL, 
        id_status INT NOT NULL, 
        mensagem VARCHAR(400), 
        id_usuario INT NOT NULL, 
        data_mudanca  DATETIME
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS tipo_atividade (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        nome VARCHAR(400)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS usuario (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        nome VARCHAR(400), 
        email VARCHAR(400), 
        login VARCHAR(400), 
        senha VARCHAR(400), 
        nivel VARCHAR(400), 
        id_setor INT
)ENGINE = InnoDB;

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

ALTER TABLE mensagem_forum ADD COLUMN  id_ocorrencia  INT ;
                        
ALTER TABLE mensagem_forum
    ADD CONSTRAINT
    fk_ocorrencia_mensagens FOREIGN KEY (id_ocorrencia)
    REFERENCES ocorrencia (id);
