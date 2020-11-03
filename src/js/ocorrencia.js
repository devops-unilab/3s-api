
$(document).ready(function(e) {
	
	$("#form_enviar_ocorrencia").on('submit', function(e) {
		
		e.preventDefault();
        $('#modalAddOcorrencia').modal('hide');

		var dados = jQuery( this ).serialize();
		
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=ocorrencia",
            data: dados,
            success: function( data )
            {
                
            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?pagina=ocorrencia';
            		});
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?pagina=ocorrencia&selecionar='+data.split(":")[2];
            		});
            		$("#textoModalResposta").text("Ocorrencia enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
					
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Ocorrencia, fale com o suporte. ");
					            	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   


$('#select-servicos').selectize({
    create: false,
    sortField: 'text'
});

$('#select-campus').selectize({
    create: false,
    sortField: 'text'
});
