

$(document).ready(function(e) {
	$(".form_status").on('submit', function(e) {
		e.preventDefault();
        $('.modal_form_status').modal('hide');
        
		var dados = jQuery( this ).serialize();
        
		jQuery.ajax({
            type: "POST",
            url: "index.php?ajax=status_ocorrencia",
            data: dados,
            success: function( data )
            {
            
				console.log(data);
            	if(data.split(":")[1] == 'sucesso'){
            		
            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=ocorrencia&selecionar='+data.split(":")[2];
            		});
            		$("#textoModalResposta").text(data.split(":")[3]);                	
            		$("#modalResposta").modal("show");
            		
            	}
            	else
            	{
                	$("#textoModalResposta").text(data.split(":")[2]);
            		$("#modalResposta").modal("show");
            	}

            }
        });
		
		
	});
	
	
});
   
