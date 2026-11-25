$(document).ready(function (){
    const urlBase = "http:/localhost/infoserv_php/"
    const urlListarPessoa = urlBase + "pessoas";

    $(".cadrastarpessoa").on("click", function(){

       $("#tituloModal").text("Cadastrar Pessoa");
    });
    $("#tabelaPessoas").on("click",".btnEditar", function(){
        var id = $(this).val();
        $("#tabelaPessoas").text("Editar Pessoa")
        $("#modalPessoa").modal("show")
    });
    $("#tabelaPessoas"). on("click", ".btnExcluir",function() {
        var id = $(this).val();

        $(this).closest("tr").remove();
    })
});