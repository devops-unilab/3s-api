<?php

/**
 * Classe de visao para Servico
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace app3s\view;

use app3s\controller\ServicoController;
use app3s\model\Servico;


class ServicoView
{


    public function showEditForm($listaAreaResponsavel, Servico $selecionado)
    {

        $visoes = array(
            ServicoController::VISAO_ADMIN,
            ServicoController::VISAO_INATIVO,
            ServicoController::VISAO_COMUM,
            ServicoController::VISAO_TECNICO
        );

        echo '






                                      ';
    }

}
