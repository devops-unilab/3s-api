<?php
            
/**
 * Customize o controller do objeto Ocorrencia aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class OcorrenciaCustomController  extends OcorrenciaController {
    

	public function __construct(){
		$this->dao = new OcorrenciaCustomDAO();
		$this->view = new OcorrenciaCustomView();
	}

	public function main(){
	    
	    echo '
	        
		<div class="card mb-4">
			<div class="card-body">
<p>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Adicionar Chamado
  </button>
	        
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Editar Filtros
  </button>
</p>
                <div class="row">
	        
	        
	        
                </div>
				<div class="row">
	        
                	<div class="col-md-8 blog-main">';
	    $this->cadastrar();
	    
	    echo '
	        
	        
	        
	        
                      <h3 class="pb-4 mb-4 font-italic border-bottom">
                        Chamados em aberto
                      </h3>
	        
';
	    
	    $this->listar();
	    echo '
	        
    </div><!-- /.blog-main -->
	        
    <aside class="col-md-4 blog-sidebar">
      <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">Sobre o novíssimo 3s</h4>
        <p class="mb-0">Esta é uma aplicação completamente nova desenvolvida pela DTI. Tudo foi refeito, desde o design até a estrutura de banco de dados. 
                        Os chamados antigos foram preservados em uma nova estrutura, 
                        a responsividade foi adicionada e muitas falhas de segurança foram sanadas. </p>
      </div>
	        
      <div class="p-4">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
          <li><a href="#">March 2014</a></li>
          <li><a href="#">February 2014</a></li>
          <li><a href="#">January 2014</a></li>
          <li><a href="#">December 2013</a></li>
          <li><a href="#">November 2013</a></li>
          <li><a href="#">October 2013</a></li>
          <li><a href="#">September 2013</a></li>
          <li><a href="#">August 2013</a></li>
          <li><a href="#">July 2013</a></li>
          <li><a href="#">June 2013</a></li>
          <li><a href="#">May 2013</a></li>
          <li><a href="#">April 2013</a></li>
        </ol>
      </div>
	        
      <div class="p-4">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </aside><!-- /.blog-sidebar -->
	        
  </div><!-- /.row -->
	        
	        
	</div>
</div>
	        
	        
	        
	        
';
	    
	}
	        
}
?>