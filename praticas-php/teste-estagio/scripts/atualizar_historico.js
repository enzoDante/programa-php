//função para atualizar a div "historico_venda"
function ajax(){
    let req = new XMLHttpRequest()
    req.onreadystatechange = function(){
        if(req.readyState == 4 && req.status == 200){
            document.getElementById('historico_vendas').innerHTML = req.responseText
        }
    }
    req.open('GET', 'atualizar_historico.php', true)
    req.send()
    var objDiv = document.getElementById("historico_vendas");
    objDiv.scrollTop = objDiv.scrollHeight;
}
setInterval(function(){ajax()}, 1000) //1000