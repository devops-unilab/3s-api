$("#login-form").on('submit', function(e) {
	e.preventDefault();
	var dados = jQuery( this ).serialize();
	$("input").prop('disabled', true);
	$("#botao-login").prop('disabled', true);
	$("#spinner-submit").removeClass("escondido");
	
	
	jQuery.ajax({
		type: "POST",
		url: "index.php?ajax=login",
		data: dados,
		success: function(data) {

			
			if (data.split(":")[1] == 'sucesso') {
				window.location.href = '.';
			}
			else {
				
				$("#textoModalResposta").text("Falha na tentativa de login.");
				$("#modalResposta").modal("show");

				$("#botao-modal-resposta").click(function() {
					window.location.href = '.';
				});
				
				
			}

		}
	});




});