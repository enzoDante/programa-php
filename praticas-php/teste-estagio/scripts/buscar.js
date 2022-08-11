function procurar(){
    var input, filter, div, elementos, valor_nome, valor_ref, i;  
    input = document.getElementById("ibuscar");
    filter = input.value.toUpperCase();
    div = document.getElementById("vendas");
    
    elementos = div.getElementsByTagName("a");
    
    for (i = 0; i < elementos.length; i++) {
    valor_nome = elementos[i].getElementsByTagName("p")[0];
    valor_ref = elementos[i].getElementsByTagName("p")[3]
    if ((valor_nome.innerHTML.toUpperCase().indexOf(filter) > -1) || (valor_ref.innerHTML.toUpperCase().indexOf(filter) > -1)) {
        elementos[i].style.display = "";
    } else {
        elementos[i].style.display = "none";
    }
    }    
    
}