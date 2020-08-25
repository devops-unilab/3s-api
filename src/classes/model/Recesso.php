
<?php
            
/**
 * Classe feita para manipulação do objeto Recesso
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class Recesso {
	private $id;
	private $data;
    public function __construct(){

    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setData($data) {
		$this->data = $data;
	}
		    
	public function getData() {
		return $this->data;
	}
	public function __toString(){
	    return $this->id.' - '.$this->data;
	}
                

}
?>