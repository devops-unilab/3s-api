<?php

namespace novissimo3s\util;

/**
 * Essa classe serve para iniciar uma sess�o usando cookie e session.
 * Serve para facilitar a utilização dessas ferramentas.
 * @author jefponte
 *
 */
class Sessao{
    
    
    public function __construct(){
        if (!isset($_SESSION)) session_start();
    }
    public function criaSessao($id, $nivel, $login, $nome, $email){
        $_SESSION['USUARIO_NIVEL'] = $nivel;
        $_SESSION['USUARIO_ID'] = $id;
        $_SESSION['USUARIO_LOGIN'] = $login;
        $_SESSION['USUARIO_NOME'] = $nome;
        $_SESSION['USUARIO_EMAIL'] = $email;
    }
    public function mataSessao(){
        @session_destroy();
    }
    public function setNivelDeAcesso($nivel){
        $_SESSION['USUARIO_NIVEL'] = $nivel;
    }
    public function getNivelAcesso(){
        if(isset($_SESSION['USUARIO_NIVEL'])){
            return $_SESSION['USUARIO_NIVEL'];
        }
        else
        {
            return self::NIVEL_DESLOGADO;
        }
        
    }
    public function getEmail(){
        
        
        if(!isset($_SESSION['USUARIO_EMAIL'])){
            $_SESSION['USUARIO_EMAIL'] = '0';
        }
        return $_SESSION['USUARIO_EMAIL'];
    }
    public function getNome(){
        if(!isset($_SESSION['USUARIO_EMAIL'])){
            $_SESSION['USUARIO_NOME'] = '';
        }
        return $_SESSION['USUARIO_NOME'];
    }
    public function getIdUsuario(){
        if(isset($_SESSION['USUARIO_ID'])){
            return $_SESSION['USUARIO_ID'];
        }
        else{
            
            return self::NIVEL_DESLOGADO;
        }
    }
    public function getLoginUsuario(){
        if(isset($_SESSION['USUARIO_LOGIN'])){
            return $_SESSION['USUARIO_LOGIN'];
        }
        else
        {
            return self::NIVEL_DESLOGADO;
        }
    }
    
    const NIVEL_DESLOGADO = null;
    const NIVEL_COMUM = 'c';
    const NIVEL_TECNICO = 't';
    const NIVEL_ADM = 'a';
    
    
}