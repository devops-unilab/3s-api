
$('#select-setores').selectize({
    create: false,
    sortField: 'text'
});

$('#select-tabela').selectize({
    maxItems: 50
});



$("#select-tabela").change(function(){
	$("#hidden-tabela").val($("#select-tabela").val());
});