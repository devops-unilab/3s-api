<?php
                
/**
 * Customize sua classe
 *
 */



class  UsuarioCustomDAO extends UsuarioDAO {
    
    public function __construct(PDO $conexao = null, $arquivoIni = DB_INI)
    {
        // TODO Auto-generated method stub
    }
    
    public function autenticar(Usuario $usuario)
    {
        $sessao = new Sessao();
        $sessao->criaSessao(3375, Sessao::NIVEL_COMUM, 'jefponte', 'JEFFERSON UCHOA PONTE', 'jefponte@unilab.edu.br', 'DTI', 103);
        return true;
    }


}