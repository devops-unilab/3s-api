<?php

/**
 * Classe feita para manipulação do objeto MensagemForum
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\model;

class MensagemForum
{
    private $id;
    private $tipo;
    private $mensagem;
    private $usuario;
    private $dataEnvio;
    public function __construct()
    {

        $this->usuario = new Usuario();
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getTipo()
    {
        return $this->tipo;
    }
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setDataEnvio($dataEnvio)
    {
        $this->dataEnvio = $dataEnvio;
    }

    public function getDataEnvio()
    {
        return $this->dataEnvio;
    }
}
