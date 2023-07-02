

$(document).ready(function(e) {
	$("#insert_form_tipo_atividade").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddTipoAtividade').modal('hide');
        
		var dados = jQuery( this ).serialize();
        
		jQuery.ajax({
            type: "POST",
            url: "?ajax=tipo_atividade",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=tipo_atividade';
            		});
            		$("#textoModalResposta").text("Tipo Atividade enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Tipo Atividade, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
