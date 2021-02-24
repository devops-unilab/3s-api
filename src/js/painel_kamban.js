/*
$('#select-setores').selectize({
    create: false,
    sortField: 'text'
});
*/

$('#select-tabela').selectize({
    maxItems: 50
});


$('#select-setores').selectize({
    maxItems: 50
});



/*

$("#select-tabela").change(function(){
	$("#hidden-tabela").val($("#select-tabela").val());
});
*/

$(document).ready(function(e){
	
	$("#btn-expandir-tela").on('click', function(e){
		$( "main" ).toggleClass("container");
		$( "#cabecalho" ).toggleClass("escondido");
		$( "#barra-brasil" ).toggleClass("escondido");
	});
	
	setInterval (function () {
		$.ajax({
			type: 'GET',
			url: '?ajax=painel_kamban',
			success: function (response){
				$('#quadro-kanban').html(response);
			}
		});
	}, 2000);
	
	
});


