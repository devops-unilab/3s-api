$(document).ready(function(e){

    modificarTela();

    var urlTabela = '?ajax=painel_kamban';
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
        modificarTela();
    });
    function modificarTela(){
        $( "main" ).toggleClass("container");
        $( "#cabecalho" ).toggleClass("escondido");
    }

    function carregarDados(url2){

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
    }, 2000);

});


