

$(document).ready(function(e) {
	// Tempo em segundos
	var dateString = $('#tempo-total').text();
	var tempo = parseInt(dateString.split(":")[0])*3600;
	tempo += parseInt(dateString.split(":")[1])*60;
	tempo += parseInt(dateString.split(":")[2]);
	
	
	function countdown() {

		// Se o tempo não for zerado
		if (tempo <= 0) {
			return;
		}
		var hor = parseInt(tempo / 3600);
		var min = parseInt((tempo % 3600)/60);
		
		var seg = tempo % 60;
		if (hor < 10) {
			hor = "0" + hor;
			hor = hor.substr(0, 2);
		}	
		if (min < 10) {
			min = "0" + min;
			min = min.substr(0, 2);
		}
		if (seg < 10) {
			seg = "0" + seg;
		}
		horaImprimivel = hor+':' + min + ':' + seg;
		$('#tempo-total').text(horaImprimivel);
		tempo--;
	}



	// Chama a função ao carregar a tela

	setInterval(function() {
		countdown();

	}, 1000);


});