<?php

/**
 * Classe feita para manipulação do objeto UsuarioController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\UsuarioDAO;
use app3s\model\Usuario;
use app3s\util\Sessao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UsuarioController
{

    protected $dao;

    public function __construct()
    {
        $this->dao = new UsuarioDAO();
    }


    public function autenticar(Usuario $usuario)
    {

        $login = $usuario->getLogin();
        $senha = $usuario->getSenha();
        $data = ['login' =>  $login, 'senha' => $senha];
        $response = Http::post(env('UNILAB_API_ORIGIN') . '/authenticate', $data);
        $responseJ = json_decode($response->body());

        $idUsuario  = 0;

        if (isset($responseJ->id)) {
            $idUsuario = intval($responseJ->id);
        }
        if ($idUsuario === 0) {
            return false;
        }
        $headers = [
            'Authorization' => 'Bearer ' . $responseJ->access_token,
        ];
        $response = Http::withHeaders($headers)->get(env('UNILAB_API_ORIGIN') . '/user', $headers);
        $responseJ2 = json_decode($response->body());

        $response = Http::withHeaders($headers)->get(env('UNILAB_API_ORIGIN') . '/bond', $headers);
        $responseJ3 = json_decode($response->body());
        $nivel = 'c';
        if ($responseJ2->id_status_servidor != 1) {
            $nivel = 'd';
        }

        $data = DB::table('users')->where("id", $idUsuario)->first();
        if ($data === null) {
            DB::table('users')->insert(
                [
                    'id' => $idUsuario,
                    'name' => $responseJ2->name,
                    'email' => $responseJ2->email,
                    'login' => $responseJ2->login,
                    'role' => $nivel
                ]
            );
        } else {
            $nivel = $data->nivel;
        }
        $usuario->setId($idUsuario);
        $usuario->setNome($responseJ2->nome);
        $usuario->setEmail($responseJ2->email);
        $usuario->setNivel($nivel);

        $usuario->setIdUnidade($responseJ3[0]->id_unidade);
        $usuario->setSiglaUnidade($responseJ3[0]->sigla_unidade);
        return true;
    }
    public function mudarNivel()
    {

        $sessao = new Sessao();
        if ($sessao->getNIvelOriginal() == Sessao::NIVEL_ADM) {
            $sessao->setNivelDeAcesso($_POST['nivel']);
            echo ':sucess:' . $sessao->getNivelAcesso();
            return;
        }
        if ($sessao->getNIvelOriginal() == Sessao::NIVEL_TECNICO) {
            if ($_POST['nivel'] != Sessao::NIVEL_ADM) {
                $sessao->setNivelDeAcesso($_POST['nivel']);
                echo ':sucess:' . $sessao->getNivelAcesso();
                return;
            }
            echo ':falha:';
            return;
        }
        echo ':falha:';
    }

    public function ajaxLogin()
    {
        if (!isset($_POST['logar'])) {
            return ":falha";
        }
        $usuario = new Usuario();
        $usuario->setLogin($_POST['usuario']);
        $usuario->setSenha($_POST['senha']);

        if ($this->autenticar($usuario)) {

            $sessao = new Sessao();
            $sessao->criaSessao(
                $usuario->getId(),
                $usuario->getNivel(),
                $usuario->getLogin(),
                $usuario->getNome(),
                $usuario->getEmail()
            );
            $sessao->setIDUnidade($usuario->getIdUnidade());
            $sessao->setUnidade($usuario->getSiglaUnidade());
            echo ":sucesso:" . $sessao->getNivelAcesso();
        } else {
            echo ":falha";
        }
    }


    public function telaLogin()
    {

        echo view('auth.login');
    }

    public function fetch()
    {
        $list = DB::table('users')->get();
        foreach ($list as $user) {
            $user->str_nivel = 'Desconhecido';
            if($user->nivel === 'a'){
                $user->str_nivel = 'Administrador';
            }
            if($user->nivel === 't'){
                $user->str_nivel = 'Técnico';
            }
            if($user->nivel === 'c'){
                $user->str_nivel = 'Comum';
            }
        }
        echo view('admin.user.index', ['list' => $list]);
    }


    public function edit()
    {
        if (!isset($_GET['edit'])) {
            return;
        }
        $selected = new Usuario();
        $selected->setId(intval($_GET['edit']));
        $this->dao->fillById($selected);

        $setores = DB::table('area_responsavel')->get();

        if (!isset($_POST['edit_usuario'])) {
            $user = DB::table('users')->where('id', intval($_GET['edit']))->first();
            echo view('admin.user.edit', ['user' => $user, 'departments' => $setores]);
            return;
        }

        if (!(isset($_POST['nivel']) && isset($_POST['id_setor']))) {
            echo '

            <div class="alert alert-danger" role="alert">
              Formulário incompleto
            </div>

            ';
            return;
        }

        $selected->setNivel($_POST['nivel']);
        $selected->setIdSetor($_POST['id_setor']);

        if ($this->dao->update($selected)) {
            echo '

<div class="alert alert-success" role="alert">
  Sucesso ao alterar usuário.
</div>

';
        } else {
            echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar alterar usuário
</div>

';
        }
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=usuario">';
    }


    public function main()
    {

        echo '

        <div class="card mb-4">
            <div class="card-body">

';
        echo '
        <div class="row">';
        echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';

        if (isset($_GET['edit'])) {
            $this->edit();
        }
        $this->fetch();
        echo '</div></div></div></div>';
    }
}
