<?php
                
/**
 * Customize sua classe
 *
 */


namespace novissimo3s\custom\dao;
use PDO;
use PDOException;
use novissimo3s\dao\DAO;
use novissimo3s\dao\UsuarioDAO;
use novissimo3s\model\Usuario;
use novissimo3s\util\Sessao;



class  UsuarioCustomDAO extends UsuarioDAO {
    
    public function autenticar(Usuario $usuario)
    {
        
        $login = $usuario->getLogin();
        $senha = $usuario->getSenha() ;
        
        $sql = "SELECT * FROM
                usuario WHERE
                LOWER(login) =  LOWER(:login) AND senha = :senha LIMIT 1";
        
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                $usuario->setId( $linha ['id'] );
                $usuario->setNome($linha['nome']);
                $usuario->setEmail( $linha ['email'] );
                $usuario->setNivel($linha['nivel']);
                
                return true;
//                 if($this->usuarioAtivo($usuario)){
                    
//                     return true;
//                 }else{
//                     return false;
//                 }
                
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        
        $daoSIGAA = new DAO(null, DB_AUTENTICACAO);
        
        
        $sql2 = "SELECT
                *
                FROM vw_autenticacao_3s
                WHERE LOWER(login) = LOWER(:login)
                AND senha = :senha LIMIT 1";
        
        try {
            $stmt = $daoSIGAA->getConnection()->prepare($sql2);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha2 ) {
                $usuario->setId($linha2['id']);
                if($linha2['id_status_servidor'] != 1){
                    return false;//Status Inativo
                }
                if(sizeof($this->fetchById($usuario)) == 0)
                {
                    $usuario->setNome($linha2['nome']);
                    $usuario->setEmail($linha2['email']);
                    $usuario->setNivel(Sessao::NIVEL_COMUM);
                    $this->insertWithPK($usuario);
                    return true;
                }
                else
                {
                    
                    $this->fillById($usuario);
                    $usuario->setNome($linha2['nome']);
                    $usuario->setEmail($linha2['email']);
                    $usuario->setLogin($linha2['login']);
                    $usuario->setSenha($linha2['senha']);
                    $this->update($usuario);
                    return true;
                }
                
            }
            
            return false;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        
    }
    /**
     * Verifica na base de autenticação se usuário está ativo ou não.
     * @param Usuario $usuario
     * @return boolean
     */
    public function usuarioAtivo(Usuario $usuario){
        $id = $usuario->getId();
        $daoSIGAA = new DAO(null, DB_AUTENTICACAO);
        $sql2 = "SELECT
                *
                FROM vw_autenticacao_3s
                WHERE id = :id LIMIT 1";
        try {
            $stmt = $daoSIGAA->getConnection()->prepare($sql2);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha2 ) {
                
                if($linha2['id_status_servidor'] == 1)
                {
                    
                    return true;//Status Inativo
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return false;
        
    }


    public function getIdUnidade(Usuario $usuario){
        $idUnidade = array();
        $id = $usuario->getId();
        $daoSIGAA = new DAO(null, DB_AUTENTICACAO);
        $sql2 = "SELECT
                *
                FROM vw_autenticacao_3s
                WHERE id = :id LIMIT 1";
        try {
            $stmt = $daoSIGAA->getConnection()->prepare($sql2);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha2 ) {
                
                if($linha2['id_status_servidor'] == 1)
                {
                    $idUnidade[$linha2['id_unidade']] = $linha2['sigla_unidade'];
                    return $idUnidade;//Status Inativo
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            return $idUnidade;
        }
        return $idUnidade;
        
    }

}