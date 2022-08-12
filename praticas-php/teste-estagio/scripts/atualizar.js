//função para atualizar a div "historico_venda"
function ajax(){
    let req = new XMLHttpRequest()
    req.onreadystatechange = function(){
        if(req.readyState == 4 && req.status == 200){
            document.getElementById('vendas_atualizada').innerHTML = req.responseText
        }
    }
    req.open('GET', 'atualizar_vendas.php', true)
    req.send()
    var objDiv = document.getElementById("vendas_atualizada");
    objDiv.scrollTop = objDiv.scrollHeight;
}
setInterval(function(){ajax()}, 1000) //1000