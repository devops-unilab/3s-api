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
            
<br><br>

<div class="container forget-password">
    <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12">
                <div class="panel-body p-3 m-3">
                    <div class="text-center">

                                
                                <div class="panel">
                                    <h3>Entrar no sistema 3s</h3>
                                   
                                </div>
                                <form id="login-form" class="form" method="post" action=".">
                        
                                    <div class="form-group">
                                        <input type="text" size="350" name="usuario" class="form-control" id="usuario" placeholder="Usuario do SIG" autofocus="autofocus">
                                    </div>
                        
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="senha" size="100" id="senha" placeholder="Senha do SIG">
                                    </div>
                                    <div class="forgot">
                                        <a href="https://sigadmin.unilab.edu.br/admin/public/recuperar_senha.jsf">Esqueceu a senha?</a>
                                    </div>
                                    <button type="submit" id="botao-login" class="btn-primary btn-lg btn-block">
                                        <span id="spinner-submit" class="escondido spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Entrar
                                    </button>
                                    
                                    <input type="hidden" class="btn btn-info btn-md" name="logar" value="Entrar">
                                </form>


                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br>
<div class="d-flex justify-content-center text-center">
Este sistema é melhor visualizado utilizando o navegador Google Chrome
<i class="fa fa-chrome ml-3"></i>
</div>

';
        
        
    }
    


}