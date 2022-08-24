function nomee(){
    let nome = document.getElementById("inome").value
    
    if(nome == ''){
        document.getElementsByClassName("requerido")[0].style.display = 'block';
        document.getElementsByClassName("requerido")[0].innerHTML = 'Digite um nome';
    }else{
        if(nome.length < 4 || nome.indexOf(" ") < 0){
            document.getElementsByClassName("requerido")[0].style.display = 'block';
            document.getElementsByClassName("requerido")[0].innerHTML = 'Insira o nome completo';
        }else{
            document.getElementsByClassName("requerido")[0].style.display = 'none';
        }
    }
    document.getElementById("card_nome").innerHTML = nome
}
//===============================
function emaill(){
    let email = document.getElementById("iemail").value
    if(email == ''){
        document.getElementsByClassName("requerido")[1].style.display = 'block';
        document.getElementsByClassName("requerido")[1].innerHTML = 'Digite um email';
    }else{
        if(email.indexOf('@') < 0 || email.indexOf('.com') < 0 || email.indexOf('@.com') > 0){
            document.getElementsByClassName("requerido")[1].style.display = 'block'
            document.getElementsByClassName("requerido")[1].innerHTML = 'Digite corretamente o email'
        }else{
            document.getElementsByClassName("requerido")[1].style.display = 'none'
        }
    }
    document.getElementById("card_email").innerHTML = email
}
//=========================
function ccpf(){
    let cpf = document.getElementById("cpf").value 
    if(cpf == ''){
        document.getElementsByClassName("requerido")[2].style.display = 'block'
        document.getElementsByClassName("requerido")[2].innerHTML = 'Digite o cpf'
    }else{
        if(cpf.length != 11 || isNaN(cpf)){
            document.getElementsByClassName("requerido")[2].style.display = 'block'
            document.getElementsByClassName("requerido")[2].innerHTML = 'Digite o cpf corretamente'
        }else{
            document.getElementsByClassName("requerido")[2].style.display = 'none'
        }
    }
    document.getElementById("card_cpf").innerHTML = cpf
}
//=======================fazerrr dataaaaa
function cdata(){
    //let data = Date(document.getElementById("idata"))
    let data = document.getElementById("idata").value 
    console.log(data)
    document.getElementsByClassName("requerido")[3].style.display = 'block'
}