$("#login-form").on('submit', function(e) {
	e.preventDefault();
	var dados = jQuery( this ).serialize();
	$("input").prop('disabled', true);
	$("#botao-login").prop('disabled', true);
	$("#spinner-submit").removeClass("escondido");
	
	console.log("Vamos testar");
	jQuery.ajax({
		type: "POST",
		url: "?ajax=login",
		data: dados,
		success: function(data) {
			console.log("Nao entrou aqui");
			
			if (data.split(":")[1] == 'sucesso') {
				if(data.split(":")[2] == 't'){
					window.location.href = './?demanda=1';
				}else{
					window.location.href = '.';	
				}				
			}
			else {
				
				$("#textoModalResposta").text("Falha na tentativa de login.");
				$("#modalResposta").modal("show");
				
				$("input").prop('disabled', false);
				$("#botao-login").prop('disabled', false);
				$("#spinner-submit").addClass("escondido");

				$("#botao-modal-resposta").click(function() {
					window.location.href = '.';
				});
				

				
			}

		}
	});




});