function carregar2(){
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
            valores = dados.split(" ")
            valores[0] = valores[0].replace("-", " ")
            
            document.getElementById("conteudo").style.display = 'flex'

            document.getElementById("card_nome").innerHTML = valores[0]
            document.getElementById("card_email").innerHTML = valores[1]
            document.getElementById("card_cpf").innerHTML = valores[2]
            document.getElementById("card_idade").innerHTML = valores[3]
            document.getElementById("card_salario").innerHTML = 'R$ '+valores[4]
            document.getElementById("card_serasa").innerHTML = valores[5]

            document.getElementById("inome").value = valores[0]
            document.getElementById("iemail").value = valores[1]
            document.getElementById("salario").value = valores[4]
            document.getElementById("serasa").value = valores[5]
            //=====
            document.getElementById("sair").innerHTML = 'Sair'
            document.getElementById("sair").removeAttribute('href')
            document.getElementById("sair").setAttribute('onclick', 'sairC()')
    
        }else{
            document.getElementById("conteudo").style.display = 'none'
            document.getElementById("sair").innerHTML = 'Logar'
            document.getElementById("sair").removeAttribute('onclick')
            document.getElementById("sair").setAttribute('href', 'logar.html')
        }
    }
    xhttp.open("GET", "server/sessoes.php", true);
    xhttp.send()

}
//===================
function alterar(e){
    let nome = document.getElementById("inome").value 
    let email = document.getElementById("iemail").value
    let salario = document.getElementById("salario").value
    let pserasa = document.getElementById("serasa").value

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() { 
        document.getElementById("dados").value = this.responseText;

        let existe = document.getElementById("dados").value
        if(existe == ''){
            window.location.href = 'suaConta.html'
        }
    }
    xhttp.open("POST", "server/alterar.php");
    // adiciona um header para a requisição HTTP
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // especifica os dados que deseja enviar   
    xhttp.send("nome="+nome+"&email="+email+"&salario="+salario+"&serasa="+pserasa);


    e.preventDefault()
}
//=========================
function sairC(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() { 
        document.getElementById("dados").innerHTML = this.responseText;
    
        let dados = document.getElementById("dados").innerHTML

        document.getElementById("conteudo").style.display = 'none'
        document.getElementById("sair").innerHTML = 'Logar'
        document.getElementById("sair").removeAttribute('onclick')
        document.getElementById("sair").setAttribute('href', 'logar.html')
    }
    xhttp.open("POST", "server/sessoes.php");
    // adiciona um header para a requisição HTTP
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // especifica os dados que deseja enviar   
    xhttp.send("sair=s");
    console.log('testando')
}
//================================
function csalario2(){
    salario = document.getElementById("salario").value
    if(isNaN(salario) || salario < 0){
        document.getElementsByClassName("requerido")[2].style.display = 'block'
        document.getElementsByClassName("requerido")[2].innerHTML = 'Informe corretamente o salário'
    }else{
        if(salario == ''){
            document.getElementsByClassName("requerido")[2].style.display = 'block'
            document.getElementsByClassName("requerido")[2].innerHTML = 'Informe o salário'
        }else
            document.getElementsByClassName("requerido")[2].style.display = 'none'
    }
    document.getElementById("card_salario").innerHTML = 'R$ '+salario
}
//========================
function cserasa2(){
    pserasa = document.getElementById("serasa").value
    if(isNaN(pserasa) || pserasa == '' || pserasa < 0 || pserasa > 1000){
        document.getElementsByClassName("requerido")[3].style.display = 'block'
        document.getElementsByClassName("requerido")[3].innerHTML = 'Informe seus pontos corretamente'
    }else{
        document.getElementsByClassName("requerido")[3].style.display = 'none'
    }
    document.getElementById("card_serasa").innerHTML = pserasa
}