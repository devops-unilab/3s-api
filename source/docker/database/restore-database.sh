#!/bin/bash

###############################################################################
# 
# Nome do arquivo: restore-database.sh
# Autor: Erivando Sena <erivandoramos@unilab.edu.br>
# Data de criação: 30/04/2023
#
# Descricao: Este script foi desenvolvido como parte do projeto [Stack DEVOPS DTI] da 
#            Universidade da Integracao Internacional da Lusofonia Afro-Brasileira (UNILAB).
#
# Direitos autorais (c) 2023 Erivando Sena/UNILAB.
#
# E concedida permissao para usar, copiar, modificar e distribuir este software apenas para 
# uso pessoal ou em sua organizacao, desde que este aviso de direitos autorais apareca em 
# todas as copias. 
# Este software e fornecido "como esta" e sem garantias expressas ou implicitas, incluindo, 
# mas nao se limitando a, garantias implicitas de comercializacao e adequacao a um proposito 
# especifico. 
# Em nenhum caso, o autor sera responsavel por quaisquer danos diretos, indiretos, 
# incidentais, especiais, exemplares ou consequentes (incluindo, mas nao se limitando 
# a, aquisicao de bens ou servicos substitutos, perda de uso, dados ou lucros, ou 
# interrupcao dos negocios) decorrentes do uso, incapacidade de uso ou resultados do 
# uso deste software.
#
# Este programa e distribuido na esperanca de que possa ser util, mas SEM NENHUMA 
# GARANTIA; sem uma garantia implicita de ADEQUACAO a qualquer MERCADO ou APLICACAO EM PARTICULAR.
# Veja a Licenca Publica Geral GNU para mais detalhes.
#
####################################################################################################

# Connection options:
#   -h, --host=HOSTNAME      host do servidor de banco de dados
#   -p, --port=PORT          porta do servidor de banco de dados
#   -U, --username=USERNAME  nome de usuario do banco de dados
#   -w, --no-password        nunca solicitar senha
#   -W, --password           forcar prompt de senha (should happen automatically)

set +eu

# Funcoes restore
function restore_postgres_prod() {
    local connection_string_root_con="postgresql://$PG_USER_ROOT:$PG_ROOT_PASSWORD@$PG_HOST:$PG_PORT/$PG_DATABASE" 
    pg_restore --list /tmp/bd_pg_dump.dmp | sed -E 's/(.* EXTENSION )/; \1/g' > /tmp/bd_pg_dump.toc
    pg_restore -v -j 2 -Fc -c -L /tmp/bd_pg_dump.toc $connection_string_root_con /tmp/bd_pg_dump.dmp
}

function restore_postgres_homolog() {
    local connection_string_root_con="postgresql://$PG_USER_ROOT:$PG_ROOT_PASSWORD@$PG_HOST:$PG_PORT/$PG_DATABASE_HOMOLOGACAO" 
    echo "Gerando o mapa de referencia para lista de objetos..."
    pg_restore --list /tmp/bd_pg_dump.dmp | sed -E 's/(.* EXTENSION )/; \1/g' > /tmp/bd_pg_dump.toc
    echo "Iniciando restore do banco de dados..."
    pg_restore -v -j 2 -Fc -c -L /tmp/bd_pg_dump.toc $connection_string_root_con /tmp/bd_pg_dump.dmp
    if [ "$?" -ne 0 ]; then
        echo "Erro ao restaurar o database!"
        exit 1
    else
        echo "O banco de dados foi restaurado com sucesso!"
    fi
}
