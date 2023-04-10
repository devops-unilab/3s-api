<?php
                
/**
 * Customize sua classe
 *
 */


namespace novissimo3s\custom\dao;
use novissimo3s\dao\RecessoDAO;
use novissimo3s\model\Recesso;
use PDO;
use PDOException;

class  RecessoCustomDAO extends RecessoDAO {
    
    
    public function listaApartirDe($data){
        $lista = array ();
        $sql = "SELECT recesso.id, recesso.data FROM recesso
                WHERE recesso.data > '$data'
                 LIMIT 1000";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            
            if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";
                return $lista;
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha )
            {
                $recesso = new Recesso();
                $recesso->setId( $linha ['id'] );
                $recesso->setData( $linha ['data'] );
                $lista [] = $recesso;
                
                
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $lista;
    }

}