

$(document).ready(function(e) {
	$("#insert_form_area_responsavel").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddAreaResponsavel').modal('hide');

		var dados = jQuery( this ).serialize();
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=area_responsavel",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=area_responsavel';
            		});
            		$("#textoModalResposta").text("Area Responsavel enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Area Responsavel, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
