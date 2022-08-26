let nome, email, cpf, data, salario, pserasa, senha, senha2
function carregar(){
    const xhttp = new XMLHttpRequest();    
    xhttp.onload = function() { 
        document.getElementById("demo").value = this.responseText;
    
        let dados = document.getElementById("demo").value
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
//verifica os dados digitados
function verificar(nome, email, cpf, idade, salario, pserasa, senha, senha2){
    if(nome.length < 4 || nome.indexOf(" ") <= 0){
        nomee()
        return false
    }
    if(email.indexOf('@') < 0 || email.indexOf('.com') < 0 || email.indexOf('@.com') > 0){
        emaill()
        return false
    }
    if(cpf == '' || cpf.length != 11 || isNaN(cpf)){
        ccpf()
        return false
    }
    if(idade == ''){
        console.log('entrou aq')
        document.getElementsByClassName("requerido")[3].style.display = 'block'
        document.getElementsByClassName("requerido")[3].innerHTML = 'Informe uma data corretamente'
        return false
    }
    if(isNaN(salario) || salario < 0 || salario == ''){
        csalario()
        return false
    }
    if(isNaN(pserasa) || pserasa == '' || pserasa < 0 || pserasa > 1000){
        cserasa()
        return false
    }
    if(senha.length < 5){
        csenha()
        return false
    }
    if(senha != senha2 || senha2 == ''){
        csenha2()
        return false
    }
    return true
}

function cadastrar(e){
    
    nome = document.getElementById("inome").value
    //=======
    email = document.getElementById("iemail").value
    //=========
    cpf = document.getElementById("cpf").value 
    //========
    let idade = document.getElementById("idade").value 
    //==============
    salario = document.getElementById("salario").value
    //===========
    pserasa = document.getElementById("serasa").value
    //==========
    senha = document.getElementById('isenha').value
    senha2 = document.getElementById("is2").value
    //========
    let box = document.getElementById("icontrato")
    //==========
    if(!box.checked)
        document.getElementsByClassName("requerido")[8].style.display = 'block'
    else{
        let verifica = verificar(nome, email, cpf, idade, salario, pserasa, senha, senha2)
        document.getElementsByClassName("requerido")[8].style.display = 'none'        

        // enviar para o php 
        if(verifica){
            idade = new Date(idade)
            let nascimento = idade.getFullYear() + '-' +digit2(idade.getMonth()+1)+ '-' + digit2(idade.getDate()+1)
            console.log(nascimento)

            //ao enviar e todos os dados estiverem corretos, irá enviar ao php e retornara a um input hidden
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() { 
                document.getElementById("demo").value = this.responseText;

                let existe = document.getElementById("demo").value
                if(existe === 'email'){
                    document.getElementsByClassName("requerido")[1].style.display = 'block'
                    document.getElementsByClassName("requerido")[1].innerHTML = 'E-mail existente'
                    
                }
                if(existe === 'cpf'){
                    document.getElementsByClassName("requerido")[2].style.display = 'block'
                    document.getElementsByClassName("requerido")[2].innerHTML = 'CPF existente'
                }
                if(existe == ''){
                    window.location.href = 'suaConta.html'
                }
            }
            xhttp.open("POST", "server/cadastrar.php");
            // adiciona um header para a requisição HTTP
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // especifica os dados que deseja enviar   
            xhttp.send("nome="+nome+"&email="+email+"&cpf="+cpf+"&idade="+nascimento+"&salario="+salario+"&serasa="+pserasa+"&senha="+senha);
        }
        
    }
    e.preventDefault()

}
//===================================
function nomee(){
    nome = document.getElementById("inome").value
    
    if(nome == ''){
        document.getElementsByClassName("requerido")[0].style.display = 'block';
        document.getElementsByClassName("requerido")[0].innerHTML = 'Digite um nome';
    }else{
        if(nome.length < 4 || nome.indexOf(" ") <= 0){
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
    email = document.getElementById("iemail").value
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
    cpf = document.getElementById("cpf").value 
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
//=======================
function digit2(num) {
    return num.toString().padStart(2, '0'); //se numero for 8, irá retornar 08
}
function cdata(){
    let data = document.getElementById("idade").value 
    data = new Date(data)

    if(data.getDate() < 1 || data.getMonth() < 1 || data.getFullYear() < 1300){
        document.getElementsByClassName("requerido")[3].style.display = 'block'
        document.getElementsByClassName("requerido")[3].innerHTML = 'Informe uma data corretamente'

    }else{
        document.getElementsByClassName("requerido")[3].style.display = 'none'
        let nascimento = digit2(data.getDate()+1) + '/' +digit2(data.getMonth()+1)+ '/' + data.getFullYear()
        document.getElementById("card_idade").innerHTML = nascimento
    }
}
//================================
function csalario(){
    salario = document.getElementById("salario").value
    if(isNaN(salario) || salario < 0){
        document.getElementsByClassName("requerido")[4].style.display = 'block'
        document.getElementsByClassName("requerido")[4].innerHTML = 'Informe corretamente o salário'
    }else{
        if(salario == ''){
            document.getElementsByClassName("requerido")[4].style.display = 'block'
            document.getElementsByClassName("requerido")[4].innerHTML = 'Informe o salário'
        }else
            document.getElementsByClassName("requerido")[4].style.display = 'none'
    }
    document.getElementById("card_salario").innerHTML = 'R$ '+salario
}
//========================
function cserasa(){
    pserasa = document.getElementById("serasa").value
    if(isNaN(pserasa) || pserasa == '' || pserasa < 0 || pserasa > 1000){
        document.getElementsByClassName("requerido")[5].style.display = 'block'
        document.getElementsByClassName("requerido")[5].innerHTML = 'Informe seus pontos corretamente'
    }else{
        document.getElementsByClassName("requerido")[5].style.display = 'none'
    }
    document.getElementById("card_serasa").innerHTML = pserasa
}
//=======================
function csenha(){
    senha = document.getElementById("isenha").value 
    if(senha == ''){
        document.getElementsByClassName('requerido')[6].style.display = 'block'
        document.getElementsByClassName('requerido')[6].innerHTML = 'Digite uma senha'
    }else{
        if(senha.length < 5){
            document.getElementsByClassName('requerido')[6].style.display = 'block'
            document.getElementsByClassName('requerido')[6].innerHTML = 'A senha deve conter mais de 5 caractere'
        }else{
            document.getElementsByClassName('requerido')[6].style.display = 'none'
        }
    }
}
function csenha2(){
    senha = document.getElementById("isenha").value 
    senha2 = document.getElementById("is2").value
    if(senha != senha2){
        document.getElementsByClassName('requerido')[7].style.display = 'block'
        document.getElementsByClassName('requerido')[7].innerHTML = 'As senhas são diferentes'
    }else
    document.getElementsByClassName('requerido')[7].style.display = 'none'
}
//========================
