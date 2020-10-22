<?php
            
/**
 * Classe de visao para Usuario
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class UsuarioCustomView extends UsuarioView {

    public function formLogin(){
        echo '
            
 <div id="login">
        <h3 class="text-center text-info pt-5">Entrar no sistema 3s. </h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post" action=".">
                            <div class="form-group">
                                <label for="usuario" class="text-info">Usuario:</label><br>
                                <input type="text" id="usuario"  class="form-control" size="350" name="usuario" autofocus="autofocus">
                            </div>
                            <div class="form-group">
                                <label for="senha" class="text-info">Senha:</label><br>
                                <input type="password" name="senha" size="100" id="senha" class="form-control">
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" class="btn btn-info btn-md" name="logar" value="Entrar">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="https://dti.unilab.edu.br" class="text-info">Visitar a página da DTI</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
                ';
    }
    


}