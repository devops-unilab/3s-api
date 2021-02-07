

$(document).ready(function(e) {
	$('#select-tecnico').selectize({
	    create: false,
	    sortField: 'text'
	});
	$('#select-servico').selectize({
	    create: false,
	    sortField: 'text'
	});

	
	$('.star').on('click', function(e){
		
		var nota = $(this).attr('nota');
		var i;
		
		for(i = 1; i <= 5; i++){
			$('.estrela-'+i).attr('src', 'img/star0.png');	
		}
		for(i = 1; i <= nota; i++){
			$('.estrela-'+i).attr('src', 'img/star1.png');	
		}
		$('#campo-avaliacao').val(nota);
		
	});
	function esconderTodos(){
		$('#container-avaliacao').addClass("escondido");
		$('#container-reservar').addClass("escondido");
		$('#container-editar-servico').addClass("escondido");
		$('#container-editar-solucao').addClass("escondido");
	}
	
	$('#botao-avaliar').on('click', function(e){
		esconderTodos();
		$('#container-avaliacao').removeClass("escondido");
		var acao = $(this).attr('acao');
		$('#campo_acao').val(acao);
		
	});
	$('#botao-editar-servico').on('click', function(e){
		esconderTodos();
		$('#container-editar-servico').removeClass("escondido");
		
		var acao = $(this).attr('acao');
		$('#campo_acao').val(acao);
		
	});
	
	$('#botao-editar-solucao').on('click', function(e){
		esconderTodos();
		$('#container-editar-solucao').removeClass("escondido");
		
		var acao = $(this).attr('acao');
		$('#campo_acao').val(acao);
		
	});
		
	$('#botao-reservar').on('click', function(e){
		esconderTodos();
		$('#container-reservar').removeClass("escondido");
		
		var acao = $(this).attr('acao');
		$('#campo_acao').val(acao);
		
	});
	
	$('.botao-status').on('click', function(e){
		esconderTodos();
		var acao = $(this).attr('acao');
		$('#campo_acao').val(acao);
	});
	

	$(".form_status").on('submit', function(e) {
		e.preventDefault();
        $('.modal_form_status').modal('hide');
        
		var dados = jQuery( this ).serialize();
        
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=status_ocorrencia",
            data: dados,
            success: function( data )
            {
            
				console.log(data);
            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=ocorrencia&selecionar='+data.split(":")[2];
            		});
            		$("#textoModalResposta").text(data.split(":")[3]);                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
                	$("#textoModalResposta").text(data.split(":")[2]);
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
