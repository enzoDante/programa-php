var params = window.location.search.substring(1).split('&');

//Criar objeto que vai conter os parametros
var paramArray = [];

//Passar por todos os parametros
for(var i=0; i<params.length; i++) {
    //Dividir os parametros chave e valor
    var param = params[i].split('=');

    //Adicionar ao objeto criado antes
    paramArray[i] = param[1];
}
document.getElementById("card_nome").innerHTML = paramArray[0]
document.getElementById("card_email").innerHTML = paramArray[1]
document.getElementById("card_cpf").innerHTML = paramArray[2]

document.getElementById("card_idade").innerHTML = paramArray[3]
document.getElementById("card_salario").innerHTML = paramArray[4]
document.getElementById("card_serasa").innerHTML = paramArray[5]