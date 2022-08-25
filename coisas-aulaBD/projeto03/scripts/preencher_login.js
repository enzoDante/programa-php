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
            document.getElementById("demo").value = this.responseText;

            let existe = document.getElementById("demo").value
            if(existe === 'senha'){
                document.getElementsByClassName("requerido")[1].style.display = 'block'
                document.getElementsByClassName("requerido")[1].innerHTML = 'Senha incorreta'
                
            }
            if(existe === 'cpf'){
                document.getElementsByClassName("requerido")[0].style.display = 'block'
                document.getElementsByClassName("requerido")[0].innerHTML = 'CPF inexistente'
            }
        }
        xhttp.open("POST", "logar.php");
        // adiciona um header para a requisição HTTP
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // especifica os dados que deseja enviar   
        xhttp.send("cpf="+cpf+"&senha="+senha);
    }       
    
    e.preventDefault()

}
//======
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