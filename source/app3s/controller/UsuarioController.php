<?php
            
/**
 * Classe feita para manipulação do objeto UsuarioController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;

use app3s\dao\AreaResponsavelDAO;
use app3s\dao\UsuarioDAO;
use app3s\model\Usuario;
use app3s\util\Sessao;
use app3s\view\UsuarioView;
use Illuminate\Support\Facades\DB;

class UsuarioController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new UsuarioDAO();
		$this->view = new UsuarioView();
	}

	
	public function autenticar(Usuario $usuario)
	{

		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$url = env('UNILAB_API_ORIGIN');
		$data = ['login' =>  $login, 'senha' => $senha];

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		$responseJ = json_decode($response);


		$idUsuario  = 0;

		if (isset($responseJ->id)) {
			$idUsuario = intval($responseJ->id);
		}
		if ($idUsuario === 0) {
			return false;
		}
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => "https://api.unilab.edu.br/api/user",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => [
				"Authorization: Bearer $responseJ->access_token"
			],
		]);

		$response = curl_exec($curl);
		curl_close($curl);
		$responseJ2 = json_decode($response);
		$nivel = 'c';
		if ($responseJ2->id_status_servidor != 1) {
			$nivel = 'd';
		}

		$data = DB::table('usuario')->where("id", $idUsuario)->first();
		if ($data === null) {
			DB::table('usuario')->insert(
				[
					'id' => $idUsuario,
					'nome' => $responseJ2->nome,
					'email' => $responseJ2->email,
					'login' => $responseJ2->login,
					'nivel' => $nivel
				]
			);
		}
		$usuario->setId($idUsuario);
		$usuario->setNome($data->nome);
		$usuario->setEmail($data->email);
		$usuario->setNivel($data->nivel);
		return true;
	}
	public function mudarNivel(){
		
		$sessao = new Sessao();
		if($sessao->getNIvelOriginal() == Sessao::NIVEL_ADM){
			$sessao->setNivelDeAcesso($_POST['nivel']);
			echo ':sucess:'.$sessao->getNivelAcesso();
			return;
		}
		if($sessao->getNIvelOriginal() == Sessao::NIVEL_TECNICO){
			if($_POST['nivel'] != Sessao::NIVEL_ADM){
				$sessao->setNivelDeAcesso($_POST['nivel']);
				echo ':sucess:'.$sessao->getNivelAcesso();
				return;
			}
			echo ':falha:';
			return;
		}
		echo ':falha:';
	}
	
	public function ajaxLogin(){
	    if (!isset($_POST['logar'])) {
	        return ":falha";
	    }
	    $usuario = new Usuario();
	    $usuario->setLogin($_POST['usuario']);
	    $usuario->setSenha($_POST['senha']);
	    
	    if ($this->autenticar($usuario)) {
	        
	        $sessao = new Sessao();
	        $sessao->criaSessao($usuario->getId(), $usuario->getNivel(), $usuario->getLogin(), $usuario->getNome(), $usuario->getEmail());
	        
	        $idUnidade = $this->dao->getIdUnidade($usuario);
	        if(count($idUnidade) > 0){
	            foreach($idUnidade as $id => $sigla){
	                $sessao->setIDUnidade($id);
	                $sessao->setUnidade($sigla );
	            }
	        }
	        
	        
	        echo ":sucesso:".$sessao->getNivelAcesso();
	    }else{
	        echo ":falha";
	    }
	}
	
	
	public function telaLogin(){
	    echo '
<div class="container">
    <div class="row">
        <div class="card mb-4">
            <div class="card-body">';
	    $this->view->formLogin();
	    echo '
            </div>
        </div>

    </div>
</div>
';
	}

	public function fetch() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_usuario'])){
            $this->view->showInsertForm();
		    return;
		}
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['login'] ) && isset ( $_POST ['senha'] ) && isset ( $_POST ['nivel'] ) && isset ( $_POST ['id_setor'] ))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		$usuario = new Usuario ();
		$usuario->setNome ( $_POST ['nome'] );
		$usuario->setEmail ( $_POST ['email'] );
		$usuario->setLogin ( $_POST ['login'] );
		$usuario->setSenha ( $_POST ['senha'] );
		$usuario->setNivel ( $_POST ['nivel'] );
		$usuario->setIdSetor ( $_POST ['id_setor'] );
            
		if ($this->dao->insert ($usuario ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Usuario
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Usuario
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=usuario">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_usuario'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['login'] ) && isset ( $_POST ['senha'] ) && isset ( $_POST ['nivel'] ) && isset ( $_POST ['id_setor'] ))) {
			echo ':incompleto';
			return;
		}
            
		$usuario = new Usuario ();
		$usuario->setNome ( $_POST ['nome'] );
		$usuario->setEmail ( $_POST ['email'] );
		$usuario->setLogin ( $_POST ['login'] );
		$usuario->setSenha ( $_POST ['senha'] );
		$usuario->setNivel ( $_POST ['nivel'] );
		$usuario->setIdSetor ( $_POST ['id_setor'] );
            
		if ($this->dao->insert ( $usuario ))
        {
			$id = $this->dao->getConnection()->lastInsertId();
            echo ':sucesso:'.$id;
            
		} else {
			 echo ':falha';
		}
	}
            
            

            
    public function edit(){
	    if(!isset($_GET['edit'])){
	        return;
	    }
        $selected = new Usuario();
	    $selected->setId(intval($_GET['edit']));
	    $this->dao->fillById($selected);
	    $areaDao = new AreaResponsavelDAO($this->dao->getConnection());
		$setores = $areaDao->fetch();
		
        if(!isset($_POST['edit_usuario'])){
            $this->view->showEditForm($selected, $setores);
            return;
        }

		if (! ( isset ( $_POST ['nivel'] ) && isset ( $_POST ['id_setor'] ))) {
			echo '

			<div class="alert alert-danger" role="alert">
			  Formulário incompleto
			</div>
			
			';
			return;
		}

		$selected->setNivel ( $_POST ['nivel'] );
		$selected->setIdSetor ( $_POST ['id_setor'] );
            
		if ($this->dao->update ($selected ))
        {
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
        

    public function main(){
        
		echo '
	        
        <div class="card mb-4">
            <div class="card-body">

';
        echo '
		<div class="row">';
        echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';
        
        if(isset($_GET['edit'])){
            $this->edit();
        }
        $this->fetch();
        
        echo '</div>';
        echo '</div>';
		echo '</div>';
        echo '</div>';
            
    }
    public function mainAjax(){

        $this->addAjax();
        
            
    }


            
}
?>