$(document).ready(function(e){
	
	var urlTabela = '?ajax=painel_tabela';
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
		$("#tabela-quadro").toggleClass("display-3");	
	});
	

	function carregarDados(url2){
		$.ajax({
			type: 'GET',
			url: url2,
			success: function (response){
				$('#quadro-tabela').html(response);
			}
		});
	}	
	setInterval (function () {
		carregarDados(urlSelecionada);
	}, 1000); 
	
});


