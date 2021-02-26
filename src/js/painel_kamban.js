




$(document).ready(function(e){

	var urlTabela = 'index.php/?ajax=painel_kamban';
	var urlSelecionada = urlTabela;
	
	$("#select-setores").change(function(){
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
	});
	
	function carregarDados(url2){
		console.log("Chamada:"+url2);
		$.ajax({
			type: 'GET',
			url: url2,
			success: function (response){
				
				$('#quadro-kamban').html(response);
			}
		});
	}	
	setInterval (function () {
		carregarDados(urlSelecionada);
	}, 1500); 
	
});


