#!/bin/bash

###############################################################################
# 
# Nome do arquivo: close-database.sh
# Autor: Erivando Sena <erivandoramos@unilab.edu.br>
# Data de criação: 28/04/2023
#
# Descrição: Este script foi desenvolvido como parte do projeto [Stack DEVOPS DTI] da 
#            Universidade da Integração Internacional da Lusofonia Afro-Brasileira (UNILAB).
#
# Direitos autorais (c) 2023 Erivando Sena/UNILAB.
#
# É concedida permissão para usar, copiar, modificar e distribuir este software apenas para 
# uso pessoal ou em sua organização, desde que este aviso de direitos autorais apareça em 
# todas as cópias. 
# Este software é fornecido "como está" e sem garantias expressas ou implícitas, incluindo, 
# mas não se limitando a, garantias implícitas de comercialização e adequação a um propósito 
# específico. 
# Em nenhum caso, o autor será responsável por quaisquer danos diretos, indiretos, 
# incidentais, especiais, exemplares ou consequentes (incluindo, mas não se limitando 
# a, aquisição de bens ou serviços substitutos, perda de uso, dados ou lucros, ou 
# interrupção dos negócios) decorrentes do uso, incapacidade de uso ou resultados do 
# uso deste software.
#
# Este programa é distribuído na esperança de que possa ser útil, mas SEM NENHUMA 
# GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR.
# Veja a Licença Pública Geral GNU para mais detalhes.
#
##############################################################################

set +eu

readonly MAX_ATTEMPTS=25
readonly WAIT_TIME=10

connection_string_dump_con="postgresql://$DB_USER_DUMP:$DB_PASSWORD_DUMP@$HOST_DUMP:$PORT_DUMP/postgres" 

# Aguardar até não haver atividades no banco de dados
while [[ $(psql $connection_string_dump_con -c "SELECT count(*) FROM pg_stat_activity WHERE datname = '$DB_DATABASE_DUMP';" -t) -gt 0 ]]
do
  echo "Ainda há atividades de banco de dados. Aguardando..."
  sleep $WAIT_TIME
  attempts=$((attempts+1))
  if [ $attempts -eq $MAX_ATTEMPTS ]; then
      >&2 echo "Todas atividades encerradas na tentaviva $MAX_ATTEMPTS."
      exit 1
  fi
done
echo "Database PostgreSQL DOWN!"

# Realiza backup por dump incluindo objetos grandes
pg_dump $connection_string_dump_con --no-owner --no-acl -Fc -b -v -f /tmp/bd_pg_dump.dmp
