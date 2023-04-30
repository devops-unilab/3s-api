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

set -xeu

# Aguardar até que não haja mais atividades de banco de dados
while [[ $(psql "postgresql://$HOST_DB_USER_DUMP:$HOST_DB_PASSWORD_DUMP@$HOST_DUMP/postgres" -c "SELECT count(*) FROM pg_stat_activity WHERE datname = 'ocorrencias';" -t) -gt 0 ]]
do
  echo "Ainda há atividades de banco de dados. Aguardando..."
  sleep 1
done

# Realiza backup por dump incluindo objetos grandes
pg_dump "postgresql://$HOST_DB_USER_DUMP:$HOST_DB_PASSWORD_DUMP@$HOST_DUMP:5432/ocorrencias" --no-owner --no-acl -Fc -b -v -f /tmp/bd_pg_dump.dmp



