<?php 

class Setor{
    private $id;
    private $nome;
    private $descricao;
    private $email; 
    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }
    
}


?>