

$(document).ready(function(e) {
	$("#insert_form_tarefa_ocorrencia").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddTarefaOcorrencia').modal('hide');
        
		var dados = jQuery( this ).serialize();
        
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=tarefa_ocorrencia",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=tarefa_ocorrencia';
            		});
            		$("#textoModalResposta").text("Tarefa Ocorrencia enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Tarefa Ocorrencia, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
