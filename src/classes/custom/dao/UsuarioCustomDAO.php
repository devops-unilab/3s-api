<?php
                
/**
 * Customize sua classe
 *
 */



class  UsuarioCustomDAO extends UsuarioDAO {
    
    public function __construct(PDO $conexao = null, $arquivoIni = DB_INI)
    {
        parent::__construct($conexao, $arquivoIni);
    }
    
    public function autenticar(Usuario $usuario)
    {
        
        $login = $usuario->getLogin();
        $senha = $usuario->getSenha() ;
        
        $sql = "SELECT * FROM 
                usuario WHERE  LOWER(login) =  LOWER(:login) AND senha = :senha LIMIT 1";
        
        try {
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                
                $usuario->setLogin ( $linha ['login'] );
                $usuario->setId( $linha ['id'] );
                $usuario->setNivel($linha['nivel']);
                return true;
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
            $stmt = $daoSIGAA->getConexao()->prepare($sql2);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha2 ) {
                $usuario->setId($linha2['id']);
                if($linha['id_status_servidor'] != 1){
                    return false;//Status Inativo
                }
                if(sizeof($this->pesquisaPorId($usuario)) == 0)  
                {
                    $usuario->setNome($linha2['nome']);
                    $usuario->setEmail($linha2['email']);
                    
                    $this->inserirComPK($usuario);
                    return true;
                }
                else
                {
                    
                    $this->preenchePorId($usuario);
                    $usuario->setNome($linha2['nome']);
                    $usuario->setEmail($linha2['email']);
                    $usuario->setLogin($linha2['login']);
                    $usuario->setSenha($linha2['senha']);
                    $this->atualizar($usuario);
                    return true;
                }
                
            }
            
            return false;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }
    
    
//     if($linha['id_status_servidor'] == 1){
//         return true;
//     }   
    
//     $sessao = new Sessao();
//     $sessao->criaSessao($linha ['id'], Sessao::NIVEL_ADM, $linha['login'], $linha['nome'], $linha['email'], $linha['sigla_unidade'], $linha['id_unidade']);


}