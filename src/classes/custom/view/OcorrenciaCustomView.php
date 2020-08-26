<?php
            
/**
 * Classe de visao para Ocorrencia
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */
class OcorrenciaCustomView extends OcorrenciaView {

    
    public function mostraFormInserir2($listaServico){
        echo '
            
<div class="collapse" id="collapseExample">
  <div class="card card-body">
            
            
<form method="post" action="" enctype="multipart/form-data">
    <span class="titulo medio">Informe os dados para cadastro</span><br>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="select-demanda">Item de Ocorrência*</label>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <select id="select-item-ocorrencia-comum" name="item_ocorrencia" required>
                        <option value="" selected="selected">Selecione uma opção</option>
            
            
            
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
            
            
  </div>
</div>
            
';
    }
    
    public function exibirLista($lista){
        echo '
            
            
            
            
            
            <ul class="list-group">
            
            
';
        
        foreach($lista as $elemento){
            echo '  <li class="list-group-item">'.$elemento->getId().' - '.$elemento->getServico()->getNome().'</li>';
            
        }
        
        echo '
</ul>
            <br><br>
            
';
    }
    ////////Digite seu código customizado aqui.
    


}