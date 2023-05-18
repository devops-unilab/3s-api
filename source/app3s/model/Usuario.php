<?php

/**
 * Classe feita para manipulação do objeto Usuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\model;

class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $login;
    private $senha;
    private $nivel;
    private $idSetor;
    private $idUnidade;
    private $siglaUnidade;
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getLogin()
    {
        return $this->login;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    public function getNivel()
    {
        return $this->nivel;
    }
    public function setIdSetor($idSetor)
    {
        $this->idSetor = $idSetor;
    }
    public function setIdUnidade($idUnidade)
    {
        $this->idUnidade = $idUnidade;
    }
    public function getIdUnidade()
    {
        return $this->idUnidade;
    }
    public function setSiglaUnidade($siglaUnidade)
    {
        $this->siglaUnidade = $siglaUnidade;
    }
    public function getSiglaUnidade()
    {
        return $this->siglaUnidade;
    }

    public function getIdSetor()
    {
        return $this->idSetor;
    }
}
