<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class OcorrenciaCustomView extends OcorrenciaView {

    
    public function mostraFormInserir2($listaServico){

        echo '
            

  <div class="card card-body">
            
            
<form method="post" action="" enctype="multipart/form-data">
    <span class="titulo medio">Informe os dados para cadastro</span><br>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="select-demanda">Serviço*</label>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <select id="select-servicos" name="item_ocorrencia" required>
                        <option value="" selected="selected">Selecione um serviço</option>';        
        foreach($listaServico as $servico){
            if($servico->getDescricao() == ""){
                $descricao = $servico->getNome();
            }else{
                $descricao = $servico->getDescricao();
            }
            echo '
                        <option value="'.$servico->getId().'">'.$descricao.'</option>';
        }
        echo '
            
            
            
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="desc_problema">Descrição*</label>
                    <textarea class="form-control" rows="3" name="desc_problema" id="desc_problema" required></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="anexo" id="anexo">
                      <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
                    </div>
            
                </div>
            </div>
            
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row"><!--Campus Local Sala Contato(Ramal e email)-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="campus">Campus*</label>
                    <select title="Campus Universitário."  rel="tooltip" name="campus" class="form-control" id="campus" required>
                        <option value="" selected>Selecione um Campus</option>
                        <option value="liberdade">Campus Liberdade</option>
                        <option value="auroras">Campus Auroras</option>
                        <option value="palmares">Campus Palmares</option>
                        <option value="males">Campus dos Malês</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="local_sala">Local/Sala</label>
                    <input class="form-control" type="text" name="local_sala" id="local_sala" value="" >
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="etiq_equipamento">Patrimônio</label>
                    <input class="form-control" type="text" name="etiq_equipamento" id="etiq_equipamento" rel="tooltip" title="Identificação do Equipamento. (Opcional)" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >Ramal</label>
                    <input class="form-control" type="text" name="ramal" id="ramal" value="">
                </div>
            
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >E-mail*</label>
                    <input class="form-control" type="text" name="email" id="email" value="$_SESSION[\'email\']" required>
                </div>
            
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center m-3">
        <input type="submit" id="btn-submit" name="enviar_ocorrencia" value="Cadastrar Ocorrência" class="btn btn-primary" >
    </div>
</form>
            
      
  </div><br><br>

            
';
    }
    
    public function exibirLista($lista){
        echo '
            <div class="row">
                <div class="col-md-8 blog-main">';
        echo '
            <div class="row">
                    <div class="col-md-10">
                        <h3 class="pb-4 mb-4 font-italic border-bottom">
                            Lista de Ocorrências
                        </h3>
                        
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-warning btn-circle btn-lg"  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-filter icone-maior"></i></button>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                                Local reservado para o formulário de edição de filtros. 
                              </div><br><br>
                            </div>
                        </div>
                        
                    </div>



                <div class="panel panel-info">
                    <div class="list-group">';
        
        foreach($lista as $elemento){
            echo '
                        <a href="?pagina=ocorrencia&selecionar='.$elemento->getId().'" class="list-group-item active">'.$elemento->getId().' - '.$elemento->getServico()->getNome().'</a>';
            
        }
        
        echo '          </div>
                    </div>
                </div>
                <aside class="col-md-4 blog-sidebar">
                  <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Sobre o novíssimo 3s</h4>
                    <p class="mb-0">Esta é uma aplicação completamente nova desenvolvida pela DTI. Tudo foi refeito, desde o design até a estrutura de banco de dados. 
                                    Os chamados antigos foram preservados em uma nova estrutura, 
                                    a responsividade foi adicionada e muitas falhas de segurança foram sanadas. </p>
                  </div>

            	        
                <div class="p-4">
                    <h4 class="font-italic">Arquivos</h4>
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
                </aside><!-- /.blog-sidebar -->
                


            </div>';
        


    }
    
    
    public function mostrarSelecionado(Ocorrencia $ocorrencia){
        echo '
            
            
        <div class="card mb-4">
            <div class="card-body">
                
                Id Local: '.$ocorrencia->getIdLocal().'<br>
                Descricao: '.$ocorrencia->getDescricao().'<br>
                Campus: '.$ocorrencia->getCampus().'<br>
                Patrimonio: '.$ocorrencia->getPatrimonio().'<br>
                Ramal: '.$ocorrencia->getRamal().'<br>
                Local: '.$ocorrencia->getLocal().'<br>
                Status: '.$ocorrencia->getStatus().'<br>
                Solucao: '.$ocorrencia->getSolucao().'<br>
                Prioridade: '.$ocorrencia->getPrioridade().'<br>
                Avaliacao: '.$ocorrencia->getAvaliacao().'<br>
                Email: '.$ocorrencia->getEmail().'<br>
                Id Usuario Atendente: '.$ocorrencia->getIdUsuarioAtendente().'<br>
                Id Usuario Indicado: '.$ocorrencia->getIdUsuarioIndicado().'<br>
                Anexo: '.$ocorrencia->getAnexo().'<br>
                Local Sala: '.$ocorrencia->getLocalSala().'<br>
                Area Responsavel: '.$ocorrencia->getAreaResponsavel().'<br>
                Servico: '.$ocorrencia->getServico().'<br>
                Usuario Cliente: '.$ocorrencia->getUsuarioCliente().'<br>
                    
            </div>
        </div>
                    
                    
                    
';
    }
    
    ////////Digite seu código customizado aqui.
    


}