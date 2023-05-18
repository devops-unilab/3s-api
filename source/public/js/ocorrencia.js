function filtroBasico(){

	var query = location.search.slice(1);
	var partes = query.split('&');
	var data = {};
	if(partes.length > 1){

		partes.forEach(function (parte) {
		    var chaveValor = parte.split('=');
		    var chave = chaveValor[0];
		    var valor = chaveValor[1];
		    data[chave] = valor;
		});
	}



	if($("#filtro-meu-setor").is(':checked')){
		data['setor'] = $("#meu-setor").val();
	}else{
		delete data['setor'];
	}
	if($("#filtro-minhas-demandas").is(':checked')){
		data['demanda'] = '1';
	}else{
		delete data['demanda'];
	}
	if($("#filtro-minhas-solicitacoes").is(':checked')){
		data['solicitacao'] = '1';
	}else{
		delete data['solicitacao'];
	}

	if($("#select-tecnico").val() != ""){
		data['tecnico'] = $("#select-tecnico").val();
	}else{
		delete data['tecnico'];
	}

	if($("#select-requisitante").val() != ""){
		data['requisitante'] = $("#select-requisitante").val();
	}else{
		delete data['requisitante'];
	}


	if($('#select-setores-filtro').val()){
		data['setores_requisitantes'] = $('#select-setores-filtro').val();
	}else{
		delete data['setores_requisitantes'];
	}


	if($('#select-setores-filtro2').val() != ""){
		data['setores_responsaveis'] = $('#select-setores-filtro2').val();
	}else{
		delete data['setores_responsaveis'];
	}
	if($('#filtro-data-1').val() != ""){
		data['data_abertura1'] = $('#filtro-data-1').val();
	}else{
		delete data['data_abertura1'];
	}
	if($('#filtro-data-2').val() != ""){
		data['data_abertura2'] = $('#filtro-data-2').val();
	}else{
		delete data['data_abertura2'];
	}

	data['campus'] = [];
	if($('#filtro-campus-males').is(':checked')){
		data['campus'].push('males');
	}
	if($('#filtro-campus-auroras').is(':checked')){
		data['campus'].push('auroras');
	}
	if($('#filtro-campus-palmares').is(':checked')){
		data['campus'].push('palmares');
	}
	if($('#filtro-campus-liberdade').is(':checked')){
		data['campus'].push('liberdade');
	}


	var novaUrl = '';
	var i = 0;

	Object.keys(data).forEach(function (key) {

		if(data[key] != ""){


			if(i != 0){
				novaUrl += '&';
			}
			novaUrl += key+'='+data[key];
			i++;
		}
	});

	if(novaUrl == ""){
		window.location.href = ".";

	}else{
		window.location.href = "?"+novaUrl;
	}

}
$(document).ready(
	function(){
		$('#form-filtro-basico').change(filtroBasico);
		$('#form-filtro-avancado').focusout(filtroBasico);
		$('#form-filtro-campus').change(filtroBasico);


	}
);

$('#easyPaginatecollapseAtraso').easyPaginate({
    paginateElement: 'div',
    elementsPerPage: 10,
    effect: 'slide',
    slideOffset: 200
});


$('#easyPaginatecollapseAberto').easyPaginate({
    paginateElement: 'div',
    elementsPerPage: 10,
    effect: 'slide'
});


$('#easyPaginatecollapseEncerrada').easyPaginate({
    paginateElement: 'div',
    elementsPerPage: 10,
    effect: 'slide'
});

$(document).ready(function(e) {



	$("#insert_form_ocorrencia").on('submit', function(e) {
		e.preventDefault();
        $('#modalAddOcorrencia').modal('hide');

        var dados = new FormData(this);
        //
        $('#btn-inserir-ocorrencia').attr('disabled', true);
		$('#btn-inserir-ocorrencia').text("Aguarde...");
		console.log("Debugando");
		jQuery.ajax({
            type: "POST",
            url: "?ajax=ocorrencia",
            data: dados,
            success: function( data )
            {
				console.log("VAMOS VERIFICAR O QUE VEM do servidor");
				console.log(data);
            	if(data.split(":")[1] == 'sucesso'){

            		$("#botao-modal-resposta").click(function(){
            			window.location.href='?page=ocorrencia&selecionar='+data.split(":")[2];
            		});
            		$("#textoModalResposta").text("Ocorrencia enviado com sucesso! ");
            		$("#modalResposta").modal("show");

            	}
            	else
            	{

                	$("#textoModalResposta").text("Falha ao inserir Ocorrencia, fale com o suporte. ");
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

