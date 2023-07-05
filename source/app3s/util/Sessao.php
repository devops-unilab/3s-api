<?php

namespace app3s\util;

/**
 * Essa classe serve para iniciar uma sess�o usando cookie e session.
 * Serve para facilitar a utilização dessas ferramentas.
 * @author jefponte
 *
 */
class Sessao
{

    public function getEmail()
    {


        if (!isset($_SESSION['USUARIO_EMAIL'])) {
            $_SESSION['USUARIO_EMAIL'] = '0';
        }
        return $_SESSION['USUARIO_EMAIL'];
    }

    public function getIdUsuario()
    {
        if (isset($_SESSION['USUARIO_ID'])) {
            return $_SESSION['USUARIO_ID'];
        } else {

            return self::NIVEL_DESLOGADO;
        }
    }
    public function getLoginUsuario()
    {
        if (isset($_SESSION['USUARIO_LOGIN'])) {
            return $_SESSION['USUARIO_LOGIN'];
        } else {
            return self::NIVEL_DESLOGADO;
        }
    }

    const NIVEL_DESLOGADO = null;
    const NIVEL_COMUM = 'customer';
    const NIVEL_TECNICO = 'provider';
    const NIVEL_ADM = 'administrator';
    const NIVEL_DISABLED = 'disabled';
}
