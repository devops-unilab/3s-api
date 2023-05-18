<?php

/**
 * Classe feita para manipulação do objeto Servico
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\model;

class Servico
{
    private $id;
    private $nome;
    private $descricao;
    private $tipoAtividade;
    private $tempoSla;
    private $visao;
    private $areaResponsavel;
    private $grupoServico;
    public function __construct()
    {

        $this->tipoAtividade = new TipoAtividade();
        $this->areaResponsavel = new AreaResponsavel();
        $this->grupoServico = new GrupoServico();
    }
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
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setTipoAtividade(TipoAtividade $tipoAtividade)
    {
        $this->tipoAtividade = $tipoAtividade;
    }

    public function getTipoAtividade()
    {
        return $this->tipoAtividade;
    }
    public function setTempoSla($tempoSla)
    {
        $this->tempoSla = $tempoSla;
    }

    public function getTempoSla()
    {
        return $this->tempoSla;
    }
    public function setVisao($visao)
    {
        $this->visao = $visao;
    }

    public function getVisao()
    {
        return $this->visao;
    }
    public function setAreaResponsavel(AreaResponsavel $areaResponsavel)
    {
        $this->areaResponsavel = $areaResponsavel;
    }

    public function getAreaResponsavel()
    {
        return $this->areaResponsavel;
    }
    public function setGrupoServico(GrupoServico $grupoServico)
    {
        $this->grupoServico = $grupoServico;
    }

    public function getGrupoServico()
    {
        return $this->grupoServico;
    }
    public function __toString()
    {
        return $this->id . ' - ' . $this->nome . ' - ' . $this->descricao . ' - ' . $this->tipoAtividade . ' - ' . $this->tempoSla . ' - ' . $this->visao . ' - ' . $this->areaResponsavel . ' - ' . $this->grupoServico;
    }
}
