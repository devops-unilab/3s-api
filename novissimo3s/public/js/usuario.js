

$(document).ready(function(e) {
	$("#insert_form_usuario").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddUsuario').modal('hide');
        
		var dados = jQuery( this ).serialize();
        
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=usuario",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=usuario';
            		});
            		$("#textoModalResposta").text("Usuario enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Usuario, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
