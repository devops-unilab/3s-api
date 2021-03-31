$("#login-form").on('submit', function(e) {
	$("input").prop('disabled', true);
	$("button").prop('disabled', true);
	$("#spinner-submit").removeClass("escondido");
	
	
});

console.log("Ola mundo do login!");