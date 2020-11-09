

$(document).ready(function(e) {
	$("#insert_form_status_ocorrencia").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddStatusOcorrencia').modal('hide');
        
		var dados = jQuery( this ).serialize();
        
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=status_ocorrencia",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=status_ocorrencia';
            		});
            		$("#textoModalResposta").text("Status Ocorrencia enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Status Ocorrencia, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
