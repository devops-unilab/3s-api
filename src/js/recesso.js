

$(document).ready(function(e) {
	$("#insert_form_recesso").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddRecesso').modal('hide');

		var dados = jQuery( this ).serialize();
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=recesso",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=recesso';
            		});
            		$("#textoModalResposta").text("Recesso enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Recesso, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
