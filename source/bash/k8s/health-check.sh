#!/bin/bash

#######################################################
# Script health-check
#
# Autor: Erivando Sena <erivandoramos@unilab.edu.br>
# Data: 30/06/2023

# Descrição: 
# Verifica se os containers init do Vault estão prontos 
# e se os secrets do Vault existem no container retorna 
# 0 em caso de sucesso e 1 em caso de falhas.
#######################################################

check_vault_init_containers() {
    status=$(kubectl get pods -n app3s-stag -o jsonpath='{.status.initContainerStatuses[*].ready}' | grep -q false && echo "false" || echo "true")
    if [[ $status == "false" ]]; then
        return 1
    else
        return 0
    fi
}

check_vault_secrets() {
    if [ -f /vault/secrets/config ]; then
        return 0
    else
        return 1
    fi
}

if check_vault_init_containers && check_vault_secrets; then
    exit 0
else
    exit 1
fi