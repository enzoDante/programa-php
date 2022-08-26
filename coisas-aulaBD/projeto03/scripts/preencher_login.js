let cpf, senha
function verificar(cpf, senha){
    if(cpf == '' || cpf.length != 11 || isNaN(cpf)){
        ccpf()
        return false
    }
    
    if(senha.length < 5){
        csenha()
        return false
    }
    return true
}

function cadastrar(e){
    cpf = document.getElementById("cpf").value 
    //========
    senha = document.getElementById('isenha').value
    //==========
    let verifica = verificar(cpf, senha)

    // enviar para o php 
    if(verifica){
        //ao enviar e todos os dados estiverem corretos, irá enviar ao php e retornara a um input hidden
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() { 
            document.getElementById("dados").innerHTML = this.responseText;

            let existe = document.getElementById("dados").innerHTML
            if(existe == ''){
                document.getElementsByClassName("requerido")[0].style.display = 'block'
                document.getElementsByClassName("requerido")[0].innerHTML = 'CPF ou senha incorreta'
            }
            if(existe == 'ex')
                window.location.href = 'suaConta.html'
        }
        xhttp.open("POST", "server/logar.php");
        // adiciona um header para a requisição HTTP
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // especifica os dados que deseja enviar   
        xhttp.send("cpf="+cpf+"&senha="+senha);
    }       
    
    e.preventDefault()

}
//===========carregou irá verificar se logado
function logado(){
    const xhttp = new XMLHttpRequest();
    // xhttp.onreadystatechange = function(){
    //     if(xhttp.readyState == 4 && xhttp.status == 200){
    //         document.getElementById('dados').innerHTML = xhttp.responseText

    //     }
    // }

    xhttp.onload = function() { 
        document.getElementById("dados").innerHTML = this.responseText;
    
        let dados = document.getElementById("dados").innerHTML
        if(dados != ''){
            document.getElementById("conta").style.display = 'inline-block'
            document.getElementById("conteudo").style.display = 'none'
            //=====
            document.getElementById("sair").innerHTML = 'Sair'
            document.getElementById("sair").removeAttribute('href')
            document.getElementById("sair").setAttribute('onclick', 'sairC()')
    
        }else{
            document.getElementById("conta").style.display = 'none'
            document.getElementById("conteudo").style.display = 'flex'
            document.getElementById("sair").innerHTML = 'Logar'
            document.getElementById("sair").removeAttribute('onclick')
            document.getElementById("sair").setAttribute('href', 'logar.html')
        }
    }
    xhttp.open("GET", "server/sessoes.php", true);
    xhttp.send()
}
//===========sairrrr=========
function sairC(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() { 
        document.getElementById("dados").innerHTML = this.responseText;
    
        let dados = document.getElementById("dados").innerHTML

        document.getElementById("conteudo").style.display = 'none'
        document.getElementById("sair").innerHTML = 'Logar'
        document.getElementById("sair").removeAttribute('onclick')
        document.getElementById("sair").setAttribute('href', 'logar.html')
        document.getElementById("conteudo").style.display = 'flex'
    }
    xhttp.open("POST", "server/sessoes.php");
    // adiciona um header para a requisição HTTP
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // especifica os dados que deseja enviar   
    xhttp.send("sair=s");
    console.log('testando')
}
//======validar=============
function ccpf(){
    cpf = document.getElementById("cpf").value 
    if(cpf == ''){
        document.getElementsByClassName("requerido")[0].style.display = 'block'
        document.getElementsByClassName("requerido")[0].innerHTML = 'Digite o cpf'
    }else{
        if(cpf.length != 11 || isNaN(cpf)){
            document.getElementsByClassName("requerido")[0].style.display = 'block'
            document.getElementsByClassName("requerido")[0].innerHTML = 'Digite o cpf corretamente'
        }else{
            document.getElementsByClassName("requerido")[0].style.display = 'none'

        }
    }
}
//=================
function csenha(){
    senha = document.getElementById("isenha").value 
    if(senha == ''){
        document.getElementsByClassName('requerido')[1].style.display = 'block'
        document.getElementsByClassName('requerido')[1].innerHTML = 'Digite uma senha'
    }else
        document.getElementsByClassName('requerido')[1].style.display = 'none'
}