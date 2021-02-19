


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






function alocaMensagem(item, index){
	
	var div = '<div class="chatbox__body__message chatbox__body__message--left">';
	div += '<div class="chatbox_timing">';
	div += '<ul><li><a href="#"><i class="fa fa-calendar"></i> 12/02/2021</a></li>';
	div += '<li><a href="#"><i class="fa fa-clock-o"></i> 15:45</a></li>';
	div += '</ul>';
	div += '</div>';
	div += '<div class="clearfix"></div>';
	div += '<div class="ul_section_full"><ul class="ul_msg">';
	div += '<li><strong>'+item.nome_usuario+'</strong></li>';
	if(item.tipo == 1){
		div += '<li>'+item.mensagem+'</li>';
	}else{
		div += '<li>Anexo: <a href="uploads/'+item.mensagem+'">Download</a></li>';	
	}
	
	div += '</ul>';
	div += '<div class="clearfix"></div>';
	div += '</div></div>';	
	$("#corpo-chat").append(div);
	$("#corpo-chat").scrollTop($("#corpo-chat")[0].scrollHeight);
	
	
}


var idOcorrencia = $("#id-ocorrencia").text();
var idUltima = $("#ultimo-id-post").text();
var urlApiMensagem  = "?api=api/mensagem_forum/";
var url1 = urlApiMensagem+idOcorrencia+"/"+idUltima;

function carregarDados(url2) {
    $.ajax({
      url:url2,  
      success: function(data) {
		if(data.length > 0){
			carregarDados(urlApiMensagem+idOcorrencia+"/"+data[data.length-1].id);
			data.forEach(alocaMensagem);	
		}
		else{
			carregarDados(url2);
		}
      }
   });	 
}
carregarDados(url1);


$(document).ready(function(e) 
{

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
            		               	
            		//window.location.href='?page=ocorrencia&selecionar='+data.split(":")[2];
					$('#botao-enviar-mensagem').attr('disabled', false);		
					$('#botao-enviar-mensagem').text("Enviar");
					$("#campo-texto").val("");
					$("#corpo-chat").scrollTop($("#corpo-chat")[0].scrollHeight);
            		
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
   
