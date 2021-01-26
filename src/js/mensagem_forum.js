$("#muda-tipo").on('change', function(e){
	
	if($("#muda-tipo").is(':checked')){
		$("#campo-texto").addClass("escondido");
		$("#campo-anexo").removeClass("escondido");	
	}else{

		$("#campo-texto").removeClass("escondido");
		$("#campo-anexo").addClass("escondido");	
	}
});


$(document).ready(function(e) {
	


	$("#insert_form_mensagem_forum").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddMensagemForum').modal('hide');
        
		var dados = jQuery( this ).serialize();
        
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=mensagem_forum",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=mensagem_forum';
            		});
            		$("#textoModalResposta").text("Mensagem Forum enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Mensagem Forum, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
