function cadastrar(e){
    e.preventDefault()
    let nome = document.getElementById("inome").value
    //=======
    let email = document.getElementById("iemail").value
    //=========
    let cpf = document.getElementById("cpf").value 
    //========
    let data = document.getElementById("idade").value 
    data = new Date(data)
    data = digit2(data.getDate()+1) + '/' +digit2(data.getMonth()+1)+ '/' + data.getFullYear()
    //==============
    let salario = document.getElementById("salario").value
    //===========
    let serasa = document.getElementById("serasa").value
    //==========
    let senha = document.getElementById('isenha').value
    let senha2 = document.getElementById("is2").value
    //========
    let img = document.getElementById("img").files[0]
    let reader = new FileReader();
    reader.readAsDataURL(img);
    reader.onload = function () {
        // Aqui temos a sua imagem convertida em string em base64.
        console.log(reader.result);
    };
    let fotos = new Array()
    fotos['type'] = img.type
    fotos['size'] = img.size
    fotos['tmp_name'] = img.tmp_name
    console.log(fotos)

    //========
    let box = document.getElementById("icontrato")
    //==========
    if(!box.checked)
        document.getElementsByClassName("requerido")[8].style.display = 'block'
    else{
        document.getElementsByClassName("requerido")[8].style.display = 'none'
    }
    console.log('teste')

}
//===================================
function nomee(){
    let nome = document.getElementById("inome").value
    
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
    let salario = document.getElementById("salario").value
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
    let pserasa = document.getElementById("serasa").value
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
    let senha = document.getElementById("isenha").value 
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
    let senha = document.getElementById("isenha").value 
    let csenha = document.getElementById("is2").value
    if(senha != csenha){
        document.getElementsByClassName('requerido')[7].style.display = 'block'
        document.getElementsByClassName('requerido')[7].innerHTML = 'As senhas são diferentes'
    }else
    document.getElementsByClassName('requerido')[7].style.display = 'none'
}
//========================
