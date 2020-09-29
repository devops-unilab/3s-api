<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class OcorrenciaCustomView extends OcorrenciaView {

    
    public function mostraFormInserir2($listaServico){
        
        $sessao = new Sessao();
        
        echo '

            

  <div class="card card-body">
            
            
<form  id="form_enviar_ocorrencia"  method="post" action="" enctype="multipart/form-data">
    <span class="titulo medio">Informe os dados para cadastro</span><br>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="select-demanda">Serviço*</label>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <select id="select-servicos" name="servico" required>
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
                    <label for="descricao">Descrição*</label>
                    <textarea class="form-control" rows="3" name="descricao" id="descricao" required></textarea>
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
                    <select name="campus" id="select-campus" required>
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
                    <label for="patrimonio">Patrimônio</label>
                    <input class="form-control" type="text" name="patrimonio" id="patrimonio" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="ramal" >Ramal</label>
                    <input class="form-control" type="text" name="ramal" id="ramal" value="">
                </div>
            
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <label for="email" >E-mail*</label>
                    <input class="form-control" type="text" name="email" id="email" value="'.$sessao->getEmail().'" required>
                </div>
            
            </div>
        </div>
    </div>
    <input type="hidden" name="enviar_ocorrencia" value="1">
    
</form>
            
      
  </div><br><br>
<div class="d-flex justify-content-center m-3">
        <button form="form_enviar_ocorrencia" type="submit" class="btn btn-primary">Cadastrar Ocorrência</button>
        
</div><br><br>

            
';
    }
    public function mostraFormEditar2(Ocorrencia $ocorrencia, $listaServico){
        $sessao = new Sessao();
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
                    <textarea class="form-control" rows="3" name="desc_problema" id="desc_problema" required>'.ltrim($ocorrencia->getDescricao()).'</textarea>
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
                    <select name="campus" id="select-campus" required>
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
                    <input class="form-control" type="text" name="email" id="email" value="'.$sessao->getEmail().'" required>
                </div>
                        
            </div>
        </div>
    </div>
                        
</form>
                        
                        
  </div><br><br>
<div class="d-flex justify-content-center m-3">
        <input type="submit" id="btn-submit" name="enviar_ocorrencia" value="Cadastrar Ocorrência" class="btn btn-primary" >
</div><br><br>
                        
                        
';
    }
    public function exibirLista($lista)
    {
        
        echo '


                    <div class="list-group">';
	    
	    foreach($lista as $elemento){
	        echo '
                        <a href="?pagina=ocorrencia&selecionar='.$elemento->getId().'" class="list-group-item active" data-toggle="tooltip" data-placement="top" title="'.$elemento->getDescricao().'">#'.$elemento->getId().' - '.$elemento->getServico()->getNome().'</a>';
	        
	    }
	    
	    echo '          
                    </div>';

    }
    
    
    public function mostrarSelecionado(Ocorrencia $ocorrencia){
        echo '
            
            
        <div class="card mb-4">
            <div class="card-body">
                Descricao: '.$ocorrencia->getDescricao().'<br>
                Servico: '.$ocorrencia->getServico().'<br>
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
                
                Usuario Cliente: '.$ocorrencia->getUsuarioCliente().'<br>
                    
            </div>
        </div>
                    
                    
                    
';
    }
    
    ////////Digite seu código customizado aqui.
    


}