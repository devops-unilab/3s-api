(function($) {
    $(document).ready(function() {
        var $chatbox = $('.chatbox');
		var $chatboxTitle = $('.chatbox__title');
        var $chatboxTitleClose = $('.chatbox__title__close');

        $chatboxTitle.on('click', function() {
            $chatbox.toggleClass('chatbox--tray');
        });
        $chatboxTitleClose.on('click', function(e) {
            e.stopPropagation();
            $chatbox.addClass('chatbox--closed');
        });
        $chatbox.on('transitionend', function() {
            if ($chatbox.hasClass('chatbox--closed')) $chatbox.remove();
        });
        
    });
})(jQuery);


$("#muda-tipo").on('change', function(e){
	
	if($("#muda-tipo").is(':checked')){
		$("#campo-texto").addClass("escondido");
		$("#campo-anexo").removeClass("escondido");
		$("#campo_tipo").val(2);	
	}else{

		$("#campo-texto").removeClass("escondido");
		$("#campo-anexo").addClass("escondido");	
		$("#campo_tipo").val(1);
		
	}
});


$(document).ready(function(e) {
	


	$("#insert_form_mensagem_forum").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddMensagemForum').modal('hide');
        
        var dados = new FormData(this);
        $('#botao-enviar-mensagem').attr('disabled', true);		
		$('#botao-enviar-mensagem').text("Aguarde...");
	
		
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
   
