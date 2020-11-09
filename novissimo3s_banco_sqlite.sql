
CREATE TABLE tarefa_ocorrencia (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    id_ocorrencia INTEGER NOT NULL,
    tarefa INTEGER ,
    id_usuario INTEGER NOT NULL,
    data_inclusao TEXT 
);

CREATE TABLE area_responsavel (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    nome TEXT ,
    descricao TEXT ,
    email TEXT 
);

CREATE TABLE grupo_servico (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    nome TEXT 
);

CREATE TABLE mensagem_forum (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    id_ocorrencia INTEGER NOT NULL,
    tipo INTEGER ,
    mensagem TEXT ,
    id_usuario INTEGER NOT NULL,
    data_envio TEXT 
);

CREATE TABLE ocorrencia (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    id_area_responsavel INTEGER NOT NULL,
    id_servico INTEGER NOT NULL,
    id_local INTEGER ,
    id_usuario_cliente INTEGER NOT NULL,
    descricao TEXT ,
    campus TEXT ,
    patrimonio TEXT ,
    ramal TEXT ,
    local TEXT ,
    status TEXT ,
    solucao TEXT ,
    prioridade TEXT ,
    avaliacao TEXT ,
    email TEXT ,
    id_usuario_atendente INTEGER ,
    id_usuario_indicado INTEGER ,
    anexo TEXT ,
    local_sala TEXT 
);

CREATE TABLE recesso (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    data TEXT 
);

CREATE TABLE servico (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    nome TEXT ,
    descricao TEXT ,
    id_tipo_atividade INTEGER NOT NULL,
    tempo_sla INTEGER ,
    visao INTEGER ,
    id_area_responsavel INTEGER NOT NULL,
    id_grupo_servico INTEGER NOT NULL
);

CREATE TABLE status (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    sigla TEXT ,
    nome TEXT 
);

CREATE TABLE status_ocorrencia (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    id_ocorrencia INTEGER NOT NULL,
    id_status INTEGER NOT NULL,
    mensagem TEXT ,
    id_usuario INTEGER NOT NULL,
    data_mudanca TEXT 
);

CREATE TABLE tipo_atividade (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    nome TEXT 
);

CREATE TABLE usuario (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    nome TEXT ,
    email TEXT ,
    login TEXT ,
    senha TEXT ,
    nivel TEXT ,
    id_setor INTEGER 
);
