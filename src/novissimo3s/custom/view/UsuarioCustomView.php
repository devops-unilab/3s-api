<?php
            
/**
 * Classe de visao para Usuario
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace novissimo3s\custom\view;
use novissimo3s\view\UsuarioView;


class UsuarioCustomView extends UsuarioView {

    
    public function formLogin(){
        echo '
            

<div class="login-form">
    <div class="main-div card">
        <div class="panel">
            <h2>Entrar no sistema 3s</h2>
            <p>Utilize o login e senha do sistema SIG</p>
        </div>
        <form id="login-form" class="form" method="post" action=".">

            <div class="form-group">
                <input type="text" size="350" name="usuario" class="form-control" id="usuario" placeholder="Usuario" autofocus="autofocus">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" type="password" name="senha" size="100" id="senha" placeholder="Senha">
            </div>
            <div class="forgot">
                <a href="https://sigadmin.unilab.edu.br/admin/public/recuperar_senha.jsf">Esqueceu a senha?</a>
            </div>
            <button type="submit" class="btn btn-primary">
                <span id="spinner-submit" class="escondido spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Entrar
            </button>
            <div id="register-link" class="text-right">
                <a href="https://dti.unilab.edu.br" class="text-info">Visitar a página da DTI</a>
            </div>
            <input type="hidden" class="btn btn-info btn-md" name="logar" value="Entrar">
        </form>
    </div>
</div>
';
        
        
    }
    


}