var req;
// FUNÇÃO PARA BUSCAR PRODUTOS
function procurar(valor) {
    // Verificando Browser
    if(window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    }
    else if(window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }
    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "produtos.php?id="+valor;
    // Chamada do método open para processar a requisição
    req.open("Get", url, true);
    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function() {
        // Exibe a mensagem "Carregando..." enquanto carrega
        if(req.readyState == 1) {
            document.getElementById('vendas').innerHTML = 'Carregando...';
        }
        // Verifica se o Ajax realizou todas as operações corretamente
        if(req.readyState == 4 && req.status == 200) {
            // Resposta retornada pelo produtos.php
            var resposta = req.responseText;
            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('vendas').innerHTML = resposta;
        }
    }
    req.send(null);
}