

$(document).ready(function(e) {
	$("#insert_form_status").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddStatus').modal('hide');

		var dados = jQuery( this ).serialize();
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=status",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=status';
            		});
            		$("#textoModalResposta").text("Status enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Status, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
