$( "#change-to-adm" ).click(function() {
    alert( "Você está tentando burlar o sistema. Se continuar sua conta será suspensa." );
});

$( "#change-to-tec" ).click(function() {
    var dados = { nivel: 't' }; 
    mudarNivel(dados);
});
$( "#change-to-default" ).click(function() {
    var dados = { nivel: 'c' };
    mudarNivel(dados);

});

function mudarNivel(dados){

    jQuery.ajax({
        type: "POST",
        url: "index.php?ajax=mudar_nivel",
        data: dados,
        success: function( data )
        {
        


            if(data.split(":")[1] == 'sucess'){
                
                $("#botao-modal-resposta").click(function(){
                    window.location.href='.';
                });
                $("#textoModalResposta").text("Nível Alterado Com Sucesso! ");                	
                $("#modalResposta").modal("show");
                
            }
            else
            {
                
                $("#textoModalResposta").text("Falha ao tentar alterar nível! ");                	
                $("#modalResposta").modal("show");
            }


        }
    });
    

}