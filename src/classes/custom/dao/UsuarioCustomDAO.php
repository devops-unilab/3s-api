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
                vw_autenticacao_3s WHERE login  = :login AND senha = :senha LIMIT 1";
        
        try {
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $linha ) {
                
                $usuario->setLogin ( $linha ['login'] );
                $usuario->setId( $linha ['id'] );
                if($linha['id_status_servidor'] == 1){
                    $sessao = new Sessao();
                    $sessao->criaSessao($linha ['id'], Sessao::NIVEL_ADM, $linha['login'], $linha['nome'], $linha['email'], $linha['sigla_unidade'], $linha['id_unidade']);
                    return true;
                }   
            }
            return false;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        } 
        return true;
    }


}