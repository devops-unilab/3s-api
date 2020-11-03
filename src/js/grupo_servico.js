

$(document).ready(function(e) {
	$("#insert_form_grupo_servico").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddGrupoServico').modal('hide');

		var dados = jQuery( this ).serialize();
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=grupo_servico",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=grupo_servico';
            		});
            		$("#textoModalResposta").text("Grupo Servico enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Grupo Servico, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
