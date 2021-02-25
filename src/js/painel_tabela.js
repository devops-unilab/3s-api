$(document).ready(function(e){
	
	var urlTabela = 'index.php/?ajax=painel_tabela';
	var urlSelecionada = urlTabela;
	$("#select-setores").change(function(){
		//$("#hidden-tabela").val($("#select-tabela").val());
		var dados = $("#select-setores").val();
		var setores = '&setores=';
		setores += dados.join(',');
		urlSelecionada = urlTabela+setores;
		
	});
	
	$('#select-setores').selectize({
    	maxItems: 50
	});
	$("#btn-expandir-tela").on('click', function(e){
		$( "main" ).toggleClass("container");
		$( "#cabecalho" ).toggleClass("escondido");
		$( "#barra-brasil" ).toggleClass("escondido");
		$("#tabela-quadro").toggleClass("display-3");	
	});
	
	
	setInterval (function () {
		$.ajax({
			type: 'GET',
			url: urlSelecionada,
			success: function (response){
				$('#quadro-tabela').html(response);
			}
		});
	}, 1000); 
	
});


