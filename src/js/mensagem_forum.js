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
        
        var dados = new FormData(this);
        
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=mensagem_forum",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){						
            			window.location.href='?page=ocorrencia&selecionar='+data.split(":")[2];
            		});
            		$("#textoModalResposta").text("Mensagem Forum enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Mensagem Forum, fale com o suporte. ");                	
            		$("#modalResposta").modal("show");
            	}

            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function() {
                    /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;


            }
        });
		
		
	});
	
	
});
   
