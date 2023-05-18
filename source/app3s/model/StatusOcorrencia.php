<?php

/**
 * Classe feita para manipulação do objeto StatusOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\model;

class StatusOcorrencia
{
    private $id;
    private $ocorrencia;
    private $status;
    private $mensagem;
    private $usuario;
    private $dataMudanca;
    public function __construct()
    {

        $this->ocorrencia = new Ocorrencia();
        $this->status = new Status();
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
    public function setOcorrencia(Ocorrencia $ocorrencia)
    {
        $this->ocorrencia = $ocorrencia;
    }

    public function getOcorrencia()
    {
        return $this->ocorrencia;
    }
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
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
    public function setDataMudanca($dataMudanca)
    {
        $this->dataMudanca = $dataMudanca;
    }

    public function getDataMudanca()
    {
        return $this->dataMudanca;
    }
    public function __toString()
    {
        return $this->id .
        ' - ' . $this->ocorrencia .
        ' - ' . $this->status .
        ' - ' . $this->mensagem .
        ' - ' . $this->usuario .
        ' - ' . $this->dataMudanca;
    }
}
