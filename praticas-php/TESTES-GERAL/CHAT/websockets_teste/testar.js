let ws = new WebSocket('ws://localhost')
///Praticando/TESTES/Dinamicas_js/websockets_teste
//http://localhost/praticas-php/TESTES-GERAL/CHAT/websockets_teste/

let text = document.querySelector('input')
let div = document.getElementById("div")

ws.addEventListener('open', console.log)
ws.addEventListener('message', console.log)

function enter(e){
    if(e.key === 'Enter'){
        let valor = text.value
        div.append('Eu: ' + valor, document.createElement('br'))
        ws.send(valor)

        text.value = ''
    }
}