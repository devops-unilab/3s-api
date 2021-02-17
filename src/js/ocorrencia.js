

$(document).ready(function(e) {

	$("#form_pedir_ajuda").on('submit', function(e) {
		e.preventDefault();
        $('#modalPedirAjuda').modal('hide');
        
		var dados = jQuery( this ).serialize();
        
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=pedir_ajuda",
            data: dados,
            success: function( data )
            {

            	if(data.split(":")[1] == 'sucesso')
				{
					$("#botao-modal-resposta").click(function(){
						$("#botao-pedir-ajuda").attr("disabled", true);
            			$('#botao-pedir-ajuda').text("Ajuda Solicitada");
            		});
            		$("#textoModalResposta").text("Um e-mail foi enviado ao chefe do setor solicitando ajuda com o chamado. ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
                	$("#textoModalResposta").text("Falha ao tentar pedir ajuda. ");                	
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
	$("#insert_form_ocorrencia").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddOcorrencia').modal('hide');
        
        var dados = new FormData(this);
        //
        $('#btn-inserir-ocorrencia').attr('disabled', true);		
		$('#btn-inserir-ocorrencia').text("Aguarde...");

		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=ocorrencia",
            data: dados,
            success: function( data )
            {
            

            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=ocorrencia&selecionar='+data.split(":")[2];
            		});
            		$("#textoModalResposta").text("Ocorrencia enviado com sucesso! ");                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
            		
                	$("#textoModalResposta").text("Falha ao inserir Ocorrencia, fale com o suporte. ");                	
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
   
